<style>
.dgi img{
  height: 29vh;
  }
 @media only screen and (max-width: 1000px) {

  .dgi img{
  height:6vh;
  } 
    
}

</style>
<div id="carouselExampleControls_a" class="carousel slide" data-ride="carousel" data-interval="3000">

    <div class="carousel-inner">
        @php $c = 0 @endphp
        @foreach ($advertisements as $advertisement)
            @php $c++; @endphp
            <div class="carousel-item {{ $c == 1 ? 'active' : '' }}">
            <a class="dgi" href="{{ $advertisement->link }}">
                <img class="d-block w-100" src="{{ asset('Asset/Uploads/advertisements/'.$advertisement->url) }}" alt="First slide">
            </a>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls_a" data-slide="prev">
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls_a" data-slide="next">
    </a>

</div>
