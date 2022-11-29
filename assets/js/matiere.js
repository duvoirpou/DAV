$(document).ready(function() {

    $('#creer').click(function() {

        $('#user_form')[0].reset();
        $('.modal-title').text('Créer une matière');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#image').html('');
        $('#message').html('');
    });

    var dataTable = $('#tContact').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "list_mat.php",
            type: "POST"
        }
    });


    $(document).on('submit', '#user_form', function(event) {
        event.preventDefault();

        var libelle = $('#libelle').val();
        var abr = $('#abr').val();
        var coef = $('#coef').val();
        var id_cy = $('#id_cy').val();
        var id_niv = $('#id_niv').val();


        if (libelle != '' && abr != '' && id_cy != '' && coef != '' && id_niv != '') {
            $.ajax({
                url: "action_matiere.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#message').html(data);
                    $('#user_form')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        } else {
            $('#message').html('<h6 class="text-danger">Remplissez tous les champs</h6>');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var matiere_id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_matiere.php",
            method: "POST",
            data: { matiere_id: matiere_id, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#matModal').modal('show');
                $('.modal-title').text('Editer une matiere');
                $('#matiere_id').val(data.id);
                $('#libelle').val(data.libelle);
                $('#abr').val(data.abr);
                $('#coef').val(data.coef);
                $('#id_cy').val(data.id_cy);
                $('#id_niv').val(data.id_niv);
                $('#action').val("Modifier");
                $('#operation').val("modifier");

            }
        });

    });

    $(document).on('click', '.suppr', function() {
        $('#user_form')[0].reset();
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('#supprModal').modal('show');

    });

    $(document).on('submit', '#confirm', function(e) {
        e.preventDefault();
        $.ajax({
            url: "action_matiere.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {

                $('#alert_msg').html('');
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});