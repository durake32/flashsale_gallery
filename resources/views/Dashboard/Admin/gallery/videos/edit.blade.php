<div class="modal fade bd-example-modal-md" id="modal-{{$video->id}}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Video<span class="member"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.video.update',$video->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <label for="name"> Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $video->name ?? old('name') }}" required>
                                </div>
                                <div>
                                    <label for="video_link"> Video Link</label>
                                    <input type="text" name="video_link" class="form-control" value="{{ $video->video_link ?? old('video_link') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>