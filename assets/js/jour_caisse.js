function selectMois() {
    var mois = document.getElementById("mois").value;
    var operation = 'mois';
    $.ajax({
        url: "afficher_journ_caisse.php",
        type: "POST",
        dataType: "JSON",
        data: { donnee: mois, action: operation },
        success: function(data) {

            $('#content').html(data);

        }
    });
}

function selectDate() {
    var date_jc = document.getElementById("date_jc").value;
    var operation = 'date_jc';
    $.ajax({
        url: "afficher_journ_caisse.php",
        type: "POST",
        dataType: "JSON",
        data: { donnee: date_jc, action: operation },
        success: function(data) {

            $('#content').html(data);

        }
    });
}


function imprime(el) {
    var restorepage=document.body.innerHTML;
    var printcontent=document.getElementById(el).innerHTML;
    document.body.innerHTML=printcontent;
    window.print();
    document.body.innerHTML=restorepage;

}

$(document).ready(function() {

    afficher_journ_caisse();


    function afficher_journ_caisse() {

        $.ajax({
            url: "afficher_journ_caisse.php",
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#content').html(data);
            }
        });

    }





});