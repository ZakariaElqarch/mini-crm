$(document).ready(() => {
    // Retrieve the URL for fetching company data from a meta tag
    const companiesDataUrl = $('meta[name="companies-data-url"]').attr('content');

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
                url: companiesDataUrl,
                type: 'GET',
                data: (d) => {
                    d.search_name = $('input[data-kt-ecommerce-order-filter="search"]').val();
                },
                error: (xhr, error, thrown) => {
                    console.error('Error fetching data:', error, thrown);
                    toastr.error('Failed to load company data. Please try again.');
                }
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { data: 'employees_count', name: 'employees_count' },
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
        $('input[data-kt-ecommerce-order-filter="search"]').on('keyup', () => {
            table.draw();
        });
    };

    // Execute the initialization functions
    const companiesTable = initializeDataTable();
    setupSearchListener(companiesTable);
});
