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
                        <h4 class="card-title">Direct Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                            @can('direct-category create')
                            <a href="{{ route('admin.directCategory.create') }}" class="btn btn-success btn-sm">
                                Create
                            </a>
                            @endcan
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
                                                        rowspan="1" colspan="1" style="width: 177px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Title
                                                    </th>
  
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatables" rowspan="1" colspan="1"
                                                        style="width: 208px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($directCategories as $directCategory)
                                                    @if (!empty($directCategory->id))
                                                        <tr role="row" class="odd">
   
                                                            <td>
                                                                    {{ $directCategory->title }}
                                                            </td>
                                          
                                                            <td class="text-right">
                                                                @can('direct-category edit')
                                                                    <a href="{{ route('admin.directCategory.edit',$directCategory->id) }}"
                                                                    class="btn btn-link btn-info btn-just-icon like"><i
                                                                        class="fa fa-edit"></i></a>
                                                                @endcan
                                                               @can('direct-category delete')
                                                                <a class="btn btn-link btn-danger btn-just-icon remove" onclick="return confirm('Are you sure?')" href="{{ route('admin.directCategory.destroy',$directCategory->id) }}"><i class="fa fa-trash"></i></a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endif
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
