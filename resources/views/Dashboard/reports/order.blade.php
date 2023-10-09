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
                    <form action="{{ route('admin.report.order')}}" method="GET">
                        <div class="card-body row ">
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="user"> Customer</label>
                                    <select class="browser-default custom-select" name="user">
                                        <option selected disabled>Select customer</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"> @if(request()->user == $user->id) selected @endif{{ $user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="order_type"> Order Type</label>
                                    <select class="browser-default custom-select" name="order_type">
                                        <option selected disabled>Select order type</option>
                                        <option value="customer_added" @if(request()->order_type == 'customer_added') selected @endif>Online</option>
                                        <option value="admin_added" @if(request()->order_type == 'admin_added') selected @endif>Offline</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="payment_type"> Payment Type</label>
                                    <select class="browser-default custom-select" name="payment_type">
                                        <option selected disabled>Select payment type</option>
                                        @foreach($payments as $payment)
                                            <option value="{{ $payment->id }}" @if(request()->payment_type == $payment->id) selected @endif>{{ $payment->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="status"> Order Status</label>
                                    <select class="browser-default custom-select" name="status">
                                        <option selected value="">Select status</option>
                                        <option value="1" @if(request()->status == "1") selected @endif>Complete</option>
                                        <option value="2" @if(request()->status == "2") selected @endif>Cancelled</option>
                                        <option value="3" @if(request()->status == "3") selected @endif>Delivered</option>
                                        <option value="4" @if(request()->status == "4") selected @endif>Out For Delivery</option>
                                        <option value="5" @if(request()->status == "5") selected @endif>Confirmed</option>
                                        <option value="6" @if(request()->status == "6") selected @endif>Order Fail</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group bmd-form-group">
                                    <label for="assign_to"> Assigned To</label>
                                    <select class="browser-default custom-select" name="assign_to">
                                        <option selected disabled>Select assigned to user</option>
                                        @foreach($assigned_users as $user)
                                            <option value="{{ $user->id }}" @if(request()->assign_to == $user->id) selected @endif>{{ $user->name}}</option>
                                        @endforeach
                                    </select>
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
                                    <a href="{{ route('admin.report.order')}}" class="btn btn-danger btn-sm text-white">Reset</a>
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
                    <h4 class="card-title">Order Report</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <p class="btn btn-success btn-sm">
                            Total Orders: {{ $orders->count()}}
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
                                                aria-label="Position: activate to sort column ascending">Assign To
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Delivery Charge
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Total without Charge
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                                                aria-label="Position: activate to sort column ascending">Total
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 200px;"
                                                aria-label="Position: activate to sort column ascending">Payment Status
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 200px;"
                                                aria-label="Position: activate to sort column ascending">Order Status
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
                                        @foreach ($orders as $order)
                                        <tr role="row" class="odd">
                                            <td>{{ $order->random_id }}</td>
                                            <td>{{ $order->order_type == 'customer_added' ? 'On-line' : 'Off-line' }}</td>

                                            <td>{{ $order->user->name ?? '' }}</td>
                                            <td>{{ $order->adminUser->name ?? '---' }}</td>
                                            <td>Rs. {{ $order->delivery_charge }} </td>
                                            <td>  Rs. {{ ($order->total_amount - $order->delivery_charge) }} </td>
                                            <td>  Rs. {{ $order->total_amount }} </td>
                                            <td> {{ $order->order_details['payment'] }}</td>
                                            <td>{{ $order->my_order_status['message'] }}</td>
                                            <td>{{ !is_null($order->order_date) ? date('M d, Y',strtotime($order->order_date)) : '---'}}</td>
                                            <td>{{ !is_null($order->delivery_date) ? date('M d, Y',strtotime($order->delivery_date)) : '---'}}</td>
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