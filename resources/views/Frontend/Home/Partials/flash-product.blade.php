<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<section class="item-detail ">
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
                            <button onclick="window.location.href='http://127.0.0.1:8000/featured-product';"
                                class="my-button">Shop Now</button>

                        </div>



                    </div>








                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">


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
                            const endDate = new Date("2023-11-23T20:20:00");
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
                        }

                        updateClock();
                        setInterval(updateClock, 1000);
                        </script>






                        <!-- cart slide -->



                        <swiper-container class="mySwiper" slides-per-view="3" centered-slides="true" space-between="30"
                            pagination="true" pagination-type="fraction" navigation="true">

                            <swiper-slide>

                                <div class="card-group">
                                    <a href="http://127.0.0.1:8000/nepali-selling" class="card-link">

                                        <div class="card">
                                            <!-- <p class=" sale"> sale</p> -->
                                            <img class="card-img-top"
                                                src="data:image/jpeg;base64,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"
                                                alt="Card image cap">


                                            <h5 class="card-title">Satia A4 Paper (1Rim-500 Sheet)</h5>


                                            <h5 class="card-text"> Rs.15</h5>
                                            <p class="off-text"> Rs.20
                                            <p>

                                        </div>
                                    </a>

                                </div>


                            </swiper-slide>





                            <swiper-slide>

                                <div class="card-group">
                                    <a href="http://127.0.0.1:8000/nepali-selling" class="card-link">

                                        <div class="card">
                                            <!-- <p class=" sale"> sale</p> -->
                                            <img class="card-img-top"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyTjeJUaD3MswsasRaok9NP4VI9a6sWzTksQ&usqp=CAU"
                                                alt="Card image cap">


                                            <h5 class="card-title">Satia A4 Paper (1Rim-500 Sheet)</h5>


                                            <h5 class="card-text"> Rs.15</h5>
                                            <p class="off-text"> Rs.20
                                            <p>

                                        </div>
                                    </a>

                                </div>


                            </swiper-slide>


                            <swiper-slide>

                                <div class="card-group">
                                    <a href="http://127.0.0.1:8000/nepali-selling" class="card-link">

                                        <div class="card">
                                            <!-- <p class=" sale"> sale</p> -->
                                            <img class="card-img-top"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyTjeJUaD3MswsasRaok9NP4VI9a6sWzTksQ&usqp=CAU"
                                                alt="Card image cap">


                                            <h5 class="card-title">Satia A4 Paper (1Rim-500 Sheet)</h5>


                                            <h5 class="card-text"> Rs.15</h5>
                                            <p class="off-text"> Rs.20
                                            <p>

                                        </div>
                                    </a>

                                </div>


                            </swiper-slide>




                            <swiper-slide>

                                <div class="card-group">
                                    <a href="http://127.0.0.1:8000/nepali-selling" class="card-link">

                                        <div class="card">
                                            <!-- <p class=" sale"> sale</p> -->
                                            <img class="card-img-top"
                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQI0h4VyWhmXvsq2nDOb-o1Z52gfCi0MnaNqQ&usqp=CAU"
                                                alt="Card image cap">


                                            <h5 class="card-title">Satia A4 Paper (1Rim-500 Sheet)</h5>


                                            <h5 class="card-text"> Rs.15</h5>
                                            <p class="off-text"> Rs.20
                                            <p>

                                        </div>
                                    </a>

                                </div>


                            </swiper-slide>






                            <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js">
                            </script>

                            <script>
                            const swiperEl = document.querySelector('swiper-container');
                            const swiper = swiperEl.swiper;

                            var appendNumber = 4;
                            var prependNumber = 1;
                            document
                                .querySelector(".prepend-2-slides")
                                .addEventListener("click", function(e) {
                                    e.preventDefault();
                                    swiper.prependSlide([
                                        '<swiper-slide>Slide ' + --prependNumber + "</swiper-slide>",
                                        '<swiper-slide>Slide ' + --prependNumber + "</swiper-slide>",
                                    ]);
                                });
                            document
                                .querySelector(".prepend-slide")
                                .addEventListener("click", function(e) {
                                    e.preventDefault();
                                    swiper.prependSlide(
                                        '<swiper-slide>Slide ' + --prependNumber + "</swiper-slide>"
                                    );
                                });
                            document
                                .querySelector(".append-slide")
                                .addEventListener("click", function(e) {
                                    e.preventDefault();
                                    swiper.appendSlide(
                                        '<swiper-slide>Slide ' + ++appendNumber + "</swiper-slide>"
                                    );
                                });
                            document
                                .querySelector(".append-2-slides")
                                .addEventListener("click", function(e) {
                                    e.preventDefault();
                                    swiper.appendSlide([
                                        '<swiper-slide>Slide ' + ++appendNumber + "</swiper-slide>",
                                        '<swiper-slide>Slide ' + ++appendNumber + "</swiper-slide>",
                                    ]);
                                });
                            </script>





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