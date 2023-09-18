@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
    $segment = Request::segment(1);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="fas fas fa-cubes fa-2x"></i>
                    </div>
                    <h4 class="card-title">Locations</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <button href="#" data-target="#modal-add-location" data-toggle="modal"
                            class="btn btn-success btn-sm">
                            Create
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
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                                    style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    Location Name
                                                </th>

                                                <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                                                    colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($locations as $location)
                                                <tr role="row" class="odd">
                                                    
                                                    <td> {{ $location->name }}</td>
                                                    <td class="text-right">
                                                        <a href="#" data-target="#modal-{{ $location->id }}" data-toggle="modal"
                                                            class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-link btn-danger btn-just-icon remove">
                                                            <form onsubmit="return confirm('Do you really want to delete?');"
                                                                action="{{ route('admin.locations.destroy', $location->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('Dashboard.Admin.locations.edit')
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

    @include('Dashboard.Admin.locations.create')
</div>
@endsection