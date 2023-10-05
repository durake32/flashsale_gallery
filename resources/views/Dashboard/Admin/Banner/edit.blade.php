@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">

    <form role="form" action="{{route('banner.update',$banner->id)}}" method="POST" enctype="multipart/form-data">
        @method('put')
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
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        @include('Dashboard.Admin.Banner.card-icon')

                        @include('Dashboard.Commons.breadcrum')
                    </div>
                    @include('Dashboard.Admin.Banner.fields')
                </div>

                <div class="card">

                    <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                            <label for="type"> Type select</label>
                            <select class="browser-default custom-select" name="type" id="type">
                                <option disabled selected>Please Type</option>
                                <option value="category" {{ $banner->type == 'category'  ? 'selected' : ''}}>
                                    Category</option>
                                <option value="subcategory"
                                    {{ $banner->type == 'subcategory'  ? 'selected' : ''}}>
                                    SubCategory</option>
                                <option value="brand" {{ $banner->type == 'brand'  ? 'selected' : ''}}>Brand
                                </option>
                                <option value="product" {{ $banner->type == 'product'  ? 'selected' : ''}}>Product
                                </option>
                            </select>
                        </div>
                    </div>

                    @if($banner->type == 'category')
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                            <label for="type_id"> Select Category *</label>
                            <select class="browser-default custom-select" name="type_id">
                                @foreach($categories as $cat)
                                <option value="{{$cat->id}}" {{$cat->id == $banner->type_id  ? 'selected' : ''}}>
                                    {{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if($banner->type == 'subcategory')
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                            <label for="type_id"> Select Sub Category *</label>
                            <select class="browser-default custom-select" name="type_id">
                                @foreach($subcategories as $cat)
                                <option value="{{$cat->id}}" {{$cat->id == $banner->type_id  ? 'selected' : ''}}>
                                    {{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if($banner->type == 'brand')
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                            <label for="type_id"> Select Brand*</label>
                            <select class="browser-default custom-select" name="type_id">
                                @foreach($brands as $cat)
                                <option value="{{$cat->id}}" {{$cat->id == $banner->type_id  ? 'selected' : ''}}>
                                    {{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if($banner->type == 'product')
                    <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                            <label for="type_id"> Select Product*</label>
                            <select class="browser-default custom-select" name="type_id">
                                @foreach($products as $cat)
                                <option value="{{$cat->id}}" {{$cat->id == $banner->type_id  ? 'selected' : ''}}>
                                    {{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                @include('Dashboard.Admin.Banner.image-section')
            </div>
            <div class="col-md-4">
                @include('Dashboard.Admin.Banner.edit-status')
                @include('Dashboard.Commons.update-button-section')

            </div>
        </div>
    </form>

</div>
@endsection
