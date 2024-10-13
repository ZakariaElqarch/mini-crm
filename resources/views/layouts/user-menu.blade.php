<!-- resources/views/layouts/user-menu.blade.php -->
<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
    <!-- Menu wrapper -->
    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <img src="{{ asset('assets/media/avatars/blank.png') }}" class="rounded-3" alt="user">
    </div>

    <!-- User account menu -->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <!-- Menu item -->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!-- Avatar -->
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="{{ asset('assets/media/avatars/blank.png') }}">
                </div>
                <!-- User info -->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">
                        {{ Auth::user()->fullName }}
                        @if (Auth::guard('admin')->check())
                            <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Admin</span>
                        @elseif (Auth::guard('employee')->check())
                            <span class="badge badge-light-info fw-bold fs-8 px-2 py-1 ms-2">Employee</span>
                        @endif

                    </div>
                    <a href="#"
                        class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                </div>
            </div>
        </div>

        <!-- Menu separator -->
        <div class="separator my-2"></div>

        <!-- Menu item -->
        <div class="menu-item px-5">
            @if (Auth::guard('admin')->check())
                <a href="{{ route('admin.profile.show') }}" class="menu-link px-5">My Profile</a>
            @elseif (Auth::guard('employee')->check())
                <a href="{{ route('employee.profile.show') }}" class="menu-link px-5">My Profile</a>
            @endif
        </div>




        <!-- Menu separator -->
        <div class="separator my-2"></div>



        <!-- Menu item -->
        <div class="menu-item px-5">
            <a href="#" class="menu-link px-5"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sign Out
            </a>
            @if (Auth::guard('admin')->check())
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @elseif (Auth::guard('employee')->check())
                <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif

        </div>

    </div>
</div>
