@extends('my-layouts.template')

@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Add Sales Orders</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">List Sales Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Sales Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex">
                        {{-- <a class="btn btn-sm btn-success ms-auto" href="{{ route('orders.create') }}">Add Sales Orders</a> --}}
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{route('orders.store')}}">
                            @method('POST')
                            @csrf
                            <div class="form-group col-md-4">
                                <label class="form-label fw-bold" for="select-customer">Customer</label>
                                <select class="form-select" id="select-customer" name="customer" required>
                                    <option selected disabled>-> Choose Customer <-</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="invoice" class="form-label fw-bold">Inovice</label>
                                <input type="text" class="form-control" id="invoice" name="invoice" value="{{ $invoice }}" readonly required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date" class="form-label fw-bold">Purchase Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="table-responsive">
                                <table id="invoiceTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price / pcs</th>
                                            <th scope="col">Total Price</th>
                                            {{-- <th>Action</th> --}}
                                            {{-- <th scope="col"><a class=" mx-auto btn btn-sm btn-success addRow"><i class="bi bi-plus-circle-dotted"></i></a></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="products">
                                        <tr>
                                            <td>
                                                <select name="product[]" class="form-select productSelect" required>
                                                    <option selected disabled>-> Choose Product <-</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" min="1" name="qty[]" class="form-control qty" value="1" required></td>
                                            <td><input type="number" name="price[]" class="form-control price" readonly required></td>
                                            <td><input type="number" name="total_price[]" class="form-control tot-price" readonly required></td>
                                            {{-- <td><a class="btn btn-danger remove "> <i class="bi bi-trash3"></i></a></td> --}}
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <select name="product[]" class="form-select productSelect" required>
                                                    <option selected disabled>-> Choose Product <-</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" min="1" name="qty[]" class="form-control qty" value="1" required></td>
                                            <td><input type="number" name="price[]" class="form-control price" readonly required></td>
                                            <td><input type="number" name="total_price[]" class="form-control tot-price" readonly required></td>
                                            <td><a class="btn btn-danger remove "> <i class="bi bi-trash3"></i></a></td>
                                        </tr> --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Total Payment</td>
                                            <td colspan="2"><input type="number" name="total_payment" class="form-control total_payment" readonly></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
    
                            <div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
        //     $('#products').on('click', '.productSelect', function () {
        //         // alert("kena");
        //         $('.productSelect').find('option').not(':selected').remove();
        //         $.ajax({
        //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //             url:'/ajax-product',
        //             method: 'get',
        //             dataType: 'json',
        //             success: function(product){
        //                 // console.log(product);
        //                 $.each(product, function(key, value) {   
        //                     $(this).find('.productSelect')
        //                         .append($("<option></option>")
        //                                     .attr("value", value.id)
        //                                     .text(value.product)); 
        //                     });
        //             }
        //         })
        //     });

            $('#invoiceTable').on('change', '.productSelect', function () {
                const id = $('.productSelect').find(':selected').val();
                // console.log(id);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:'/ajax-product',
                    data: {id : id},
                    method: 'get',
                    dataType: 'json',
                    success: function(product){
                        console.log(product);
                        var count = $('.qty').val();
                        // console.log(count * product.price);
                        $('.price').val(product.price);
                        $('.tot-price').val(product.price * count);
                        $('.total_payment').val(product.price * count);
                    }
                })
            });

            // $('.tot-price').on('change', function(){
            //     var count = $('.qty').val();
            //     var price = $('.price').val();
            //     // console.log(count);
            //     $('.tot-price').val(price * count);

            // });

            $('.qty').on('change', function(){
                var count = $('.qty').val();
                var price = $('.price').val();
                // console.log(count);
                $('.tot-price').val(price * count);
                $('.total_payment').val(price * count);

            });

            $('.addRow').on('click', function () {
                addRow();
            });

            function addRow() {
                var addRow = 
                '<tr>\n' +
                    '<td><select class="form-select productSelect"><option selected disabled>-> Choose Product <-</option></select></td>\n' +
                    '<td><input type="number" min="1" name="qty[]" class="form-control qty" value="1"></td>\n' +
                    '<td><input type="number" name="price[]" class="form-control price" readonly></td>\n' +
                    '<td><input type="number" name="total_price[]" class="form-control tot-price" readonly></td>\n' +
                    '<td><a class="btn btn-danger remove "> <i class="bi bi-trash3"></i></a></td>\n' +
                '</tr>';
                $('tbody').append(addRow);
            };

            $('#invoiceTable').on('click', '.remove', function () {
                var l = $('tbody tr').length;
                // console.log(l);
                if(l==1){
                        alert('you cant delete last one')
                    }else{
                    $(this).parent().parent().remove();
                }

            });


            // $(".addCF").click(function(){
	        //     $("#customFields").append('<tr valign="top"><th scope="row"><label for="customFieldName">Custom Field</label></th><td><input type="text" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Input Name" /> &nbsp; <input type="text" class="code" id="customFieldValue" name="customFieldValue[]" value="" placeholder="Input Value" /> &nbsp; <a href="javascript:void(0);" class="remCF">Remove</a></td></tr>');
            // });
            // $("#customFields").on('click','.remCF',function(){
            //     $(this).parent().parent().remove();
            // });
        });

</script>
@endsection
