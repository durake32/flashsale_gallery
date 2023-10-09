  <section class="category mb-5" id="demos">
    <div class="container-fluid gap-top">
          <div class="category-header">
              <h2>Top Brands</h2>
          </div>
          <!--feature title-->
          <div class="feature-catogory home-page-fc lazyload animated fadeIn">
              <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                      <div class="large-12 columns">
                          <div class="owl-carousel owl-theme">
                              @foreach ($brands  as $brand)
                                  <div class="item cato-box text-center pb-2 ">
                                      <a href="{{ url('brand', $brand->slug) }}"
                                          title="{{ $brand->name }}">
                                          <img class="pb-3"
                                              src="{{ asset('Asset/Uploads/Brands/' . $brand->image) }}"
                                              width="100%" height="175px">
                                          <div class="f-category-name"><b>{{ $brand->name }} </b><span
                                                  class="offer-tag-main"></span>
                                          </div>
                                      </a>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!--feature-catogory-->
    </div>
  </section>

  <script>
      $(document).ready(function() {
          var owl = $(".owl-carousel");
          owl.owlCarousel({
              margin: 10,
              nav: false,
              loop: true,
              dots: false,
              autoplay: true,
              autoplayHoverPause: true,
              autoplaySpeed: 3000,
              autoHeight: true,
              responsive: {
                  0: {
                      items: 2,
                  },
                 600 : {
                     items: 2,
                  },
                  768: {
                      items: 4,
                  },
                  1000: {
                      items: 6,
                  },
              },
          });
      });
    
  </script>
