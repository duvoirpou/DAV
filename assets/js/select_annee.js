jQuery(document).on('submit', '#annee', function(event) {
    event.preventDefault();

    var annee_scolaire = $('#annee_scolaire').val();

    if(annee_scolaire != '' ) {
        jQuery.ajax({
            url: 'action_select_annee.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function () {
                $('.info').val("validation....");
            }

        })
            .done(function (requet) {

                console.log(requet);

                if (!requet.error) {
                    window.location = 'accueil.php?p=home';
                    // location.href = 'Main/';

                } else {

                    $('#erreur_annee').slideDown('slow');
                    setTimeout(function () {
                        $('#erreur_annee').slideUp('slow');
                    }, 3000);

                    $('.info').val("validation....");

                }

            })

            .fail(function (reponse) {

                console.log(reponse.reponseText);

            })

            .always(function () {

                console.log("complete");

            })

    }
    else
    {
        $('#erreur_champ').slideDown('slow');
        setTimeout(function () {
            $('#erreur_champ').slideUp('slow');
        }, 3000);
    }

});