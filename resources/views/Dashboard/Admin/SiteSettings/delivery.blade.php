<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">Delivery</i>
        </div>
        <h4 class="card-title">Delivery</h4>
    </div>
    <div class="card-body ">
        <div>
            <label for="exampleEmails">Delivery charge applicable below *</label>
            <input type="text" class="form-control" value="{{$site_setting['aplicable']}}" name="aplicable" id="meta_title"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
    
        <div>
            <label for="exampleEmails"> Delivery charge *</label>
            <input type="text" class="form-control" value="{{$site_setting['charge']}}" name="charge" id="meta_title"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div>
            <label for="exampleEmails"> Minimum Cart Amount *</label>
            <input type="text" class="form-control" value="{{$site_setting['minimum_amount']}}" name="minimum_amount"
                id="minimum_amount" required="true" aria-required="true" style="cursor: auto;">
        </div>
    </div>
</div>