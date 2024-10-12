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
    </script>
@endsection
