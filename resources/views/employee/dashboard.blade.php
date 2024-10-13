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
                                    class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"></span>
                                <span class="text-white  pt-1 fw-semibold fs-6">Employees</span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                              
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white  w-100 mt-auto mb-2">
                                    
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white  w-100 mt-auto mb-2">
                                    
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-danger rounded">
                                   
                                </div>
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
