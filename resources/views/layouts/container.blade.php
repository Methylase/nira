<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nira {{$title}}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('skydash-admin/template/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('skydash-admin/template/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" />
  <link href="{{asset('images/favicon.ico')}}" rel="apple-touch-icon">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            @yield('content')           
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('skydash-admin/template/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('skydash-admin/template/js/off-canvas.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/template.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/settings.js')}}"></script>
  <script src="{{asset('skydash-admin/template/js/todolist.js')}}"></script>
  <!-- endinject -->
</body>

</html>
               