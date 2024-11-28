<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{asset ( 'assets/')}}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('resources/assets/img/branding/pic_EN.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/css/rtl/theme-default.css"')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/css/demo.css')}}" />
    <style>
    .btn-primary {
        background-color: #40b42c;
        /* light purple #6a5acd*/
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-color: #73B87E;
        /* #5a4bbd */
        color: white;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    a {
        color: gray;
        text-decoration: none;
    }

    a:hover {
        color: #73B87E;
    }

    input {
        border-color: gray;
    }

    input:hover {
        border-color: gray;
    }

    #email:focus {
        border-color: gray;
        outline: none;
    }

    #password:focus {
        border-color: gray;
        outline: none;
    }

    .auth-cover-bg {
        background: none !important;
        /* Remove any background color or image */
    }

    .auth-cover-bg-color {
        background: none !important;
        /* Remove background from this class as well */
    }

    .platform-bg {
        display: none !important;
        /* Hide the second image */
    }
    .form-check-input:checked {
    background-color: gray;
    border-color: gray;
    }
    </style>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <!-- Vendor -->
    <link rel="stylesheet"
        href="{{asset ('resources/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset ('resources/assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{asset ('resources/assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/js/template-customizer.js')}}"></script>
    <script src="{{asset ('resources/assets/js/config.js')}}"></script>
</head>

<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{asset ('resources/assets/img/illustrations/auth-reset-password-illustration-light.png')}}"
                        alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-reset-password-illustration-light.png"
                        data-app-dark-img="illustrations/auth-reset-password-illustration-light.png" />

                    <img src="{{asset ('resources/assets/img/illustrations/bg-shape-image-light.png')}}"
                        alt="auth-login-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a class="app-brand-link gap-2">
                            <!-- <span class="app-brand-logo demo"> -->
                            <img style="width:150px;" src="{{asset ('resources/assets/img/branding/pic_EN.png')}}"
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
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1 fw-bold">Bienvenue sur Entraide National ! 👋</h3>
                    <p class="mb-4">Connectez-vous pour accéder à la plateforme</p>

                    @if (Session::has("success"))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    <form id="formAuthentication" class="mb-3" action="{{route('login.submit')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Entrez votre email" autofocus />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Mot de passe</label>
                                <!-- <a href="forgetpassword">
                                    <small>Mot de passe oublié ?</small>
                                </a> -->
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <!-- <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span> -->
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Se souvenir de moi </label>
                            </div>
                        </div>

                        <button class="btn btn-primary d-grid w-100" type="submit">
                        Se connecter</button>
                    </form>

                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->

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
    <script src="{{asset ('resources/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset ('resources/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset ('resources/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset ('resources/assets/js/pages-auth.js')}}"></script>
</body>

</html>
