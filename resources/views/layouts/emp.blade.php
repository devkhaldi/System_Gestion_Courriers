<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion des courriers</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{ asset('images/favicon.png') }}">
    <script>
        window.Laravel={!! json_encode([
        'csrftoken'   =>csrf_token(),
        'url'    =>url('/')
        ])!!};
   </script>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <!-- LOGO
            <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo.svg" class="mr-2" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
         -->
            <a class="navbar-brand brand-logo mr-5" href="index.html">COURRIERS</a>
            <a class="navbar-brand brand-logo-mini" href="index.html">C</a>

        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="ti-view-list"></span>
            </button>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                    <div class="input-group">
                        <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
                        </div>
                        <form action="{{url('courrier/search')}}" method="post" class="form-inline">
                            {{ csrf_field() }}
                            <input type="text" name="query" class="form-control" id="navbar-search-input" placeholder="Trouver un courrier ..." aria-label="search" aria-describedby="search">
                        </form>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">

                <li class="nav-item">
                    {{ Auth::user()->name }}
                </li>
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">

                        <img src="{{asset('images/faces/face1.jpg')}}" alt="profile"/>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                        <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="ti-power-off text-primary"></i>
                            Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="ti-view-list"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
            
                <li class="nav-item">
                    <a class="nav-link" href="{{url('courrier/nonvue')}}">
                        <i class="ti-star menu-icon"></i>
                        <span class="menu-title"> Nouveaux courriers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">
                        <i class="ti-layers-alt menu-icon"></i>
                        <span class="menu-title">Tous les courriers</span>
                    </a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="#">
                      <i class="ti-layout-list-post menu-icon"></i>
                      <span class="menu-title">Status des courriers</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <i class="ti-user menu-icon"></i>
                      <span class="menu-title">Profile</span>
                  </a>
              </li>
              
              <li class="nav-item">
                  <a class="nav-link" href="{{url('utilisateurs')}}">
                      <i class="ti-more-alt menu-icon"></i>
                      <span class="menu-title"> Utilisateurs</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <i class="ti-settings menu-icon"></i>
                      <span class="menu-title"> Paramétres</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">
                      <i class="ti-info menu-icon"></i>
                      <span class="menu-title"> A propos</span>
                  </a>
              </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel" id="app">
            <div class="content-wrapper">
            @yield('content')
          
            <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.templatewatch.com/" target="_blank">Templatewatch</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
                    </div>
                </footer>
                -->
            </div>
            <!-- partial -->
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    
    <script src="{{ asset('js/jquery.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    
    <!-- plugins:js -->
    <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}" defer></script>
    <!-- endinject -->
  
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}" defer></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}" defer></script>
    <script src="{{ asset('js/template.js') }}" defer></script>
    <script src="{{ asset('js/todolist.js') }}" defer></script>

    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    <script src="{{ asset('js/file-upload.js') }}" defer></script>

    <script src="{{asset('js/vue.js')}}"></script>
<script src="{{asset('js/axios.js')}}"></script>

    <!-- Vue JS et Axios JS-->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
  <!-- endinject -->
  <!-- Custom js for this page-->

</body>

</html>