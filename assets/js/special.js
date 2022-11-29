$(document).ready(function () {

    var dataTable = $('#tProduit').DataTable({
        "processing" : true,
        "serverSide" : true,
        "ajax" : {
            url : "affiche_produit_vente.php",
            type : "post"
        }

    });

});