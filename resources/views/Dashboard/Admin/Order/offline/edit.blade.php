@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <form role="form" action="{{ route('admin.offlineorders.update',$order->id)}}" method="POST">
        @csrf
        @method('PUT')
        @if ($errors->any())
        <div class="alert alert-danger col-md-12">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="far fa-file-alt fa-2x"></i>
                        </div>

                        <h4 class="card-title">
                            Offline Order
                        </h4>
                    </div>
                    <div class="card-body row ">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group">
                                <label for="user_idord"> Customer *</label>
                                <select class="browser-default custom-select" name="user_id" disabled>
                                    <option selected value="">Select customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" @if($customer->id == $order->user_id) selected
                                        @endif >{{ $customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label for="order_date"> Order Date *</label>
                                <input type="date" class="form-control" value="{{ $order->order_date}}"
                                    name="order_date" id="order_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label for="order_status"> Order Status *</label>
                                <select class="browser-default custom-select" name="order_status">
                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Complete</option>
                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Cancelled</option>
                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Delivered</option>
                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Out For Delivery
                                    </option>
                                    <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Confirmed</option>
                                    <option value="6" {{ $order->status == 6 ? 'selected' : '' }}>Order Fail</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label for="delivery_date"> Delivery Date *</label>
                                <input type="date" class="form-control" value="{{ $order->delivery_date}}"
                                    name="delivery_date" id="delivery_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label for="delivery_charge"> Delivery Charge *</label>
                                <input type="text" class="form-control" value="{{ $order->delivery_charge}}"
                                    name="delivery_charge" id="delivery_charge">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label for="user_idord"> Assign Order To </label>
                                <select class="browser-default custom-select" name="assign_user">
                                    <option selected value="">Select User</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id == $order->assign_user_id) selected
                                        @endif >{{ $user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <p class="text-danger">Note: Here, Admin can only update product quantity and selling price.</p>
                <table class="table table-striped table-bordered table-hover table-checkable order-column table-100">
                    <thead>
                        <tr>
                            <th class="desktop" style="width: 30%">Product Name</th>
                            <th class="desktop" style="width: 20%">Unit Price</th>
                            <th class="desktop" style="width: 20%">Selling Price</th>
                            <th class="desktop" style="width: 20%">Quantity</th>
                            <th class="desktop" style="width: 20%">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr></tr>
                        @foreach($orderProducts as $key=> $order_product)
                        <input type="hidden" name="orderproduct[{{$key}}]" id="orderproduct-{{$key}}"
                            value="{{ $order_product['orderproduct_id']}}">
                        <tr>
                            <td>
                                <div class="form-group" style="margin-left: 5px;margin-right: 5px;">
                                    <select class="form-control productType" id="selectProduct"
                                        name="product[{{$key}}]" required>
                                        <option value="{{ $order_product['product_id']}}">
                                            {{ $order_product['product_name']}}
                                        </option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <input type="number" class="form-control quantityPrice-{{$key}}" value=""
                                    id="priceQuantity" name="product_price[{{$key}}]" readonly>
                            </td>
                            <td>
                                <input type="number" class="form-control sell_price-{{$key}}"
                                    name="sell_price[{{$key}}]" min="0" value="">
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6"><input type="number" id="" value="" style="width: 100px"
                                            min="0" max="" class="form-control productQuantity-{{$key}}"
                                            name="product_quantity[{{$key}}]" required>
                                    </div>
                                    <div class="col-md-6" style="padding: 10px;"><span class="quantityData font-bold"
                                            id="dataQuantity"></span>
                                    </div>
                                </div>
                            </td>

                            <td><input type="number" class="form-control subTotal-{{$key}}" id="amountTotal-{{$key}}"
                                    name="amount[{{$key}}]" min="0" value="" readonly>
                            </td>

                            <td>
                                <a class="font-bold removeData{{$key}}" style="font-size: 20px;"><i class="fa fa-trash"
                                        style="color: red"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="totalValue">
                    <div class="row">
                         <div class="col-md-6 col-sm-12">
                            <a class="btn btn-info btn-sm addNew"><i class="fa fa-plus"></i> Add</a>
                            <span class="count" style="display: none;">0</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="row">
                                <div class="total font-bold" align="center" style="font-size: 18px;">Total
                                    :
                                    <input type="number"
                                        style="width: 40%; border: none; background: #fff; margin-top: -31px; text-align: right; margin-left: 80px; font-size: 18px;"
                                        name="total" value="0" class="form-control totalSum" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer" style="display: block;">
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
@endsection
@section('js')
<script>

  /* product select and list the availability and other info */
  $("select#selectProduct").change(function () {
        let selectedProduct = $(this).children("option:selected").val();
        @foreach($products as $product)
            items = <?php echo $product->id;  ?>;
        if (items == selectedProduct) {
            $('.quantityData').empty();
            $('.quantityData').append(`
                        ( {{$product->allowed_quantity}} left )
                    `);
            $('.quantityPrice').css('text-align', 'center').val({{$product->regular_price}});
            $('.productQuantity').attr('max',{{ $product->allowed_quantity }})
            $('.productQuantity').keyup(function () {
                var amountTotal = parseInt($('#amountTotal').val(), 10);
                var totalAmount = (parseInt($('.totalSum').val(), 10) - amountTotal);
                let quantities = $(this).val();
                let prices = $('.sell_price').val(); //selling price
                let subTotal = (prices * quantities);
                total = (subTotal + totalAmount);
                $('#amountTotal').val(parseInt(subTotal), 10);
                $('.totalSum').val(total);
            });
            $('.sell_price').keyup(function () {
                    let quantities = $('.productQuantity').val();
                    let prices = $(this).val();
                    let subTotal = (prices * quantities);
                    $('#amountTotal').val(subTotal);
                    $('.totalSum').val(subTotal);
                });
        }
        @endforeach
    });

    $(".addNew").click(function () {

        $('.count').html(function (i, val) {
            return val * 1 + 1
        });
        let counter = $('.count').text();
        $('#tableBody tr:last').after(`
                <tr>
                    <td>
                        <div class="form-group" style="margin-left: 5px;margin-right: 5px;">
                            <select class="bs-select form-control custom-select productType${counter}" id="productType" name="product[]" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
        <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
        </select>
            </div>
        </td>
        <td>
    <input type="number" class="form-control quantityPrice${counter}" name="product_price[]" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control sell_price${counter}" min="0" name="sell_price[]" value="0" >
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-6"><input type="number" style="width: 100px" min="0" max="" class="form-control productQuantity${counter}" name="product_quantity[]" required></div>
                            <div class="col-md-6" style="padding: 10px;"><span class="quantityData${counter} font-bold"></span></div>
                        </div>
                    </td>
                    <td><input type="number" class="form-control subTotal" name="amount[]" min="0" id="amountTotal${counter}" value="0" readonly></td>
                    <td>
                        <a class="font-bold removeData${counter}" style="font-size: 20px;"><i class="fa fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
        `);

        $('select.custom-select').select2();
        /* product select and list the availability and other info */
        $("select.productType" + counter).change(function () {
            let selectedProduct = $(this).children("option:selected").val();
            @foreach($products as $product)
            items = <?php echo $product->id;  ?>;
            if (items == selectedProduct) {
                $('.quantityData' + counter).empty();
                $('.quantityData' + counter).append(`
                        ({{$product->allowed_quantity}} left )
                    `);
                $('.quantityPrice' + counter).css('text-align', 'center').val({{$product->regular_price}});
                $('.productQuantity'+counter).attr('max', {{ $product->allowed_quantity}});
                $('.productQuantity' + counter).keyup(function () {
                    var amountTotal = parseInt($('#amountTotal' + counter).val(), 10);
                    var totalAmount = (parseInt($('.totalSum').val(), 10) - amountTotal);
                    let quantities = $(this).val();
                    let prices = $('.sell_price' + counter).val();
                    let subTotal = (prices * quantities);
                    total = (totalAmount + subTotal);
                    $('input[name="total"]').val(total);
                    $('#amountTotal' + counter).val(subTotal);
                });
                $('.sell_price' + counter).keyup(function () {
                        amountTotal = parseInt($('#amountTotal' + counter).val(), 10);
                        totalAmount = (parseInt($('.totalSum').val(), 10) - amountTotal);
                        let quantities = $('.productQuantity' + counter).val();
                        let prices = $(this).val();
                        let subTotal = (prices * quantities);
                        total = (totalAmount + subTotal);
                        $('input[name="total"]').val(total);
                        $('#amountTotal' + counter).val(subTotal);
                    });

            }
            @endforeach
        });
        $('.removeData' + counter).on('click', function () {
                total = (parseInt($('.totalSum').val(), 10) - parseInt($('#amountTotal' + counter).val(), 10));
                $('input[name="total"]').val(total);
                $(this).closest('tr').remove();
            }
        );
    });

</script>
<script>
    var total = 0;
    @foreach($orderProducts as $key => $order_product)
        total1 = 0;
        $('.quantityData').empty();
        $('.quantityPrice-' + {{$key}}).css('text-align', 'center').val({{
            $orderProducts[$key]['product_price']
        }});
        $('.productQuantity-' + {{$key}}).css('text-align', 'center').val({{
            $orderProducts[$key]['qty']}});
        $('.sell_price-' + {{$key}}).css('text-align', 'center').val({{
            $orderProducts[$key]['price'] }});
        $('.subTotal-' + {{ $key }}).css('text-align', 'center').val({{
            $orderProducts[$key]['total']
        }});
        $('.totalSum').val({{
            $order->total_amount - $order->delivery_charge
        }});

        $('.productQuantity-' + {{$key }}).keyup(function() {
            var amountTotal = parseInt($('#amountTotal-' + {{$key}}).val(), 10);
            console.log('totalamt', amountTotal)
            var totalAmount = (parseInt($('.totalSum').val(), 10) - amountTotal);
            let quantities = $(this).val();
            let prices = $('.sell_price-' + {{$key}}).val();
            let subTotal = (prices * quantities);
            console.log('subtotal', subTotal)
            console.log('totalAmount', totalAmount)

            total = (subTotal + totalAmount);
            $('#amountTotal-' + {{ $key }}).val(parseInt(subTotal), 10);
            $('.totalSum').val(total);
        });

        $('.sell_price-' + {{$key}}).keyup(function() {
            amountTotal = parseInt($('#amountTotal-' + {{$key}}).val(), 10);
            totalAmount = (parseInt($('.totalSum').val(), 10) - amountTotal);
            let quantities = $('.productQuantity-' + {{$key}}).val();
            let prices = $(this).val();
            let subTotal = (prices * quantities);
            total = (totalAmount + subTotal);
            $('input[name="total"]').val(total);
            $('#amountTotal-' + {{$key }}).val(subTotal);
        });

         $('.removeData' + {{$key}}).on('click', function () {
            let orderProductId = $('#orderproduct-' + {{$key}}).val();
            $.ajax({
                url: '/admin/offline-orders/remove-product-items/'+orderProductId,
                type: 'GET',
                data: {},
                success: function (data) {
                    old_total = parseInt($('.totalSum').val(), 10);
                    remove_amt = $('#amountTotal-' + {{$key}}).val();
                    total = old_total - remove_amt;
                    // console.log('#total',total ,old_total, remove_amt)
                    $('input[name="total"]').val(total);
                    $(this).closest('tr').remove();
                    location.reload();
                },
                error: function (error) {
                },
            });
            }
        );

@endforeach
</script>
@endsection