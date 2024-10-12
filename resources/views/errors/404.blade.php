<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Styles -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon-illizeo.png') }}" />

    <!-- Vite Scripts & Styles -->
    @vite(['resources/js/app.js'])

    <!-- Prevent Clickjacking -->
    <script>
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <!-- Theme mode setup on page load -->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <!-- Root -->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!-- Page bg image -->
        <style>
            body {
                background-image: url('{{ asset('assets/media/auth/bg4.jpg') }}');
            }
        </style>

        <!-- Authentication - Signup Welcome Message -->
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <!-- Content -->
            <div class="d-flex flex-column flex-center text-center p-10">
                <!-- Wrapper -->
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <!-- Title -->
                        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                        <!-- Text -->
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">We can't find that page.</div>

                        <!-- Illustration -->
                        <div class="mb-3">
                            <img src="{{ asset('assets/media/auth/404-error.png') }}"
                                class="mw-100 mh-300px theme-light-show" alt="Error Image Light" />
                            <img src="{{ asset('assets/media/auth/404-error-dark.png') }}"
                                class="mw-100 mh-300px theme-dark-show" alt="Error Image Dark" />
                        </div>

                        <!-- Link -->
                        <div class="mb-0">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Return Back</a>
                        </div>

                    </div>
                </div>
                <!-- End Wrapper -->
            </div>
            <!-- End Content -->
        </div>
        <!-- End Authentication - Signup Welcome Message -->
    </div>
    <!-- End Root -->

    <!-- Javascript -->
    <script>
        var hostUrl = "{{ asset('assets/') }}";
    </script>

    <!-- Global Javascript Bundle -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!-- End Global Javascript Bundle -->
</body>

</html>
