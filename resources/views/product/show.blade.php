{{-- @extends('layouts.app')

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
            {{ $product }}

            @forelse ($products as $product)
                <tr>
                    <td>{{ $product }}</td>
                    <td>{{ $loop->index +1 }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_purchase_price }}</td>
                    <td>{{ $product->product_selling_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>
                        <a href="{{ route('product.show', $product->id) }}" class="text-primary"><i class="bi bi-eye-fill"></i></a>
                        <a href="#" class="text-warning mx-4"><i class="bi bi-pencil-fill"></i></a>
                        <a href="#" class="text-danger"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="50">
                        <span class="text-danger">No Product To Show</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
    </div>
</div>

</main>

@endsection --}}
