

@foreach ($product->reviews as $review)
    <div class="bootstrap-tab-text-grid">
        <div>
         <h3 style="display: inline">{{ $review->user->name }}</h3>
            <p style="margin-left:10px">
                {{ $review->message }}
            </p>
        </div>
        <div class="clearfix"> </div>
    </div>
@endforeach



