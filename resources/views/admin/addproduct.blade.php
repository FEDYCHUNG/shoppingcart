@extends('admin_layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Add product</h3>
                            </div>

                            @if (Session::has('status'))
                                <div class="alert alert-success">
                                    {{ Session::get('status') }}
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="frm_addproduct" enctype="multipart/form-data" method="post" action="{{ route('admin.products.saveproduct') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_name">Product name</label>
                                        <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter product name">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product price</label>
                                        <input type="number" name="product_price" class="form-control" id="product_price" placeholder="Enter product price" min="1">
                                    </div>
                                    <div class="form-group">
                                        <label>Product category</label>
                                        <select class="form-control select2" name="product_category" style="width: 100%;">
                                            <option value="">Select Category</option>
                                            @isset($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <label for="product_image">Product image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="product_image" name="product_image">
                                            <label class="custom-file-label" for="product_image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    document.getElementById("frm_addproduct").submit();
                }
            });
            $('#frm_addproduct').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    product_price: {
                        required: true,
                    },
                    product_category: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: "Please enter a product name",
                    },
                    product_price: {
                        required: "Please provide a product price",
                    },
                    product_category: {
                        required: "Please provide a product category",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
