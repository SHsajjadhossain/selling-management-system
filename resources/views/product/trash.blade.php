@extends('layouts.app')

@section('header_css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.0/sweetalert2.min.css">
@endsection

@section('content')

<main class="page-content">

<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
            <button type="button" class="btn btn-primary">Settings</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                <a class="dropdown-item" href="javascript:;">Another action</a>
                <a class="dropdown-item" href="javascript:;">Something else here</a>
                <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
            </div>
            </div>
        </div>
    </div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0">Product List</h5>
            <form class="ms-auto position-relative">
                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                <input class="form-control ps-5" type="text" placeholder="search">
            </form>
        </div>
        <div class="table-responsive mt-3">
            <table class="table align-middle">
                <thead class="table-secondary">
                    <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($trash_products as $key => $trash_product)
                        <tr>
                            {{-- <input type="hidden" class="fdelete" value="{{ $trash_product->id }}"> --}}
                            <td>{{ $trash_products->firstItem() +$key }}</td>
                            <td>{{ $trash_product->product_name }}</td>
                            <td>{{ $trash_product->product_purchase_price }}</td>
                            <td>{{ $trash_product->product_selling_price }}</td>
                            <td>{{ $trash_product->product_quantity }}</td>
                            <td>
                                {{-- <a href="#" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a> --}}
                                <a href="{{ route('trash.restore', $trash_product->id) }}" class="text-primary me-3" style="font-size: 16px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Restore" aria-label="Edit">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                                <a href="" data-id ="{{ $trash_product->id }}" class="text-danger force_delete" style="font-size: 14px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="50" class="text-center">
                                <span class="text-danger">No Product To Show</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->

    {{ $trash_products->links() }}
</div>

</main>

@endsection

@section('footer_js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.0/sweetalert2.all.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif


        $(document).on('click', '.force_delete', function (e) {
                e.preventDefault();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                    swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to recover this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var force_delete = $(this).data('id');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            url: '/product/trash/forcedelete',
                            data: {force_delete:force_delete},
                            success: function (response) {
                                if (response.status=='success') {
                                    $('.table').load(location.href+' .table');
                                    swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted Successfully.',
                                    'success'
                                    );
                                }
                            }
                        });

                    }
                    else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                        )
                    }
                })
        });

    </script>
@endsection
