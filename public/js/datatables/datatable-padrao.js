$(function () {

    var columns = Array();

    $('#columns').val().split(",").forEach(function (valor, chave) {
        if (valor == 'action') {
            columns.push({ data: valor, orderable: false, searchable: false });
        } else {
            columns.push({ data: valor });
        }
    });

    let table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#baseurldatatable").val(),
        columns: columns,
        columnDefs: [{
            "defaultContent": "--------",
            "targets": "_all"
        }],
        order: [[1, 'asc']],
    });
});
