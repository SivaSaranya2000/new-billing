@extends('layout.nav')
@section('content')
 <div class="content">
    <h3 class="text-center">Purchase Details</h3>
      <div class="col-md-12">
        <a href="{{ route('purchases.create') }}" class="btn btn-success">Add Purchase</a>
      </div>
    <hr class="my-4">
</div>


                                  


@endsection