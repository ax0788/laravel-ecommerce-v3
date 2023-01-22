@extends('admin.index')
@section('content')
 <div class="d-flex flex-row">

  <!--begin::Content-->
  <div class="flex-row-fluid ml-lg-8">
   <!--begin::Card-->
   <div class="card card-custom card-stretch">
    <!--begin::Header-->
    <div class="card-header py-3">
     <div class="card-title align-items-start flex-column">
      <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
      <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
     </div>

    </div>
    <!--end::Header-->

    <!--begin::Form-->
    <form class="form" method="POST" action="{{ route('user-profile-information.update') }}">
     @csrf
     @method('PUT')
     <!--begin::Body-->
     <div class="card-body">
      <div class="row">
       <label class="col-xl-3"></label>
       <div class="col-lg-9 col-xl-6">
        <h5 class="font-weight-bold mb-6">Admin Info</h5>
       </div>
      </div>

      <div class="form-group row">
       <label class="col-xl-3 col-lg-3 col-form-label">Name:</label>
       <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="text" value="{{ $user->first_name }}">
       </div>
      </div>

      <div class="form-group row">
       <label class="col-xl-3 col-lg-3 col-form-label">Email:</label>
       <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="email" value="{{ $user->email }}">
       </div>
      </div>
      <div class="d-flex align-items-center justify-content-center mb-3 ">
       <a href="{{ route('admin.password.edit') }}" class="btn btn-info mr-4">Change Password</a>
       <button type="submit" class="btn btn-success mr-2">Update</button>
      </div>
     </div>

     <!--end::Body-->
    </form>
    <!--end::Form-->
   </div>
  </div>
  <!--end::Content-->
 </div>
@endsection
