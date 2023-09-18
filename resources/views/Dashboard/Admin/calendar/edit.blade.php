@extends('Dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" action="{{ route('admin.calendars.update',$event->id)}}" method="POST" >
            @csrf
            @method('PUT')
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
                                <i class="fas fas fa-cube fa-2x"></i>
                            </div>
                            @include('Dashboard.Commons.breadcrum')
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <label for="user_id">Customer *</label>
                                        <select class="form-control custom-select" id="user_id" name="user_id" required>
                                            <option value="">Select Customer</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($user->id == $event->user_id) selected @endif> {{ $user->name ." (". $user->email .")" }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="email">Email *</label>
                                        <input type="email" class="form-control" value="{{ $event->email }}" name="email" id="email">
                                    </div>
                                    <div>
                                        <label for="program_name">Program Name *</label>
                                        <input type="text" class="form-control" value="{{ $event->program_name }}" name="program_name" id="program_name">
                                    </div>
                                    <div>
                                        <label for="event_date">Event Date *</label>
                                        <input type="date" class="form-control" value="{{ $event->event_date }}" name="event_date" id="event_date">
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
