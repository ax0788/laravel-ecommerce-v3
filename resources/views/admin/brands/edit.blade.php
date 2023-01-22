@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-md-10">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Edit Brand
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data">
     @csrf
     @method('PUT')
     <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">

     <div class="card-body">

      <div class="form-group">
       <label>Brand Name: <span class="text-danger">*</span></label>
       <input type="text" class="form-control" name="brand_name_en" value="{{ $brand->brand_name_en }}" />
       @error('brand_name_en')
       <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>

      <div class="form-group">
       <label>Brand Image: <span class="text-danger">*</span></label>
       <input type="file" class="form-control" name="brand_image"  />
       @error('brand_image')
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
