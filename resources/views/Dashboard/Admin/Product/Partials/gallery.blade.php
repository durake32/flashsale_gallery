@extends('Dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" action="{{ route('admin.storeProductImage', $product->id) }}" id="form-example-1" method="POST"
            enctype="multipart/form-data">
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
                            <div class="card-icon">
                                <i class="fas fa-cube fa-2x"></i>
                            </div>
                            @include('Dashboard.Commons.breadcrum')
                        </div>
                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">contacts</i>
                                </div>
                                <h4 class="card-title">Image</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 col-sm-4">
                                        @if($product->images()->count() > 0)
                                            <div class="user-image mb-3 text-center">
                                                <div class="displayImage">
                                                    @foreach ($product->images as $image)
                                                        <div class="fileinput-new">
                                                        <img src="{{ asset('Asset/Uploads/Products/' . $image->image) }}" height="200" width="200" 
                                                            alt="{{ $product->product_details['name'] }}">
                                                            <a href="{{ route('admin.removeProductImage',$image->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 col-sm-4">
                                        <div class="user-image mb-3 text-center">
                                            <div class="imgPreview"> </div>
                                        </div>
                        
                                        <div class="custom-file">
                                            <input type="file" name="image[]" class="custom-file-input" id="images" multiple="multiple">
                                            <label class="custom-file-label" for="images">Choose image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('Dashboard.Includes.Buttons.submit-button-section')
                </div>
            </div>
        </form>

    </div>
@endsection