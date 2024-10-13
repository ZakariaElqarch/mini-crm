<!-- resources/views/dashboard.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Colleagues')
@section('page_title', 'Colleagues')
@section('breadcrumb', 'Colleagues')



@section('content')
    <meta name="colleagues-data-url" content="{{ route('employee.colleagues.index') }}">

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
                            <input type="text" id="employee-search" data-kt-employee-order-filter="search"
                                class="form-control form-control-solid w-200px ps-12" placeholder="Search by name">
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                    <div id="kt_colleagues_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable w-100"
                            id="kt_colleagues_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Full Name</th>
                                    <th class="min-w-125px">Email</th>
                                    <th class="min-w-125px">Company</th>
                                    <th class="min-w-125px">Verified</th>
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

 
@endsection

@section('scripts')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#kt_modal_new_employee').modal('show');
            });
        </script>
    @endif

    <script src="{{ asset('assets/js/custom/apps/support-center/tickets/create.js') }}"></script>
    <script src="{{ asset('assets/js/colleagues.js') }}"></script> <!-- Make sure you have this file for employee related JS -->

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
