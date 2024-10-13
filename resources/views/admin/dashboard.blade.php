@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('breadcrumb', 'Dashboards')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!-- Card for Welcome Message -->
                    <a class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10 hover-elevate-up"
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
                    <a href="{{ route('employee.index') }}" class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10 hover-elevate-up  bg-primary "
                        >
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span
                                    class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalVerifiedEmployees + $totalUnVerifiedEmployees }}</span>
                                <span class="text-white  pt-1 fw-semibold fs-6">Employees</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                @php
                                    $totalEmployees = $totalVerifiedEmployees + $totalUnVerifiedEmployees;
                                    $percentageVerified = $totalEmployees > 0 ? ($totalVerifiedEmployees / $totalEmployees) * 100 : 0;
                                    $percentageUnVerified = $totalEmployees > 0 ? ($totalUnVerifiedEmployees / $totalEmployees) * 100 : 0;

                                @endphp
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white  w-100 mt-auto mb-2">
                                    <span>{{ $totalVerifiedEmployees }} Active</span>
                                    <span>{{ number_format($percentageVerified, 2) }}%</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white  w-100 mt-auto mb-2">
                                    <span>{{ $totalUnVerifiedEmployees }} Pending</span>
                                    <span>{{ number_format($percentageUnVerified, 2) }}%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                    <div class="bg-danger rounded h-8px" role="progressbar"
                                        style="width: {{ $percentageVerified }}%;" aria-valuenow="{{ $percentageVerified }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!--end::Col-->

                <!--begin::Col for Companies and Admins-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!-- Card for Companies -->
                    <a href="{{ route('admin.companies.index') }}" class="card card-flush h-md-50 mb-5 mb-xl-10 hover-elevate-up" style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white">{{ $totalCompanies }}</span>
                                <span class="text-white  pt-1 fw-semibold fs-6">Companies</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <p class="text-white">Total number of companies in the system.</p>
                        </div>
                    </a>

                    <!-- Card for Admins -->
                    <a href="{{ route('admins.index') }}" class="card card-flush h-lg-50 hover-elevate-up" style="background-color: #1C325E">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-white">{{ $totalAdmins }}</span>
                                <span class="text-white  pt-1 fw-semibold fs-6">Admins</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <p class="text-white">Total number of admins managing the system.</p>
                        </div>
                    </a>
                </div>
                <!--end::Col-->

                <div class="col-xxl-6">
                    <!-- Card for History -->
                    <div class="card card-flush h-md-100">
                        <div class="card-body d-flex flex-column justify-content-between bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0"
                            style="background-position: 100% 50%;">
                            <div class="d-flex flex-stack fs-4">
                                <div class="fw-bold">History</div>
                                <a href="{{ route('history.index') }}"
                                    class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2">Show more</a>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div class="tab-content mt-10">
                                <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel"
                                    aria-labelledby="kt_activity_today_tab">
                                    <div class="timeline timeline-border-dashed">
                                        @foreach ($historyLogs as $log)
                                            <div class="timeline-item">
                                                <div class="timeline-line"></div>
                                                <div class="timeline-icon">
                                                    <i class="ki-duotone ki-time fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <div class="timeline-content mb-10 mt-n1">
                                                    <div class="pe-3 mb-5">
                                                        <div class="fs-5 fw-semibold mb-2">{{ $log->description }}</div>
                                                        <div class="d-flex align-items-center mt-1 fs-6">
                                                            <div class="text-muted me-2 fs-7">At
                                                                {{ $log->created_at->format('h:i A') }} on
                                                                {{ $log->created_at->format('M d, Y') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if ($historyLogs->isEmpty())
                                            <div class="text-center">
                                                <p class="text-muted">No history logs found.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
