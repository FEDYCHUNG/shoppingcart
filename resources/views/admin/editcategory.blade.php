@extends('admin_layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit category</small></h3>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="frm_editcategory" method="POST" action="{{ route('admin.categories.updatecategory') }}">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{ isset($category) ? $category->id : '' }}">
                                    <div class="form-group">
                                        <label for="category_name">Category name</label>
                                        <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter category"
                                            value="{{ isset($category) ? $category->category_name : '' }}">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                    <a href="{{ route('admin.categories.categories') }}" class="btn btn-warning" value="Back">Back</a>
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
                    document.getElementById("frm_editcategory").submit();
                }
            });
            $('#frm_editcategory').validate({
                rules: {
                    category_name: {
                        required: true,
                    },
                },
                messages: {
                    category_name: {
                        required: "Please enter a Category Name",
                    },
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
