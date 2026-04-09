@extends('layout.nav')
@section('content')
  <div class="content">
    <h3 class="text-center">Sales Details</h3>
      <div class="col-md-12">
        <a href="{{ route('sell.create') }}" class="btn btn-success">Create Sale</a>
      </div>
    <hr class="my-4">
</div>

@endsection