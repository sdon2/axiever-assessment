<?php
namespace App\Http\Controllers;

use App\DataTables\SalesOrdersDataTable;
use App\Models\SalesOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SalesOrderController extends Controller
{
    public function index(SalesOrdersDataTable $dataTable, Request $request)
    {
        if ($request->ajax()) {

            $data = SalesOrder::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Customer', 'customer_name')
                ->editColumn('order_date', function ($row) {
                    return Carbon::parse($row->order_date)->format('d/m/Y');
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->diffForHumans();
                })
                ->editColumn('items', function ($row) {
                    return $row->products->sum('quantity');
                })
                ->addColumn('status', function ($row) {
                    switch ($row->status) {
                        case 'pending':
                            return '<span class="badge text-dark bg-warning">Pending</span>';
                        case 'completed':
                            return '<span class="badge text-dark bg-success">Completed</span>';
                        case 'cancelled':
                            return '<span class="badge text-dark bg-danger">Cancelled</span>';
                        default:
                            return '<span class="badge text-dark bg-secondary">Unknown</span>';
                    }
                })
                ->addColumn('actions', function ($row) {
                    return view('salesOrders.actions', compact('row'));
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }
        return $dataTable->render('salesOrders.index');
    }

    public function show(SalesOrder $salesOrder)
    {
        return view('salesOrders.show', compact('salesOrder'));
    }

    public function create()
    {
        return view('salesOrders.create');
    }

    public function edit(SalesOrder $salesOrder)
    {
        return view('salesOrders.edit', compact('salesOrder'));
    }

    public function download(SalesOrder $salesOrder)
    {
        $pdf = Pdf::loadView('salesOrders.download', compact('salesOrder'));
        return $pdf->stream('Sales-Order-' . $salesOrder->id . '.pdf');
    }

    public function destroy(SalesOrder $salesOrder)
    {
        try {
            DB::beginTransaction();

            if ($salesOrder->status == 'completed') {
                foreach ($salesOrder->products as $product) {
                    $product->product->increment('stock', $product->quantity);
                }
            }

            $salesOrder->delete();

            DB::commit();

            return redirect()->route('salesOrders.index')->with('success', 'Sales Order deleted successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete Sales Order: ' . $e->getMessage());
        }
    }
}
