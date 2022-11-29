$(document).ready(function() {
    
    function affiche_note() {
       
        $.ajax({
            url: "affiche_note.php",
            method: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#list_notes').html(data);

            }
        })
    }

    $('#creer').click(function() {

        $('#form')[0].reset();
        $('.modal-title').text('Ajouter une note');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');

    });



    $(document).on('submit', '#form', function(event) {
        event.preventDefault();

        var note = $('#note').val();
        var matricule = $('#matricule').val();



        if ( note != ''  && matricule != '') {
            $.ajax({
                url: "action_note.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#message').html(data);
                    $('#form')[0].reset();
                    affiche_note();
                    
                }
            })
        } else {
            $('#message').html('<h6 class="text-danger">Remplissez tous les champs</h6>');
        }

    });

    $(document).on('submit', '#form_choix', function(ev) {
        ev.preventDefault();

        var id_matiere = $('#id_matiere').val();
        var id_cont = $('#id_cont').val();


        if (id_matiere != '' && id_cont != '') {
            var donnee = $(this).serialize();
            $.ajax({
                url: "affiche_note.php",
                method: "POST",
                data: donnee,
                 dataType: "JSON",
                success: function(data) {
                
                   affiche_note();

                }
            });
        } else {
            alert('Remplissez tous les champs');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var niveau_id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_niveau.php",
            method: "POST",
            data: { niveau_id: niveau_id, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#matModal').modal('show');
                $('.modal-title').text('Editer un niveau');
                $('#niveau_id').val(data.id_niv);
                $('#lib_niv').val(data.lib_niv);
                $('#id_cy').val(data.id_cy);
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
            url: "action_niveau.php",
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