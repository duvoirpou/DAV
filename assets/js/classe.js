$(document).ready(function () {

    $('#btnClass').click(function () {

        $('#form_classe')[0].reset();
        $('.modal-title').text('Créer une classe');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');

    });

    var dataTable = $('#tabClasse').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "list_cla.php",
            method: "POST"
        }



    });



    $(document).on('submit', '#form_classe', function (event) {
        event.preventDefault();

        var id_niv = $('#id_niv').val();
        var lib_classe = $('#lib_classe').val();
        var effectif = $('#effectif').val();

        if (id_niv != '' && lib_classe != '' && effectif != '') {

            $.ajax({
                url: "action_classe.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#message').html(data);
                    $('#form_classe')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        } else {
            $('#message').html('<h6 class="text-danger">Remplissez le champs</h6>');
        }

    });


    $(document).on('click', '.edit', function () {
        $('#message').html('');
        var id_classe = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_classe.php",
            method: "POST",
            data: {
                id_classe: id_classe,
                operation: operation
            },
            dataType: "JSON",
            success: function (data) {

                $('#modalCla').modal('show');
                $('.modal-title').text('Edition d\'une classe');
                $('#id_niv').val(data.id_niv);
                $('#lib_classe').val(data.lib_classe);
                $('#id_classe').val(data.id_classe);
                $('#effectif').val(data.effectif);
                $('#action').val("Modifier");
                $('#operation').val("modifier");
            }
        });

    });

    $(document).on('click', '.suppr', function () {
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('#supprModal').modal('show');

    });

    $(document).on('submit', '#confirm', function (e) {
        e.preventDefault();
        $.ajax({
            url: "action_classe.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#confirm')[0].reset();
                $('#avert').html('');
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});