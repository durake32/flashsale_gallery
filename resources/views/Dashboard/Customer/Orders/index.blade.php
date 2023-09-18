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
                        Orders
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
                    <h2 class="pb-3">My Orders</h2>
                    <div class=" mb-5">
                        <div class="order-det">
                            <h5>Recent Orders</h5>

                            <table class="table" id="orderTable" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Placed On</th>
                                       <th scope="col">Expected Delivery Date </th>
                                       <th scope="col">Status</th>
                                        <th scope="col">Cancel Order</th>
                                        <th scope="col">Check</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tableOrders as $order)
                                        <tr>
                                            <td>{{ $order->order_details['random_id'] }}</td>
                                            <td>{{ $order->order_details['ordered_date'] }}</td>
                                             <td>
                                                 @if($order->delivery_date == NULL)
                                                     ----
                                                 @else
                                                     {{ $order->order_details['delivery_date'] }}
                                                 @endif
                                             </td>
                                               <td>
                                                    @if ($order['status'] == 1)
                                                        <span class="badge-primary">Successfully ordered</span>
                                                    @elseif($order['status'] == 2)
                                                        <span class="badge-danger">order canceled</span>
                                                    @elseif($order['status'] == 3)
                                                        <span class="badge-info"> order delivered</span>
                                                    @elseif($order['status'] == 4)
                                                        <span class="badge-dark"> On the Way</span>
                                                    @elseif($order['status'] == 5)
                                                        <span class="badge-warning"> Confirm delivery</span>
                                                    @endif
                                                </td>

                                            <td>


                                           @if($order->status == 1)
                                            <a class="btn btn-primary text-white"
                                                         href="{{ route('customer.order.cancel', $order->id) }}">Cancel</a>

                                           @elseif($order->status == 3)
                                                 <a class="btn btn-primary text-white"
                                                         href="{{ route('customer.order.cancel', $order->id) }}">Cancel</a>

                                           @elseif($order->status == 6)
                                                 <a class="btn btn-primary text-white"
                                                         href="{{ route('customer.order.cancel', $order->id) }}">Cancel</a>
                                          @endif

                                            </td>
                                            <td>
                                                <a class="btn btn-primary text-white"
                                                    href="{{ route('customer.order.check', $order->order_details['random_id']) }}">Check</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <br>
                        @if (count($orders))
                            <a class="btn btn-primary" href="{{ route('export.order') }}" style="margin-left:80%">Export to
                                excel</a>
                        @endif <br><br>

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
