$(document).ready(function() {
    $("#datatable").DataTable();

    var a = $("#datatable-buttons").DataTable({ lengthChange: !1, buttons: ["copy", "excel", "pdf"] });
    $("#key-table").DataTable({ keys: !0 }), $("#responsive-datatable").DataTable(), $("#selection-datatable").DataTable({ select: { style: "multi" } }), a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $('.dt-custome').DataTable({
        "paging": true,
        "ordering": false,
        "info": false,
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ]
    });
    $('.dt-custome2').DataTable({
        "paging": true,
        "ordering": false,
        "info": false,
        lengthMenu: [
            [20, 50, 100, -1],
            [20, 50, 100, "All"]
        ],
        responsive: true
    });
});