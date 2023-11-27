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
            <form action="{{ route('admin.video.update',$video->id)}}" method="POST" enctype="multipart/form-data">
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
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    @if($video->image)
                                        <div class="user-image mb-3 text-center">
                                            <div class="displayImage">
                                                    <img src="{{ asset('Asset/Uploads/Video/' . $video->image) }}"
                                                        alt="{{ $video->name }}" width="100%">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{ asset('Asset/Uploads/Static/avatar.jpg') }}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" kl_vkbd_parsed="true">
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i
                                                class="fa fa-times"></i> Remove</a>
                                    </div>
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