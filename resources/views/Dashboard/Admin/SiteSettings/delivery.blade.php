@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <form role="form" action="{{route('site-settings.update',$site_setting['id'])}}" method="POST"
        enctype="multipart/form-data">
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
        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">contacts</i>
                        </div>
                        <h4 class="card-title">Delivery Setting</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group bmd-form-group">
                            <label for="exampleEmails">Delivery charge aplicable below *</label>
                            <input type="text" class="form-control" value="{{$site_setting['aplicable']}}"
                                name="aplicable" id="meta_title" required="true" aria-required="true">
                        </div>

                        <div class="form-group bmd-form-group">
                            <label for="exampleEmails"> Delvery charge *</label>
                            <input type="text" class="form-control" value="{{$site_setting['charge']}}"
                                name="charge" id="meta_title" required="true" aria-required="true">
                        </div>

                    </div>

                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="box-footer" style="display: block;">
                            {{-- <input class="btn btn-primary" type="submit" name="action" value="Update"> --}}
                            <button class="btn btn-primary" type="submit" name="action">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection