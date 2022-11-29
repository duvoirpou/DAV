$(document).ready(function() {

    var dataTable = $('#tabCct').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "afficher_consulter_cah_texte.php",
            type: "POST"
        }
    });

});