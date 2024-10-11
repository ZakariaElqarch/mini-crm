<!-- resources/views/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Admins')
@section('page_title', 'Admins')
@section('breadcrumb', 'Admins')

@section('action')
    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_ticket"
        class="btn btn-primary fw-bold fs-8 fs-lg-base">Create</a>
@endsection

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class=" card card-body pt-15">
                <!--begin::Summary-->
                <div class="d-flex flex-center flex-column mb-5">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-150px symbol-circle mb-7">
                        <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image">
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <div class="fs-3 text-gray-800  fw-bold mb-1">{{ $admin->fullName }}</div>
                    <!--end::Name-->
                    <!--begin::Email-->
                    <div class="fs-5 fw-semibold text-muted  mb-6">{{ $admin->email }}</div>
                    <!--end::Email-->
                </div>
                <!--end::Summary-->
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold">Details</div>
                    <!--begin::Badge-->
                    <div class="badge badge-light-info d-inline">Admin</div>
                    <!--begin::Badge-->
                </div>
                <!--end::Details toggle-->
                <div class="separator separator-dashed my-3"></div>
                <!--begin::Details content-->
                <div class="pb-5 fs-6">
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Account ID</div>
                    <div class="text-gray-600">ID-{{ $admin->id }}</div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Email</div>
                    <div class="text-gray-600">
                        <div class="text-gray-600">{{ $admin->email }}</div>
                    </div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Birth Date</div>
                    <div class="text-gray-600">{{ $admin->birthDate }}</div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Phone</div>
                    <div class="text-gray-600">{{ $admin->phone ?? 'Not provided' }}</div>
                    <!--end::Details item-->
                </div>
                <!--end::Details content-->
            </div>
        </div>
    </div>

    <!-- Create Admin Modal -->
    <div class="modal fade @if ($errors->any()) show @endif" id="kt_modal_new_ticket" tabindex="-1"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>

                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_new_ticket_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                        action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Create Admin</h1>
                        </div>

                        <!-- Full Name Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Full Name</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid @error('fullName') is-invalid @enderror"
                                placeholder="Enter full name" name="fullName" value="{{ old('fullName') }}" required>
                            @error('fullName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Email</span>
                            </label>
                            <input type="email"
                                class="form-control form-control-solid @error('email') is-invalid @enderror"
                                placeholder="Enter admin email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Password</span>
                            </label>
                            <input type="password"
                                class="form-control form-control-solid @error('password') is-invalid @enderror"
                                placeholder="Enter password (min 8 characters)" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Birth Date Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Birth Date</span>
                            </label>
                            <input type="date"
                                class="form-control form-control-solid @error('birthDate') is-invalid @enderror"
                                name="birthDate" value="{{ old('birthDate') }}" required>
                            @error('birthDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="optional">Phone</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                placeholder="00 111 222 333 444" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_ticket_cancel" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="kt_modal_new_ticket_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
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

@endsection

@section('scripts')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#kt_modal_new_ticket').modal('show');
            });
        </script>
    @endif

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
    </script>
@endsection
