@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fas fas fa-cubes fa-2x"></i>
                    </div>
                    <h4 class="card-title">Direct Orders</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                        @can('direct-category view')
                            <a href="{{route('admin.directCategory.index')}}" class="btn btn-success btn-sm">
                                Direct Order Category
                            </a>
                        @endcan
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    @include('Dashboard.Admin.Direct-Order.table')
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