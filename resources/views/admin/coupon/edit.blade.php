@extends('admin.index')
@section('content')
 <div class="row">
  <div class="col-md-10">
   <div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Edit Coupon
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form method="POST"  action="{{ route('admin.coupon.update', $coupons->id) }}" >
     @csrf

     <div class="card-body">

      <div class="form-group">
       <label>Coupon Name: <span class="text-danger">*</span></label>
       <input type="text" class="form-control" name="coupon_name" value="{{ $coupons->coupon_name }}" />
       @error('coupon_name')
       <span class="text-danger">{{ $message }}</span>
      @enderror
      </div>


      <div class="form-group">
        <label>Coupon Discount(%): <span class="text-danger">*</span></label>
        <input type="text" name="coupon_discount" class="form-control" value="{{ $coupons->coupon_discount }}">
        @error('coupon_discount')
         <span class="text-danger">{{ $message }}</span>
        @enderror
       </div>
       <div class="form-group">
        <label>Coupon Validity(%): <span class="text-danger">*</span></label>
        <input type="date" name="coupon_validity" class="form-control"
             min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $coupons->coupon_validity }}">
            @error('coupon_validity')
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
