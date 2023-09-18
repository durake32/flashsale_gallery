<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Social Links</h4>
    </div>
    <div class="card-body ">
        <div class="form-group bmd-form-group">
             <label for="title"> Facebook *</label>
            <input type="text" class="form-control" value="{{$site_setting['facebook']}}" name="facebook" id="facebook"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword"> Instagram *</label>
            <input type="text" class="form-control" value="{{$site_setting['instagram']}}" name="instagram"
                id="instagram" required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword"> Twitter *</label>
            <input type="text" class="form-control" value="{{$site_setting['twitter']}}" name="twitter" id="twitter"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword"> LinkedIn *</label>
            <input type="text" class="form-control" value="{{$site_setting['linkedin']}}" name="linkedin" id="linkedin"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
         <div class="form-group bmd-form-group">
            <label for="examplePassword" > Whatsapp *</label>
            <input type="text" class="form-control" value="{{$site_setting['whatsapp']}}" name="whatsapp" id="whatsapp"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword"> Youtube *</label>
            <input type="text" class="form-control" value="{{$site_setting['youtube']}}" name="youtube" id="youtube"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
    </div>
</div>