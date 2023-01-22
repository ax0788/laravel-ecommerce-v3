<!--begin::Header-->
<div id="kt_header" class="header header-fixed">

 <!--begin::Container-->
 <div class="container-fluid d-flex align-items-stretch justify-content-between">
  <div></div>

  <!--begin::Topbar-->
  <div class="topbar">

   <!--begin::User-->
   <div class="dropdown">

    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
     <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2  border">
      <span
       class=" text-light-50 font-weight-bolder font-size-base  d-md-inline mr-3 ">{{ auth()->user()->first_name }}</span>
     </div>
    </div>

    <!--end::Toggle-->

    <!--begin::Dropdown-->
    <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">

     <!--[html-partial:include:{"file":"partials/_extras/dropdown/user.html"}]/-->
     @include('admin.partials.account')
    </div>

    <!--end::Dropdown-->
   </div>

   <!--end::User-->
  </div>

  <!--end::Topbar-->
 </div>

 <!--end::Container-->
</div>

<!--end::Header-->
