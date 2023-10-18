<section class="similar_prods">
    <div class="container">
        <h2>Similar Products</h2>
        <div class="product-det">
            <div class="feature-catogory home-page-fc lazyload animated fadeIn">
                <div class="row">
                    @foreach ($similarProducts as $forYou)
                        <div class="col-md-3 col-sm-6 cato-box text-center pb-2"style="background: #FFF;">
                            <div class=" agile_ecommerce_tab_left">
                                <div class="hs-wrapper">
                                 <a href="{{ route('product-details', $forYou->slug) }}"><img src="{{ asset('Asset/Uploads/Products/' . $forYou->main_image) }}"
                                        alt=" " width="100%" height="100%">
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
                                        style="border-color: rgba(0, 0, 0, 0.05);background-color:white;"><span
                                            class="fa fa-eye" aria-hidden="true"></span>
                                    </a>
                                </li>
                                <div class="">
                                    <div class="simpleCart_shelfItem" style="color: #000; text-align:center;">
                                        <strong>
                                            <h5>
                                                <b>
                                                    @if ($forYou->sale_price)
                                                        NRS<del> {{ $forYou->regular_price }}</del>
                                                        <span style="color: #f30404;"> {{ $forYou->sale_price }}</span>
                                                    @else
                                                        NRS {{ $forYou->regular_price }}
                                                    @endif
                                                </b>
                                            </h5>
                                        </strong>
                                    </div>

                                </div>
                                <li>
                                    <form class="cart" role="form" action="{{ route('index.cart.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="number" name="quantity" value="1" />
                                        <input type="hidden" id="id" name="id"
                                            value="{{ $forYou->id }}" />
                                        <button type="submit" class="AddtoCartbtn button alt"
                                            style="background-color:white;padding:6px;border:none"><span
                                                class="fa fa-shopping-cart" aria-hidden="true"></span></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
    </div>
</section>
