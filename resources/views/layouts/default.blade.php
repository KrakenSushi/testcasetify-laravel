<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/checklist.svg') }}">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.css"> --}}
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
  <link  rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" id="pagestyle" >
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
      {{-- <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i> --}}
      <a class="navbar-brand m-0 d-flex align-items-center" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/img/checklist.svg') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 fs-4 font-weight-bold">TestCasetify</span>
      </a>

    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

        @yield('nav_items')

      </ul>
    </div>
    <div class="sidenav-footer mx-3" style="position: absolute; left: 0; bottom: 0; width: 85%; padding: 10px;">
      <!-- Logout and watermark here -->
      <center>
        
        <a href="https://www.github.com/KrakenSushi" class="font-weight-bold fs-6" target="_blank">
          <img src="{{ asset('assets/img/krakensushi.png') }}" width="72px"><br>
          <i class="fab fa-github"></i> KrakenSushi
          </a>
      </center>
      <hr class="horizontal dark">
      <form action="backend/logout.php" method="post">
        <a href="{{ route('logout') }}" class="btn btn-danger mb-2 w-100 text-uppercase">
          Logout <i class="fas fa-right-to-bracket"></i>
        </a>
      </form>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h2 class="font-weight-bolder text-white mb-0 mt-4">@yield('title')</h2>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              
            </div>
          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
          </ul>
          <!-- User Field -->
            <div class="d-flex align-items-center d-sm-block d-none">
                <span class="fs-5 fw-bolder text-light"><span id="greeting-msg"></span>, <span class="fs-4">{{ auth()->user()->name }} </span>!</span>
            <img src="assets/img/avatar-default.png" class="float-end ms-1 " width="48">
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">

      @yield('body')

    </div>
  </main>

  <div class="fixed-plugin">
    <div class="fixed-plugin-button position-fixed px-3 py-2 bg-dark text-light" id="themeToggleBtn">
      <i class="fa fa-moon py-2"></i>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.js?v=2.0.4') }}"></script>
  <script>
      $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
  </script>
  <script>
      // Check if dark mode preference is stored in local storage
      var isDarkMode = localStorage.getItem("darkMode");

      // Apply dark mode if set to true
      if (isDarkMode === "true") {
        enableDarkMode(); 
        $('#themeToggleBtn').removeClass('text-light bg-dark').addClass('text-dark bg-white').html('<i class="fas fa-sun text-warning"></i>');
      }else{
        $('#sidenav-main').removeClass('dark-version').addClass('bg-white');
        $('#themeToggleBtn').addClass('text-light bg-dark').removeClass('text-dark bg-white').html('<i class="fas fa-moon text-white"></i>');
      }

    $('#themeToggleBtn').on('click', function(){
      if (isDarkMode === "true") {
        disableDarkMode();
        $('#themeToggleBtn').addClass('text-light bg-dark').removeClass('text-dark bg-white').html('<i class="fas fa-moon text-white"></i>');
        isDarkMode = "false";
      } else {
        enableDarkMode();
        $('#themeToggleBtn').removeClass('text-light bg-dark').addClass('text-dark bg-white').html('<i class="fas fa-sun text-warning"></i>');
        isDarkMode = "true";
      }

      // Update the preference in local storage
      localStorage.setItem("darkMode", isDarkMode);
    })


    function enableDarkMode() {
      // Apply necessary styles to enable dark mode
      const body = $('body');
      const aside = $('#sidenav-main');
      $('.modal-content').addClass('dark-version');
      $('.modalField').addClass('dark-input text-white');
      body.addClass('dark-version');
      aside.addClass('dark-version').removeClass('bg-white');
      // Add other necessary changes here
    }

    function disableDarkMode() {
      // Remove dark mode styles
      const body = $('body');
      const aside = $('#sidenav-main');
      const modalFields = $('.modalFields');

      $('.modal-content').removeClass('dark-version');
      $('.modalField').removeClass('dark-input text-white');
      body.removeClass('dark-version');
      aside.removeClass('dark-version').addClass('bg-white');
      // Remove other changes made for dark mode here
    }

      let currentTime = new Date().getHours();
      let greeting = "";

      if (currentTime >= 5 && currentTime <= 12) {
          greeting = 'Good Morning';
      } else if (currentTime >= 12 && currentTime < 17) {
          greeting = 'Good Afternoon';
      } else if ((currentTime >= 17 && currentTime <= 23) || (currentTime >= 0 && currentTime < 4)) {
          greeting = 'Good Evening';
      }
      $('#greeting-msg').text(greeting);
      console.log('Time: '+currentTime);
      console.log('Greeting: '+greeting);
  </script>
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
  @yield('js')
</body>

</html>