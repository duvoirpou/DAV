$(document).ready(function() {

    var dataTable = $('#produits').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "affiche_produit.php",
            type: "post"
        },
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print', 'pageLength'
        ]

    });

    /*$('#user_dialog').dialog({
        autoOpen: false,
        width: 400
    });*/

    $('#add').click(function() {
        $('#Modal').modal('show');
        //$('#user_dialog').attr('title', 'Ajout produit');
        $('#action').val('insert');
        $('#form_action').val('ajouter');
        $('#user_form')[0].reset();
        $('#form_action').attr('disabled', false);
        //$('#user_dialog').dialog('open');
    });

    $('#user_form').on('submit', function(event) {
        event.preventDefault();
        var erreur_produit = '';
        var erreur_cat = '';
        var erreur_prix = '';

        if ($('#desc').val() == '') {
            erreur_produit = 'le nom du produit requis';
            $('#erreur_produit').text(erreur_produit);
            $('#desc').css('border-color', '#cc0000');
        } else {
            erreur_produit = '';
            $('#erreur_produit').text(erreur_produit);
            $('#desc').css('border-color', '');
        }

        if ($('#id_cat').val() == '') {
            erreur_cat = 'selectionnez la catégorie';
            $('#erreur_cat').text(erreur_cat);
            $('#id_cat').css('border-color', '#cc0000');
        } else {
            erreur_cat = '';
            $('#erreur_cat').text(erreur_cat);
            $('#id_cat').css('border-color', '');
        }

        if ($('#prix').val() == '') {
            erreur_prix = 'le prix du produit requis';
            $('#erreur_prix').text(erreur_prix);
            $('#prix').css('border-color', '#cc0000');
        } else {
            erreur_prix = '';
            $('#erreur_prix').text(erreur_prix);
            $('#prix').css('border-color', '');
        }

        if (erreur_produit == '' && erreur_cat == '' && erreur_prix == '') {

            // $('#form_action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({

                url: "action_produit.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    dataTable.ajax.reload();
                    $('#action_alert').append('<div class="text-success">' + data + '</div>');

                    $('#user_form')[0].reset();

                    setTimeout(function() {
                        $('#action_alert').empty();
                    }, 5000);
                }
            });
        }
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        var action = 'afficher';
        $.ajax({
            url: "action_produit.php",
            method: "POST",
            data: { id: id, action: action },
            dataType: "JSON",
            success: function(reponse) {
                $('#Modal').modal('show');
                $('#desc').val(reponse.desc);
                $('#id_cat').val(reponse.id_cat);
                $('#prix').val(reponse.prix);
                $('#user_dialog').attr('title', 'Modif produit');
                $('#action').val('modifier');
                $('#hidden_id').val(id);
                $('#form_action').val('Modifier');
                // $('#user_dialog').modal('show');

            }
        });
    });


});