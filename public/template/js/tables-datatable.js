$(function () {
    var dataTable = $('#datatable1').DataTable({
        responsive: {
            details: false
        }
    }
    );

    $(document).on('sidebarChanged', function () {
        dataTable.columns.adjust();
        dataTable.responsive.recalc();
        dataTable.responsive.rebuild();
    });

});

