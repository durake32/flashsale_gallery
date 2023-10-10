@extends('Dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" action="{{ route($segment . '.' . 'product.store') }}" id="form-example-1" method="POST"
            enctype="multipart/form-data">
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
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="fas fas fa-cube fa-2x"></i>
                            </div>
                            @include('Dashboard.Commons.breadcrum')
                        </div>
                        @include('Dashboard.Admin.Product.fields')
                    </div>
                    @include('Dashboard.Admin.Product.Partials.main_image-section')
                </div>
                <div class="col-md-4">

                    @include('Dashboard.Commons.status')

                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <h4 class="card-title">Product Type</h4>
                        </div>
                        <div class="card-body">
                            <div class="box-footer" style="display: block;">
                                <select class="browser-default custom-select" name="product_type">
                                    <option selected value="">Select product type</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @include('Dashboard.Admin.Product.Partials.brand')

                    @include('Dashboard.Admin.Product.Partials.category')

                    @include('Dashboard.Admin.Product.Partials.sub_category')

                    {{-- @can(['is_admin', 'is_super_admin'])
                        @include('Dashboard.Admin.Product.Partials.retailer')
                    @endcan --}}

                    {{-- @if (Gate::check('is_admin') || Gate::check('is_super_admin')) --}}
                    @if($segment == 'admin')
                        @include('Dashboard.Admin.Product.Partials.retailer')
                    @endif

                    @include('Dashboard.Admin.Product.Partials.is_featured')
                   @include('Dashboard.Admin.Product.Partials.section1')

                    @include('Dashboard.Includes.Buttons.submit-button-section')

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
