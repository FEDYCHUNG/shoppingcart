@extends('admin_layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                        <form id="frm_categories" method="post" action="">
                            <input type="hidden" name="_method" id="_method" style="user-select: auto;">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All categories</h3>
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
                                                <th>Category Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1;  @endphp
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $category->category_name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.categories.editcategory', ['id' => $category->id]) }}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                                        <a href="{{ route('admin.categories.deletecategory', ['id' => $category->id]) }}" class="btn btn-danger delete">
                                                            <i class="nav-icon fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php $i++;  @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Num.</th>
                                                <th>Category Name</th>
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
        $(document).on("click", ".delete", function(e) {
            e.preventDefault();
            document.getElementById("_method").value = "delete";
            document.getElementById("frm_categories").action = $(this).attr("href");

            bootbox.confirm("Do you really want to delete this category name ?", function(confirmed) {
                if (confirmed) {
                    document.getElementById("frm_categories").submit();
                };
            });
        });
    </script>
    <!-- page script -->
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
        });
    </script>
@endsection
