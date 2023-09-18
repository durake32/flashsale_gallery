@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fas fa-users-cog fa-2x"></i>
                    </div>
                    <h4 class="card-title">Customers</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                        @can('customer create')
                            <a href="{{route('customer.create')}}" class="btn btn-success btn-sm">
                                Create
                            </a>
                        @endcan

                        <a href="{{route('admin.customerDeactive')}}" class="btn btn-danger btn-sm">
                            Inactive Customer
                        </a>

                        <a href="{{route('admin.customer_types.index')}}" class="btn btn-info btn-sm">
                            Customer Type
                        </a>
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    @include('Dashboard.Admin.Customer.table')
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