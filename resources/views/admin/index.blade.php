<!DOCTYPE html>

<html lang="en">

<head>
 <base href="" />
 <meta charset="utf-8" />
 <title>Ebso Admin</title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
 <link href="{{ asset('backend/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
  type="text/css" />
 <link href="{{ asset('backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/css/themes/layout/header/base/dark.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css" />
 <link rel="shortcut icon" href="{{ asset('Ebso-logo/vector/default-monochrome.svg') }}" />
 <link href="{{ asset('backend/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
 <script src="sweetalert2.min.js"></script>
 <link rel="stylesheet" href="sweetalert2.min.css">
 <!--begin::Page Vendors Styles(used by this page)-->
 <link href="{{ asset('backend/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
  type="text/css" />
 <!--end::Page Vendors Styles-->


</head>

<body id="kt_body"
 class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading ">
 @include('admin.partials.layout')

 <!--[html-partial:include:{"file":"partials/_extras/scrolltop.html"}]/-->
 @include('admin.partials.scrolltop')

 <!--begin::Global Config(global config for global JS scripts)-->
 <script>
  var KTAppSettings = {
   breakpoints: {
    sm: 576,
    md: 768,
    lg: 992,
    xl: 1200,
    xxl: 1400,
   },
   colors: {
    theme: {
     base: {
      white: "#ffffff",
      primary: "#3699FF",
      secondary: "#E5EAEE",
      success: "#1BC5BD",
      info: "#8950FC",
      warning: "#FFA800",
      danger: "#F64E60",
      light: "#E4E6EF",
      dark: "#181C32",
     },
     light: {
      white: "#ffffff",
      primary: "#E1F0FF",
      secondary: "#EBEDF3",
      success: "#C9F7F5",
      info: "#EEE5FF",
      warning: "#FFF4DE",
      danger: "#FFE2E5",
      light: "#F3F6F9",
      dark: "#D6D6E0",
     },
     inverse: {
      white: "#ffffff",
      primary: "#ffffff",
      secondary: "#3F4254",
      success: "#ffffff",
      info: "#ffffff",
      warning: "#ffffff",
      danger: "#ffffff",
      light: "#464E5F",
      dark: "#ffffff",
     },
    },
    gray: {
     "gray-100": "#F3F6F9",
     "gray-200": "#EBEDF3",
     "gray-300": "#E4E6EF",
     "gray-400": "#D1D3E0",
     "gray-500": "#B5B5C3",
     "gray-600": "#7E8299",
     "gray-700": "#5E6278",
     "gray-800": "#3F4254",
     "gray-900": "#181C32",
    },
   },
   "font-family": "Poppins",
  };
 </script>

 <!--end::Global Config-->

 <!--begin::Global Theme Bundle(used by all pages)-->
 <script src="sweetalert2.all.min.js"></script>

 <script src="{{ asset('backend/plugins/global/plugins.bundle.js') }}"></script>
 <script src="{{ asset('backend/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/scripts.bundle.js') }}"></script>
 <script src="{{ asset('backend/js/engage_code.js') }}"></script>

 <!--end::Global Theme Bundle-->



 <!--begin::Page Scripts(used by this page)-->
 <script src="{{ asset('backend/js/pages/widgets.js') }}"></script>
 <!--begin::Page Vendors(used by this page)-->
 <script src="{{ asset('backend/plugins/custom/datatables/datatables.bundle.js') }}"></script>
 <!--end::Page Vendors-->
 <script src="{{ asset('backend/js/pages/features/miscellaneous/toastr.js') }}"></script>

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


 <script src="{{ asset('backend/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
 <!--begin::Page Scripts(used by this page)-->
 <script src="{{ asset('backend/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
 <!--end::Page Scripts-->
 <script src="{{ asset('backend/js/sweetalert.js') }}"></script>


 <!--begin::Page Vendors(used by this page)-->
 <script src="{{ asset('backend/plugins/custom/datatables/datatables.bundle.js') }}"></script>
 <!--end::Page Vendors-->

 <!--begin::Page Scripts(used by this page)-->
 <script src="{{ asset('backend/js/pages/crud/datatables/basic/paginations.js') }}"></script>
 <!--end::Page Scripts-->


</body>
<!--end::Body-->

</html>
