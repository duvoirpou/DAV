$(document).ready(function() {

    $('#tabSujets').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "afficher_depot_sujet.php",
            type: "POST"
        }
    });
});