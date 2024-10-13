@extends('layouts.dashboard')

@section('title', 'Profile')

@section('page_title', 'Profile')

@section('breadcrumb', 'Edit Profile')

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card pt-10">
                <div class="modal-content rounded">
                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <form id="kt_modal_edit_employee_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <h4 class="fw-bold">Employee Profile</h4>
                            </div>

                            <!-- Avatar -->
                            <div class="d-flex flex-center flex-column mb-5">
                                <div class="symbol symbol-150px symbol-circle mb-7">
                                    <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image">
                                </div>
                            </div>

                            <!-- Full Name Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2 required">Full Name</label>
                                <input type="text"
                                    class="form-control form-control-solid @error('fullName') is-invalid @enderror"
                                    placeholder="Enter your full name" name="fullName"
                                    value="{{ old('fullName', $admin->fullName) }}">
                                @error('fullName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2 required">Email</label>
                                <input type="email"
                                    class="form-control form-control-solid @error('email') is-invalid @enderror"
                                    placeholder="Enter your email" name="email"
                                    value="{{ old('email', $admin->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Phone</label>
                                <input type="text"
                                    class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                    placeholder="Enter your phone number" name="phone"
                                    value="{{ old('phone', $admin->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Birth Date Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Birth Date</label>
                                <input type="date"
                                    class="form-control form-control-solid @error('birthDate') is-invalid @enderror"
                                    name="birthDate" value="{{ old('birthDate', $admin->birthDate) }}">
                                @error('birthDate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="text-end">
                                <button type="submit" id="kt_modal_edit_employee_submit" class="btn btn-primary">
                                    <span class="indicator-label">Update Profile</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/companies.js') }}"></script>
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>
@endsection
