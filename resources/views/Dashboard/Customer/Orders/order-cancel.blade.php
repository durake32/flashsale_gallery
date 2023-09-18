@extends('Frontend.layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <?php $segment = Request::segment(1); ?>
    <!-- banner -->
    <div class="nav-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                       Cancel Orders
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="mybody mt-3">
        <div class="container">
            <div class="row">
                @include('Dashboard.Customer.Partials.side-nav')
                <div class="col-md-8 profile-manage ">
                    <h2 class="pb-3">Cancel Orders</h2>
                    <div class=" mb-5">
                        <form role="form" action="{{ route('ordersCancel', $orders->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                             @if ($errors->any())
                              <div class="alert alert-danger col-md-12">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                             @endif
                            <div class="row mb-3">

                                <div class="col-md-12">
                                    <p>
                                        <input class="form-control" type="hidden" name="status" value="2">
                                    </p>
                                </div>

                                <br><br>
                                <div class="col-md-12">
                                    <p>
                                        <span> Reason For Cancel</span> <br>
                                        <textarea class="form-control" name="remark" id="exampleFormControlTextarea3" rows="7"></textarea>
                                    </p>
                                </div>

                            </div>

                            <button type="submit" class="user-manage-btn">SAVE CHANGES</button>
                        </form>

                    </div>


                </div>

            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        $('#orderTable').DataTable({
            scrollX: true,
        });
    </script>

@endsection
