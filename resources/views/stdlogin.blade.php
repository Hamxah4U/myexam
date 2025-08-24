<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyExam - Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Administrator Login Portal">
    
    <link rel="shortcut icon" href="{{ asset('img/arashmil.jpg') }}" type="image/x-icon">

    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}">
    <style>
      :root {
        --primary: #177dff;
        --primary-light: rgba(23, 125, 255, 0.14);
      }
      
      body {
        background-color: #f8f9fa;
        display: flex;
        min-height: 100vh;
        align-items: center;
        justify-content: center;
        background-image: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
      }
      
      .login-container {
        max-width: 480px;
        width: 100%;
        padding: 0 15px;
      }
      
      .login-card {
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
      }
      
      .login-card .card-header {
        background-color: var(--primary);
        color: white;
        text-align: center;
        padding: 1.5rem;
        border-bottom: none;
      }
      
      .login-card .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
      }
      
      .login-card .card-body {
        padding: 2rem;
      }
      
      .login-card .form-control {
        height: 45px;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        padding-left: 15px;
        transition: all 0.3s;
      }
      
      .login-card .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(23, 125, 255, 0.25);
      }
      
      .login-card .btn-login {
        background-color: var(--primary);
        border: none;
        padding: 10px 25px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s;
      }
      
      .login-card .btn-login:hover {
        background-color: #1269db;
        transform: translateY(-2px);
      }
      
      .login-card .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #555;
      }
      
      .login-logo {
        text-align: center;
        margin-bottom: 1.5rem;
      }
      
      .login-logo img {
        height: 60px;
        width: auto;
      }
      
      .forgot-password {
        text-align: right;
        margin-top: -10px;
        margin-bottom: 15px;
      }
      
      .forgot-password a {
        color: #777;
        font-size: 0.85rem;
        text-decoration: none;
      }
      
      .forgot-password a:hover {
        color: var(--primary);
      }
      
      @media (max-width: 575.98px) {
        .login-card .card-body {
          padding: 1.5rem;
        }
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="login-card card">
        <div class="card-header">
          <div class="login-logo">
            <img src="{{ asset('img/black and silver logo.png') }}" alt="Company Logo">
          </div>
          <div class="card-title">Student Portal</div>
        </div>
        <div class="card-body">
          <form id="studentloginForm" method="POST" action="{{ route('studentlogin') }}">
            @csrf
            <div class="form-group">
              <label for="email">Email Address</label>
              <input
                type="email"
                class="form-control"
                id="email"
                placeholder="Enter your email"
                name="email"
              />
              <x-form-error name='email'/>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Enter your password"
                name="password"
              />
              <x-form-error name='password' />
              {{-- <div class="forgot-password">
                <a href="#">Forgot password?</a>
              </div> --}}
            </div>
            <div class="form-group mb-0">
              <button type="submit" class="btn btn-success btn-block btn-login">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center mt-3">
        <p class="text-muted">© {{ date('Y') }} MyExam. All rights reserved.</p>
      </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    
    <!-- Sweet Alert -->
    <script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    
    <script>
      $(document).ready(function() {
        // Form submission
        $('#loginForm').on('submit', function(e) {
          e.preventDefault();          
          swal({
            title: "Login Successful!",
            text: "You are being redirected to the dashboard...",
            icon: "success",
            buttons: false,
            timer: 2000
          });
          
          // In a real application, you would redirect after successful login
          // setTimeout(function() {
          //   window.location.href = "/dashboard";
          // }, 2000);
        });
        
        // Add animation to the login button on hover
        $('.btn-login').hover(
          function() {
            $(this).css('transform', 'translateY(-2px)');
          },
          function() {
            $(this).css('transform', 'translateY(0)');
          }
        );
      });
    </script>
  </body>
</html>