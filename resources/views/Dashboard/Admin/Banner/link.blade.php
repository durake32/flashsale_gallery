<div class="card">

    <div class="col-md-12">
        <div class="form-group bmd-form-group">
            <label for="type"> Type select</label>
            <select class="browser-default custom-select" name="type" id="type">
                <option disabled selected>Please Type</option>
                <option value="category">Category</option>
                <option value="subcategory">SubCategory</option>
                <option value="brand">Brand</option>
                <option value="product">Product</option>
            </select>
        </div>
    </div>


    <div class="col-md-12" id="category">
        <div class="form-group bmd-form-group">
            <label for="type_id"> Select Category *</label>
            <select class="browser-default custom-select" name="type_id">
                <option disabled selected>Please Select Category</option>
                @foreach($categories as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12" id="sub_category">
        <div class="form-group bmd-form-group">
            <label for="type_id"> Select Sub Category *</label>
            <select class="browser-default custom-select" name="type_id">
                <option disabled selected>Please Select SubCategory</option>
                @foreach($subcategories as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12" id="brand">
        <div class="form-group bmd-form-group">
            <label for="type_id"> Select Brand*</label>
            <select class="browser-default custom-select" name="type_id">
                <option disabled selected>Please Select Brand</option>
                @foreach($brands as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12" id="product">
        <div class="form-group bmd-form-group">
            <label for="type_id"> Select Product *</label>
            <select class="browser-default custom-select" name="type_id">
                <option disabled selected>Please Select Product</option>
                @foreach($products as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@section('js')
<script>
    $('#category').hide();
    $('#sub_category').hide();
    $('#brand').hide();
    $('#product').hide();
    $('#type').on('change',function(){
        let filter = $(this).val();
        if(filter == 'category'){
            $('#category').show();
            $('#sub_category').hide();
            $('#brand').hide();
            $('#product').hide();
        }else if(filter == 'subcategory') {
            $('#category').hide();
            $('#sub_category').show();
            $('#brand').hide();
            $('#product').hide();
        }else if(filter == 'product') {
            $('#category').hide();
            $('#sub_category').hide();
            $('#brand').hide();
            $('#product').show();
        }else{
            $('#category').hide();
            $('#sub_category').hide();
            $('#brand').show();
            $('#product').hide();
        }
    });
</script>
@endsection