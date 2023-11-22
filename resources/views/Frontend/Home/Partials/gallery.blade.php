<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<section class=" dailomaa-gallery">
   
    <div class="container-fluid ">
        <div class="category-header">
            <h2>Dailomaa gallery</h2>
        </div>

        <div class="row gallery">
            <swiper-container class="mySwiper" slides-per-view="4" rewind="true" navigation="null">
               
                @foreach($videos as $video)
                <swiper-slide>
                    <div class="t-nail">
                        <img src="{{ asset('Asset/Uploads/Video/' . $video->image) }}">
                    </div>
                    <button class="watch-button " data-toggle="modal" data-target="#videoModel{{$video->id}}">
                        Watch Now
                    </button>
                </swiper-slide>

                <div class="modal fade " id="videoModel{{$video->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="videoModel{{$video->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <video width="100%" controls>
                                <source src="video1.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach($galleries as $gallery)
                    @foreach($gallery->images as $image)
                    <swiper-slide>
                        <div class="t-nail">
                            <img src="{{ asset('Asset/Uploads/Gallery/' . $image->image) }}">
                        </div>
                        <button class="watch-button" data-toggle="modal" data-target="#img{{$image->id}}">
                            Watch Now
                        </button>
                    </swiper-slide>

                    <div class="modal fade " id="img{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="img{{$image->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content ">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <img src="{{ asset('Asset/Uploads/Gallery/' . $image->image) }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforeach
            </swiper-container>




            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
        </div>
    </div>

</section>