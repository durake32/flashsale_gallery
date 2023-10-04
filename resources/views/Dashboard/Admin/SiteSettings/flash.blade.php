<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">Flash</i>
        </div>
        <h4 class="card-title">Flash Sales</h4>
    </div>
    <div class="card-body ">
        <div>
            <label for="exampleEmails">Enable Flash Sale *</label>
            <select class="browser-default custom-select" name="enable_flash_sale">
                <option value="0" @if($site_setting->enable_flash_sale == 0) selected @endif>No</option>
                <option value="1" @if($site_setting->enable_flash_sale == 1) selected @endif >Yes</option>
            </select>
        </div>
        <div>
            <label for="exampleEmails">Sale From Date  *</label>
            <input type="date" class="form-control" value="{{$site_setting->sale_from?->format('Y-m-d')}}" name="sale_from" id="sale_from">
        </div>
        <div>
            <label for="exampleEmails">Sale To Date  *</label>
            <input type="date" class="form-control" value="{{$site_setting->sale_to?->format('Y-m-d')}}" name="sale_to" id="sale_to">
        </div>
    </div>
</div>