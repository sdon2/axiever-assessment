<?php
namespace App\Livewire;

use App\Models\Product;
use App\Models\SalesOrder as SalesOrderModel;
use App\Models\SalesOrderProduct;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SalesOrder extends Component
{
    public $id;
    public $order_date;
    public $customer_name;
    public $orderProducts = [];

    public $products = [];

    public $status;

    public $viewMode = false;

    public function mount($salesOrder = null, $viewMode = false)
    {
        $this->viewMode = $viewMode;

        if ($salesOrder) {
            $this->id            = $salesOrder->id;
            $this->order_date    = $salesOrder->order_date;
            $this->customer_name = $salesOrder->customer_name;

            $this->status = $salesOrder->status;

            $this->orderProducts = collect($salesOrder->products)->map(function ($product) {
                return [
                    'product_id' => $product->product_id,
                    'quantity'   => $product->quantity,
                    'price'      => $product->price,
                ];
            })->toArray();
        } else {
            $this->order_date    = now()->format('Y-m-d'); // Default to today's date
            $this->customer_name = '';
            $this->orderProducts = [];
            $this->addProduct(); // Start with one product entry
        }

        // Load products for the dropdown
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Product::query()->orderBy('name')->get(); // Fetch or set your products here
    }

    public static $rules = [
        'order_date'                 => ['required', 'date_format:Y-m-d'],
        'customer_name'              => ['required', 'string', 'max:255'],
        'orderProducts'              => ['required', 'array'],
        'status'                     => ['required', 'in:completed,cancelled'],
        'orderProducts.*.product_id' => ['required', 'integer', 'exists:products,id'],
        'orderProducts.*.quantity'   => ['required', 'numeric', 'min:1'],
        'orderProducts.*.price'      => ['required', 'numeric', 'min:1'],
    ];

    public function rules()
    {
        return self::$rules;
    }

    protected function validationAttributes()
    {
        return [
            'order_date'                 => 'Order Date',
            'customer_name'              => 'Customer Name',
            'orderProducts'              => 'Order Products',
            'orderProducts.*.product_id' => 'Product',
            'orderProducts.*.quantity'   => 'Quantity',
            'orderProducts.*.price'      => 'Price',
        ];
    }

    public function save()
    {
        $data = $this->validate();

        // Logic to store the sales order
        try {
            DB::beginTransaction();

            $salesOrderData               = collect($data)->only(['order_date', 'customer_name', 'status'])->toArray();
            $salesOrderData['created_by'] = auth()->user()->id; // Assuming you want to track who created the order

            if ($this->id) {
                $salesOrder = SalesOrderModel::findOrFail($this->id);
                $salesOrder->update($salesOrderData);

                if ($salesOrder->status === 'completed') {
                    // If the order is completed, you need to update stock
                    foreach ($data['orderProducts'] as $orderProduct) {
                        $product = Product::find($orderProduct['product_id']);
                        if ($product) {
                            $product->decrement('stock', $orderProduct['quantity']);
                        }
                    }
                }

            } else {
                $salesOrder = SalesOrderModel::create($salesOrderData);
            }

            // Clear existing products if updating
            if ($this->id) {
                SalesOrderProduct::query()->where('sales_order_id', $salesOrder->id)->delete();
            }

            foreach ($data['orderProducts'] as $orderProduct) {
                SalesOrderProduct::query()->create($orderProduct + ['sales_order_id' => $salesOrder->id]);
            }

            DB::commit();

            session()->flash('success', 'Sales Order created successfully.');
            return $this->redirectRoute('salesOrders.index');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to create Sales Order: ' . $e->getMessage());
            return $this->redirectRoute('salesOrders.index');
        }
    }

    public function removeProduct($index)
    {
        array_splice($this->orderProducts, $index, 1);
    }

    public function addProduct()
    {
        $this->orderProducts[] = [
            'product_id' => null,
            'quantity'   => 1,
            'price'      => 0.00,
        ];
    }

    public function updatePrice($index)
    {
        $productId = $this->orderProducts[$index]['product_id'];
        $product   = Product::find($productId);

        $this->orderProducts[$index]['price'] = $product ? $product->price : 0;
    }

    public function render()
    {
        return view('livewire.sales-order');
    }
}
