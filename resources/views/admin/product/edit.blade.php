@extends('admin.index')
@section('content')
 {{-- JQUERY --}}
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

 <!--begin::Card-->
 <div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
   <h3 class="card-title">
    EDIT PRODUCT
   </h3>
  </div>
  <!--begin::Form-->
  <form method="POST" action="{{ route('admin.products.update', $products) }}">
   @csrf
   @method('PUT')
   <input type="hidden" name="id" value="{{ $products->id }}">
   <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">


   <div class="card-body">
    {{-- start 1st row --}}
    <div class="form-group row">
     {{-- start 1st col --}}
     <div class="col-lg-4">
      <label>Select Brand:</label>
      <div class="controls">
       <select name="brand_id" class="form-control" required>
        <option selected disabled>Brand</option>
        @foreach ($brands as $brand)
         {{-- when brandtable id matches with product table brand_id, select --}}
         <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
          {{ $brand->brand_name_en }}</option>
        @endforeach
       </select>
       @error('brand_id')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
     </div>

     {{-- start 2nd col --}}

     <div class="col-lg-4">
      <label>Select Category:</label>
      <div class="controls">
       <select name="category_id" class="form-control" required>
        <option selected disabled>Category</option>
        @foreach ($categories as $category)
         <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected' : '' }}>
          {{ $category->category_name_en }}</option>
        @endforeach
       </select>
       @error('category_id')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
     </div>
     {{-- start 3rd col --}}

     <div class="col-lg-4">
      <label>Select subcategory:</label>
      <div class="controls">
       <select name="subcategory_id" class="form-control" required>
        <option selected>Select SubCategory</option>
        @foreach ($subcategories as $subcategory)
         <option value="{{ $subcategory->id }}" {{ $subcategory->id == $products->subcategory_id ? 'selected' : '' }}>
          {{ $subcategory->subcategory_name_en }}</option>
        @endforeach
       </select>
       @error('subcategory_id')
        <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
     </div>
    </div>
    {{-- end 1st row --}}


    {{-- start 2nd row --}}
    <div class="form-group row">

     {{-- start 1st col --}}
     <div class="col-lg-4">
      <label>Name:</label>
      <input type="text" class="form-control" name="product_name_en" required
       value="{{ $products->product_name_en }}">
      @error('product_name_en')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>

     {{-- start 2nd col --}}

     <div class="col-lg-4">
      <label>Product Code:</label>
      <input type="text" class="form-control" name="product_code" value="{{ $products->product_code }}">
      @error('product_code')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>

     {{-- start 3rd col --}}
     <div class="col-lg-4">
      <label>Quantity:</label>
      <input type="text" name="product_qty" class="form-control" required value="{{ $products->product_qty }}">
      @error('product_qty')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
    </div>
    {{-- end 2nd row --}}




    {{-- start 3rd row --}}
    <div class="form-group row">

     {{-- start 1st col --}}
     <div class="col-lg-4">
      <label>Tags:</label>
      <input type="text" class="form-control" name='product_tags' value="{{ $products->product_tags }}" />
      @error('product_tags')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>

     {{-- start 2nd col --}}

     <div class="col-lg-4">
      <label>Size:</label>
      <input type="text" class="form-control" name='product_size' value="{{ $products->product_size }}" />

      @error('product_size_en')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>

     {{-- start 3rd col --}}

     <div class="col-lg-4">
      <label>Color:</label>
      <input type="text" class="form-control" name='product_color' value="{{ $products->product_color }}" />
      @error('product_color')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
    </div>
    {{-- end 3rd row --}}


    {{-- start 4th row --}}
    <div class="form-group row">

     {{-- start 1st col --}}
     <div class="col-lg-4">
      <label>Selling Price:</label>
      <input type="number" class="form-control" name='selling_price' required value="{{ $products->selling_price }}" />
      @error('selling_price')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>

     {{-- start 2nd col --}}

     <div class="col-lg-4">
      <label>Discount Price:</label>
      <input type="number" name="discount_price" class="form-control" required value="{{ $products->discount_price }}">
      @error('discount_price')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>

     {{-- start 3rd col --}}





    </div>
    {{-- end 4th row --}}


    {{-- start 5th row --}}
    <div class="form-group row">

     {{-- start 1st col --}}
     <div class="col-lg-6">
      <label>Product description (short):</label>
      <textarea name="short_descp_en" class="form-control">        {!! $products->short_descp !!}
    </textarea>
     </div>

     {{-- start 2nd col --}}

     <div class="col-lg-6">
      <label>Product description (long):</label>
      <textarea id="editor1" name="long_descp_en" rows="10" cols="80">
        {!! $products->long_descp !!}
            </textarea>
     </div>
    </div>

    {{-- end 5th row --}}


    {{-- start 6th row --}}
    <div class="form-group row">

     <div class="col-lg-6">
      <div class="form-group">
       <fieldset>
        <input type="checkbox" id="checkbox_2" name="hot_deals" value="1"
         {{ $products->hot_deals == 1 ? 'checked' : '' }}>
        <label for="checkbox_2">Hot Deals</label>
       </fieldset>

       <fieldset>
        <input type="checkbox" id="checkbox_3" name="featured" value="1"
         {{ $products->featured == 1 ? 'checked' : '' }}>
        <label for="checkbox_3">Featured</label>
       </fieldset>
      </div>
     </div>

     <div class="col-lg-6">
      <div class="form-group">
       <fieldset>
        <input type="checkbox" id="checkbox_4" name="special_offer" value="1"
         {{ $products->special_offer == 1 ? 'checked' : '' }}>
        <label for="checkbox_4">Special Offer</label>
       </fieldset>
      </div>
     </div>
    </div>
    {{-- end 6th row --}}
   </div> {{-- end card body --}}
   <div class="card-footer">
    <div class="row">
     <div class="col-lg-4"></div>
     <div class="col-lg-8">
      <button type="submit" class="btn btn-success mr-2">Update</button>
      <button type="reset" class="btn btn-danger">Cancel</button>
     </div>
    </div>
   </div>
  </form>
  <!--end::Form-->
 </div>
 <!--end::Card-->

 <div class="card card-custom gutter-b">
  <div class="card-header">
   <h3 class="card-title">
    Edit Thumbnail Image
   </h3>
  </div>

  {{-- Thumbnail Image Update Section  START --}}
  <form method="post" action="{{ route('admin.products.update.thumbnail') }}" enctype="multipart/form-data">
   @csrf
   <input type="hidden" name="id" value="{{ $products->id }}">
   <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">

   <div class="card-body">
    <div class="form-group row">

     <div class="card text-center">
      <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top mt-3"
       style="width:140px; height:275px; margin:0 auto;">
      <div class="card-body">
       <p class="card-text">
       <div class="form-group">
        <label class="form-control-label">Change Image <span class="text-danger">*</span></label>
        <input type="file" class="form-control mb-7" name="product_thumbnail" onchange="mainThumbnailUrl(this)">
        <br><br>
        <img src="" id="mainThumb">
       </div>
       </p>
      </div>
     </div> <!-- End col md 3  -->
    </div>
    <div class="card-footer">
     <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-8">
       <button type="submit" class="btn btn-success mr-2">Update</button>
       <button type="reset" class="btn btn-danger">Cancel</button>
      </div>
     </div>
    </div>
  </form>
</div>
  {{-- Thumbnail Image Update Section END --}}

  <div class="card card-custom gutter-b mt-5 pd-10">
    <div class="card-header">
     <h3 class="card-title">
        Product Multiple Image Update
    </h3>
    </div>

    <form method="post" action="{{ route('admin.products.update.multiImage') }}" enctype="multipart/form-data">
        @csrf

        <div class="row pd-10 m-10 ">
         @foreach ($multiImages as $img)
          <div class="col-md-3 pd-2">
           <div class="card text-center">
            <img src="{{ asset($img->photo_name) }}" class="card-img-top mt-3"
             style="width:140px; height:275px; margin:0 auto;">

            <div class="card-body">
             <a href="{{ route('admin.products.delete.multiImage', $img->id) }}"
              class=" card-title btn btn-sm btn-danger m-5" id="delete" title="Delete Img"><i
               class="fa fa-trash fa-xl"></i></a>
             <p class="card-text">
             <div class="form-group">
              <label class="form-control-label">Change Image <span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="multi_img[{{ $img->id }}]">
             </div>
             </p>
            </div>
           </div>
          </div> <!-- End col md 3  -->
         @endforeach
        </div>
        <div class="card-footer">
            <div class="row">
             <div class="col-lg-4"></div>
             <div class="col-lg-8">
              <button type="submit" class="btn btn-success mr-2">Update</button>
              <button type="reset" class="btn btn-danger">Cancel</button>
             </div>
            </div>
           </div>
       </form>

  </div>


 <script type="text/javascript">
  $(document).ready(function() {
   $('select[name="category_id"]').on('change', function() {
    const category_id = $(this).val();
    if (category_id) {
     $.ajax({
      url: "{{ url('/admin/products/create/ajax') }}/" + category_id,
      type: "GET",
      dataType: "json",
      success: function(data) {
       $('select[name="subsubcategory_id"]').html('');
       const d = $('select[name="subcategory_id"]').empty();
       $.each(data, function(key, value) {
        $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value
         .subcategory_name_en + '</option>');
       });
      },
     });
    } else {
     alert('danger');
    }
   });
  });
 </script>

 <script>
  function mainThumbnailUrl(input) {
   if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
     $('#mainThumb').attr('src', e.target.result).width(140).height(275);
    };
    reader.readAsDataURL(input.files[0]);
   }
  }
 </script>




 {{-- Show Multi Image JavaScript Code --}}
 <script>
  $(document).ready(function() {
   $('#multiImg').on('change', function() { //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
     const data = $(this)[0].files; //this file data

     $.each(data, function(index, file) { //loop though each file
      if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
       const fRead = new FileReader(); //new filereader
       fRead.onload = (function(file) { //trigger function on successful read
        return function(e) {
         const img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(140)
          .height(140); //create image element
         $('#preview_img').append(img); //append image to output element
        };
       })(file);
       fRead.readAsDataURL(file); //URL representing the file's data.
      }
     });

    } else {
     alert("Your browser doesn't support File API!"); //if File API is absent
    }
   });
  });
 </script>
 {{-- ====End Show Multi Image JavaScript Code==== --}}
@endsection
