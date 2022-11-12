@extends('my-layouts.template')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Product</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Product</li>
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
                        <a class="btn btn-sm btn-success ms-auto tambahProduct" href="#" data-bs-toggle="modal" data-bs-target="#modalProduct">Add Product</a>
                    </div>
                    <div class="card-body">
                    </div>
                    <!-- table striped -->
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Code Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $product->product }}</td>
                                        <td>{{ $product->code_product }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-warning editProduct" href="javascript:void(0)" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#modalProduct">Edit</a>
                                            {{-- <a class="btn btn-sm btn-danger" href="">Delete</a> --}}
                                            <form action="/product/{{ $product->id }}" method="post" class="d-inline">
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
    <div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="modalProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formModal" action="" method="POST">
                    @csrf
                    {{-- @method('PATCH') --}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product">Product</label>
                            <input type="text" id="product" class="form-control" name="product" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="code_product">Code Product</label>
                            <input type="text" id="code_product" class="form-control" name="code_product" placeholder="Code Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" id="price" class="form-control" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" class="form-control" name="stock" placeholder="Stock" required>
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
            $('.tambahProduct').on('click', function() {
                $('#product').val('');
                $('#code_product').val('');
                $('#price').val('');
                // console.log('oke');
                $('#modalProductLabel').html('Add Product');
                // $('#formModal').attr('method', 'POST');
                $('#formModal').append('<input type="hidden" name="_method" value="POST">');
                $('.modal-footer button[type=submit]').html('Save');
                $('.modal-content form').attr('action', '/product');
            })

            $('.editProduct').on('click', function() {
                const id = $(this).data('id');
                // console.log(id);
                
                $('#modalProductLabel').html('Edit Product');
                // $('#formModal').attr('method', 'PATCH');
                $('#formModal').append('<input type="hidden" name="_method" value="PATCH">');
                $('.modal-footer button[type=submit]').html('Save Changes');
                $('.modal-content form').attr('action', '/product/' + id);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:'/ajax-product',
                    data: {id : id},
                    method: 'post',
                    dataType: 'json',
                    success: function(product){
                        console.log(product);
                        $('#product').val(product.product);
                        $('#code_product').val(product.code_product);
                        $('#price').val(product.price);
                        $('#stock').val(product.stock);
                    }
                })
            })

        })
    </script>
@endsection
