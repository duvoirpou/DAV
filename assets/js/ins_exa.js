$(document).ready(function() {

    $('#creer').click(function() {

        $('#ins_exa_form')[0].reset();
        $('.modal-title').text('Créer un examen d Etat');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');


    });

    var dataTable = $('#tInsExa').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "list_ins_exa.php",
            method: "POST"
        }
    });


    $(document).on('submit', '#ins_exa_form', function(event) {
        event.preventDefault();

        var matricule = $('#matricule').val();
        var id_classe = $('#id_classe').val();
        var id_classe = $('#id_examen').val();
        var annee_scolaire = $('#annee_scolaire').val();


        if (matricule != '' && id_classe != '') {
            $.ajax({
                url: "action_ins_exa.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#message').html(data);
                    $('#ins_exa_form')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        } else {
            $('#message').html('<h6 class="text-danger">Remplissez tous les champs</h6>');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var examen_detat_id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_ins_exa.php",
            method: "POST",
            data: { examen_detat_id: examen_detat_id, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#matModal').modal('show');
                $('.modal-title').text('Editer un examen d état');
                $('#examen_detat_id').val(data.id);
                $('#matricule').val(data.matricule);
                $('#id_classe').val(data.id_classe);
                $('#id_examen').val(data.id_examen);
                $('#annee_scolaire').val(data.annee_scolaire);
                $('#action').val("Modifier");
                $('#operation').val("modifier");

            }
        });

    });

    $(document).on('click', '.suppr', function() {
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('#supprModal').modal('show');

    });

    $(document).on('submit', '#confirm', function(e) {
        e.preventDefault();
        $.ajax({
            url: "action_ins_exa.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});