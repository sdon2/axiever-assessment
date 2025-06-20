<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Livewire\SalesOrder as SalesOrderLivewire;
use App\Models\SalesOrder;
use App\Models\SalesOrderProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function show($id)
    {
        $salesOrder = SalesOrder::query()->with('products')->where('id', $id)->first()->toArray();

        return response()->json($salesOrder);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            SalesOrderLivewire::$rules
        );

        // Logic to store the sales order
        try {
            DB::beginTransaction();

            $salesOrderData               = collect($data)->only(['order_date', 'customer_name', 'status'])->toArray();
            $salesOrderData['created_by'] = auth()->user()->id; // Assuming you want to track who created the order

            $salesOrder = SalesOrder::create($salesOrderData);

            foreach ($data['orderProducts'] as $orderProduct) {
                SalesOrderProduct::query()->create($orderProduct + ['sales_order_id' => $salesOrder->id]);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Sales Order created successfully.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create Sales Order: ' . $e->getMessage(), 500]);
        }
    }
}
