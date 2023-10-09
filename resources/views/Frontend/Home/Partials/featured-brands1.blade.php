<style>
.dgh img{
  height: 29vh;
  }
 @media only screen and (max-width: 1000px) {

  .dgh img{
  height:6vh;
  } 
    
}

</style>
<div id="carouselExampleControls_b" class="carousel slide" data-ride="carousel" data-interval="3000">

    <div class="carousel-inner">
        @php $c = 0 @endphp
        @foreach ($advertisements1 as $advertisement)
            @php $c++; @endphp
            <div class="carousel-item {{ $c == 1 ? 'active' : '' }}">
                <a class="dgh" href="{{ $advertisement->link }}">
                    <img class="d-block w-100" src="{{ asset('Asset/Uploads/advertisements1/' . $advertisement->url) }}"
                        alt="First slide">
                </a>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls_b" data-slide="prev">
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls_b" data-slide="next">
    </a>

</div>
