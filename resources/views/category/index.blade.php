@extends('layout.nav')
@section('content')
<div class="content">
    <h3 class="mb-4">Category Details</h3>

<!-- Add Category Form -->
    <form  action="{{ route('categories.store')}}" method="POST" id="categoryForm" class="row g-3 mb-4">
      @csrf
      <div class="col-md-3">
        <label for="CategoryName">Category Name :<span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="category" id="Categoryname" placeholder="Enter Category Name" required />
      </div>
      <div class="col-md-3">
        <label for="categoryCode">Category Code :</label>
        <input type="text" class="form-control" name="category_code" id="categorycode" placeholder="Enter Category Code" />
      </div>
      <div class="col-md-3">
        <label for="categorydescription">Description :</label>
        <input type="text" class="form-control" name="description" id="categorydescription" placeholder="Enter Description" />
      </div>
      <div class="col-md-3">
        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>Add Category</button>
      </div>
    </form>
</div>
@endsection