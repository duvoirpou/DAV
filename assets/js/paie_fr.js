$(document).ready(function () {

    etatPaiement();

    function etatPaiement() {

        $.ajax({
            url: "info_paiement.php",
            type: "POST",
            dataType: "json",
            success: function (data) {
                $('#info_eleve').html(data);

            }
        });
    }


    $(document).on('submit', '#form_paie', function (event) {
        event.preventDefault();

        var montant = $('#montant').val();

        if ( montant != '') {


            $.ajax({
                url: "action_paiement_caisse.php",
                method: "POST",
                data: new FormData(this),
                dataType :'JSON',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#info_recu').html(data.bouton);
                    $('#message').html(data.message);
                    $('#form_paie')[0].reset();
                    etatPaiement();

                }
            });
        } else {
            $('#message').html('<h5 class="text-danger">Remplissez tous les champs</h5>');
        }

    });


    $(document).on('submit', '#form_periode', function (event) {
        event.preventDefault();

        var montant = $('#montant_periode').val();
        var periode = $('#periode').val();

        if ( montant != '' && periode != '') {


            $.ajax({
                url: "action_paiement_caisse2.php",
                method: "POST",
                data: new FormData(this),
                dataType :'JSON',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#info_recu').html(data.bouton);
                    $('#message_periode').html(data.message);
                    etatPaiement();

                }
            });
        } else {
            $('#message_periode').html('<h5 class="text-danger">Remplissez tous les champs</h5>');
        }

    });


    $(document).on('submit', '#form_acompte', function (event) {
        event.preventDefault();

        var montant = $('#montant_acompte').val();

        if ( montant != '') {


            $.ajax({
                url: "action_paiement_caisse3.php",
                method: "POST",
                data: new FormData(this),
                dataType :'JSON',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#info_recu').html(data.bouton);
                    $('#message_acompte').html(data.message);
                    $('#form_paie')[0].reset();
                    etatPaiement();

                }
            });
        } else {
            $('#message_acompte').html('<h5 class="text-danger">Remplissez tous les champs</h5>');
        }

    });



    $(document).on('click', '.normal', function () {

        $('#message').html('');
        $('#form_paie')[0].reset();

        var matricule = $(this).attr("id");

        $.ajax({
            url: "selection_paie.php",
            method: "POST",
            data: { matricule: matricule},
            dataType: "json",
            success: function (data) {

                $('#modalNormal').modal('show');
                $('.modal-title').text('Paiement des Frais (Normal)');
                $('#matricule').val(data.matricule);
                $('#eleve').val(data.noms+' '+data.prenoms);
                $('#classe').val(data.lib_classe);
                $('#id_classe').val(data.id_classe);
                $('#id_freq').val(data.id_freq);

            }
        });

    });



    $(document).on('click', '.periode', function () {

        $('#message_periode').html('');
        $('#form_periode')[0].reset();

        var matricule = $(this).attr("id");

        $.ajax({
            url: "selection_paie.php",
            method: "POST",
            data: { matricule: matricule},
            dataType: "json",
            success: function (data) {

                $('#modalPeriode').modal('show');
                $('.modal-title').text('Paiement des Frais (par periode)');
                $('#matricule_periode').val(data.matricule);
                $('#eleve_periode').val(data.noms+' '+data.prenoms);
                $('#classe_periode').val(data.lib_classe);
                $('#id_classe_periode').val(data.id_classe);
                $('#id_freq_periode').val(data.id_freq);

            }
        });

    });


    $(document).on('click', '.acompte_juin', function () {

        $('#message_acompte').html('');
        $('#form_acompte')[0].reset();

        var matricule = $(this).attr("id");

        $.ajax({
            url: "selection_paie.php",
            method: "POST",
            data: { matricule: matricule},
            dataType: "json",
            success: function (data) {

                $('#modalAcompte').modal('show');
                $('.modal-title').text('Paiement des Frais (avec acompte juin)');
                $('#matricule_acompte').val(data.matricule);
                $('#eleve_acompte').val(data.noms+' '+data.prenoms);
                $('#classe_acompte').val(data.lib_classe);
                $('#id_classe_acompte').val(data.id_classe);
                $('#id_freq_acompte').val(data.id_freq);

            }
        });

    });


});