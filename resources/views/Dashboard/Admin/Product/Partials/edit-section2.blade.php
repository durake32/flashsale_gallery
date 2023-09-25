<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Top Selling</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="section2">
                <option selected value="">Select selling status</option>
                <option value="1" {{$product->section2 == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->section2 == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Is Best Product</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="best">
                <option selected value="">Select selling status</option>
                <option value="1" {{$product->best == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->best == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">New Arrival</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="latest">
                <option selected value="">Select selling status</option>
                <option value="1" {{$product->latest == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->latest == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Trending Product</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="trending">
                <option selected value="">Select selling status</option>
                <option value="1" {{$product->trending == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->trending == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>