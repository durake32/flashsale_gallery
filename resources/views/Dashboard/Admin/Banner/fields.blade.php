<div class="card-body ">
    <div class="form-group bmd-form-group">
        <label for="title"> Title *</label>
        <input type="text" class="form-control" value="{{$banner->title }}" name="title" id="title">
    </div>

    <div class="form-group bmd-form-group">
        <label for="url"> Url *</label>
        <input type="text" class="form-control" value="{{$banner->url }}" name="url" id="url">
    </div>
  
    <div class="input-group input-group-static mb-4">
      <label for="exampleFormControlSelect1" class="ms-0">Type select</label> 
     <select  class="form-control" id="exampleFormControlSelect1" name="type" id="type">
        <option value="category" class="form-control">Categoty</option>
        <option value="subcategory" class="form-control">SubCategory</option>
        <option value="brand" class="form-control">Brand</option>
      </select>
    </div>
  
 
        <div class="input-group input-group-static mb-4">
        <label for="type_id"> Select Category *</label>
       <select class="form-control" name="type_id" id="type">
      <option   class="form-control" disabled selected>Please Select Category</option>
         @foreach($categories as $cat)
        <option value="{{$cat->id}}"  {{$cat->id == $banner->type_id  ? 'selected' : ''}}  class="form-control">{{$cat->name}}</option>
         @endforeach
      </select>
     </div>
  
       <div class="input-group input-group-static mb-4">
        <label for="type_id"> Select SubCategory *</label>
       <select class="form-control" name="type_id" id="type">
         <option  class="form-control" disabled selected>Please Select SubCategory</option>
         @foreach($subcategories as $subcat)
        <option value="{{$subcat->id}}" {{$subcat->id == $banner->type_id  ? 'selected' : ''}} class="form-control">{{$subcat->name}}</option>
         @endforeach
      </select>
     </div>
  
  
          <div class="input-group input-group-static mb-4">
        <label for="type_id"> Select Brand *</label>
       <select class="form-control" name="type_id" id="type">
         <option   class="form-control" disabled selected>Please Select Brand</option>
         @foreach($brands as $brand)
        <option value="{{$brand->id}}" {{$brand->id == $banner->type_id  ? 'selected' : ''}} class="form-control">{{$brand->name}}</option>
         @endforeach
      </select>
     </div>
  
  
     <div class="form-group bmd-form-group">
        <label for="title"> Description *</label>
        <textarea rows="10" class="form-control" name="description"
            id="description">{{  $banner->description }}</textarea>
    </div>

</div>
