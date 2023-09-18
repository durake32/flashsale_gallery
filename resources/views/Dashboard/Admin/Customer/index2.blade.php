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
                        @can('customer view')
                        <button>
                            <a href="{{route('customer.index')}}">
                                Customer List
                            </a>
                        </button>
                        @endcan
                        <button>
                            <a href="{{route('admin.customerDeactive')}}">
                                Inactive Customer
                            </a>
                        </button>
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatables"
                                        class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                                        cellspacing="0" width="100%" style="width: 100%;" role="grid"
                                        aria-describedby="datatables_info">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th class="text-center"></th> --}}
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Image
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Position: activate to sort column ascending">Email
                                                </th>

                                                <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Position: activate to sort column ascending">Mobile
                                                </th>

                                                <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                                                    colspan="1" aria-label="Date: activate to sort column ascending">
                                                    Reason
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                            <tr role="row" class="odd">
                                                <td>
                                                    <div class="img-container">
                                                        <img src="{{ !empty($user->image) ? asset('Asset/Uploads/Users/' . $user->image) : url('images/Static/profile.png') }}"
                                                            alt="" height="100" width="100">
                                                    </div>
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->contact_no }}</td>
                                                <td>{{ $user->remarks }}</td>

                                            </tr>
                                            @empty
                                            <p>No Customers</p>
                                            @endforelse
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