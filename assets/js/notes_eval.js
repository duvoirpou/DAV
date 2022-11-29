$(document).ready(function() {


    function affiche_notes_eval() {
        $.ajax({
            url: "affiche_notes_eval.php",
            method: "POST",
            success: function(data) {
                $('tbody').html(data);

            }
        });
    }


    $(document).on('submit', '#form_choix', function(event) {
        event.preventDefault();


        var id_classe = $('#id_classe').val();

        if (id_classe != '') {
            $('.alert').empty();
            $('#message').html('');
            var donnee = $(this).serialize();
            $.ajax({
                url: "affiche_notes_eval.php",
                method: "POST",
                data: donnee,
                success: function(data) {

                    affiche_notes_eval();

                }
            })
        } else {
            $('#message').html('<h6 class="text-danger alert alert-danger">Remplissez tous les champs</h6>');
        }

    });


    $(document).on('click', '.notes_eval', function(e) {
        e.preventDefault();

        var matricule = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "impr_notes_eval.php",
            method: "POST",
            data: { matricule: matricule, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#modalBul').modal('show');
                $('.modal-title').text('notes_eval de notes');
                $('#madalAff').html(data);


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