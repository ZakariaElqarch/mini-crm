@extends('layouts.admin')

@section('title', 'History')
@section('page_title', 'History')
@section('breadcrumb', 'History')

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">

                <div class="card-body">
                    <div class="tab-content">
                        <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel"
                            aria-labelledby="kt_activity_today_tab">
                            <div class="timeline timeline-border-dashed">
                                @foreach ($historyLogs as $log)
                                    <div class="timeline-item">
                                        <div class="timeline-line"></div>
                                        <div class="timeline-icon">
                                            <i class="ki-duotone ki-time fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="timeline-content mb-10 mt-n1">
                                            <div class="pe-3 mb-5">
                                                <!-- Display the action description -->
                                                <div class="fs-5 fw-semibold mb-2">{{ $log->description }}</div>

                                                <!-- Display the creation time -->
                                                <div class="d-flex align-items-center mt-1 fs-6">
                                                    <div class="text-muted me-2 fs-7">At
                                                        {{ $log->created_at->format('h:i A') }} on
                                                        {{ $log->created_at->format('M d, Y') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if ($historyLogs->isEmpty())
                                    <div class="text-center">
                                        <p class="text-muted">No history logs found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
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
