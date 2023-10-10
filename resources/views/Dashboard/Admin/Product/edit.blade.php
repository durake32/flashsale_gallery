@extends('Dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" action="{{ route($segment . '.' . 'product.update', $product->id) }}" id="form-example-1" method="POST"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger col-md-12">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-cube fa-2x"></i>
                            </div>
                            @include('Dashboard.Commons.breadcrum')
                        </div>
                        <a class="col-md-3 btn btn-success btn-sm" 
                        href="{{ route('admin.createProductImage',$product->id)}}"> Manage Product Gallery</a>
                        @include('Dashboard.Admin.Product.fields')

                    </div>
                        @include('Dashboard.Admin.Product.Partials.main_image-section')

                </div>
                <div class="col-md-4">
                    @include('Dashboard.Admin.Product.Partials.edit-status')
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <h4 class="card-title">Product Type</h4>
                        </div>
                        <div class="card-body">
                            <div class="box-footer" style="display: block;">
                                <select class="browser-default custom-select" name="product_type">
                                    <option selected value="">Select product type</option>
                                    <option value="online" @if($product->product_type == "online") selected @endif>Online</option>
                                    <option value="offline"  @if($product->product_type == "offline") selected @endif>Offline</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @include('Dashboard.Admin.Product.Partials.edit-brand')
                    @include('Dashboard.Admin.Product.Partials.edit-category')

                    @include('Dashboard.Admin.Product.Partials.edit-sub_category')

                    @if ($segment == 'admin')
                        @include('Dashboard.Admin.Product.Partials.edit-retailer')
                    @endif

                    @include('Dashboard.Admin.Product.Partials.edit-is_featured')
                   @include('Dashboard.Admin.Product.Partials.edit-section1')

                    @include('Dashboard.Commons.update-button-section')
                </div>
            </div>
        </form>

    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#category').on('change',function(e) {
                var cat_id = e.target.value;
                $.ajax({
                    url:"{{ route('subCategory') }}",
                    type:"POST",
                    data: {
                        category_id: cat_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success:function (data) {
                        $('#subcategory').empty();
                        $.each(data.subcategories, function (key, value) {
                            $("#subcategory").append('<option value="'+ value.id +'">' + value.name + '</option>');
                        });
                    }
                })
            });
        });
    </script>
@endsection
