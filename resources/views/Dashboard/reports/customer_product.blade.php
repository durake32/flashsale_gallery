@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fas fa-filter fa-2x"></i>
                    </div>
                    <h4 class="card-title">Filter</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.report.customer_product')}}" method="GET">
                        <div class="card-body row ">
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label for="user"> Customer</label>
                                    <select class="browser-default custom-select" name="user">
                                        <option selected disabled>Select customer</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" @if(request()->user == $user->id) selected @endif>{{ $user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label for="product"> Product</label>
                                    <select class="browser-default custom-select" name="product">
                                        <option selected disabled>Select product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" @if(request()->product == $product->id) selected @endif>{{ $product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="order"> Order Id</label>
                                    <input type="text" class="form-control" value="{{ request()->order}}" name="order" id="order">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="from_date"> From *</label>
                                    <input type="date" class="form-control" value="{{ request()->from_date}}" name="from_date" id="from_date" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="to_date"> To *</label>
                                    <input type="date" class="form-control" value="{{ request()->to_date}}" name="to_date" id="to_date" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="search_by"> Search By</label>
                                    <select class="browser-default custom-select" name="search_by">
                                        <option value="order_date">Order Date</option>
                                        <option value="delivery_date">Delivery Date</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="submit"></label>
                                    <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                                    <a href="{{ route('admin.report.customer_product')}}" class="btn btn-danger btn-sm text-white">Reset</a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fas fas fa-cubes fa-2x"></i>
                    </div>
                    <h4 class="card-title">Customer Product Report</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <p class="btn btn-success btn-sm">
                            Total Orders: {{ $order_products->count() }}
                        </p>
                        <p class="btn btn-info btn-sm">
                            Total Amount: Rs. {{ $total_amt }}
                        </p>
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
                                    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                                    <thead>
                                        <tr role="row">
                                            <th></th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                Order Id
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                Order Type
                                            </th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                Customer
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Product Name
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Regular Price
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Wholesale Price
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Selling Price
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Quantity
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Total
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                                                aria-label="Date: activate to sort column ascending">Ordered At
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                                            aria-label="Date: activate to sort column ascending">Delivered At
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($order_products as $order_product)
                                                <tr role="row" class="odd">
                                                    <td></td>
                                                    <td>{{ $order_product->order?->random_id }}</td>
                                                    <td>{{ $order_product->order?->order_type == 'customer_added' ? 'On-line' : 'Off-line' }}</td>
                                                    <td>{{ $order_product->order?->user->name ?? '' }}</td>
                                                    <td>{{ $order_product->product_name }} </td>
                                                    <td>  Rs. {{ $order_product->product->regular_price }} </td>
                                                    <td>  Rs. {{ $order_product->wholesaler_price }} </td>
                                                    <td>  Rs. {{ $order_product->price }} </td>
                                                    <td>{{ $order_product->quantity }} </td>
                                                    <td>  Rs. {{ $order_product->quantity * $order_product->price }} </td>
                                                    <td>{{ !is_null($order_product->order?->order_date) ? date('M d, Y',strtotime($order_product->order->order_date)) : '---'}}</td>
                                                    <td>{{ !is_null($order_product->order?->delivery_date) ? date('M d, Y',strtotime($order_product->order->delivery_date)) : '---'}}</td>
                                                </tr>
                                            @endforeach

                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection