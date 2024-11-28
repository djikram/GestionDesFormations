<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="rtl" data-theme="theme-default"
    data-assets-path="{{asset ( 'assets/')}}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Formation</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('resources/assets/img/branding/pic_EN.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
<!--test css-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">







<!--test css-->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/css/rtl/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/swiper/swiper.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet"
        href="{{asset ('resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet"
        href="{{asset ('resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />

<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load Select2 CSS and JS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<!-- Include Choices CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>




    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/css/pages/cards-advance.css')}}" />
    <!-- Helpers -->
    <script src="{{asset ('resources/assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{asset ('resources/assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset ('resources/assets/js/config.js')}}"></script>
<style>
/* .menu-item{color:"red";} */

</style>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a class="app-brand-link">
                        <!-- <span class="app-brand-logo demo"> -->
                        <img style="width:80px;" src="{{asset ('resources/assets/img/branding/pic_EN.png')}}"
                        alt="" />
                            <!-- <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                    fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                    fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#7367F0" />
                            </svg> -->
                        <!-- </span> -->
                        <span class="app-brand-text demo menu-text fw-bold">Formation</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active open">
                        <a href="/dash" class="menu-link" style="background: linear-gradient(72.47deg, rgba(255, 0, 0, 0.7) 22.16%, #cc2c2c 76.47%)!important;"><!--menu-link menu-toggle-->
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="لوحات التحكم">لوحات التحكم</div>
                            <!-- <div class="badge bg-label-primary rounded-pill ms-auto">3</div> -->
                        </a>
                    </li>

                    <!-- Users -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                            <div data-i18n="المستخدم">المستخدم</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="/user" class="menu-link">
                                    <div data-i18n="قائمة المستخدمين">قائمة المستخدمين</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/adduser" class="menu-link">
                                    <div data-i18n="إضافة مستخدم">إضافة مستخدم</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Courses -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                            <div data-i18n="الدورات التدريبية">الدورات التدريبية</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="/courses" class="menu-link">
                                    <div data-i18n="قائمة التكوينات">قائمة التكوينات</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="/addcourse" class="menu-link">
                                    <div data-i18n="إضافة تكوين">إضافة تكوين</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0"
                                    href="javascript:void(0);">
                                    <!-- <i class="ti ti-search ti-md me-2"></i>
                                    <span class="d-none d-md-inline-block text-muted">بحث (Ctrl+/)</span> -->
                                </a>
                            </div>
                        </div>
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                            </li>
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{asset ('resources/assets/img/avatars/1.png')}}" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" >
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{asset ('resources/assets/img/avatars/1.png')}}" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-semibold d-block">{{ Session::get('username') }}</span>
                                                    <small class="text-muted">{{ Session::get('role') }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <div class="dropdown-divider"></div>
                                    </li> -->
                                    <li>
                                        <a class="dropdown-item" href="pages-profile-user.html">
                                            <i class="ti ti-user-check me-2 ti-sm"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <div class="dropdown-divider"></div>
                                    </li> -->
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="ti ti-logout me-2 ti-sm"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                        <!-- Logout form -->
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper d-none">
                        <input type="text" class="form-control search-input container-xxl border-0"
                            placeholder="Search..." aria-label="Search..." />
                        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- / Content -->

                    <!-- Footer -->
                    <!-- <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                <div>
                                    ©
                                    <script>
                                    document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank"
                                        class="fw-semibold">Pixinvent</a>
                                </div>
                                <div>
                                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://pixinvent.ticksy.com/" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer> -->
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset ('resources/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/node-waves/node-waves.js')}}"></script>

    <script src="{{asset ('resources/assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{asset ('resources/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/swiper/swiper.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
    <!-- Main JS -->
    <script src="{{asset ('resources/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset ('resources/assets/js/dashboards-analytics.js')}}"></script>
<!--hadi-->
    <script src="{{asset ('resources/assets/js/form-wizard-numbered.js')}}"></script>
    <script src="{{asset ('resources/assets/js/form-wizard-validation.js')}}"></script>

<!-- hadi -->
<script src="{{asset ('resources/assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>

    <script src="{{asset ('resources/assets/js/charts-apex.js')}}"></script><!---->


    <script>
    // Initialize the DataTable
    $(document).ready(function() {
        $('#tableID').DataTable({

            // Enable the searching
            // of the DataTable
            searching: true
        });
    });
    </script>
</body>

</html>
