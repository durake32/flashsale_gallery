@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4 class="card-title">Admins</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                        <button>
                            <a href="{{route('roles.create')}}">
                                Create
                            </a>
                        </button>
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
                                        width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                                        <thead>
                                            <tr role="row">
                                                <th aria-label="Name: activate to sort column descending">Name
                                                </th>
                                                <th aria-label="Name: activate to sort column descending">Permission
                                                </th>
                                                <th aria-label="Actions: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($roles as $role)
                                                <tr role="row" class="odd">
                                                    <td tabindex="0" class="sorting_1">{{ $role->name }}</td>
                                                    <td>
                                                        @foreach($role->permissions as $permission)
                                                            <badge class="btn btn-sm">{{ $permission->name}}</badge>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-link btn-info btn-just-icon like"><i
                                                                class="fa fa-edit"></i></a>
                            
                                                    </td>
                                                </tr>
                                            @empty
                                                <p>No Admins</p>
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