jQuery(document).on('submit', '#login', function(event) {
    event.preventDefault();

    var matricule = $('#matricule').val();
    var password = $('#password').val();

    if(matricule != '' && password != '') {
        jQuery.ajax({
            url: 'verif.php',
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
                    window.location = 'select_annee.php';
                    // location.href = 'Main/';

                } else {

                    $('#erreur_login').slideDown('slow');
                    setTimeout(function () {
                        $('#erreur_login').slideUp('slow');
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