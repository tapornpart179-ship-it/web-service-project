<!doctype html>
<html lang="en">
  <!--begin::Head--><head>
  @include('template.backend.css')
  @livewireStyles
</head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
     @include('template.backend.header')
      <!--end::Header-->
      <!--begin::Sidebar-->
     @include('template.backend.sidebar')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      @yield('content')
      <!--end::App Main-->
      <!--begin::Footer-->
      @include('template.backend.footer')
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    @include('template.backend.js')
    <!--end::Script-->
    @livewireScripts
  </body>

</html>