<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Sub Category</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <label>Sub Categories</label>
            <select name="sub_category_id" id="subcategory" class="browser-default custom-select" >
              	<option value="" selected="" disabled="">Select SubCategory</option>
			 @foreach($subCategories as $sub)
           <option value="{{ $sub->id }}" {{ $sub->id == $product->sub_category_id ? 'selected': '' }} >{{ $sub->name }}</option>	
			@endforeach
            </select>
        </div>
    </div>
</div>



