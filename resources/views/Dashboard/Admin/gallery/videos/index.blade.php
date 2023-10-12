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
                    <h4 class="card-title">Video Gallery</h4>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        @can('video create')
                        <button href="#" data-target="#modal-add" data-toggle="modal"
                            class="btn btn-success btn-sm">
                            Create
                        </button>
                        @endcan
                       
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
                                                    Image
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                                    style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    Name
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                                                    style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                    Link
                                                </th>
                                                <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                                                    colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($videos as $video)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <div class="img-container">
                                                            <img src="{{ !empty($video->image) ? asset('Asset/Uploads/Video/' . $video->image) : url('images/Static/profile.png') }}"
                                                                alt="" height="100" width="100">
                                                        </div>
                                                    </td>
                                                    <td> {{ $video->name }}</td>
                                                    <td> {{ $video->video_link }}</td>
                                                    <td class="text-right">
                                                        @can('video edit')
                                                        <a href="#" data-target="#modal-{{ $video->id }}" data-toggle="modal"
                                                            class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                                                        </a>
                                                        @endcan
                                                        @can('video delete')
                                                        <a class="btn btn-link btn-danger btn-just-icon remove">
                                                            <form onsubmit="return confirm('Do you really want to delete?');"
                                                                action="{{ route('admin.video.destroy', $video->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                        @endcan
                                                    </td>
                                                </tr>

                                                @include('Dashboard.Admin.gallery.videos.edit')
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

    @include('Dashboard.Admin.gallery.videos.create')
</div>
@endsection