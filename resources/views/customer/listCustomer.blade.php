@extends('my-layouts.template')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Customers</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Customers</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h4>Error!!</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{!! $message !!}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex">
                        <a class="btn btn-sm btn-success ms-auto addCustomer" href="#" data-bs-toggle="modal" data-bs-target="#modalCustomer">Add Customers</a>
                    </div>
                    <div class="card-body">
                    </div>
                    <!-- table striped -->
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $index => $customer)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-warning editCustomer" href="#" data-id="{{ $customer->id }}" data-bs-toggle="modal" data-bs-target="#modalCustomer">Edit</a>
                                            <form action="/customer/{{ $customer->id }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
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

    <!-- Modal -->
    <div class="modal fade" id="modalCustomer" tabindex="-1" aria-labelledby="modalCustomerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCustomerLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formModal" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Customer name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" class="form-control" name="phone" placeholder="Customer phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control" name="address" placeholder="Customer address" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('.addCustomer').on('click', function() {
                $('#name').val('');
                $('#phone').val('');
                $('#address').val('');
                // console.log('oke');
                $('#modalCustomerLabel').html('Add Customer');
                $('#formModal').append('<input type="hidden" name="_method" value="POST">');
                $('.modal-footer button[type=submit]').html('Save');
                $('.modal-content form').attr('action', '/customer');
            })

            $('.editCustomer').on('click', function() {
                const id = $(this).data('id');
                // console.log(id);
                
                $('#modalCustomerLabel').html('Edit Customer');
                $('#formModal').append('<input type="hidden" name="_method" value="PATCH">');
                $('.modal-footer button[type=submit]').html('Save Changes');
                $('.modal-content form').attr('action', '/customer/' + id);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:'/ajax-customer',
                    data: {id : id},
                    method: 'post',
                    dataType: 'json',
                    success: function(customer){
                        // console.log(customer);
                        $('#name').val(customer.name);
                        $('#phone').val(customer.phone);
                        $('#address').val(customer.address);
                    }
                })
            })

        })
    </script>
@endsection
