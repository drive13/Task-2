@extends('my-layouts.template')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Sales Orders</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Sales Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex">
                        <a class="btn btn-sm btn-success ms-auto" href="{{ route('customer.create') }}">Add Sales Orders</a>
                    </div>
                    <div class="card-body">
                    </div>
                    <!-- table striped -->
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Invoice</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Date</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $order->invoice }}</td>
                                        <td>{{ $order->customer_id }}</td>
                                        <td>{{ $order->product_id }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-warning" href="">Edit</a>
                                            <a class="btn btn-sm btn-danger" href="">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
