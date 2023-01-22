@extends('frontend.main_master')
@section('content')
 <div class="body-content">
  <div class="container">
   <div class="row">
    @include('frontend.common.sidebar')

    <div class="sign-in-page">
        <div class="row">
          <div class="col-md-10 col-sm-10">
            <h4 class="checkout-subtitle">Edit Profile.</h4>
            <form method="POST" action="{{ route('user-profile-information.update') }}">
                @method('PUT')
                @csrf
                @if (session('status') == 'profile-information-updated')
                <div class="alert alert-success">
                    Profile updated successfully!
                </div>
            @endif
              <div class="form-group">
                <label class="info-title"
                  >First Name <span>*</span></label
                >
                <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
              </div>
              <div class="form-group">
                <label class="info-title"
                  >Last Name <span>*</span></label
                >
                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
              </div>


        <div class="form-group">
            <label class="info-title">Email Address:</label>
            <input type="email" class="form-control unicase-form-control text-input" name="email"
             value="{{ $user->email }}">
           </div>

              <div class="form-group">
                <label class="info-title">Phone:</label>
                <input type="text" class="form-control unicase-form-control text-input" name="phone"
                 value="{{ $user->phone }}">
               </div>


              <button
                type="submit"
                class="btn-upper btn btn-success"
              >
              Update
              </button>
            </form>
          </div>
          <!-- create a new account -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.sigin-in-->

   </div>
  </div>
 </div>
@endsection
