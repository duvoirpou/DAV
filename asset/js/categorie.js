$(document).ready(function() {

    var dataTable = $('#categ').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "affiche_categorie.php",
            type: "post"
        }

    });

    /*$('#cat_dialog').dialog({
        autoOpen: false,
        width: 400
    });*/

    $('#ajouter').click(function() {
        $('#Modal').modal('show');
        //$('#cat_dialog').attr('title', 'Ajout categorie');
        $('#action').val('insert');
        $('#form_action').val('ajouter');
        $('#cat_form')[0].reset();
        $('#form_action').attr('disabled', false);
        //$('#cat_dialog').dialog('open');
    });

    $('#cat_form').on('submit', function(event) {
        event.preventDefault();
        var erreur_cat = '';


        if ($('#nom').val() == '') {
            erreur_cat = 'le nom de la categorie requis';
            $('#erreur_cat').text(erreur_cat);
            $('#nom').css('border-color', '#cc0000');
        } else {
            erreur_cat = '';
            $('#erreur_cat').text(erreur_cat);
            $('#nom').css('border-color', '');
        }


        if (erreur_cat == '') {

            $('#form_action').attr('disebled', 'disebled');
            var form_data = $(this).serialize();
            $.ajax({

                url: "action_cat.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    dataTable.ajax.reload();
                    $('#action_alert').append('<div class="text-success">' + data + '</div>');

                    $('#cat_form')[0].reset();

                    setTimeout(function() {
                        $('#action_alert').empty();
                    }, 5000);

                }
            });
        }
    });



    /*$(document).on('click', '.edit', function() {
        var id = $(this).attr('id');

        var action = 'afficher';
        $.ajax({
            url: "action_cat.php",
            method: "POST",
            data: { id: id, action: action },
            dataType: "JSON",
            success: function(reponse) {
                $('#nom').val(reponse.nom);
                $('#cat_dialog').attr('title', 'Modif categorie');
                $('#action').val('modifier');
                $('#hidden_id').val(id);
                $('#form_action').val('Modifier');
                $('#cat_dialog').dialog('open');

            }
        });
    });*/


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var id = $(this).attr("id");
        var action = 'afficher';
        $.ajax({
            url: "action_cat.php",
            method: "POST",
            data: {
                id: id,
                action: action
            },
            dataType: "JSON",
            success: function(data) {
                $('#Modal').modal('show');
                $('.modal-title').text('Editer');
                $('#nom').val(data.nom);
                $('#id_cat').val(data.id_cat);

                $('#operation').val('Modifier');
                $('#action').val('modifier');
            }
        });

    });


});