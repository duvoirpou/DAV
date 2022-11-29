function selectClasse() {
    var id_classe = document.getElementById("id_classe").value;
    var operation = 'classe';
    $.ajax({
        url: "action_liste_eleve_classe.php",
        type: "POST",
        dataType: "JSON",
        data: { id_classe: id_classe, action: operation },
        success: function(data) {

            $('#content').html(data);

        }
    });
}
