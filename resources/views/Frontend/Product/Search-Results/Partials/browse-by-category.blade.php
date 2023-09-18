<h4>Browse By category</h4>
<ul class="product-categories">
    @foreach ($categories as $category)
        <li class="cat-item">
            {{-- <a href="{{ url('category', $category->slug) }}">{{ $category->name }}</a> --}}
            <a href="{{ route('product-category-wise', $category->slug) }}">{{ $category->name }}</a>
        </li>
    @endforeach
</ul>
