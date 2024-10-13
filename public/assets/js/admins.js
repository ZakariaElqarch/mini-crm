$(document).ready(() => {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };

    // Retrieve the URL for fetching admin data from a meta tag
    const adminsDataUrl = $('meta[name="companies-data-url"]').attr('content');

    // Initialize DataTable with server-side processing
    const initializeDataTable = () => {
        return $('#kt_companies_table').DataTable({
            processing: false,
            serverSide: true,
            info: false,
            pageLength: 10,
            lengthChange: true,
            searching: true,
            ajax: {
                url: adminsDataUrl,
                type: 'GET',
                data: (d) => {
                    d.search_name = $('input[data-kt-ecommerce-order-filter="search"]').val();
                },
                error: (xhr, error, thrown) => {
                    console.error('Error fetching data:', error, thrown);
                    toastr.error('Failed to load admin data. Please try again.');
                }
            },
            columns: [
                { data: 'email', name: 'email' },
                { data: 'fullName', name: 'fullName' },
                { data: 'birthDate', name: 'birthDate' },
                { data: 'phone', name: 'phone' },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
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
        $('input[data-kt-ecommerce-order-filter="search"]').on('keyup', function () {
            table.search(this.value).draw();
        });
    };

    // Execute the initialization functions
    const adminsTable = initializeDataTable();
    setupSearchListener(adminsTable);



    function clearErrors() {
        // Clear form fields
        $('#kt_modal_new_ticket_form')[0].reset();

        // Remove error classes and messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    }

    // Clear errors when modal is closed
    $('#kt_modal_new_ticket').on('hidden.bs.modal', function () {
        clearErrors();
        location.reload();
    });
});