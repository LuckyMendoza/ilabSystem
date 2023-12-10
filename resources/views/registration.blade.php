<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Divine Grace Medical Clinic</title>

  <meta name="description" content="" />





  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('asset/img/favicon/favicon.ico')}}" />


  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{asset('asset/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('asset/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('asset/css/theme-default.css')}}" class="template-customizer-theme-css" />
  {{--
  <link rel="stylesheet" href="{{asset('asset/css/demo.css')}}" /> --}}

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('asset/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

  <!-- Page CSS -->
  {{--
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/parsley.css')}}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('custom/css/custom.css')}}" rel="stylesheet" type="text/css" />

  <!-- Page -->
  <link rel="stylesheet" href="{{asset('asset/css/pages/page-auth.css')}}" />
  <!-- Helpers -->
  <script src="{{asset('asset/js/helpers.js')}}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{asset('asset/js/config.js')}}"></script>
</head>

<body >
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <img src="{{ asset('images/ilab_logo.jpg') }}" style="width: 200px; height: 190px;">
              </a>
            </div>
            <div class="text-center mt-0" style="margin-top: -25px !important">
              <h4 class="mb-2 bold">Welcome to GraceClinic</h4>
              <p class="mb-2">Please create an account</p>
            </div>

            <div id="msg"></div>

            <form class="mb-3" data-parsley-validate>
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" autofocus autocomplete="off" required />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" autofocus autocomplete="off" required />
              </div>
              <div class="mb-3">
                <label for="gender" class="form-label">--Select gender--</label>
                <select class="form-control" name="gender" required>
                    <option value="" selected disabled>--Select gender--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                 
                </select>
            </div>
            
              <div class="mb-3">
                <label for="email" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" autofocus autocomplete="off" required />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Contact</label>
                <input type="text" class="form-control" name="contact" autofocus autocomplete="off" required />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Birthdate</label>
                <input type="date" class="form-control" name="birthdate" autofocus autocomplete="off" required />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" name="email" autofocus autocomplete="off" required />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label">Password</label>
                </div>

                <div class="input-group input-group-merge">
                  <input type="password" class="form-control" name="password" id="password""off" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>

              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label">Confirm Password</label>
                </div>

                <div class="input-group input-group-merge">
                  <input type="password" class="form-control" name="password" id="confirm_password""off" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>

              </div>

              <div class="mb-3">
                <button class="btn btn-success d-grid w-100" id="register_btn" type="submit">Sign Up</button>
              </div>
              <div class="col-md-6 mb-3">
                <p>Already have an account?<a href="/login">Sign In</a></p>
              </div>

            </form>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>



  <!--partcles.js-->
  {{-- <script src="{{asset('particles.js')}}"></script>
  <script src="{{asset('particles.min.js')}}"></script> --}}
  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{asset('asset/libs/jquery/jquery.js')}}"></script>
  <script src="{{asset('asset/libs/popper/popper.js')}}"></script>
  <script src="{{asset('asset/js/bootstrap.js')}}"></script>
  <script src="{{asset('asset/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

  <script src="{{asset('asset/js/menu.js')}}"></script>


  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="{{asset('asset/js/main.js')}}"></script>

  {{-- <script src="{{asset('asset/js/ui-toasts.js')}}"></script> --}}


  {{-- <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script> --}}
  <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/parsley.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/jquery.form.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>

  <!-- Nex Library -->
  <script src="{{ asset('js/nexlibrary.js') }}" type="text/javascript"></script>
  <script src="{{ asset('custom/js/login.js') }}" type="text/javascript"></script>

</body>

</html>
