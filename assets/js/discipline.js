$(document).ready(function() {

    $(document).on('click', '.discip', function() {

        var matricule = $(this).attr('id');

        $('#matricule').val(matricule);
        $('.modal-title').text('Discipline');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#modalDis').modal('show');



    });

    var dataTable = $('#tabDelit').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_delit.php",
            type: "POST"
        }

    });

    $("#recherche").keyup(function() {

        var recherche = $(this).val();
        var data = 'motclef=' + recherche;
        if (recherche.length > 2) {

            $.ajax({
                type: 'POST',
                url: 'recherche_eleve.php',
                data: data,
                success: function(reponse) {

                    $('#resultat').html(reponse);

                }
            });

        }

    });




    $(document).on('submit', '#form_discip', function(event) {
        event.preventDefault();

        var matricule = $('#matricule').val();
        var motif = $('#motif').val();
        var date_delit = $('#date_delit').val();
        var sanction = $('#sanction').val();
        var etat = $('#etat').val();
        var annee = $('#annee').val();

        if (matricule != '' && motif != '' && date_delit != '' && sanction != '' && annee != '' && etat != '') {

            var donnee = $(this).serialize();
            console.log(donnee);

            $.ajax({
                url: "action_discipline.php",
                method: "POST",
                data: donnee,
                success: function(data) {
                    $('#message').html(data);
                    $('#form_discip')[0].reset();
                    $('#resultat').html('');
                    dataTable.ajax.reload();
                }
            });

        } else {
            $('#message').html('<div class="text-danger">Remplissez tous les champs</div>');
        }


    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_discipline.php",
            method: "POST",
            data: { id: id, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#modalDis').modal('show');
                $('.modal-title').text('Modifier un delit');
                $('#id').val(data.id);
                $('#matricule').val(data.matricule);
                $('#motif').val(data.motif);
                $('#date_delit').val(data.date_delit);
                $('#sanction').val(data.sanction);
                $('#etat').val(data.etat);
                $('#annee').val(data.annee);
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
            url: "action_user.php",
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