$(document).ready(function () {

    $('#resultat').html('');

    $('#mot').keyup(function () {
        var recherche = $(this).val();
        var data = 'motclef=' + recherche;

        if (recherche.length > 0) {

            $.ajax({
                type: 'POST',
                url: 'recherche_el.php',
                data: data,
                success: function (reponse) {

                    $('#resultat').html(reponse);

                }
            });

        }
    });
   

});