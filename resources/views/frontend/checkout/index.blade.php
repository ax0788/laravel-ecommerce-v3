@extends('frontend.main_master')
@section('title')
My Checkout
@endsection
@section('content')
{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">

                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- guest-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>Shipping Address & Details</b></h4>

                                            <form class="register-form" action="{{ route('checkout.store') }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="info-title">Name <span>*</span></label>
                                                    <input type="text" name="shipping_name"
                                                        class="form-control unicase-form-control text-input"
                                                       value="{{ Auth::user()->first_name }}"
                                                        >
                                                </div> {{-- End Form-Group --}}

                                                <div class="form-group">
                                                    <label class="info-title">Email <span>*</span></label>
                                                    <input type="email" name="shipping_email"
                                                        class="form-control unicase-form-control text-input"
                                                        placeholder="Email" value="{{ Auth::user()->email }}" >
                                                </div> {{-- End Form-Group --}}

                                                <div class="form-group">
                                                    <label class="info-title">Phone <span>*</span></label>
                                                    <input type="text" name="shipping_phone"
                                                        class="form-control unicase-form-control text-input"
                                                        placeholder="Phone Number" value="{{ Auth::user()->phone }}"
                                                        >
                                                </div> {{-- End Form-Group --}}

                                                <div class="form-group">
                                                    <label class="info-title">Post Code <span>*</span></label>
                                                    <input type="text" name="post_code"
                                                        class="form-control unicase-form-control text-input"
                                                        placeholder="Post Code">
                                                </div> {{-- End Form-Group --}}


                                        </div>
                                        <!-- guest-login -->




                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">

                                            <div class="form-group">
                                                <h5>Country:<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="country_id" class="form-control" required>
                                                        <option selected>Select Country</option>
                                                        @foreach ($countries as $item)
                                                        <option value="{{ $item->id }}">{{ $item->country_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('country_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> {{-- End Form-Group --}}

                                            <div class="form-group">
                                                <h5>State <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="state_id" class="form-control" required>
                                                        <option selected>Select State</option>

                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> {{-- End Form-Group --}}

                                            <div class="form-group">
                                                <h5>District <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="district_id" class="form-control" required>
                                                        <option selected>Select District</option>
                                                    </select>
                                                    @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> {{-- End Form-Group --}}

                                            <div class="form-group">
                                                <label class="info-title">Notes <span>*</span></label>
                                                <textarea class="form-control" cols="30" rows="10" placeholder="Notes"
                                                    name="notes"></textarea>
                                            </div> {{-- End Form-Group --}}
                                        </div>
                                        <!-- already-registered-login -->
                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->
                    </div><!-- /.checkout-steps -->
                </div>




                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach ($cartData as $item)
                                        <li>
                                            <strong>Image: </strong>
                                            <img src="{{ asset($item->options->image) }}" alt=""
                                                style="width: 50px; height:50px;">
                                        </li>

                                        <li>
                                            <strong>Qty: </strong>
                                            {{ $item->qty }}
                                            <strong>Color: </strong>
                                            {{ $item->options->color }}
                                            <strong>Size: </strong>
                                            {{ $item->options->size }}
                                        </li>
                                        @endforeach
                                        <hr>
                                        <li>
                                            @if (Session::has('coupon'))
                                            <strong>SubTotal: </strong> ${{ $cartTotal }}
                                            <hr>
                                            <strong>Coupon Code: </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            ({{ session()->get('coupon')['coupon_discount'] }}% off)
                                            <hr>
                                            <strong>Discount Amount: </strong> ${{
                                            session()->get('coupon')['discount_amount'] }}
                                            <hr>
                                            <strong class="text-success">Grand Total: </strong> ${{
                                            session()->get('coupon')['total_amount'] }}
                                            @else
                                            <strong>SubTotal: </strong> ${{ $cartTotal }}
                                            <hr>
                                            <strong class="text-success">Grand Total: </strong> ${{ $cartTotal }}
                                            <hr>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div> <!-- col-md-4 -->






                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment</h4>
                                </div>


                                <div class="row">

                                    <div class="col-md-4">
                                        <label for="">Stripe</label>
                                        <input type="radio" name="payment_method" value="stripe">
                                        <img src="{{ asset('frontend/assets/images/payments/4.png') }}">
                                    </div><!-- col-md-4 -->

                                    <div class="col-md-4">
                                        <label for="">Card</label>
                                        <input type="radio" name="payment_method" value="card">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}">
                                    </div><!-- col-md-4 -->

                                    <div class="col-md-4">
                                        <label for="">Cash</label>
                                        <input type="radio" name="payment_method" value="cash">
                                        <img src="{{ asset('frontend/assets/images/payments/6.png') }}">
                                    </div><!-- col-md-4 -->
                                </div><!-- row -->
                                <br>
                                <hr>
                                <button type="submit"
                                    class="btn-upper btn btn-primary checkout-page-button">Proceed</button>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div> <!-- col-md-4 -->
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
    $('select[name="country_id"]').on('change', function() {
     let country_id = $(this).val();
     if (country_id) {
      $.ajax({
       url: "{{ url('/state-get/ajax') }}/" + country_id,
       type: "GET",
       dataType: "json",
       success: function(data) {
        $('select[name="district_id"]').empty();
        let d = $('select[name="state_id"]').empty();
        $.each(data, function(key, value) {
         $('select[name="state_id"]').append('<option value="' + value.id + '">' + value.state_name + '</option>');
        });
       },
      });
     } else {
      alert('danger');
     }
    });


    $('select[name="state_id"]').on('change', function() {
     let state_id = $(this).val();
     if (state_id) {
      $.ajax({
       url: "{{ url('/district-get/ajax') }}/" + state_id,
       type: "GET",
       dataType: "json",
       success: function(data) {
        let d = $('select[name="district_id"]').empty();
        $.each(data, function(key, value) {
            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.district_name + '</option>');
        });
       },
      });
     } else {
      alert('danger');
     }
    });
   });
    </script>
    @endsection
