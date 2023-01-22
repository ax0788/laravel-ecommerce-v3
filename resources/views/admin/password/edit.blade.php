@extends('admin.index')
@section('content')
 <div class="d-flex flex-row">

  <!--begin::Content-->
  <div class="flex-row-fluid ml-lg-8">
   <!--begin::Card-->
   <div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header py-3">
     <div class="card-title align-items-start flex-column">
      <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
      <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
     </div>
    </div>
    <!--end::Header-->

    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('user-password.update') }}">
     @csrf
     @method('PUT')

     @if (session('status') == 'password-updated')
      <div class="alert alert-success">
       Password Updated Successfully!
      </div>
     @endif

     <div class="card-body">

      {{-- Current Password --}}
      <div class="form-group row">
       <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
       <div class="col-lg-9 col-xl-6">
        <input type="password"
         class="form-control form-control-lg form-control-solid mb-2  @error('current_password', 'updatePassword') is-invalid
         @enderror"
         name="current_password">
        @error('current_password', 'updatePassword')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
         </span>
        @enderror
        <a href="#" class="text-sm font-weight-bold">Forgot password ?</a>
       </div>
      </div>

      {{-- New Password --}}
      <div class="form-group row">
       <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
       <div class="col-lg-9 col-xl-6">
        <input type="password"
         class="form-control form-control-lg form-control-solid @error('password', 'updatePassword') is-invalid @enderror"
         name="password">
        @error('password', 'updatePassword')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
         </span>
        @enderror
       </div>
      </div>

      {{-- Confirm Password --}}
      <div class="form-group row">
       <label class="col-xl-3 col-lg-3 col-form-label text-alert">Confirm Password</label>
       <div class="col-lg-9 col-xl-6">
        <input type="password"
         class="form-control form-control-lg form-control-solid @error('password_confirmation', 'updatePassword') is-invalid @enderror"
         name="password_confirmation">
        @error('password_confirmation', 'updatePassword')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
         </span>
        @enderror
       </div>
      </div>
      <div class="d-flex align-items-center justify-content-center mb-3 ">
       <button type="submit" class="btn btn-success mr-2">Update</button>
      </div>
     </div>
    </form>
    <!--end::Form-->
   </div>
  </div>
  <!--end::Content-->
 </div>
@endsection
