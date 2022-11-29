$(document).ready(function() {
    affiche_sit();

    function affiche_sit() {
        $.ajax({
            url: "situation_paiement_eleve.php",
            type: "POST",
            dataType: "json",
            success: function(liste) {

                $('#status').html(liste);

            }
        });

    }

    $(document).on('submit', '#reinscription', function(e) {
        e.preventDefault();
        var montant = $('#montant').val();
        var total = $('#total').val();

        if (montant != '') {

            $('#msg').html('');

            $('#montant').css('border-color', '');
            var donnee = $(this).serialize();
            $.ajax({
                url: "action_reinscription3.php",
                method: "POST",
                data: donnee,
                dataType: "JSON",
                success: function(reponse) {
                    $('#info').hide();
                    $('#termine').show();
                    $('#valider').html(reponse.succes);
                    affiche_sit();
                    if (reponse.num != undefined) {
                        $('#imprimer').html('<a target="_blank" href="imprimer_recu_insc.php?recu=' + reponse.num + '" class="btn btn-success btn-sm"><i class="fa fa-print"></i> imprimer le reçu</a>');

                        $('#new').html(reponse.new);
                    }

                     $('#new').html(reponse.new);
                      $('#imprimer').html('<a target="_blank" href="imprimer_recu_insc.php?recu=' + reponse.num + '" class="btn btn-success btn-sm"><i class="fa fa-print"></i> imprimer le reçu</a>');

                }
            });

        } else {
            $('#msg').html('<h6 class="text-danger">Remplissez le champs montant payé</h6>');
            $('#montant').css('border-color', 'red');
        }




    })
});