@extends('layouts.auth')

@section('content')
<!--begin::Body-->
<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
    <!--begin::Card-->
    <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('employee.login') }}" method="POST">
                @csrf

                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">To your admin account</div>
                    <!--end::Subtitle-->
                </div>
                <!--end::Heading-->

                <!--begin::Separator-->
                <span class="separator my-14"></span>
                <!--end::Separator-->

                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off"
                        class="form-control bg-transparent {{ $errors->has('email') ? 'is-invalid' : '' }}" />
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <!--end::Input group-->

                <div class="fv-row mb-3">
                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                        class="form-control bg-transparent {{ $errors->has('password') ? 'is-invalid' : '' }}" />
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <!--end::Input group-->

                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                        <span class="indicator-label">Sign In</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                <!--end::Submit button-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Card-->
</div>
<!--end::Body-->
@endsection
