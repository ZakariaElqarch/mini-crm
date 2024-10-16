<!-- resources/views/layouts/toolbar.blade.php -->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                @yield('page_title', 'Dashboard')
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    @if (Auth::guard('admin')->check())
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    @elseif(Auth::guard('employee')->check())
                        <a href="{{ route('employee.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    @endif
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">@yield('breadcrumb', 'Dashboard')</li>
            </ul>
        </div>

        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            @yield('action')
            <!--end::Primary button-->
        </div>
    </div>
</div>
