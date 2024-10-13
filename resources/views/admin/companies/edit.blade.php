@extends('layouts.dashboard')

@section('title', 'Edit Company')

@section('page_title', 'Edit Company')

@section('breadcrumb', 'Edit Company')

@section('content')
    <meta name="companies-data-url" content="{{ route('admin.companies.index') }}">

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card pt-10">
                <div class="modal-content rounded">
                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <form id="kt_modal_edit_ticket_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ route('admin.companies.update', $company) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updating -->

                            <div class="mb-4">
                                <h4 class="fw-bold">Edit Company Details</h4>
                            </div>

                            <!-- Name Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2 required">Name</label>
                                <input type="text"
                                    class="form-control form-control-solid @error('name') is-invalid @enderror"
                                    placeholder="Enter the company name" name="name"
                                    value="{{ old('name', $company->name) }}">
                                @error('name')
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
                                    placeholder="Enter company email" name="email" value="{{ old('name', $company->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Address Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2 required">Address</label>
                                <input type="text"
                                    class="form-control form-control-solid @error('address') is-invalid @enderror"
                                    placeholder="Enter the company address" name="address"
                                    value="{{ old('address', $company->address) }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2 required">Phone</label>
                                <input type="text"
                                    class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                    placeholder="00 111 222 333 444" name="phone"
                                    value="{{ old('phone', $company->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Description</label>
                                <textarea class="form-control form-control-solid @error('description') is-invalid @enderror" rows="4"
                                    name="description" placeholder="Type your company description">{{ old('description', $company->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="text-end">
                                <button type="submit" id="kt_modal_edit_ticket_submit" class="btn btn-primary">
                                    <span class="indicator-label">Update</span>
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
