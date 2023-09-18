@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <form action="{{route('admin.notification.send')}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    @csrf
                    <div class="card-body row ">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Message</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Description" name="body" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image Url</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter image link" name="img">
                            </div>
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        function loadPhoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
  
</div>

@endsection