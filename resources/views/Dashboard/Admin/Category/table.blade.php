<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 200px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name
            </th>
            @can('sub-category view')
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 200px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Sub Categories
            </th>
            @endcan
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                aria-label="Position: activate to sort column ascending">Featured
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 90px;"
                aria-label="Position: activate to sort column ascending">Status
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Added At
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Updated At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr role="row" class="odd">
            <td>
                <div class="img-container">
                    <img src="{{ asset($category->category_details['image']) }}" alt="{{ $category->name }}"
                        height="100" width="100">
                </div>
            </td>
            <td>{{ $category->name }}</td>
            @can('sub-category view')
            <td>
                <a href="{{ route($segment . '.' . 'category-wise-sub-category.show', $category->slug) }}">
                    <i class="fas fa-folder-open"></i>
                    {{ $category->sub_categories->count() }}
                </a>
            </td>
            @endcan
            <td>
                <i class="{{ $category->featured_status['status'] }}">
                </i>
            </td>
            <td>
                <span class="{{ $category->active_status['status'] }}">
                    {{ $category->active_status['message'] }}
                </span>
            </td>
            <td>{{ date('M d, Y',strtotime($category->created_at)) }}</td>
            <td>{{ date('M d, Y',strtotime($category->updated_at)) }}</td>

            <td class="text-right">
                <a href="#" data-target="#modal-{{ $category->id }}" data-toggle="modal"
                    class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                </a>
                @can('category edit')
                <a href="{{ route($segment . '.' . 'category.edit', $category->id) }}"
                    class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i>
                </a>
                @endcan
                @can('category delete')
                <a class="btn btn-link btn-danger btn-just-icon remove" onclick="return confirm('Are you sure?')"
                    href="{{ route('admin.destroy.category',$category->id) }}"><i class="fa fa-trash"></i>
                </a>
                @endcan
            </td>
            @include('Dashboard.Admin.Category.Partials.modal')
        </tr>
        @endforeach
    </tbody>
</table>