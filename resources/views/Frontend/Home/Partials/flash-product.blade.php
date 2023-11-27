<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<section class="item-detail ">
    <div id="flash">
        <div class="container-fluid">
            <div class="category-header">
                <h2>{{ $setting->flash_title}}</h2>
            </div>

            <div class="background ">
                <div class="container flash-left">
                    <div class="row ">
                        <div class="col-md-12 col-12" data-aos="fade-up">
                            <div class="flash-text  align-items-center justify-content-center">
                                <h4> New Year Flash Sale </h4>
                                <hr class="hr1">
                                <h1>FLASH SALE</h1>
                                <hr class="hr2">
                                <p> Grab The Deal Before it's Gone </p>
                                <a href="{{ route('flashSaleProducts') }}">
                                    <button type="button" class="my-button">
                                        Shop Now
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 col-12 ">
                        <!-- countdown section  -->
                        <div class="col">
                            <div>
                                <input type="text" readonly id="days">
                                <br/>
                                <label for="">Days</label>
                            </div>
                            <div>
                                <input type="text" readonly id="hours">
                                <br />
                                <label for="">Hours</label>
                            </div>
                            <div>
                                <input type="text" readonly id="minutes">
                                <br />
                                <label for="">Min</label>
                            </div>
                            <div>
                                <input type="text" readonly id="seconds">
                                <br />
                                <label for="">Sec</label>
                            </div>
                        </div>
                        
                        <!-- cart slide -->
                        <!-- Swiper -->
                        <div class="sswiper-box">
                            <i class="fa-solid fa-chevron-left left"></i>
                            <i class="fa-solid fa-chevron-right right"></i>
                            <div #swiperRef="" class="swiper mySwiper swiper1">
                                <div class="swiper-wrapper" rewind="true">
                                    @foreach($flash_products as $product)
                                        <div class="swiper-slide">
                                            <a href="{{ route('product-details', $product->slug) }}" class="card-link">
                                                <div class="card ">
                                                    @if($product->is_discount)
                                                        <p class="offer">-{{$product->discount_percentage}}%</p>
                                                    @endif
                                                    <img class="card-img-top"  alt="{{ $product->name}}"
                                                        src="{{ asset('Asset/Uploads/Products/' . $product->main_image) }}">
                                                    <h5 class="card-title">{{ $product->name}}</h5>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        centeredSlides: true,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".right",
            prevEl: ".left",
        },
    });

    var appendNumber = 4;
    var prependNumber = 1;
    document
        .querySelector(".prepend-2-slides")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.prependSlide([
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
            ]);
        });
    document
        .querySelector(".prepend-slide")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.prependSlide(
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>"
            );
        });
    document
        .querySelector(".append-slide")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.appendSlide(
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>"
            );
        });
    document
        .querySelector(".append-2-slides")
        .addEventListener("click", function(e) {
            e.preventDefault();
            swiper.appendSlide([
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
            ]);
        });
    </script>
    <script>
        AOS.init({
            offset: 300,
            duration: 1000,
        });
        function updateClock() {
            const endDate = new Date("{{ $setting->sale_to}}");
            const now = new Date();
            const diff = Math.max(0, endDate - now) / 1000;

            const days = Math.floor(diff / 86400);
            const hours = Math.floor((diff % 86400) / 3600);
            const minutes = Math.floor((diff % 3600) / 60);
            const seconds = Math.floor(diff % 60);

            document.getElementById('days').value = days;
            document.getElementById('hours').value = hours;
            document.getElementById('minutes').value = minutes;
            document.getElementById('seconds').value = seconds;

            // Check if the countdown has reached zero
            if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                // Hide the div when the countdown finishes
                document.getElementById('flash').style.display = 'none';
            }
        }

        // Ensure the DOM is fully loaded before running the script
        window.addEventListener('DOMContentLoaded', function() {
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
@endsection