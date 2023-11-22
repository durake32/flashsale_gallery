<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<section class="item-detail ">
    <div id="flash">
        <div class="container-fluid">
            <div class="category-header">
                <h2>Flash Products </h2>
            </div>

            <div class="background ">
                <div class="container flash-left">
                    <div class="row ">
                        <div class="col-md-12 col-12  " data-aos="fade-up">

                            <div class="flash-text  align-items-center justify-content-center">
                                <h4> New Year Flash Sale </h4>

                                <hr class="hr1">
                                <h1>FLASH SALE</h1>
                                <hr class="hr2">


                                <p> Grab The Deal Before it's Gone </p>
                                <a href="{{ route('featured.product') }}">
                                    <button type="button" class="my-button">

                                        Shop Now</button>
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

                        <script>
                        function updateClock() {
                            const endDate = new Date("2023-12-08T12:54:05");
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







                        <!-- cart slide -->
                        <!-- Swiper -->
                        <div class="sswiper-box">
                            <i class="fa-solid fa-chevron-left left"></i>


                            <i class="fa-solid fa-chevron-right right"></i>




                            <div #swiperRef="" class="swiper mySwiper swiper1  ">


                                <div class=" swiper-wrapper " rewind="true">



                                    <div class="swiper-slide">

                                        <a href="http://127.0.0.1:8000/nepali-selling" class="card-link">

                                            <div class="card ">
                                                <p class="offer">-55%</p>
                                                <img class="card-img-top"
                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyTjeJUaD3MswsasRaok9NP4VI9a6sWzTksQ&usqp=CAU"
                                                    alt="Card image cap">


                                                <h5 class="card-title">Satia A4 Paper (1Rim-500 Sheet)</h5>




                                            </div>
                                        </a>


                                    </div>




                                    <div class="swiper-slide">
                                        <div class="card-group">
                                            <a href="http://127.0.0.1:8000/nepali-selling" class="card-link">

                                                <div class="card">
                                                    <p class="offer">90%</p>
                                                    <img class="card-img-top"
                                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyTjeJUaD3MswsasRaok9NP4VI9a6sWzTksQ&usqp=CAU"
                                                        alt="Card image cap">


                                                    <h5 class="card-title">Satia A4 Paper (1Rim-500 Sheet)</h5>




                                                </div>
                                            </a>

                                        </div>
                                    </div>



                                    <div class="swiper-slide">
                                        <div class="card-group">
                                            <a href="http://127.0.0.1:8000/nepali-selling" class="card-link">

                                                <div class="card">
                                                    <p class="offer">-43%</p>
                                                    <img class="card-img-top"
                                                        src="https://scontent.fktm18-1.fna.fbcdn.net/v/t39.30808-6/347548810_224374713852402_435310008195151020_n.jpg?stp=dst-jpg_s960x960&_nc_cat=107&ccb=1-7&_nc_sid=5f2048&_nc_ohc=easo0GM5hoQAX8hp8kv&_nc_ht=scontent.fktm18-1.fna&oh=00_AfD-qA8yQ9CSZ2jN64K5eZ1vw6LsVjHPNWOey42TZhqLqQ&oe=654F1B89"
                                                        alt="Card image cap">


                                                    <h5 class="card-title">Satia A4 Paper (1Rim-500 Sheet)</h5>


                                                </div>


                                            </a>

                                        </div>
                                    </div>



                                </div>







                            </div>
                        </div>





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






                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


    </div>
</section>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>


<script>
AOS.init({
    offset: 300,
    duration: 1000,
});
</script>