<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?php echo $config['web']['base_url'] ?>assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?php echo $config['web']['title'] ?> | Adminpanel</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo $config['web']['base_url'] ?>assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="<?php echo $config['web']['base_url'] ?>assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php echo $config['web']['base_url'] ?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?php echo $config['web']['base_url'] ?>assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo $config['web']['base_url'] ?>assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                    fill="#7367F0" />
                  <path
                    opacity="0.06"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                    fill="#161616" />
                  <path
                    opacity="0.06"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                    fill="#161616" />
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                    fill="#7367F0" />
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bold">Adminpanel</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->

            <li class="menu-item active">
              <a href="<?php echo $config['web']['base_url'] ?>admin" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>
            <!-- Apps & Pages -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Apps &amp; Pages</span>
            </li>
            <li class="menu-item">
              <a href="<?php echo $config['web']['base_url'] ?>admin/user" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="User">User</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-book"></i>
                <div data-i18n="Layanan">Layanan</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/provider" class="menu-link">
                    <div data-i18n="Provider API">Provider API</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/categoryl" class="menu-link">
                    <div data-i18n="Kategori">Kategori</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/service" class="menu-link">
                    <div data-i18n="Layanan">Layanan</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-credit-card"></i>
                <div data-i18n="Deposit">Deposit</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/deposit_method" class="menu-link">
                    <div data-i18n="Metode Deposit">Metode Deposit</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/voucher" class="menu-link">
                    <div data-i18n="My Course">Redeem Voucher</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/deposit" class="menu-link">
                    <div data-i18n="Deposit">Deposit</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/deposit/report" class="menu-link">
                    <div data-i18n="Laporan">Laporan</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div data-i18n="Transaksi">Transaksi</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/order" class="menu-link">
                    <div data-i18n="Order">Order</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/order/report" class="menu-link">
                    <div data-i18n="Laporan">Laporan</div>
                  </a>
                </li>
                
              </ul>
            </li>

            

            <!-- Components -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Halaman Lainnya</span>
            </li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-map"></i>
                <div data-i18n="Log">Log</div>
                
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/log/login" class="menu-link">
                    <div data-i18n="Masuk">Masuk</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $config['web']['base_url'] ?>admin/log/balance-usage" class="menu-link">
                    <div data-i18n="Penggunaan Saldo">Penggunaan Saldo</div>
                  </a>
                </li>
              
              </ul>
            </li>
            <li class="menu-item">
              <a href="<?php echo $config['web']['base_url'] ?>admin/page" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-description"></i>
                <div data-i18n="Halaman">Halaman</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $config['web']['base_url'] ?>admin/ticket" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail-opened"></i>
                <div data-i18n="Tiket">Tiket</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $config['web']['base_url'] ?>admin/news" class="menu-link">
                <i class="menu-icon tf-icons ti ti-layout-navbar"></i>
                <div data-i18n="Berita & Informasi">Berita & Informasi</div>
              </a>
            </li>
            

            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">User Session</span>
            </li>
            <!-- Forms -->
            
            <!-- Tables -->
            <li class="menu-item">
              <a href="tables-basic.html" class="menu-link">
                <i class="menu-icon tf-icons ti ti-logout"></i>
                <div data-i18n="Logout">Logout</div>
              </a>
            </li>
            
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                

                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- Quick links  -->
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php echo $config['web']['base_url'] ?>assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->