function selectNiveau() {
    var id_niv = document.getElementById("id_niv").value;
    var choix = 'choix';
    $.ajax({
        url: "affiche_bulletin.php",
        type: "POST",
        dataType: "JSON",
        data: {
            id_niv: id_niv,
            choix: choix
        },
        success: function (data) {

            $('#contenu').html(data);

        }
    });
}