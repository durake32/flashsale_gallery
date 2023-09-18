@extends('Dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        @can('dashboard view')
         @include('Dashboard.Admin.Dashboard.records')
        @endcan
    </div>
@endsection
