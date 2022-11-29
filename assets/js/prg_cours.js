var dataTable = $('#prg_cours').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: "afficher_prg_cours.php",
        type: "POST"
    }
});