@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('breadcrumb', 'Dashboards')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">
                    <!-- Card for Welcome Message -->
                    <a a href="{{ route('employee.profile.show') }}" class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10 hover-elevate-up"
                        style="background-color: #F1416C; background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}')">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">Hi,</span>
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2 mt-5">
                                    {{ Auth::user()->fullName }}</span>
                            </div>
                        </div>
                    </a>

                    <!-- Card for Employees -->
                    <a href="{{ route('employee.colleagues.index') }}"
                        class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10 hover-elevate-up bg-primary ">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $verifiedEmployeeCount }}</span>
                                <span class="text-white pt-1 fw-semibold fs-6">Colleagues</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <p class="text-white">Total number of colleagues.</p>
                        </div>
                    </a>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                    <!-- Company data -->
                    <a href="{{ route('employee.Company.show') }}" class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-100 mb-5 mb-xl-10 hover-elevate-up"
                        style="background-color: #F1416C; background-image:url('{{ asset('assets/media/patterns/vector-1.png') }}'); min-height: 20px;">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">Company:</span>
                                <span class="fs-1 fw-bold text-white me-2 lh-1 ls-n2 mt-5">
                                    {{ $company->name ?? 'No company associated' }}</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <span class="d-flex align-items-center text-white admin me-5 mb-2">
                                    <i class="ki-duotone ki-sms fs-2 me-1 text-white">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>contact@companya.com</span>

                                <span class="d-flex align-items-center text-white admin me-5 mb-2">
                                    <i class="ki-duotone ki-geolocation fs-2 me-1 text-white">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>123 Main St, City A</span>

                                <span class="d-flex align-items-center text-white admin me-5 mb-2">
                                    <i class="ki-duotone ki-phone fs-2 me-1 text-white">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    1234567890</span>

                            </div>
                        </div>

                    </a>
                </div>
                <!--end::Col-->
            </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
