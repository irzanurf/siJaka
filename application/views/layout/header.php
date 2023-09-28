<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Penjadwalan - Universitas Diponegoro</title>
    <link rel="apple-touch-icon" href="<?= base_url('assets/undip.png');?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/undip.png');?>">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/main/css/vendors.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/main/vendors/css/charts/chartist.css');?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/main/css/app-lite.css');?>">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/main/css/core/menu/menu-types/vertical-menu.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/main/css/core/colors/palette-gradient.css');?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
  </head>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
      <div class="navbar-wrapper">
        <div class="navbar-container content" style="background-image: linear-gradient(to left, #2dc3e8, #1976d2);">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-link" onclick="topFunction()" id="top-btn" href="#"><i class="ficon ft-chevrons-up"></i></a></li>
              <script>
                //Get the button:
                mybutton = document.getElementById("top-btn");

                // When the user scrolls down 20px from the top of the document, show the button
                window.onscroll = function() {scrollFunction()};

                function scrollFunction() {
                  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                  } else {
                    mybutton.style.display = "none";
                  }
                }

                // When the user clicks on the button, scroll to the top of the document
                function topFunction() {
                  document.body.scrollTop = 0; // For Safari
                  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                } 
              </script>
            </ul>
            
            <ul class="nav navbar-nav float-right">
              
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="<?= base_url('assets/main/images/ico/admin.png');?>" alt="avatar"><i></i></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="arrow_box_right">
                  <?PHP if(!empty($sidebar)) { ?>  
                  <a class="dropdown-item" href="#"><span class="avatar avatar-online"><img src="<?= base_url('assets/main/images/ico/admin.png');?>" alt="avatar">
                  
                  <span class="user-name text-bold-700 ml-1">Admin</span>
                  
                </span></a>
                <?PHP } ?>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?= base_url('Welcome/changePass');?>"><i class="ft-user"></i> Ganti Password</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?= base_url('Welcome/logout');?>"><i class="ft-power"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="<?= base_url('assets/main/images/backgrounds/02.jpg');?>">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url('/');?>"><img class="brand-logo" alt="logo" src="<?= base_url('assets/undip.png');?>"/>
              <h3 class="brand-text" style="font-size: 16px;">Penjadwalan</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <?PHP if(!empty($sidebar)) { ?>
          <li class=" nav-item"><a href="<?= base_url('/');?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class=" nav-item"><a href="<?= base_url('Admin/jadwal');?>"><i class="ft-calendar"></i><span class="menu-title" data-i18n="">Jadwal</span></a>
          </li>
          <li class=" nav-item"><a href="<?= base_url('Admin/karyawan');?>"><i class="ft-users"></i><span class="menu-title" data-i18n="">Pegawai</span></a>
          </li>
          <li class=" nav-item"><a href="<?= base_url('Admin/unit');?>"><i class="ft-server"></i><span class="menu-title" data-i18n="">Unit</span></a>
          </li>
          <li class=" nav-item"><a href="<?= base_url('Admin/list_assign_karyawan');?>"><i class="ft-book"></i><span class="menu-title" data-i18n="">Assign Petugas</span></a>
          </li>
          <!-- <li class=" nav-item"><a href="#"><i class="ft-server"></i><span class="menu-title" data-i18n="">Penjadwalan</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="<?= base_url('Admin/list_jadwal_unit');?>">By Unit</a>
              </li>
              <li><a class="menu-item" href="<?= base_url('Admin/list_jadwal_karyawan');?>">By Karyawan</a>
              </li>
            </ul> -->
          <!-- <li class=" nav-item"><a href="<?= base_url('Admin/list_jadwal');?>"><i class="ft-server"></i><span class="menu-title" data-i18n="">Analis</span></a>
          </li> -->
      <?PHP } 
      else {?>
       <li class=" nav-item"><a href="<?= base_url('/');?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class=" nav-item"><a href="<?= base_url('Unit/karyawan');?>"><i class="ft-users"></i><span class="menu-title" data-i18n="">Pegawai</span></a>
          </li>
          <li class=" nav-item"><a href="<?= base_url('Unit/list_assign_karyawan');?>"><i class="ft-book"></i><span class="menu-title" data-i18n="">Assign Petugas</span></a>
       </li>
        </ul>
      <?php } ?>
      </div>
      <div class="navigation-background"></div>
    </div>

    <div class="app-content content">
      <div class="content-wrapper" s>
        <div class="content-wrapper-before" style="height:120px; background-image: linear-gradient(to left, #2dc3e8, #1976d2);"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"></h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Line Awesome section start -->