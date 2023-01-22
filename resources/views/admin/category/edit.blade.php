@extends('admin.index')
@section('content')
 <div class="row">



  <div class="col-md-10">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Edit Category
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="card-body">

      <div class="form-group">
       <label>Icon Class: <span class="text-danger">*</span></label>
       <input type="text" class="form-control" name="category_icon" value="{{ $category->category_icon }}" />
       @error('category_icon')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>

      <div class="form-group">
       <label>Category Name: <span class="text-danger">*</span></label>
       <input type="input" class="form-control" name="category_name_en"  value="{{ $category->category_name_en }}"/>
       @error('category_name_en')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>

      <div class="card-footer">
       <button type="submit" class="btn btn-primary mr-2">Update</button>
      </div>
    </form>
    <!--end::Form-->
   </div>
  </div>
 </div>
@endsection
