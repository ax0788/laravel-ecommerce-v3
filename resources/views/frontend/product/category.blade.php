@extends('frontend.main_master')
@section('title')
 Category Products
@endsection
@section('content')
 <div class="breadcrumb">
  <div class="container">
   <div class="breadcrumb-inner">
    <ul class="list-inline list-unstyled">
     <li><a href="#">Home</a></li>
     <li class='active'>Handbags</li>
    </ul>
   </div>
   <!-- /.breadcrumb-inner -->
  </div>
  <!-- /.container -->
 </div>
 <!-- /.breadcrumb -->


 <div class="body-content outer-top-xs">
  <div class='container'>
   <div class='row'>
    <div class='col-md-3 sidebar'>
     <!-- ================================== TOP NAVIGATION ================================== -->
     {{-- @include('frontend.common.vertical_menu') --}}
     <!-- /.side-menu -->
     <!-- ================================== TOP NAVIGATION : END ================================== -->
     <div class="sidebar-module-container">
      <div class="sidebar-filter">
       <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
       <div class="sidebar-widget wow fadeInUp">
        <h3 class="section-title">shop by</h3>

        <form action="{{ $currenturl}}" method="GET">
        <div class="widget-header">
         <h4 class="widget-title">Brands
            <button type="submit" class="btn btb-primary btn-sm">Filter</button>
         </h4>
        </div>
        <div class="sidebar-widget-body">
         <div class="accordion">

          @foreach ($brands as $brand)
           <div class="accordion-group">
            <div class="accordion-heading">
             <input type="checkbox" name="filterbrand" value="{{ $category_id }}"> {{ $brand->brand_name_en }}
            </div>
            <!-- /.accordion-heading -->
           </div>
           <!-- /.accordion-group -->
          @endforeach
         </div>
         <!-- /.accordion -->
        </div>
    </form>



    <form action="{{ $currenturl}}" method="GET">
        <div class="widget-header">
         <h4 class="widget-title">Category
            <button type="submit" class="btn btb-primary btn-sm">Filter</button>
         </h4>
        </div>
        <div class="sidebar-widget-body">
         <div class="accordion">

          @foreach ($categories as $category)
          @php
          $checked = [];
          if(isset($_GET['filtercategory']))
          {
            $checked = $_GET['filtercategory'];
          }
          @endphp

           <div class="accordion-group">
            <div class="accordion-heading">
             <input type="checkbox" name="filtercategory[]" value="{{ $category->id }}"
             @if (in_array($category->id, $checked))
             checked
             @endif
             > {{ $category->category_name_en }}
            </div>
            <!-- /.accordion-heading -->
           </div>
           <!-- /.accordion-group -->
          @endforeach
         </div>
         <!-- /.accordion -->
        </div>
        </form>
        <!-- /.sidebar-widget-body -->
       </div>
       <!-- /.sidebar-widget -->
       <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

       <!-- ============================================== PRICE SILDER============================================== -->
       <div class="sidebar-widget wow fadeInUp">
        <div class="widget-header">
         <h4 class="widget-title">Price Slider</h4>
        </div>
        <div class="sidebar-widget-body m-t-10">
         <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span
            class="pull-right">$800.00</span> </span>
          <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
          <input type="text" class="price-slider" value="">
         </div>
         <!-- /.price-range-holder -->
        </div>
        <!-- /.sidebar-widget-body -->
       </div>
       <!-- /.sidebar-widget -->
       <!-- ============================================== PRICE SILDER : END ============================================== -->


       <!-- ============================================== MANUFACTURES============================================== -->
       <div class="sidebar-widget wow fadeInUp">
        <div class="widget-header">
         <h4 class="widget-title">Brands</h4>
        </div>
        <div class="sidebar-widget-body">
         <div class="accordion">

          @foreach ($brands as $item)
           <div class="accordion-group">
            <div class="accordion-heading">
             <input type="checkbox" name="" id=""> {{ $item->brand_name_en }}
            </div>
            <!-- /.accordion-heading -->
           </div>
           <!-- /.accordion-group -->
          @endforeach
         </div>
         <!-- /.accordion -->
        </div>
        <!-- /.sidebar-widget-body -->
       </div>
       <!-- /.sidebar-widget -->
       <!-- ============================================== MANUFACTURES: END ============================================== -->

       <!-- /.sidebar-widget -->
      </div>
      <!-- /.sidebar-filter -->
     </div>
     <!-- /.sidebar-module-container -->
    </div>
    <!-- /.sidebar -->


    <div class='col-md-9'>
     <!-- ========================================== SECTION – HERO ========================================= -->

     <div class="clearfix filters-container m-t-10">
      <div class="row">
       <div class="col col-sm-6 col-md-2">
        <div class="filter-tabs">
         <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
          <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a>
          </li>
          <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
         </ul>
        </div>
        <!-- /.filter-tabs -->
       </div>
       <!-- /.col -->
       <div class="col col-sm-12 col-md-6">
        <div class="col col-sm-3 col-md-6 no-padding">
         <div class="lbl-cnt"> <span class="lbl">Sort by :</span>
          <div class="fld inline">
           <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
            <div class="form-group"
             style="  position: absolute;
            top: 0;
            bottom: 0;
            left: 20px;
            width: max-content;
            right: 40px;
            margin-right: 20px;">
             <select class="form-control" id="sortBy" placeholder="Options">

              <option selected disabled>Default</option>
              <option value="priceAsc">Price:Lowest
              </option>
              <option value="priceDesc">Price:Highest
              </option>
              <option value="titleAsc">Alphabetical A
               to Z</option>
              <option value="titleDesc">Alphabetical Z
               to A</option>
              <option value="discAsc" >Discount - Lowest
               to Highest</option>
              <option value="discDesc">Discount -
               Highest to Lowest</option>
             </select>
            </div>

           </div>
          </div>
          <!-- /.fld -->
         </div>
         <!-- /.lbl-cnt -->
        </div>
        <!-- /.col -->
        <div class="col col-sm-3 col-md-6">
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group" style="    position: absolute;
                top: -15%;
                left: 80%;
               ">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
              </form>

        </div>
        <!-- /.col -->
       </div>
       <!-- /.col -->
       <div class="col col-sm-6 col-md-4 text-right">
        <!-- /.pagination-container -->
       </div>
       <!-- /.col -->
      </div>
      <!-- /.row -->
     </div>

     <!--    //////////////////// START Grid View  ////////////// -->

     <div class="search-result-container ">
      <div id="myTabContent" class="tab-content category-list">
       <div class="tab-pane active " id="grid-container">
        <div class="category-product">
         <div class="row">

          @foreach ($products as $product)
           <div class="col-sm-6 col-md-4 wow fadeInUp">
            <div class="products">
             <div class="product">
              <div class="product-image">
               <div class="image"> <a
                 href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}"><img
                  src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
               <!-- /.image -->

               @php
                $amount = $product->selling_price - $product->discount_price;
                $discount = ($amount / $product->selling_price) * 100;
               @endphp

               <div>
                @if ($product->discount_price == null)
                 <div class="tag new"><span>new</span></div>
                @else
                 <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                @endif
               </div>
              </div>
              <!-- /.product-image -->
              <div class="product-info text-left">
               <h3 class="name"><a
                 href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                 {{ $product->product_name_en }}
                </a>
               </h3>
               <div class="rating rateit-small"></div>
               <div class="description"></div>
               @if ($product->discount_price == null)
                <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
               @else
                <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span
                  class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
               @endif
               <!-- /.product-price -->
              </div>
              <!-- /.product-info -->
              <div class="cart clearfix animate-effect">
               <div class="action">
                <ul class="list-unstyled">
                 <li class="add-cart-button btn-group">
                  <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i
                    class="fa fa-shopping-cart"></i> </button>
                  <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                 </li>
                 <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i
                    class="icon fa fa-heart"></i> </a> </li>
                 <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                    class="fa fa-signal"></i> </a> </li>
                </ul>
               </div>
               <!-- /.action -->
              </div>
              <!-- /.cart -->
             </div>
             <!-- /.product -->

            </div>
            <!-- /.products -->
           </div>
           <!-- /.item -->
          @endforeach

         </div>
         <!-- /.row -->
        </div>
        <!-- /.category-product -->
       </div>
       <!-- /.tab-pane -->
       <!--            //////////////////// END Grid View  ////////////// -->



       <!--            //////////////////// List View Start ////////////// -->
       <div class="tab-pane " id="list-container">
        <div class="category-product" id="product-data">
         {{-- @foreach ($products as $product)
          <div class="category-product-inner wow fadeInUp">
           <div class="products">
            <div class="product-list product">
             <div class="row product-list-row">
              <div class="col col-sm-4 col-lg-4">
               <div class="product-image">
                <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>
               </div>
               <!-- /.product-image -->
              </div>
              <!-- /.col -->
              <div class="col col-sm-8 col-lg-8">
               <div class="product-info">
                <h3 class="name"><a
                  href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_en) }}">
                   {{ $product->product_name_en }}
                 </a>
                </h3>
                <div class="rating rateit-small"></div>


                @if ($product->discount_price == null)
                 <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                @else
                 <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span
                   class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
                @endif

                <!-- /.product-price -->
                <div class="description m-t-10">
                  {{ $product->short_descp_en }}
                </div>
                <div class="cart clearfix animate-effect">
                 <div class="action">
                  <ul class="list-unstyled">
                   <li class="add-cart-button btn-group">
                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i
                      class="fa fa-shopping-cart"></i> </button>
                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                   </li>
                   <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i
                      class="icon fa fa-heart"></i> </a> </li>
                   <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                      class="fa fa-signal"></i> </a> </li>
                  </ul>
                 </div>
                 <!-- /.action -->
                </div>
                <!-- /.cart -->

               </div>
               <!-- /.product-info -->
              </div>
              <!-- /.col -->
             </div>



             @php
              $amount = $product->selling_price - $product->discount_price;
              $discount = ($amount / $product->selling_price) * 100;
             @endphp

             <!-- /.product-list-row -->
             <div>
              @if ($product->discount_price == null)
               <div class="tag new"><span>new</span></div>
              @else
               <div class="tag hot"><span>{{ round($discount) }}%</span></div>
              @endif
             </div>



            </div>
            <!-- /.product-list -->
           </div>
           <!-- /.products -->
          </div>
          <!-- /.category-product-inner -->
         @endforeach --}}
         @include('frontend.product.single')



         <!--            //////////////////// Product List View END ////////////// -->


        </div>
        <!-- /.category-product -->
       </div>
       <!-- /.tab-pane #list-container -->
      </div>
      <!-- /.tab-content -->
      <div class="clearfix filters-container">
       <div class="text-center">
        <div class="pagination-container">
         <ul class="list-inline list-unstyled">
          {{ $products->links() }}
         </ul>
         <div class="ajax-load text-center" style="display: none;">
          <img src="{{ asset('frontend/assets/images/Loading_icon.gif') }}" alt="" style="height: 220px;">
         </div>

         <!-- /.list-inline -->
        </div>
        <!-- /.pagination-container -->
       </div>
       <!-- /.text-right -->

      </div>
      <!-- /.filters-container -->

     </div>
     <!-- /.search-result-container -->

    </div>
    <!-- /.col -->
   </div>
   <!-- /.row -->
   <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
  </div>
  <!-- /.container -->

 </div>
 <!-- /.body-content -->
@endsection

@section('scripts')
 <script>
  $('#sortBy').change(function() {
   let sort = $('#sortBy').val();
   window.location = "{{ url('' . $category_id . '') }}/{{ $category_slug }}?sort=" + sort;

  })
 </script>
@endsection
