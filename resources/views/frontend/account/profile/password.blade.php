@extends('frontend.main_master')
@section('content')
 <div class="body-content">
  <div class="container">
   <div class="row">
    @include('frontend.common.sidebar')

    <div class="sign-in-page">
        <div class="row">
          <div class="col-md-10 col-sm-10">
            <h4 class="checkout-subtitle">Change Password.</h4>
            <form method="POST" action="{{ route('user-password.update') }}">
                @method('PUT')
                @csrf
                @if (session('status') == 'password-updated')
                    <div class="alert alert-success">
                        Password updated successfully!
                    </div>
                @endif
              <div class="form-group">
                <label class="info-title"
                  >Current Password <span>*</span></label
                >
                <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required>
                @error('current_password', 'updatePassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>


              <div class="form-group">
                <label class="info-title"
                  >New Password <span>*</span></label
                >
                <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required>
                @error('password', 'updatePassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <label class="info-title"
                  >Confirm Password <span>*</span></label
                >
                <input  type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
              </div>


              <button
                type="submit"
                class="btn-upper btn btn-success"
              >
              Change Password
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
