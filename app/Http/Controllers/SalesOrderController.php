<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.listSalesOrder', [
            'title' => 'List Sales Orders',
            'orders' => SalesOrder::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = SalesOrder::latest()->first();
        if ($invoice == null) {
            $newInv = 'INV/' . date('Y-m-d') . '/' . '0001';
        } else {
            $explode = explode("/", $invoice->invoice);
            $newInv = 'INV/' . date('Y-m-d') . '/' . intval($explode[2]) + 1;
        }
        // dd($newInv);
        return view('order.addORder', [
            'title' => 'Add Order',
            'customers' => Customer::all(),
            'invoice' => $newInv,
            'products' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        DB::transaction(function () use ($request) {
            $salesOrder = SalesOrder::create([
                'invoice' => $request->invoice,
                'customer_id' => $request->customer,
                'date' => $request->date,
                'total_payment' => '600000',
            ]);

            for ($i = 0; $i < count($request->product); $i++) {
                $salesOrder->details()->create([
                    'product_id' => $request->product[$i],
                    'qty' => $request->qty[$i],
                    'total' => $request->total_price[$i],
                ]);
                $stockUpdate = Product::where('id', $request->product[$i])->first();
                // dd($request->product[$i], $stockUpdate);

                $stockUpdate->stock = $stockUpdate->stock - $request->qty[$i];
                $stockUpdate->save();
            }
        });




        return redirect('/orders')->with('success', 'New order has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalesOrderRequest  $request
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalesOrderRequest $request, SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }
}
