<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/checklist.svg') }}">
  <title>
    TestCasetify 
  </title>
  <!--     Fonts and icons     -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet">
</head>

<body style=" background: rgb(243,231,233); background: linear-gradient(180deg, rgba(243,231,233,1) 0%, rgba(219,230,245,1) 54%, rgba(219,245,239,1) 91%); height:100vh; overflow: hidden;">
  <main class="main-content  mt-0">
    <div class="container">
      <div class="row mt-5 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0 shadow">
            <div class="card-header text-center pt-4">
              <img src="assets/img/checklist.svg" width="128">
              <h3 class="mt-1">TestCasetify</h3>
              <hr class="horizontal dark mt-0">
              <h5>Register</h5>
              <span class="text-secondary text-xs">Fill up the form</span>
            </div>
            
            <div class="card-body">
              <form role="form" method="POST">
                @csrf
                <div class="form-group mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Input Name">
                </div>
                <div class="form-group mb-3">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Input Email">
                </div>
                <div class="form-group mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Input Password">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up <i class="fas fa-user-plus"></i></button>
                </div>
                <p class="text-sm mt-3 mb-0 text-center">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>  
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=3.1.0') }}"></script>
       @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @endif
    @if(session('err'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "{{ session('err') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                icon: "error",
                title: "Validation Error!",
                html: "<ul>@foreach ($errors->all() as $error){{ $error }}<br>@endforeach</ul>",
                showConfirmButton: false,
                showCloseButton: true,
            })
        </script>
    @endif
</body>
</html>