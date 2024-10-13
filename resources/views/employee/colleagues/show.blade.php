@extends('layouts.dashboard')

@section('title', 'Colleague')

@section('page_title', 'Colleague')

@section('breadcrumb', 'Detail Colleague')

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
                    <div class="fs-3 text-gray-800  fw-bold mb-1">{{ $employee->fullName }}</div>
                    <!--end::Name-->
                    <!--begin::Email-->
                    <div class="fs-5 fw-semibold text-muted  mb-6">{{ $employee->email }}</div>
                    <!--end::Email-->
                </div>
                <!--end::Summary-->
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold">Details</div>
                    <!--begin::Badge-->
                    <div class="badge badge-light-success d-inline">Employee</div>
                    <!--begin::Badge-->
                </div>
                <!--end::Details toggle-->
                <div class="separator separator-dashed my-3"></div>
                <!--begin::Details content-->
                <div class="pb-5 fs-6">
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Account ID</div>
                    <div class="text-gray-600">ID-{{ $employee->id }}</div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Email</div>
                    <div class="text-gray-600">
                        <div class="text-gray-600">{{ $employee->email }}</div>
                    </div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Birth Date</div>
                    <div class="text-gray-600">{{ $employee->birthDate ?? 'Not provided' }}</div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Phone</div>
                    <div class="text-gray-600">{{ $employee->phone ?? 'Not provided' }}</div>
                    <!--end::Details item-->
                </div>
                <!--end::Details content-->
            </div>

            <div class="card card-body pt-8 mt-15">
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold">Company</div>
                </div>
                <!--end::Details toggle-->
                <div class="separator separator-dashed my-3"></div>
                <!--begin::Details content-->
                <div class="pb-5 fs-6">
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Company ID</div>
                    <div class="text-gray-600">ID-{{ $company->id }}</div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Company Name</div>
                    <div class="text-gray-600">{{ $company->name }}</div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Company Email</div>
                    <div class="text-gray-600">
                        <div class="text-gray-600">{{ $company->email }}</div>
                    </div>
                    <!--end::Details item-->
                    <!--begin::Details item-->
                    <div class="fw-bold mt-5">Company Phone</div>
                    <div class="text-gray-600">{{ $company->phone ?? 'Not provided' }}</div>
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
