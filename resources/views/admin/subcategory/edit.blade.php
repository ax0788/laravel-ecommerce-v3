@extends('admin.index')
@section('content')
 <div class="row">



  <div class="col-md-12">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Edit Sub-Category
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form method="POST" action="{{ route('admin.subcategories.update', $subcategory) }}">
        @csrf
        @method('PUT')
     <div class="card-body">
        <div class="form-group">
            <h5>Category Select <span class="text-danger">*</span></h5>
            <div class="controls">
             <select name="category_id" class="form-control">
              <option selected disabled>Select Category</option>
              @foreach ($categories as $category)
              {{-- When categories table id match with subcategories category_id column ids, then that will be selcted --}}
               <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }} >{{ $category->category_name_en }}
               </option>
              @endforeach
             </select>
             @error('category_id')
              <span class="text-danger">{{ $message }}</span>
             @enderror
            </div>
           </div>
           <div class="form-group">
            <h5>Subcategory Name:</h5>
            <div class="controls">
             <input type="text" name="subcategory_name_en" class="form-control" value="{{ $subcategory-> subcategory_name_en}}">
             @error('subcategory_name_en')
              <span class="text-danger">{{ $message }}</span>
             @enderror
            </div>
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
