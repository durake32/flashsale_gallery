@extends('Frontend.layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

<?php $segment = Request::segment(1); ?>
<!-- banner -->
<div class="nav-info">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <nav class="breadcrumbs">
                    <a href="">home</a>
                    <span class="divider">/</span>
                    Calendar
                </nav>
            </div>

        </div>
    </div>
</div>

<section class="mybody mt-3">
    <div class="container">
        <div class="row">
            @include('Dashboard.Customer.Partials.side-nav')
            <div class="col-md-8 profile-manage ">
                <h2 class="pb-3">Calendar</h2>
                <div class=" mb-5">
                    <div class="order-det">
                        <h5> Calendar Events</h5>

                        <table class="table" id="orderTable" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Event Date</th>
                                    <th scope="col">Program Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <td>{{ date('M d,Y',strtotime($event->event_date)) }}</td>
                                    <td>{{ $event->program_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
$('#orderTable').DataTable({
    scrollX: true,
});
</script>
@endsection