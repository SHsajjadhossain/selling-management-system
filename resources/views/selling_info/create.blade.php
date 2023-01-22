@extends('layouts.app')

@section('header_css')

{{-- <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/jQuery-ui/jquery-ui.min.css') }}"> --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@endsection

@section('content')

<main class="page-content">

<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Selling Info</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add Selling Info</li>
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
                <h6 class="mb-0 text-uppercase">Add Selling Info (Customer)</h6>
                    <hr>
                    <form class="row g-3" action="{{ route('selling_info.store') }}" method="POST">
                        @csrf
                        <div class="col-12">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ old('customer_name') }}">
                        @error('customer_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ old('customer_email') }}">
                        @error('customer_email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12">
                        <label class="form-label">Phone</label>
                        <input type="number" class="form-control @error('customer_phone') is-invalid @enderror" name="customer_phone" value="{{ old('customer_phone') }}">
                        @error('customer_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name') }}">
                            @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Product Price</label>
                            <input type="number" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" value="{{ old('product_price') }}">
                            @error('product_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Product Quantity</label>
                            <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" name="product_quantity" value="{{ old('product_quantity') }}">
                            @error('product_quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Add Selling Info</button>
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

{{-- <script src="{{ asset('dashboard/assets/js/jquery-3.6.3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboard/assets/plugins/jQuery-ui/jquery-ui.min.js') }}"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}")
    @endif
</script>

{{-- <script>
    $(document).ready(function () {
        $("#product_name").autocomplete({
            source: [
                'Apple',
                'Banana',
                'Orange'
            ]
        });
    });
</script> --}}

{{-- <script>
    $(document).ready(function () {
        $('#product_name').autocomplete({
            source: function (request, response) {
                $.getJSON("{{ route('selling_info.product_info') }}", function(data){
                    var array = $.map(data, function (row) {
                        return {
                            value:row.product_price,
                            label:row.product_name
                        }
                    })

                    response(array);
                })
             }
        });
    });
</script> --}}

{{-- <script type="text/javascript">

    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function () {
        $("#product_name").autocomplete({
            source:function(request, response){
                // Fetch data
                $.ajax({
                    url:"{{ route('selling_info.getProductinfo') }}",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        product_name: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#product_name').val(ui.item.label); // display the selected text
                $('#product_price').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });

</script> --}}



@endsection

