<!DOCTYPE html>
<html lang="en">

<head>
 <!-- Meta -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
 <meta name="description" content="">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <meta name="author" content="">
 <meta name="keywords" content="MediaCenter, Template, eCommerce">
 <meta name="robots" content="all">
 <title>@yield('title')</title>

 <!-- Bootstrap Core CSS -->

 <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}"><!-- Customizable CSS -->
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
 <script src="https://js.stripe.com/v3/"></script>

 <!-- Icons/Glyphs -->
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">


 <!-- Fonts -->
 <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
 <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
  rel='stylesheet' type='text/css'>
 <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

 {{-- Font Awesome v6 --}}
 <script src="https://kit.fontawesome.com/383363df1b.js" crossorigin="anonymous"></script>

 {{-- JQUERYUI --}}
 <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body class="cnt-home">
 <!-- ============================================== HEADER ============================================== -->
 @include('frontend.body.header')

 <!-- ============================================== HEADER : END ============================================== -->
 @yield('content')
 <!-- /#top-banner-and-menu -->

 <!-- ============================================================= FOOTER ============================================================= -->
 @include('frontend.body.footer')
 <!-- ============================================================= FOOTER : END============================================================= -->

 <!-- For demo purposes – can be removed on production -->

 <!-- For demo purposes – can be removed on production : End -->

 <!-- JavaScripts placed at the end of the document so the pages load faster -->
 <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
 <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- Searching & Autocomplete --}}
 <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 <script>
    $(document).ready(function () {
        src = "{{ route('searchproductajax') }}";

        $( "#search_text" ).autocomplete({
      source: function(request, response){
       $.ajax({
        url: src,
        data: {
            term: request.term
        } ,
        dataType: "JSON",
        success: function (data){
           response(data);
        }
       })

      },
      minLength: 1,
    });

    $(document).on('click', 'ui-menu-item', function () {
        $('#search-form').submit();
    })

    });
 </script>


 <script>
  @if (Session::has('message'))
   var type = "{{ Session::get('alert-type', 'info') }}"
   switch (type) {
    case 'info':
     toastr.info(" {{ Session::get('message') }} ");
     break;

    case 'success':
     toastr.success(" {{ Session::get('message') }} ");
     break;

    case 'warning':
     toastr.warning(" {{ Session::get('message') }} ");
     break;

    case 'error':
     toastr.error(" {{ Session::get('message') }} ");
     break;
   }
  @endif
 </script>

 <!-- ADD to Cart Product Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span></strong></h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
      <span aria-hidden="true">&times;</span>
     </button>
    </div>
    <div class="modal-body">
     <div class="row">

      <div class="col-md-4">
       <div class="card" style="width: 18rem;">
        <img src="" class="card-img-top" alt="..." style="height:200px; width:200px; " id="image">
       </div>
      </div> {{-- End col-md-4 --}}

      <div class="col-md-4">
       <ul class="list-group">
        <li class="list-group-item">Price: <strong class="text-success mr-2">$<span id="pprice"></span></strong>
         <del class="text-danger" id="oldprice">$</del>
        </li>
        <li class="list-group-item">Code: <strong id="code"></strong></li>
        <li class="list-group-item">Category: <strong id="category"></strong> </li>
        <li class="list-group-item">Brand: <strong id="brand"></strong></li>
        <li class="list-group-item">Stock:
         <strong class="text-success " id="available" style="background-color: green; color:white;"></strong>
         <strong class="text-danger " id="stockout" style="background-color: red; color:white;"></strong>
        </li>
       </ul>
      </div>{{-- End col-md-4 --}}

      <div class="col-md-4">
       <div class="form-group">
        <label for="color">Choose Color</label>
        <select class="form-control" id="color" name="color">
        </select>
       </div> {{-- End form-group --}}
       <div class="form-group" id="sizeArea">
        <label for="size">Choose Size</label>
        <select class="form-control" id="size" name="size">
        </select>
       </div> {{-- End form-group --}}

       <div class="form-group">
        <label for="qty">Quantity</label>
        <input type="number" class="form-control" id="qty" value="1" min="1">
       </div> {{-- End form-group --}}
       <input type="hidden" id="product_id">
       <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to Cart</button>
      </div>{{-- End col-md-4 --}}

     </div> {{-- End Row --}}
    </div>
   </div>
  </div>
 </div>
 <!--END  Add to Cart Product Modal -->

 <script>
  $.ajaxSetup({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
  })

  // Start Product View with Modal
  function productView(id) {

   $.ajax({
    type: 'GET',
    url: '/product/view/modal/' + id,
    dataType: 'json',
    success: function(data) {
     $('#pname').text(data.product.product_name_en);
     $('#price').text(data.product.selling_price);
     $('#code').text(data.product.product_code);
     $('#category').text(data.product.category.category_name_en);
     $('#brand').text(data.product.brand.brand_name_en);
     $('#image').attr('src', '/' + data.product.product_thumbnail);

     $('#product_id').val(id);
     $('#qty').val(1);

     //  Product Price
     if (data.product.discount_price == null) {
      $('#pprice').text('');
      $('#oldprice').text('');
      $('#pprice').text(data.product.selling_price);
     } else {
      $('#pprice').text(data.product.discount_price);
      $('#oldprice').text(data.product.selling_price);
     } //End Product Price

     //  Stock Option
     if (data.product.product_qty > 0) {
      $('#available').text('');
      $('#stockout').text('');
      $('#available').text('available');
     } else {
      $('#available').text('');
      $('#stockout').text('');
      $('#stockout').text('stockout');
     } //End Stock Option



     //  Color
     $('select[name="color"]').empty();
     $.each(data.color, function(key, value) {
      $('select[name = "color"]').append('<option value=" ' + value + ' "> ' + value + ' </option>')
     })
     //  Size
     $('select[name="size"]').empty();
     $.each(data.size, function(key, value) {
      $('select[name = "size"]').append('<option value=" ' + value + ' "> ' + value + ' </option>');

      if (data.size == "") {
       $('#sizeArea').hide();
      } else {
       $('#sizeArea').show();

      }
     })
    }
   })
  }
  //End Product Modal View

  //START Add to Cart
  function addToCart() {
   const product_name = $('#pname').text();
   const id = $('#product_id').val();
   const color = $('#color option:selected').text();
   const size = $('#size option:selected').text();
   const quantity = $('#qty').val();
   $.ajax({
    type: "POST",
    dataType: 'json',
    data: {
     product_name: product_name,
     color: color,
     size: size,
     quantity: quantity
    },
    url: "/cart/data/store/" + id,
    success: function(data) {
     miniCart();
     $('#closeModal').click();

     // Start Message
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      icon: 'success',
      showConfirmButton: false,
      timer: 3000,
     })
     if ($.isEmptyObject(data.error)) {
      Toast.fire({
       type: 'success',
       title: data.success,
      })
     } else {
      Toast.fire({
       type: 'error',
       title: data.error,
      })

     }
     //End Message
    }
   })
  }
  //END Add to Cart
 </script>


 {{-- START ADD TO MINI CART --}}
 <script>
  function miniCart() {
   $.ajax({
    type: "GET",
    dataType: 'json',
    url: "/product/mini/cart",
    success: function(response) {
     let miniCart = "";
     $.each(response.cartData, function(key, value) {
      $('span[id="cartSubTotal"]').text(response.cartTotal);
      $('#cartQty').text(response.cartQty);

      miniCart +=
       ` <div class="cart-item product-summary">
         <div class="row">
          <div class="col-xs-4">
           <div class="image"> <a href="detail.html"><img src="/${value.options.image}"
              alt=""></a> </div>
          </div>
          <div class="col-xs-7">
           <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
           <div class="price">${value.price} * ${value.qty}</div>
          </div>
          <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" class="text-danger"><i class="fa fa-trash"></i></button>
          </div>
         </div>
        </div>
        <!-- /.cart-item -->
        <div class="clearfix"></div>
        <hr>
        `
     });
     $('#miniCart').html(miniCart);
    }
   })

  }
  miniCart();

  //  {{-- END ADD TO MINI CART --}}

  //Start  MiniCart Remove
  function miniCartRemove(rowId) {
   $.ajax({
    type: 'GET',
    url: '/product/minicart/remove/' + rowId,
    dataType: 'json',
    success: function(data) {
     miniCart();
     // Start Message
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      icon: 'success',
      showConfirmButton: false,
      timer: 3000
     })
     if ($.isEmptyObject(data.error)) {
      Toast.fire({
       type: 'success',
       title: data.success
      })
     } else {
      Toast.fire({
       type: 'error',
       title: data.error
      })
     }
     // End Message
    }
   });
  }
  //   END MiniCart Remove
 </script>


 {{-- START  Add To WISHLIST --}}
 <script>
  function addToWishList(product_id) {
   $.ajax({
    type: 'POST',
    dataType: 'json',
    url: '/add-to-wishlist/' + product_id,
    success: function(data) {
     // Start Message
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
     })
     if ($.isEmptyObject(data.error)) {
      Toast.fire({
       type: 'success',
       icon: 'success',
       title: data.success
      })
     } else {
      Toast.fire({
       type: 'error',
       icon: 'error',
       title: data.error
      })
     }
     // End Message
    }
   });
  }
 </script>
 {{-- END Add To WISHLIST --}}

 {{-- START WISHLIST PAGE DATA --}}
 <script>
  function wishlist() {
   $.ajax({
    type: "GET",
    dataType: 'json',
    url: '/get-wishlist-product',
    success: function(response) {
     let rows = "";
     $.each(response, function(key, value) {
      rows +=
       `  <tr>
          <td class="col-md-2"><img src="/${value.product.product_thumbnail} " alt="imga"></td>
          <td class="col-md-7">
           <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
           <div class="price">
            ${value.product.discount_price == null
            ? `${value.product.selling_price}`
                : `${value.product.discount_price} <span>${value.product.selling_price}</span>
                                                                                                                                                                                                                                                       `
            }
           </div>
          </td>
          <td class="col-md-2">
            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal"
                data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)">Add to Cart</button>
          </td>
          <td class="col-md-1 close-btn">
           <button type="submit" id="${value.id}" onclick="wishlistRemove(this.id)" class="text-danger"><i class="fa fa-times"></i></button>
          </td>
         </tr>
          `
     });
     $('#wishlist').html(rows);
    }
   })

  }
  wishlist();
  /*   {{-- END WISHLIST PAGE DATA --}}
   */
  //Start  Wishlist Remove
  function wishlistRemove(id) {
   $.ajax({
    type: 'GET',
    url: '/wishlist-remove/' + id,
    dataType: 'json',
    success: function(data) {
     wishlist();
     // Start Message
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
     })
     if ($.isEmptyObject(data.error)) {
      Toast.fire({
       type: 'success',
       icon: 'success',
       title: data.success
      })
     } else {
      Toast.fire({
       type: 'error',
       icon: 'error',
       title: data.error
      })
     }
     // End Message
    }
   });
  }
 </script>
 {{-- //   END Wishlist Remove --}}

 {{-- START MY CART PAGE --}}
 <script>
  function cart() {
   $.ajax({
    type: "GET",
    dataType: 'json',
    url: '/get-cart-product',
    success: function(response) {
     let rows = "";
     $.each(response.cartData, function(key, value) {
      rows +=
       `  <tr>
          <td class="col-md-2"><img src="/${value.options.image} " alt="imga" style="width:90px; height:90px;" ></td>


          <td class="col-md-2">
           <div class="product-name"><a href="#">${value.name}</a></div>
           <div class="price">
                   $${value.price}
           </div>
          </td>

          <td class="col-md-2">
            <strong>
                 ${value.options.color}
             </strong>
          </td>


          <td class="col-md-2">
            ${value.options.size == null
                ? `<span class="text-danger">N/A</span>`
                :
          ` <strong>
                 ${value.options.size}
              </strong>`
               }
          </td>

          <td class="col-md-2">
            ${value.qty > 1
            ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`

            :  `<button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`

            }

         <input type="text" value="${value.qty}" min="1" max="100" disabled id="" style="width:27px;">

         <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
          </td>

          <td class="col-md-2">
            <strong>
                 $${value.subtotal}
             </strong>
          </td>

          <td class="col-md-1 close-btn">
           <button type="submit" id="${value.rowId}" onclick="cartRemove(this.id)" class="text-danger"><i class="fa fa-times"></i></button>
          </td>
         </tr>
          `
     });
     $('#cartPage').html(rows);
    }
   })

  }
  cart();
  /*   {{-- END  MY CART PAGE --}}*/

  //Start REMOVE MY CART PRODUCT
  function cartRemove(id) {
   $.ajax({
    type: 'GET',
    url: '/cart-remove/' + id,
    dataType: 'json',
    success: function(data) {
     couponCal();
     cart();
     miniCart();
     $('#couponField').show();
     $('#coupon_name').val('');

     // Start Message
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
     })
     if ($.isEmptyObject(data.error)) {
      Toast.fire({
       type: 'success',
       icon: 'success',
       title: data.success
      })
     } else {
      Toast.fire({
       type: 'error',
       icon: 'error',
       title: data.error
      })
     }
     // End Message
    }
   });
  }
  //   END REMOVE MY CART PRODUCT

  //-------------START CART INCREMENT---------------//
  function cartIncrement(rowId) {
   $.ajax({
    type: 'GET',
    url: "/cart-increment/" + rowId,
    dataType: 'json',
    success: function(data) {
     couponCal();
     cart();
     miniCart();
    }
   })
  }
  //------------- END CART INCREMENT---------------//

  //-------------START CART DECREMENT---------------//
  function cartDecrement(rowId) {
   $.ajax({
    type: 'GET',
    url: "/cart-decrement/" + rowId,
    dataType: 'json',
    success: function(data) {
     couponCal();
     cart();
     miniCart();
    }
   })
  }
  //------------- END CART DECREMENT---------------//
 </script>
 {{-- //------------- END CART---------------// --}}


 {{-- COUPON APPLY START --}}
 <script>
  function applyCoupon() {
   let coupon_name = $('#coupon_name').val();
   $.ajax({
    type: 'POST',
    dataType: 'json',
    data: {
     coupon_name: coupon_name
    },
    url: "{{ url('/coupon-apply') }}",
    success: function(data) {
     couponCal();
     if (data.validity == true) {
      $('#couponField').hide();
     }
     // Start Message
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
     })
     if ($.isEmptyObject(data.error)) {
      Toast.fire({
       type: 'success',
       icon: 'success',
       title: data.success
      })
     } else {
      Toast.fire({
       type: 'error',
       icon: 'error',
       title: data.error
      })
     }
     // End Message
    }
   })
  }

  function couponCal() {
   $.ajax({
    type: 'GET',
    url: "{{ url('/coupon-cal') }}",
    dataType: 'json',
    success: function(data) {
     //  IF there is no coupon
     if (data.total) {
      $('#couponCalField').html(
       ` <tr>
          <th>
           <div class="cart-sub-total">
            Subtotal<span class="inner-left-md">$${data.total}</span>
           </div>
           <div class="cart-grand-total">
            Grand Total<span class="inner-left-md">$${data.total}</span>
           </div>
          </th>
         </tr>`

      )
     }
     //  IF have coupon
     else {
      $('#couponCalField').html(
       `
   <tr>
   <th>
    <div class="cart-sub-total">
     Subtotal:<span class="inner-left-md">$${data.subtotal}</span>
    </div>

    <div class="cart-sub-total">
     Coupon:<span class="inner-left-md mr-3">${data.coupon_name}</span>
     <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i></button>
    </div>

    <div class="cart-sub-total">
     Discount:<span class="inner-left-md">$${data.discount_amount}</span>
    </div>

    <div class="cart-grand-total">
     Grand Total:<span class="inner-left-md">$${data.total_amount}</span>
    </div>
   </th>
    </tr>
    `
      )
     }

    }
   })
  }
  couponCal();
 </script>
 {{-- COUPON APPLY END --}}

 {{-- START COUPON REMOVE --}}
 <script>
  function couponRemove() {
   $.ajax({
    type: 'GET',
    url: "{{ url('/coupon-remove') }}",
    dataType: 'json',
    success: function(data) {
     couponCal();
     $('#couponField').show();
     $('#coupon_name').val('');
     // Start Message
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
     })
     if ($.isEmptyObject(data.error)) {
      Toast.fire({
       type: 'success',
       icon: 'success',
       title: data.success
      })
     } else {
      Toast.fire({
       type: 'error',
       icon: 'error',
       title: data.error
      })
     }
     // End Message
    }
   })
  }
 </script>

@yield('scripts')

 {{-- END COUPON REMOVE --}}
</body>

</html>
