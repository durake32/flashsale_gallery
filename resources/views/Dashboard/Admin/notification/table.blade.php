<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Date
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Title
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Message
            </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($notifications as $notification)
        <tr role="row" class="odd">
            <td>{{ date('M d, Y',strtotime($notification->created_at))}}</td>
            <td>
                <div class="img-container">
                    <img src="{{ asset($notification->img) }}" alt="{{ $notification->title }}" height="100"
                        width="100">
                </div>
            </td>
            <td>{{ $notification->title }}</td>
            <td>{{ $notification->body }}</td>
        </tr>
        @endforeach
    </tbody>
</table>