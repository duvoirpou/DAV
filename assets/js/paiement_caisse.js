$(document).ready(function () {

     var dataTable = $('#table_el_paie').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "recherche_eleve_paie.php",
            type: "POST"
        }
    });

});