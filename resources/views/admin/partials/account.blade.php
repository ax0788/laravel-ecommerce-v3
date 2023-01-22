@php
 $id = Auth::user()->id;
 $user = App\Models\User::find($id);
@endphp

<!--begin::Nav-->
<div class="navi navi-spacer-x-0 pt-5">

 <!--begin::Item-->
 <a href="" class="navi-item px-8">
  <div class="navi-link">
   <div class="navi-icon mr-2">
    <i class="flaticon2-calendar-3 text-success"></i>
   </div>
   <div class="navi-text">
    <div class="font-weight-bold"> My Profile</div>
    <div class="text-muted">Account settings and more
    </div>
   </div>
  </div>
 </a>

 <!--end::Item-->

 <!--begin::Item-->
 <a href="custom/apps/user/profile-3.html" class="navi-item px-8">
  <div class="navi-link">
   <div class="navi-icon mr-2">
    <i class="flaticon2-mail text-warning"></i>
   </div>
   <div class="navi-text">
    <div class="font-weight-bold">My Messages</div>
    <div class="text-muted">Inbox and tasks</div>
   </div>
  </div>
 </a>

 <!--end::Item-->
 <!--begin::Footer-->
 <div class="navi-separator mt-3"></div>
 <div class="navi-footer px-8 py-5">
  <a href="{{ route('logout') }}" onclick="event.preventDefault();
  document.getElementById('logout-form').submit();"
   class="btn btn-light-primary font-weight-bold"> {{ __('Logout') }}</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
   @csrf
  </form>
 </div>

 <!--end::Footer-->
</div>

<!--end::Nav-->
