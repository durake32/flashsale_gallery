<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Nepali Product</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="section1">
                <option selected value="">Select product type</option>
                <option value="1" {{$product->section1 == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->section1 == 0 ? 'selected' : ''}}>No</option>
              
            </select>
        </div>
    </div>
</div>