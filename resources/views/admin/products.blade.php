@extends('admin_layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                        <form id="frm_products" method="post" action="">
                            <input type="hidden" name="_method" id="_method" style="user-select: auto;">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All Products</h3>
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
                                                <th>Product Name</th>
                                                <th>Product Category</th>
                                                <th>Product Price</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($products)
                                                @php $i=1; @endphp
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>
                                                            <img src="{{ asset('storage/product_images/' . $product->product_image) }}" style="height : 50px; width : 50px" class="img-circle elevation-2"
                                                                alt="User Image">
                                                        </td>
                                                        <td>{{ $product->product_name }}</td>
                                                        <td>{{ $product->category_name }}</td>
                                                        <td>{{ $product->product_price }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.products.active_unactive_product', ['id' => $product->id, 'status_update' => intval(!$product->status)]) }}"
                                                                class="btn {{ $product->status == config('constants.PRODUCT_ACTIVE') ? 'btn-success' : 'btn-warning' }}" id="active_unactive">
                                                                {{ $product->status == config('constants.PRODUCT_ACTIVE') ? 'Activate' : 'Unactivate' }}
                                                            </a>
                                                            <a href="{{ route('admin.products.editproduct', ['id' => $product->id]) }}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                                                            <a href="{{ route('admin.products.deleteproduct', ['id' => $product->id]) }}" id="delete" class="btn btn-danger">
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
                                                <th>Product Name</th>
                                                <th>Product Category</th>
                                                <th>Product Price</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </form>
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

            $(document).on("click", "#delete", function(e) {
                e.preventDefault();
                document.getElementById("_method").value = "DELETE";
                document.getElementById("frm_products").action = $(this).attr("href");

                bootbox.confirm("Do you really want to delete this product name ?", function(confirmed) {
                    if (confirmed) {
                        document.getElementById("frm_products").submit();
                    };
                });
            });

            $(document).on("click", "#active_unactive", function(e) {
                e.preventDefault();
                document.getElementById("_method").value = "put";
                document.getElementById("frm_products").action = $(this).attr("href");
                document.getElementById("frm_products").submit();
            });
        });
    </script>
@endsection
