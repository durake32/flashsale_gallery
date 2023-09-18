@extends('Frontend.layouts.master')

<style>
/* HIDE RADIO */
[type=radio] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* IMAGE STYLES */
[type=radio]+img {
    cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked+img {
    outline: 2px solid #f16226;
}
</style>
@section('content')
<!-- banner -->
<div class="nav-info mb-5">
    <div class="container">
        <div class="flex-col flex-grow medium-text-center">
            <nav
                class="breadcrumbs flex-row flex-row-center heading-font checkout-breadcrumbs text-center strong h4 uppercase">
                <a href="" class="hide-for-small ">
                    <span class="breadcrumb-step hide-for-small">1</span> Shopping Cart </a>
                <span class="divider hide-for-small">
                    <fa class="fa fa-angle-right"></i>
                </span>
                <a href="" class="current">
                    <span class="breadcrumb-step hide-for-small">2</span> Checkout details </a>
                <span class="divider hide-for-small">
                    <fa class="fa fa-angle-right"></i>
                </span>
                <a href="#" class="no-click hide-for-small">
                    <span class="breadcrumb-step hide-for-small">3</span> Order Complete </a>
            </nav>
        </div>
    </div>
</div>
<!-- main body -->
<div class="cart-container">
    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger col-md-12">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-7 epay">
                <h4>Select Payment Method</h4>

                <div class="row">
                    <div id="paymentOptions" class="col-md-12">
                        @if (count($paymentMethods))
                        <ul>
                            @foreach ($paymentMethods as $paymentMethod)
                            <li>
                                <span class="radio">
                                    <label>
                                        <input type="radio" name="payment_method" value="{{ $paymentMethod->slug }}" />
                                        <img class="payment-img"
                                            src="{{asset('Asset/Uploads/Payment-Methods/'.$paymentMethod->image)}}"
                                            alt="payment">

                                    </label>
                                </span>

                            </li>

                            @endforeach
                        </ul>
                        @else
                        <ul>
                            No payment method has been added
                        </ul>
                        @endif

                    </div>
                </div>

            </div>

            @include('Frontend.Payment-Methods.esewa')
            @include('Frontend.Payment-Methods.cash-on-delivery')

            <div class="col-md-5 cart-total">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartCollection as $cartData)
                        <tr>
                            <td class="text-secondary text-weight-light">
                                {{ $cartData->name }} x
                                <input type="hidden" name="product_id[]" value="{{ $cartData->id }}">
                                <input type="hidden" name="quantity" value="{{ $cartData->quantity }}">
                                <input type="hidden" name="image" value="{{ $cartData->attributes->image }}">
                                <span class="c_Inumber">{{ $cartData->quantity }}</span>
                            </td>
                            <td class="text-right">
                                Rs. {{ $cartData->price }} x {{ $cartData->quantity }}
                            </td>


                        </tr>
                        @endforeach
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-right">Rs. {{ \Cart::getTotal() }}</td>
                        </tr>


                        @php
                        $siteSettings = \App\Models\SiteSetting::first();
                        @endphp

                        <tr>
                            <td>Delivery Charge</td>
                            @if( \Cart::getTotal() < $siteSettings->aplicable )
                                <td class="text-right">Rs. {{ $siteSettings->charge }}</td>
                                @else
                                <td class="text-right"> Rs. 0 </td>
                                @endif
                        </tr>



                        <tr>
                            <td>Total Amount</td>
                            @if( \Cart::getTotal() < $siteSettings->aplicable )
                                <td class="text-right">Rs. {{ \Cart::getTotal() + $siteSettings->charge }}</td>
                                @else
                                <td class="text-right"> Rs. {{\Cart::getTotal()}} </td>
                                @endif
                        </tr>
                    </tbody>
                </table>


            </div>

        </div>
        {{-- </form> --}}
    </div>
</div>
<!-- main body -->



@endsection