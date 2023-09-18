<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 300px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Product Type
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Regular Price
            </th>

            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Sale
                Price
            </th>

            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Wholesale Price
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 300px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Brand
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 300px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Category
            </th>

            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 300px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                SubCategory
            </th>

            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 300px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Supplier
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                aria-label="Position: activate to sort column ascending">Featured
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                aria-label="Position: activate to sort column ascending">Status
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 150px;"
                aria-label="Date: activate to sort column ascending">Reviews
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 150px;"
                aria-label="Date: activate to sort column ascending">Order Qty Count
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Added At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        @if(!empty($product->id))
        <tr role="row" class="odd">
            <td>
                <div class="img-container">
                    <img src="{{ asset($product->product_details['main_image']) }}" alt="{{ $product->name }}"
                        height="100" width="100">
                </div>
            </td>
            <td>
                @if($product->product_type == 'offline')
                <p class="text-danger">{{ $product->name }}</p>
                @else
                <p>{{ $product->name }}</p>
                @endif
            </td>
            <td>{{ ucfirst($product->product_type) }}</td>

            <td>{{ $product->regular_price }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>{{ $product->wholesaler_price }}</td>
            <td>{{ $product->product_details['brand'] }}</td>
            <td>{{ $product->category->name }}</td>
            <td>
                @isset($product->sub_category->name)
                {{ $product->sub_category->name }}
                @endisset
            </td>
            <td>{{ $product->product_details['retailer'] }}</td>
            <td>

                <span class="{{  $product->featured_status['status'] }}">
                    {{ $product->featured_status['message'] }}
                </span>
            </td>

            <td>
                <span class="{{ $product->active_status['status'] }}">
                    {{ $product->active_status['message'] }}
                </span>
            </td>

            <td>
                <a href="{{ route($segment . '-' . 'product-wise-reviews', $product->id) }}">

                    <i class="fas fa-folder-open"></i>
                    <span>
                        {{ $product->reviews->count() }}
                    </span>
                </a>
            </td>
            @php
            $orders = App\Models\OrderProduct::selectRaw('sum(quantity) as qty')
            ->where('product_id', $product->id)->pluck('qty')->first();
            @endphp
            <td>{{ $orders }}</td>
            <td>{{ date('M d, Y',strtotime($product->created_at)) }}</td>
            <td class="text-right">
                @can('product view')
                <a href="#" data-target="#modal-{{ $product->id }}" data-toggle="modal"
                    class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                </a>
                @endcan
                @can('product edit')
                <a href="{{ route($segment . '.' . 'product.edit', $product->id) }}"
                    class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                @endcan
                @can('product delete')
                <a class="btn btn-link btn-danger btn-just-icon remove" onclick="return confirm('Are you sure?')"
                    href="{{ route('admin.destroy.product', $product->id) }}"><i class="fa fa-trash"></i></a>
                @endcan
            </td>
            @include('Dashboard.Admin.Product.Partials.modal')
        </tr>
        @endif
        @endforeach
    </tbody>
</table>