<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Models\Customer;

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
        $explode = explode("/", $invoice->invoice);
        $newInv = 'INV/' . date('Y-m-d') . '/' . intval($explode[2]) + 1;
        // dd($newInv);
        return view('order.addORder', [
            'title' => 'Add Order',
            'customers' => Customer::all(),
            'invoice' => $newInv,
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

        //validate order data
        // $validateDataOrder = $request->validate([
        //     'invoice' => 'required',
        //     'customer_id' => 'required',
        //     'date' => 'required',
        //     'total_payment' => 'required',
        // ]);

        $salesOrder = SalesOrder::create([
            'invoice' => $request->invoice,
            'customer_id' => $request->customer,
            'date' => $request->date,
            'total_payment' => '600000',
        ]);

        foreach ($request->product as $index => $product) {
            $salesOrder->order_details()->create([
                'product_id' => $request->product[$index],
                'qty' => $request->qty[$index],
                'total' => $request->total_price[$index],
            ]);
            $index + 1;
        }
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
