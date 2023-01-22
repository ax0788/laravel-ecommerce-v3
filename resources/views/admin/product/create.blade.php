@extends('admin.index')
@section('content')
  {{-- JQUERY --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

 <!--begin::Card-->
 <div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
   <h3 class="card-title">
   ADD NEW PRODUCT
   </h3>
  </div>
  <!--begin::Form-->
  <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
   @csrf

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
          <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
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
           <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
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
                <option disabled selected>subcategory</option>
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
      <input type="text" name="product_name_en" class="form-control" required>
      @error('product_name_en')
       <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>

     {{-- start 2nd col --}}

     <div class="col-lg-4">
        <label>Product Code:</label>
        <input type="text" name="product_code" class="form-control" required>
        @error('product_code')
         <span class="text-danger">{{ $message }}</span>
        @enderror
       </div>

     {{-- start 3rd col --}}
     <div class="col-lg-4">
        <label>Quantity:</label>
        <input type="text" name="product_qty" class="form-control" required>
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
        <input type="text" class="form-control" name='product_tags'  required/>
       @error('product_tags')
        <span class="text-danger">{{ $message }}</span>
       @enderror
       </div>

     {{-- start 2nd col --}}

     <div class="col-lg-4">
        <label>Main Size:</label>
        <input type="text" class="form-control" name='product_size'  required/>

       @error('product_size_en')
        <span class="text-danger">{{ $message }}</span>
       @enderror
       </div>

     {{-- start 3rd col --}}

     <div class="col-lg-4">
        <label>Color:</label>
        <input type="text" class="form-control" name='product_color'  required/>
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
           <input type="number" class="form-control" name='selling_price'  required/>
           @error('selling_price')
            <span class="text-danger">{{ $message }}</span>
           @enderror
          </div>

        {{-- start 2nd col --}}

        <div class="col-lg-4">
           <label>Discount Price:</label>
           <input type="number" name="discount_price" class="form-control" required>
           @error('discount_price')
            <span class="text-danger">{{ $message }}</span>
           @enderror
          </div>

        {{-- start 3rd col --}}

        <div class="col-lg-4">
           <label>Main Thumbnail:</label>
           <input type="file" name="product_thumbnail" class="form-control" onchange="mainThumbnailUrl(this)"
               required>
              @error('product_thumbnail')
               <span class="text-danger">{{ $message }}</span>
              @enderror
              <img src="" id="mainThumb">
          </div>


        <div class="col-lg-4">
           <label>Product Images:</label>
           <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg" required>
              @error('multi_img')
               <span class="text-danger">{{ $message }}</span>
              @enderror
              <div class="row" id="preview_img"></div>
          </div>
       </div>
    {{-- end 4th row --}}


    {{-- start 5th row --}}
    <div class="form-group row">

        {{-- start 1st col --}}
        <div class="col-lg-6">
           <label>Product description (short):</label>
           <textarea name="short_descp_en" class="form-control" required></textarea>
          </div>

        {{-- start 2nd col --}}

        <div class="col-lg-6">
           <label>Product description (long):</label>
           <textarea id="editor1" name="long_descp_en" rows="10" cols="80">
            </textarea>
          </div>
       </div>

    {{-- end 5th row --}}


    {{-- start 6th row --}}
    <div class="form-group row">
        <div class="col-lg-6">
            <div class="form-group">
                 <fieldset>
                  <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                  <label for="checkbox_2">Hot Deals</label>
                 </fieldset>
                 <fieldset>
                  <input type="checkbox" id="checkbox_3" name="featured" value="1">
                  <label for="checkbox_3">Featured</label>
                 </fieldset>
               </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                 <fieldset>
                  <input type="checkbox" id="checkbox_4" name="special_offer" value="1">
                  <label for="checkbox_4">Special Offer</label>
                 </fieldset>
               </div>
        </div>
    </div>
    {{-- end 6th row --}}


   </div>
   <div class="card-footer">
    <div class="row">
     <div class="col-lg-4"></div>
     <div class="col-lg-8">
      <button type="submit" class="btn btn-primary mr-2">Submit</button>
      <button type="reset" class="btn btn-secondary">Cancel</button>
     </div>
    </div>
   </div>
  </form>
  <!--end::Form-->
 </div>
 <!--end::Card-->


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
       $('#mainThumb').attr('src', e.target.result).width(140).height(140);
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
