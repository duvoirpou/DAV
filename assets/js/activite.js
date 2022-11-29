$(document).ready(function() {

    $('#btnAct').click(function() {

        $('#form_act')[0].reset();
        $('.modal-title').text('Créer une activité');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');


    });

    var dataTable = $('#activite').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "list_act.php",
            method: "POST"
        }
    });

    $(document).on('submit', '#form_act', function(event) {
        event.preventDefault();

        var annee_scolaire = $('#annee_sco').val();
        var libelle_act = $('#libelle_act').val();
        var date_act = $('#date_act').val();
        var lieu_act = $('#lieu_act').val();
        var horaire_act = $('#horaire_act').val();
        var acteur_act = $('#acteur_act').val();
        var obs = $('#obs').val();

        if (annee_scolaire != '' && libelle_act != '' && date_act != '' && lieu_act != '' && horaire_act != '' && acteur_act != '' && obs != '') {

            var donnee = $(this).serialize();
            console.log(donnee);
            $.ajax({
                url: "action_act.php",
                method: "POST",
                data: donnee,
                success: function(data) {

                    $('#message').html(data);
                    $('#form_act')[0].reset();
                    dataTable.ajax.reload();
                }
            });
        } else {
            $('#message').html('<h6 class="text-danger">remplissez touts les champs</h6>');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_act.php",
            method: "POST",
            data: { id: id, operation: operation },
            dataType: "JSON",
            success: function(data) {
                $('#ModalAct').modal('show');
                $('#id_act').val(data.id_act);
                $('#annee_sco').val(data.annee_sco);
                $('#libelle_act').val(data.libelle_act);
                $('#date_act').val(data.date_act);
                $('#lieu_act').val(data.lieu_act);
                $('#horaire_act').val(data.horaire_act);
                $('#acteur_act').val(data.acteur_act);
                $('#obs').val(data.obs);
                $('.modal-title').text('Modifier une activité');
                $('#action').val("Modifier");
                $('#operation').val("modifier");
            }
        });

    });

    $(document).on('click', '.suppr', function() {
        var id = $(this).attr("id");
        $('#confirm_id').val(id);
        $('#supprModal').modal('show');

    });

    $(document).on('submit', '#confirm', function(e) {
        e.preventDefault();
        $.ajax({
            url: "action_act.php",
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