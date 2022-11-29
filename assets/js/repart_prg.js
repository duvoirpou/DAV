var dataTable = $('#repartPrg').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: "afficher_repartition.php",
        type: "POST"
    }
});