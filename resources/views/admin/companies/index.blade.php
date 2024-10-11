<!-- resources/views/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Companies')
@section('page_title', 'Companies')
@section('breadcrumb', 'Companies')

@section('action')
    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_ticket"
        class="btn btn-primary fw-bold fs-8 fs-lg-base">Create</a>
@endsection

@section('content')
    <meta name="companies-data-url" content="{{ route('admin.companies.index') }}">

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
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Address</th>
                                    <th class="min-w-125px">Phone</th>
                                    <th class="min-w-125px">Number of Employees</th>
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
                        action="{{ route('admin.companies.store') }}" method="POST">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Create Company</h1>
                        </div>

                        <!-- Name Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Name</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                placeholder="Enter the company name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Address</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid @error('address') is-invalid @enderror"
                                placeholder="Enter the company address" name="address" value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Phone</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                placeholder="00 111 222 333 444" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Description</label>
                            <textarea class="form-control form-control-solid @error('description') is-invalid @enderror" rows="4"
                                name="description" placeholder="Type your company description">{{ old('description') }}</textarea>
                            @error('description')
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

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
        };
    </script>
@endsection
