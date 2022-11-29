$(document).ready(function() {

    $('#creer').click(function() {

        $('#form')[0].reset();
        $('.modal-title').text('Ajouter une operation de caisse');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');

    });

    var dataTable = $('#tabCaisse').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_caisse.php",
            type: "POST"
        }

    });



    $(document).on('submit', '#form', function(event) {
        event.preventDefault();

        var libelle_op = $('#libelle_op').val();

        if (libelle_op != '') {

            $.ajax({
                url: "action_caisse.php",
                method: "POST",
                data: $(this).serialize(),

                success: function(data) {
                    $('#message').html(data);
                    $('#form')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        } else {
            $('#message').html('<h6 class="text-danger">Remplissez le champs</h6>');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var id_classe = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_classe.php",
            method: "POST",
            data: { id_classe: id_classe, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#modalCla').modal('show');
                $('.modal-title').text('Edition d\'une classe');
                $('#id_niv').val(data.id_niv);
                $('#lib_classe').val(data.lib_classe);
                $('#id_classe').val(data.id_classe);
                $('#action').val("Modifier");
                $('#operation').val("modifier");
            }
        });

    });

    $(document).on('click', '.suppr', function() {
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('#modalForm').modal('show');

    });

    $(document).on('submit', '#confirm', function(e) {
        e.preventDefault();
        $.ajax({
            url: "action_classe.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $('#confirm')[0].reset();
                $('#avert').html('');
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});