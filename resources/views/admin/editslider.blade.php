@extends('admin_layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slider</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Slider</li>
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
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Edit slider</h3>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="frm_editslider" enctype="multipart/form-data" method="post" action="{{ route('admin.sliders.updateslider') }}">
                                @method('put')
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $slider->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="description1">Slider description 1</label>
                                        <input type="text" name="description1" class="form-control" id="description1" placeholder="Enter slider description" value="{{ $slider->description1 }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description2">Slider description 2</label>
                                        <input type="text" name="description2" class="form-control" id="description2" placeholder="Enter slider description" value="{{ $slider->description2 }}">
                                    </div>
                                    <label for="slider_image">Slider image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="slider_image" name="slider_image">
                                            <label class="custom-file-label" for="slider_image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="submit" class="btn btn-warning" value="Update">
                                    <a href="{{ route('admin.sliders.sliders') }}" class="btn btn-warning">Back</a>
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
                    document.getElementById("frm_editslider").submit();
                }
            });
            $('#frm_editslider').validate({
                rules: {
                    description1: {
                        required: true,
                    },
                    description2: {
                        required: true,
                    },
                },
                messages: {
                    description1: {
                        required: "Please provide Slider description 1",
                    },
                    description2: {
                        required: "Please provide Slider description 2",
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
