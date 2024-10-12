$(document).ready(() => {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };
    
    // Retrieve the URL for fetching Employee data from a meta tag
    const employeeDataUrl = $('meta[name="employees-data-url"]').attr('content');

    // Initialize DataTable with server-side processing
    const initializeDataTable = () => {
        return $('#kt_employees_table').DataTable({
            processing: false,
            serverSide: true,
            info: false,
            pageLength: 10,
            lengthChange: true,
            searching: true, // Enable searching
            ajax: {
                url: employeeDataUrl,
                type: 'GET',
                data: (d) => {
                    d.search_name = $('input[data-kt-employee-order-filter="search"]').val(); // Send search name
                },
                error: (xhr, error, thrown) => {
                    console.error('Error fetching data:', error, thrown);
                    toastr.error('Failed to load employee data. Please try again.');
                }
            },
            columns: [
                { data: 'fullName', name: 'fullName' },
                { data: 'email', name: 'email' },
                { data: 'company_name', name: 'company_name' }, // Company name
                { data: 'invitation_status', name: 'invitation_status' }, // Invitation status
                { data: 'verified', name: 'verified' }, // Verified status
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            drawCallback: () => {
                // Reinitialize the dropdown menu trigger after each table redraw
                KTMenu.createInstances();
            }
        });
    };

    // Add event listener for the search input
    const setupSearchListener = (table) => {
        $('input[data-kt-employee-order-filter="search"]').on('keyup', () => {
            table.draw();
        });
    };

    // Execute the initialization functions
    const employeesTable = initializeDataTable();
    setupSearchListener(employeesTable);

    function clearErrors() {
        // Clear form fields
        $('#kt_modal_new_employee_form')[0].reset();

        // Remove error classes and messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    }

    // Clear errors when modal is closed
    $('#kt_modal_new_ticket').on('hidden.bs.modal', function () {
        clearErrors();
    });
});
