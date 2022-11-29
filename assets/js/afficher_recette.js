function selectDate() {
    var date_rec = document.getElementById("date_rec").value;

    $.ajax({
        url: "action_afficher_recette_date.php",
        type: "POST",
        dataType: "JSON",
        data: {
            date_rec: date_rec
        },
        success: function (data) {

            $('#content').html(data);

        }
    });
}



function selectMois() {
    var mois_rec = document.getElementById("mois_rec").value;

    $.ajax({
        url: "afficher_recette_mois.php",
        type: "POST",
        dataType: "JSON",
        data: {
            mois_rec: mois_rec
        },
        success: function (data) {

            $('#content').html(data);

        }
    });
}

