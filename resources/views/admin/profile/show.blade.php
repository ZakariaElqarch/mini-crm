@extends('layouts.dashboard')

@section('title', 'Profile')

@section('page_title', 'Profile')

@section('breadcrumb', 'Detail Profile')

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-body pt-15">
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
                    <div class="badge badge-light-success d-inline">Admin</div>

                    <!--end::Email-->
                </div>
                <!--end::Summary-->
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold">Details</div>
                    <!--begin::Badge-->
                    <a href="{{ route('admin.profile.edit') }}"
                        class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2">Edit</a>
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
                    <div class="text-gray-600">{{ $admin->birthDate ?? 'Not provided' }}</div>
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
