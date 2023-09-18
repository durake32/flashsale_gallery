<div class="card-body ">
    <div class="row">
        <div class="col-md-12">
            <div>
                <label for="name"> Name *</label>
                <input type="name" class="form-control" value="{{ isset($subCategory) ? $subCategory->name : old('name') }}" name="name"
                    id="name">
            </div>

        </div>
    </div>

</div>
