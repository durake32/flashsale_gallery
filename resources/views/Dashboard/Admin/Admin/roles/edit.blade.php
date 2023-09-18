@extends('Dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <form role="form" action="{{ route('roles.update',$role->id) }}" method="POST">
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
                                <i class="fas fa-user"></i>
                            </div>
                            @include('Dashboard.Commons.breadcrum')
                        </div>
                        <div class="card-body ">
                            <div>
                                <label for="name"> Name *</label>
                                <input type="name" class="form-control" value="{{ $role->name }}" name="name" id="name">
                            </div>
                            <div>
                                <label for="name"> Assign Permission *</label>
                                <!-- <button type='button' class="btn btn-sm btn-success" id='selectAll'>Select All </button> -->
                                <!-- <button type='button' class="btn btn-sm btn-danger" id='deselectAll'> Deselect All </button> -->

                                <select class="form-control custom-select" id="permission" name="permission[]" multiple required>
                                    <option value="" disabled>Select Permission</option>
                                    @foreach($permissions as $permrission)
                                        <option value="{{$permrission->id}}" {{in_array($permrission->id,$rolePermissions) ?  'selected' : ''}}> {{ $permrission->name}}
                                                </option>
                                    @endforeach
                                </select>
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
@section('js')
<script>
    
    $('#selectAll').click(function() {
        $('#permission option').attr("selected","selected");
    });   
    $('#deselectAll').click(function() {
        $('#permission option').removeAttr("selected");
    });
</script>
@endsection
