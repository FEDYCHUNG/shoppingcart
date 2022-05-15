@extends('admin_layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sliders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form id="frm_sliders" method="post" action="">
                            <input type="hidden" name="_method" id="_method" value="">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All Sliders</h3>
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
                                <div class="card-body">
                                    <table id="example1" class="table-bordered table-striped table">
                                        <thead>
                                            <tr>
                                                <th>Num.</th>
                                                <th>Picture</th>
                                                <th>Description one</th>
                                                <th>Description Two</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($sliders)
                                                @php $i=1; @endphp
                                                @foreach ($sliders as $slider)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/slider_images/' . $slider->slider_image) }}" style="height : 50px; width : 50px" class="img-circle elevation-2"
                                                                alt="User Image">
                                                        </td>
                                                        <td>{{ $slider->description1 }}</td>
                                                        <td>{{ $slider->description2 }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.sliders.active_unactive_slider', ['id' => $slider->id, 'status_update' => intval(!$slider->status)]) }}"
                                                                class="active_unactive btn {{ $slider->status == config('constants.SLIDER_ACTIVE') ? 'btn-success' : 'btn-warning' }}">
                                                                {{ $slider->status == config('constants.SLIDER_ACTIVE') ? 'Activate' : 'Unactivate' }}
                                                            </a>
                                                            <a href="{{ route('admin.sliders.editslider', ['id' => $slider->id]) }}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                                            <a href="{{ route('admin.sliders.deleteslider', ['id' => $slider->id]) }}" class="delete btn btn-danger">
                                                                <i class="nav-icon fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Num.</th>
                                                <th>Picture</th>
                                                <th>Description one</th>
                                                <th>Description Two</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $(document).on("click", ".active_unactive", function(e) {
                e.preventDefault();
                document.getElementById("_method").value = "put";
                document.getElementById("frm_sliders").action = $(this).attr("href");
                document.getElementById("frm_sliders").submit();
            });

            $(document).on("click", ".delete", function(e) {
                e.preventDefault();
                document.getElementById("_method").value = "delete";
                document.getElementById("frm_sliders").action = $(this).attr("href");
                bootbox.confirm("Do you really want to delete this slider ?", function(confirmed) {
                    if (confirmed) {
                        document.getElementById("frm_sliders").submit();
                    };
                });
            });
        });
    </script>
@endsection
