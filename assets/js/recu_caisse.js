$(document).ready(function() {

    var dataTable = $('#tabRecuCaisse').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_recu_caisse.php",
            type: "POST"
        }

    });


});