@extends('Frontend.layouts.master')
@section('content')
    @if (Session::has('loginForm'))
        <script>
            var modal = document.getElementById("id01").style.display = 'block';

            // When the user clicks anywhere outside of the modal, close it
            if (event.target == modal) {
                modal.style.display = "none";
            }
        </script>
    @endif


    @include('Frontend.Home.Partials.banner')

    <div class="container-fluid mt-5">
        @include('Frontend.Home.Partials.top-categories')
       
      @include('Frontend.Home.Partials.new-products')
          
      @include('Frontend.Home.Partials.top-brands')
    </div>
    @include('Frontend.Home.Partials.featured-products')




    <section class="highlight">
        <div class="banner-bottom">


            <div class="">
                {{-- <div class="video-img">

                        </div> --}}
            </div>

            @include('Frontend.Home.Partials.featured-brands')



            <div class="clearfix"> </div>

        </div>
    </section>

    @include('Frontend.Home.Partials.abc')
    @include('Frontend.Home.Partials.def')
    @include('Frontend.Home.Partials.featured-brands1')
    @include('Frontend.Home.Partials.just-for-you')
  


    <!-- Modal -->
    <div class="modal show" id="myModal_a" role="dialog">

        <div class="col-md-4 " style="margin: 0 auto;">
            <!-- Modal content-->
            <div class="modal-content animate_a">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body1">
                   <img src="{{asset('Asset/Uploads/Logo/'.$setting['popup'])}}" class="img-fluid img-thumbnail" alt="" >
                </div>
            
            </div>


        </div>

    </div>


    @if ($errors->any())
        <script>
            var modal = document.getElementById("id01").style.display = 'block';
        </script>
    @endif
@endsection
