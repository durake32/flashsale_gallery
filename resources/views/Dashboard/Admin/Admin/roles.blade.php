@extends('Dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <form role="form" action="{{ route('admin.assignRoleToUser') }}" method="POST">
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
                        <input type="hidden" name="admin_id" value="{{$admin->id}}">
                        <div class="card-body ">
                            <div>
                                <label for="name"> Assign Role To User *</label>
                                <select class="form-control custom-select"
                                        name="role" required>
                                    <option value="" disabled>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" @if(!is_null($admin_role) && $admin_role->id == $role->id) selected @endif> {{ $role->name}}
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
