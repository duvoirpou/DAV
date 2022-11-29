$(document).ready(function() {

    $('#btnClass').click(function() {

        $('#form_classe')[0].reset();
        $('.modal-title').text('Créer une classe');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');

    });

    var dataTable = $('#tabPaie').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_paie_fr_scol.php",
            type: "POST"
        }

    });


    $(document).on('click', '.paie', function() {
        $('#message').html('');
        var matricule = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_paie_fr_scol.php",
            method: "POST",
            data: { matricule: matricule, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#modalPaie').modal('show');
                $('.modal-title').text('paiement des frais');
                $('#matricule').val(data.matricule);
                $('#noms').val(data.noms);
                $('#prenoms').val(data.prenoms);
                $('#action').val("Ajouter");
                $('#operation').val("ajouter");
            }
        });

    });


    $(document).on('submit', '#form', function(e) {
        e.preventDefault();
        var libelle = $('#libelle').val();
        var mt_chiffre = $('#mt_chiffre').val();
        var mt_lettre = $('#mt_lettre').val();

        if (libelle != '' && mt_chiffre != '' && mt_lettre != '') {

            var donnee = $(this).serialize();
            $.ajax({
                url: "action_paie_fr_scol.php",
                method: "POST",
                data: donnee,
                success: function(data) {
                    $('#form')[0].reset();
                    $('#message').html(data);
                    dataTable.ajax.reload();

                }
            });

        } else {
            $('#message').html('<h5 class="text-danger">Remplissez tous les champs</h5>');
        }

    });

});