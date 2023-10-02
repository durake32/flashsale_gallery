<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Event Date
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Customer Name
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Email
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Programs
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Status
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Created At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
        <tr role="row" class="odd">
            <td>{{ date('M d, Y',strtotime($event->event_date)) }}</td>
            <td>{{ $event->user->name ?? '' }}</td>
            <td>{{ $event->email }}</td>
            <td>{{ $event->program_name }}</td>
            <td>{{ $event->is_sent ? 'Send' : 'Pending'}}</td>
            <td>{{ date('M d, Y',strtotime($event->created_at)) }}</td>
            <td class="text-right">
                @can('calendar edit')
                <a href="{{ route('admin.calendars.edit', $event->id) }}"
                    class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                @endcan
                @can('calendar delete')
                <a class="btn btn-link btn-danger btn-just-icon remove">
                    <form onsubmit="return confirm('Do you really want to delete?');"
                        action="{{ route('admin.calendars.destroy', $event->id) }}" method="POST">
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

        @endforeach
    </tbody>
</table>