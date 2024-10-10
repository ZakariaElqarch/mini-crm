@extends('layouts.auth')

@section('content')
    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--begin::Form-->
                <div class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                    @csrf

                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bolder mb-3">Welcome Back!</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">Please choose your role to proceed</div>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Separator-->
                    <span class="separator my-14"></span>
                    <!--end::Separator-->

                    <!--begin::Submit button for Admin-->
                    <div class="d-grid mb-10">
                        <a href="{{ route('admin.login') }}" id="kt_sign_in_submit" class="btn btn-primary" role="button"
                            aria-label="Sign in as Admin">
                            <span class="indicator-label">Log in as Admin</span>
                        </a>
                    </div>
                    <!--end::Submit button for Admin-->

                    <!--begin::Submit button for Employee-->
                    <div class="d-grid mb-10">
                        <a href="{{ route('employee.login') }}" id="kt_sign_in_employee" class="btn btn-secondary"
                            role="button" aria-label="Sign in as Employee">
                            <span class="indicator-label">Log in as Employee</span>
                        </a>
                    </div>
                    <!--end::Submit button for Employee-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Body-->
@endsection
