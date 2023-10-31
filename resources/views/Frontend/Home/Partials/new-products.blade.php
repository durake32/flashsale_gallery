<style>
.position-relative {
    position: relative;
}

@media (min-width: 768px) {

    .banner-4-2col .banner__item {

        flex-basis: 25%;

    }

    .banner-4-2col .banner__item {
        padding: 0 8px 16px;
    }
}

.banner-4-2col .banner__item a {
    width: 100%;
}

.link img {
    height: auto;
    width: 100%;
}

.banner__item {
    margin: 0 auto;

}

.banner {

    display: flex;

    flex-flow: row wrap;
    overflow: hidden;
    position: relative;
}

.banner__item {

    display: flex;

}
</style>

<section class="item-detail">
    <div class="container-fluid">
        <div class="category-header">
            <h2>Our Educational Partners</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative">
                    <div class="banner banner-4-2col">
                        @foreach ($sectionFeatured as $sectionFeature)
                        <div class="banner__item">
                            <a href="{{ $sectionFeature->link ?? '#' }}" class="d-block link" target="__blank">
                                <img src="{{ asset('Asset/Uploads/advertisements2/'.$sectionFeature->url) }}" alt=""
                                    loading="lazy">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{--  <div class="position-relative">
                <div class="banner banner-4-2col">
                    <div class="banner__item">
                    <a href="#" class="d-block link">
                        <img src="{{ asset('Asset/Uploads/Products/b.jpg') }}" alt="" loading="lazy">
                </a>
            </div>
            <div class="banner__item">
                <a href="#" class="d-block link">
                    <img src="{{ asset('Asset/Uploads/Products/c.jpg') }}" alt="" loading="lazy">
                </a>
            </div>
            <div class="banner__item">
                <a href="#" class="d-block link">
                    <img src="{{ asset('Asset/Uploads/Products/a.jpg') }}" alt="" loading="lazy">
                </a>
            </div>
            <div class="banner__item">
                <a href="#" class="d-block link">
                    <img src="{{ asset('Asset/Uploads/Products/b.jpg') }}" alt="" loading="lazy">
                </a>
            </div>
        </div> --}}
    </div>
    </div>
    </div>
    </div>
</section>
<div class="container-fluid">
    <div class="category-header">
        <h2>New Arrival</h2>
    </div>

<div class="feature-catogory home-page-fc lazyload animated fadeIn">
    <div class="row">
        @foreach ($newProducts as $forYou)
        <div class="col-md-2 col-sm-6 cato-box text-center pb-2" style="background: #FFF;">
            <div class=" agile_ecommerce_tab_left">
                <div class="hs-wrapper">
                    <a href="{{ route('product-details', $forYou->slug) }}"> <img
                            src="{{ asset('Asset/Uploads/Products/' . $forYou->main_image) }}" alt=" " width="100%"
                            height="100%">
                    @if($forYou->images()->count() > 0)
                        @foreach ($forYou->images as $forYo)
                            <img src="{{ asset('Asset/Uploads/Products/' . $forYo->image) }}"
                                width="100%" height="100%">
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="f-category-name">{{ $forYou->name }} <span class="offer-tag-main"></span>
            </div></a>
            <hr>
            <ul style=" display:flex; justify-content:space-between;">
                <li style="padding: 6px;">
                    <a href="{{ route('product-details', $forYou->slug) }}"
                        style="border-color: rgba(0, 0, 0, 0.05);background-color:white;"><span class="fa fa-eye"
                            aria-hidden="true"></span>
                    </a>
                </li>
                <div class="">
                    <div class="simpleCart_shelfItem" style="color: #000; text-align:center;">
                        <strong>
                            <h5>
                                <b>
                                    @if ($flash && $forYou->discount_amount > 0)
                                        NRS<del> {{ $forYou->regular_price }}</del>
                                        <span style="color: #f30404;"> {{ $forYou->discount_amount }}</span>
                                    @elseif ($forYou->sale_price)
                                        NRS<del> {{ $forYou->regular_price }}</del>
                                        <span style="color: #f30404;"> {{ $forYou->sale_price }}</span>
                                    @else
                                        NRS {{ $forYou->regular_price }}
                                    @endif
                                </b>
                            </h5>
                            @if($flash && $forYou->is_discount)
                                <span style="color: #f30404;"> Off {{ $forYou->discount_percentage }} %</span>
                            @endif
                        </strong>
                    </div>

                </div>
                <li>
                    <form class="cart" role="form" action="{{ route('index.cart.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="number" name="quantity" value="1" />
                        <input type="hidden" id="id" name="id" value="{{ $forYou->id }}" />
                        <button type="submit" class="AddtoCartbtn button alt"
                            style="background-color:white;padding:6px;border:none"><span class="fa fa-shopping-cart"
                                aria-hidden="true"></span></button>
                    </form>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</div>
<div class="" style="float: right;">
    <a href="{{ route('new.arrival.product') }}"> <button type="button" class="btn">
            View All <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        </button></a>
</div>
</div>
</section>