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
    <meta name="companies-data-url" content="{{ route('admins.index') }}">

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-ecommerce-order-filter="search"
                                class="form-control form-control-solid w-200px ps-12" placeholder="Search">
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div id="kt_customers_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable w-100"
                            id="kt_companies_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">email</th>
                                    <th class="min-w-125px">fullName</th>
                                    <th class="min-w-125px">birthdate</th>
                                    <th class="min-w-125px">phone</th>
                                    <th class="min-w-125px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <!-- Dynamic rows will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Admin Modal -->
    <div class="modal fade @if ($errors->any()) show @endif" id="kt_modal_new_ticket" tabindex="-1"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal"
                        onclick="clearErrors()">
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
                                placeholder="Enter full name" name="fullName" value="{{ old('fullName') }}">
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
                                placeholder="Enter admin email" name="email" value="{{ old('email') }}">
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
                                placeholder="Enter password (min 8 characters)" name="password">
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
                                name="birthDate" value="{{ old('birthDate') }}">
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

    <script src="{{ asset('assets/js/custom/apps/support-center/tickets/create.js') }}"></script>
    <script src="{{ asset('assets/js/admins.js') }}"></script>

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
