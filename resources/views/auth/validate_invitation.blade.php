@extends('layouts.auth')

@section('content')
    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_profile_form"
                    action="{{ route('invite.complete', $invitation->token) }}" method="POST">
                    @csrf

                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bolder mb-3">Complete Your Profile</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">Please provide your details to complete the setup.</div>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Separator-->
                    <span class="separator my-14"></span>
                    <!--end::Separator-->

                    <!--begin::Input group for Address-->
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Address" name="address" required autocomplete="off"
                            class="form-control bg-transparent {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address') }}"/>
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group for Phone Number-->
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Phone Number" name="phoneNumber" required autocomplete="off"
                            class="form-control bg-transparent {{ $errors->has('phoneNumber') ? 'is-invalid' : '' }}"  value="{{ old('phoneNumber') }}"/>
                        @if ($errors->has('phoneNumber'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phoneNumber') }}
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group for Date of Birth-->
                    <div class="fv-row mb-8">
                        <input type="date" name="date_of_birth" required
                            class="form-control bg-transparent {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" value="{{ old('date_of_birth') }}"/>
                        @if ($errors->has('date_of_birth'))
                            <div class="invalid-feedback">
                                {{ $errors->first('date_of_birth') }}
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group for Password-->
                    <div class="fv-row mb-8">
                        <input type="password" placeholder="Password" name="password" required autocomplete="off"
                            class="form-control bg-transparent {{ $errors->has('password') ? 'is-invalid' : '' }}" />
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group for Confirm Password-->
                    <div class="fv-row mb-8">
                        <input type="password" placeholder="Confirm Password" name="password_confirmation" required
                            autocomplete="off" class="form-control bg-transparent {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" />
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->

                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_profile_submit" class="btn btn-primary">
                            <span class="indicator-label">Complete Profile</span>
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
