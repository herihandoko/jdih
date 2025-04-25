$(document).ready(function() {
    var table = $('#dataTable').DataTable({
        fixedHeader: true,
        fixedColumns: true,
        paging: true,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 500,
        responsive: true,
        orderCellsTop: true, // Ensure that the order cells are placed at the top
    });

    // Custom filtering function which will search data in column based on input
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var filters = $('.column-filter');
            var isValid = true;

            filters.each(function() {
                var columnIndex = $(this).data('column');
                var filterValue = $(this).val().toLowerCase();
                var columnData = data[columnIndex].toLowerCase();

                if (filterValue && columnData.indexOf(filterValue) === -1) {
                    isValid = false;
                    return false; // break the each loop
                }
            });

            return isValid;
        }
    );

    // Apply the search
    $('.column-filter').on('keyup change', function() {
        table.draw();
    });
});