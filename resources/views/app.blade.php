<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Ordine</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,300&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/user.css') }}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('styles')
    <style>
        .main {
            min-height: 100vh;
            /* Minimum height of the main content */
        }

        .form-label {
            margin-bottom: .1rem;
        }

        .bg-holder {
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }

        @media (max-width: 768px) {

            body,
            html {
                overflow-x: auto;
                overflow-y: auto;
            }
        }

        /* Add this CSS to your stylesheet */
        @media (max-width: 991.98px) {

            /* Styles for mobile menu items background color */
            .navbar-collapse {
                background-color: #f0f0f0;
                /* Change this to your desired gray color */
            }

            .navbar-nav .nav-link {
                padding: 15px;
                /* Adjust padding as needed */
            }
        }
    </style>
</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 " data-navbar-on-scroll="bg-200">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav pt-2 pt-lg-0 font-base align-items-center">
                        <li class="nav-item"><a class="nav-link px-3"
                                href="{{ url('/') }}">{{ __('messages.home') }}</a></li>
                        <li class="nav-item"><a class="nav-link px-3"
                                href="{{ url('/download') }}">{{ __('Dowload PDF ') }}</a></li>

                    </ul>
                    <div class="col-md-4">

                    </div>

                </div>


            </div>
        </nav>

        @yield('content')
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->

    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.0/gsap.min.js"></script>

    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        console.clear();

        $(document).ready(function() {
            var initialDtaValue = $('[data-navbar-on-scroll]').attr('data-navbar-on-scroll');
            // Add a scroll event listener
            $(window).scroll(function() {
                var scrollPosition = $(window).scrollTop();
                if (scrollPosition > 50) {
                    $('[data-navbar-on-scroll]').addClass(initialDtaValue);
                } else {
                    $('[data-navbar-on-scroll]').removeClass(initialDtaValue);
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>
