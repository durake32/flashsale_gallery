@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <form role="form" action="{{ route('admin.gallery.store')}}" method="POST" enctype="multipart/form-data">
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
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="far fa-file-alt fa-2x"></i>
                        </div>
                        <h4 class="card-title">
                           Add Gallery
                        </h4>
                    </div>
                    <div class="card-body row ">
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group">
                                <label for="name"> Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                           
                        </div>
                        <div class="col-md-6 col-sm-4">
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

            <div class="box-footer" style="display: block;">
                <input class="btn btn-primary" type="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
@endsection
