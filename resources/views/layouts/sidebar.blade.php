<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('admin.dashboard') }}">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo-illizeo.png') }}"
                class="h-25px app-sidebar-logo-default">
            <img alt="Logo" src="{{ asset('assets/media/logos/favicon-illizeo.png') }}"
                class="h-20px app-sidebar-logo-minimize">
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180"><span class="path1"></span><span
                    class="path2"></span></i>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-home fs-2"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}"
                            href="{{ route('admin.companies.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-office-bag fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Companies</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('employee.index') ? 'active' : '' }}"
                            href="{{ route('employee.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-badge fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Employees</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admins.index') ? 'active' : '' }}"
                            href="{{ route('admins.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user-tick fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Admins</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('history.index') ? 'active' : '' }}"
                            href="{{ route('history.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-questionnaire-tablet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">History</span>
                        </a>
                    </div>
                    <!--end:Menu item-->

                </div>
            </div>
        </div>
    </div>
</div>
