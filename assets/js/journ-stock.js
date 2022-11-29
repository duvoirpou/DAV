$(document).ready(function(){

    var dataTable = $('#stock').DataTable({
        "processing" : true,
        "serverSide" : true,
        "ajax" : {
            url : "afficher_stock.php",
            type : "post"
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]

    });

});