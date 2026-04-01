@extends('layout.nav')
@section('content')
  <div class="content">
    <h3 class="text-center">Product Details</h3>
      <div class="col-md-12">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
      </div>
    <hr class="my-4">
</div>

@endsection




