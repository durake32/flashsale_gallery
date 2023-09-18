<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">Name
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending">Email
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending">Mobile
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending">Address
            </th>


            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-label="Position: activate to sort column ascending">Order Count
            </th>


            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-label="Date: activate to sort column ascending">Registered At
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-label="Date: activate to sort column ascending">Status
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" aria-label="Actions: activate to sort column ascending">Actions</th>
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

            <td>{{ $user->address }}</td>
            @php
            $orders = App\Models\Order::where('user_id', $user->id)->orderBy('created_at','DESC')->count();
            @endphp
            <td>{{ $orders }}</td>
            <td>{{ date('M d, Y',strtotime($user->created_at)) }}</td>
            <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>

            <td>
                <a href="#" data-target="#modal-{{ $user->id }}" data-toggle="modal"
                    class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                </a>
                @can('customer edit')
                <a href="{{ route('customer.edit', $user->id) }}" class="btn btn-link btn-info btn-just-icon like"><i
                        class="fa fa-edit"></i></a>
                @endcan
                @can('customer delete')
                <a class="btn btn-link btn-danger btn-just-icon remove">
                    <form onsubmit="return confirm('Do you really want to delete?');"
                        action="{{ route('customer.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </a>
                @endcan
            </td>
            @include('Dashboard.Admin.Customer.modal')
        </tr>
        @empty
        <p>No Customers</p>
        @endforelse
    </tbody>
</table>