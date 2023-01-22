@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-md-10">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Edit Country
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form method="POST" action="{{ route('admin.country.update', $country->id) }}">
     @csrf
     <div class="card-body">

      <div class="form-group">
       <label>Country Name: <span class="text-danger">*</span></label>
       <input type="text" class="form-control" name="country_name" value="{{ $country->country_name }}"/>
       @error('country_name')
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
