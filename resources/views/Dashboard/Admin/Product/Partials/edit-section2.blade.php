<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Section2</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="section2">
                <option selected value="">Select section2 status</option>
                <option value="1" {{$product->section2 == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->section2 == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>