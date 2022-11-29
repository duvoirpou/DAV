$(document).ready(function() {

    var dataTable = $('#stock').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "afficher_stock.php",
            type: "post"
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]

    });

    $(document).on('click', '.md', function() {
        var id_prod = $(this).attr('id');

        $('#modalMd').modal('show');

    });



});