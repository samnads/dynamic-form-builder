$(document).ready(function () {
    $('#formTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#formTable').attr('url'),
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'url', name: 'url' }
        ]
    });
});