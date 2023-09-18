<div id="esewaPaymentModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">eSewa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('checkout.esewa.process') }}">
                    @csrf
                    <button class="btn btn-primary" type="submit">
                     @php
                     $siteSettings = \App\Models\SiteSetting::first();
                     @endphp

                      @if( \Cart::getTotal() < $siteSettings->aplicable )
                           Rs. {{ \Cart::getTotal() + $siteSettings->charge }}
                      @else
                       Rs. {{\Cart::getTotal()}}
                      @endif

                      Pay with eSewa
                        @foreach ($cartCollection as $cartData)
                            <input type="hidden" name="product_id[]" value="{{ $cartData->id }}">
                            <input type="hidden" name="amount" value="{{\Cart::getTotal()}}">
                        @endforeach
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
