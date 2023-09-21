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
                    <form action="{{ route('admin.report.customer')}}" method="GET">
                        <div class="card-body row ">
                            <div class="col-md-4">
                                <div class="form-group bmd-form-group">
                                    <div class="form-group bmd-form-group">
                                        <label for="type"> Customer Type</label>
                                        <select class="browser-default custom-select" name="type">
                                            <option selected value="">Select customer type</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}" @if(request()->type == $type->id) selected @endif>{{ $type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group bmd-form-group">
                                    <div class="form-group bmd-form-group">
                                        <label for="location"> Location</label>
                                        <select class="browser-default custom-select" name="location">
                                            <option selected value="">Select location</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" @if(request()->location == $location->id) selected @endif>{{ $location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                            <div class="col-md-4">
                                <div class="form-group bmd-form-group">
                                    <label for="submit"></label>
                                    <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                                    <a href="{{ route('admin.report.customer')}}" class="btn btn-danger btn-sm text-white">Reset</a>

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
                        <i class="fas fa-cubes fa-2x"></i>
                    </div>
                    <h4 class="card-title">Customer Report</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <p class="btn btn-success btn-sm">
                            Total Customers: {{ $customers->count()}}
                        </p>
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 100px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Image
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Name
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Type
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Email
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Mobile
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Address
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Location
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Order Count
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Created At
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                    rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customers as $user)
                                            <tr role="row" class="odd">
                                                <td>
                                                    <div class="img-container">
                                                        <img src="{{ !empty($user->image) ? asset('Asset/Uploads/Users/' . $user->image) : url('images/Static/profile.png') }}"
                                                            alt="" height="100" width="100">
                                                    </div>
                                                </td>
                                                <td>{{ $user->name }} </td>
                                                <td>{{ $user->customer_type ? $user->customer_type->name : '' }} </td>                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->contact_no }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->location ? $user->location->name : '' }}</td>
                                                <td>{{ $user->orders_count }}</td>
                                                <td>{{ date('M d, Y',strtotime($user->created_at)) }}</td>
                                                <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                                            </tr>
                                            @empty
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