@php
$categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
@endphp
<div class="side-menu animate-dropdown outer-bottom-xs">
 <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
 <nav class="yamm megamenu-horizontal">
  <ul class="nav">

   @foreach ($categories as $category)
    <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
       class="icon {{ $category->category_icon }}" aria-hidden="true"></i>
       {{ $category->category_name_en }}
     </a>
     <ul class="dropdown-menu mega-menu">
      <li class="yamm-content">
       <div class="row">
        {{-- GET SubCategory Table Data --}}
        @php
         $subcategories = App\Models\SubCategory::where('category_id', $category->id)
             ->orderBy('subcategory_name_en', 'ASC')
             ->get();
        @endphp
        @foreach ($subcategories as $subcategory)
         <div class="col-sm-12 col-md-3">
          <a href="{{ url('subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug_en) }}">
           <h2 class="title mt-5">
             {{ $subcategory->subcategory_name_en }}
           </h2>
          </a>
         </div>
         <!-- /.col -->
        @endforeach
       </div>
       <!-- /.row -->
      </li>
      <!-- /.yamm-content -->
     </ul>
     <!-- /.dropdown-menu -->
    </li>
    <!-- /.menu-item -->
   @endforeach
  </ul>

  <!-- /.nav -->
 </nav>
 <!-- /.megamenu-horizontal -->
</div>
