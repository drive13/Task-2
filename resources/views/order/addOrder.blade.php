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
                                            <th scope="col"><a class=" mx-auto btn btn-sm btn-success addRow"><i class="bi bi-plus-circle-dotted"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="products">
                                        <tr>
                                            <td>
                                                <select name="product[]" class="form-select productSelect" required>
                                                    <option selected disabled>-> Choose Product <-</option>
                                                    {{-- @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </td>
                                            <td><input type="number" min="1" name="qty[]" class="form-control qty" value="0" required></td>
                                            <td><input type="number" name="price[]" class="form-control price" readonly required></td>
                                            <td><input type="number" name="total_price[]" class="form-control tot-price" readonly required></td>
                                            <td><a class="btn btn-danger remove "> <i class="bi bi-trash3"></i></a></td>
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
                                    {{-- <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Total Payment</td>
                                            <td colspan="2"><input type="number" name="total_payment" class="form-control total_payment" readonly></td>
                                        </tr>
                                    </tfoot> --}}
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
            $('#products').on('click', '.productSelect', function (e) {
                
                // $(this).e.target.
                $(this).find('option').not(':selected').remove();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:'/ajax-product',
                    method: 'get',
                    dataType: 'json',
                    success: function(product){
                        $.each(product, function(key, value) {   
                            $(e.target).append($("<option></option>")
                                            .attr("value", value.id)
                                            .text(value.product)); 
                            });
                    }
                })
            });

            $('#products').on('change', '.productSelect', function (e) {
                const id = $(this).find(':selected').val();
                let self = this;
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:'/ajax-product',
                    data: {id : id},
                    method: 'get',
                    dataType: 'json',
                    success: function(product){
                        $(self.parentElement.parentElement).find('.qty').val(0);
                        $(self.parentElement.parentElement).find('.price').val(product.price);
                        // $(self.parentElement.parentElement).find('.tot-price').val(product.price);
                    }
                });
            });

            // $('.tot-price').on('change', function(){
            //     var count = $('.qty').val();
            //     var price = $('.price').val();
            //     // console.log(count);
            //     $('.tot-price').val(price * count);

            // });

            $('#products').on('change', '.qty',function(e){
                // const countPayment = $('#products .tot-price').each(function(){
                    
                // });
                // const totalPayment = $('#products .total_payment');
                let pricePcs = $(this.parentElement.parentElement).find('.price').val();
                let qty = $(this.parentElement.parentElement).find('.qty').val();
                $(this.parentElement.parentElement).find('.tot-price').val(qty * pricePcs);

                // console.log(countPayment);
                // countPayment.each(function(){
                //     count += countPayment.val();
                // });
                // console.log(count);
            });


            $('.addRow').on('click', function () {
                addRow();
            });

            function addRow() {
                var addRow = 
                '<tr>\n' +
                    '<td><select class="form-select productSelect" name="product[]"><option selected disabled>-> Choose Product <-</option></select></td>\n' +
                    '<td><input type="number" min="1" name="qty[]" class="form-control qty" value="0"></td>\n' +
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

        });

</script>
{{-- <script>
    const table = document.getElementById('invoiceTable');
    const total_payment = document.querySelector('.total_payment');
    // console.log(total_payment);
    
    table.addEventListener('change', function(e){
        const total = document.querySelectorAll('.tot-price');
        total.forEach(element => {
            
        });
        console.log(totalBayar);
        // total_payment.value = totalBayar;
    });
</script> --}}
@endsection
