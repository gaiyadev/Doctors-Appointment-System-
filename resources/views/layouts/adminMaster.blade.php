<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Dashboard by Creative Tim
  </title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

</head>

<body class="">
  <div class="wrapper " id="app">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo"><a href="" class="simple-text logo-normal">
          Creative Tim
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <router-link class="nav-link" to="/admin_dashboard">
              <i class="material-icons">dashboard </i>
              <p>Dashboard</p>
            </router-link>
          </li> 
      @include('includes.adminSide')
    <div class="main-panel">
      <!-- Navbar -->
         @include('includes.adminNavbar')
      <!-- End Navbar -->
      <div class="content" >
        <div class="container-fluid">  
        <h4 class="text-primary">Welcome {{ Auth::user()->firstname }}  </h4>    
     <transition name="fade" mode="out-in" >
      <router-view></router-view>
      </transition>
   
      </div>
      
    </div>
  </div>
    </div>
    <style>
    .fade-enter,  .fade-leave-active {
      opacity: 0;
      
    }
    .fade-enter-active, .fade-leave-active {
      transiton-duration: 0.3s;
      transiton-property: opacity;
      transition-timing-function: ease;
    }
   
  
    
    </style>
  <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="" target="_blank">Gaiya M. Obed</a> for a better web.
          </div>
        </div>
      </footer>
          <script src=" {{ asset('js/app.js') }}"></script>
</body>
         @include('includes.footerScript')

</html>