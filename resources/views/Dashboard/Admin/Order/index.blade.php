@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
    $segment = Request::segment(1);
    ?>
    <div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Direct Order</p>
                <h3 class="card-title">{{$directorders}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                  <a class="nav-link" href="{{ url(Request::segment(1), 'direct-order') }}">
                    <span class="sidebar-mini"> DO </span>
                    <span class="sidebar-normal">Direct </span>
                  </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                   <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Pending Order</p>
                <h3 class="card-title">{{$pendingorders}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                  <a class="nav-link" href="{{ url(Request::segment(1), 'pending-orders') }}">
                    <span class="sidebar-mini"> PO </span>
                    <span class="sidebar-normal">Pending </span>
                  </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Cancelled Order</p>
                <h3 class="card-title">{{$cancelledorders}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                  <a class="nav-link" href="{{ url(Request::segment(1), 'cancelled-orders') }}">
                    <span class="sidebar-mini"> CO </span>
                    <span class="sidebar-normal">Cancelled </span>
                  </a>
                </div>
            </div>
        </div>
    </div>


          <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Confirm Order</p>
                <h3 class="card-title">{{$confirmedorders}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                  <a class="nav-link" href="{{ url(Request::segment(1), 'confirmed-orders') }}">
                    <span class="sidebar-mini"> CO </span>
                    <span class="sidebar-normal">Confirm </span>
                  </a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                 <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Out For Delivery</p>
                <h3 class="card-title">{{$outForDelivery}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                   <a class="nav-link" href="{{ url(Request::segment(1), 'out-for-delivery') }}">
                     <span class="sidebar-mini"> OFD </span>
                    <span class="sidebar-normal">Out For Delivery </span>
                  </a>
                </div>
            </div>
        </div>
    </div>


     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                 <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category">Payment Fail</p>
                <h3 class="card-title">{{$paymentFail}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                   <a class="nav-link" href="{{ url(Request::segment(1), 'payment-fail') }}">
                     <span class="sidebar-mini"> PF </span>
                    <span class="sidebar-normal">Payment Fail </span>
                  </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                 <i class="fas fa-shopping-cart"></i>

                </div>
                <p class="card-category"> Delivered  Orders</p>
                <h3 class="card-title">{{$deliveredorders}}</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                  <a class="nav-link" href="{{ route(Request::segment(1) . '.' . 'delivered') }}">
                    <span class="sidebar-mini"> DD </span>
                    <span class="sidebar-normal">Delivered </span>
                  </a>
                </div>
            </div>
        </div>
    </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fas fas fa-cubes fa-2x"></i>
                    </div>
                    <h4 class="card-title">Orders</h4>
                </div>
                <div class="card-body">
                    <div class="material-datatables">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    @include('Dashboard.Admin.Order.table')
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
