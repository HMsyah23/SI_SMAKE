<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Unit Pelaksana Teknis Daerah Tahura Tahura Bukit Soeharto | Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png')}}" />
  <link href='https://fonts.googleapis.com/css?family=Convergence' rel='stylesheet'>

  <style>
    body {
            font-family: 'Convergence';
        }
    .row,.content-wrapper {background-color: #bad8cc;}
  </style>

</head>

<body>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h2 class="text-center dinas"><strong>Sistem Surat</strong></h2>
              <div class="brand-logo text-center">
                <img src="{{ asset('assets/admin/images/logo.png')}}" alt="logo">
              </div>
              <h3 class="text-center dinas"><strong>DINAS KEHUTANAN</strong></h3>
              <h4 class="text-center dinas">Unit Pelaksana Teknis Daerah <br> Tahura Bukit Soeharto</h2>
              <h6 class="text-center pt-3"><small>Silahkan login terlebih dahulu</small></h6>
              <form class="pt-1" method="POST" action="{{ route('login.custom') }}">
                @csrf
                <div class="form-group">
                  <input type="text" placeholder="Email" id="email" class="form-control form-control-lg" name="email" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Password" id="password" class="form-control form-control-lg" name="password" required>
                  @if (Session::has('error'))
                    <span class="text-danger">{{ Session::get('error') }}</span>
                  @endif
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Login</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  {{-- <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>  --}}
                  {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                  <a href="/" class="auth-link text-black">Kembali Ke halaman utama</a>
                </div>
                {{-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/admin/js/off-canvas.js')}}"></script>
  <script src="{{ asset('assets/admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('assets/admin/js/template.js')}}"></script>
  <script src="{{ asset('assets/admin/js/settings.js')}}"></script>
  <script src="{{ asset('assets/admin/js/todolist.js')}}"></script>
  <!-- endinject -->
</body>

</html>
