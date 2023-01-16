@extends('layouts.app')

@section('header_css')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

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
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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

<div class="row align-items-center m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Edit Product</h6>
                    <hr>
                    <form class="row g-3" action="{{ route('product.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="col-12">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->product_name }}">
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12">
                        <label class="form-label">Purchase Price</label>
                        <input type="number" class="form-control @error('product_purchase_price') is-invalid @enderror" name="product_purchase_price" value="{{ $product->product_purchase_price }}">
                        @error('product_purchase_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12">
                        <label class="form-label">Selling Price</label>
                        <input type="number" class="form-control @error('product_selling_price') is-invalid @enderror" name="product_selling_price" value="{{ $product->product_selling_price }}">
                        @error('product_selling_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" name="product_quantity" value="{{ $product->product_quantity }}">
                        @error('product_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Edit Product</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

</main>

@endsection

@section('footer_js')

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}")
    @endif
</script>

@endsection
