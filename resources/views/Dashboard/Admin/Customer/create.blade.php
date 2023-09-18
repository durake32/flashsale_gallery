@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <form role="form" action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger col-md-12">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        {{-- <h4 class="card-title">Details</h4> --}}
                        @include('Dashboard.Commons.breadcrum')
                    </div>
                    @include('Dashboard.Admin.Customer.fields')
                </div>
                @include('Dashboard.Admin.Customer.Partials.image-section')
            </div>
            <div class="col-md-4">

                @include('Dashboard.Includes.Components.password-create-section')

                <div class="card">
                    <div class="card-body">
                        <div class="box-header with-border">
                            <h4 class="box-title">Customer Type *</h4>
                        </div>
                        <div class="box-footer" style="display: block;">
                            <select class="browser-default custom-select" name="customer_type_id">
                                <option selected disabled>Select Customer Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="box-header with-border">
                            <h4 class="box-title">Location *</h4>
                        </div>
                        <div class="box-footer" style="display: block;">
                            <select class="browser-default custom-select" name="location_id">
                                <option selected disabled>Select Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @include('Dashboard.Includes.Buttons.submit-button-section')

            </div>
        </div>
    </form>
</div>
@endsection