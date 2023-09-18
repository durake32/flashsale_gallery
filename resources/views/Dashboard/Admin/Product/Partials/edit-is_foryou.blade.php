<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Section For You</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="is_foryou">
                <option selected value="">Select section For You status</option>
                <option value="1" {{$product->is_foryou == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->is_foryou == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>