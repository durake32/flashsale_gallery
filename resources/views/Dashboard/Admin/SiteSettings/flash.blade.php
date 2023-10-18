<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">Flash</i>
        </div>
        <h4 class="card-title">Flash Sales</h4>
    </div>
    <div class="card-body ">
        <div>
            <label for="flash_title">Flash Title  *</label>
            <input type="text" class="form-control" value="{{$site_setting->flash_title}}" name="flash_title" id="flash_title">
        </div>
        <div>
            <label for="enable_flash_sale">Enable Flash Sale *</label>
            <select class="browser-default custom-select" name="enable_flash_sale">
                <option value="0" @if($site_setting->enable_flash_sale == 0) selected @endif>No</option>
                <option value="1" @if($site_setting->enable_flash_sale == 1) selected @endif >Yes</option>
            </select>
        </div>
        <div>
            <label for="sale_from">Sale From Date  *</label>
            <input type="date" class="form-control" value="{{$site_setting->sale_from?->format('Y-m-d')}}" name="sale_from" id="sale_from">
        </div>
        <div>
            <label for="sale_to">Sale To Date  *</label>
            <input type="date" class="form-control" value="{{$site_setting->sale_to?->format('Y-m-d')}}" name="sale_to" id="sale_to">
        </div>
        <div>
            <label for="sale_to">Flash Image *</label>
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                @isset($site_setting['flash_image'])
                <div class="fileinput-new thumbnail">
                    <img src="{{asset('Asset/Uploads/Logo/'.$site_setting['flash_image'])}}" alt="{{$site_setting['flash_image']}}">
                </div>
                @else
                <div class="fileinput-new thumbnail">
                    <img src="{{asset('Asset/Dashboard/Images/Static/avatar.jpg')}}" alt="...">
                </div>
                @endif
                
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select Flash Image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="flash_image" kl_vkbd_parsed="true">
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i
                            class="fa fa-times"></i> Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>