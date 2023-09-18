<div class="card">
    <div class="card-body">
        <h3>Link</h3>
        <input type="url" name="link" class="form-control" required>
    </div>

    <div class="col-md-12">
        <div class="form-group bmd-form-group">
            <label for="type"> Type select</label>
            <select class="browser-default custom-select" name="type" id="type">
                <option disabled selected>Please Type</option>
                <option value="category">Category</option>
                <option value="subcategory">SubCategory</option>
                <option value="brand">Brand</option>
            </select>
        </div>
    </div>


    <div class="col-md-12">
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

    <div class="col-md-12">
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

    <div class="col-md-12">
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
</div>