$(document).ready(function() {

    $('#creer').click(function() {

        $('#depart_form')[0].reset();
        $('.modal-title').text('Créer un departement');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");



    });

    var dataTable = $('#tabDep').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "list_depart.php",
            method: "POST"
        }
    });


    $(document).on('submit', '#depart_form', function(event) {
        event.preventDefault();

        var depart = $('#depart').val();


        if (depart != '') {
            $.ajax({
                url: "action_depart.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#message').html(data);
                    $('#depart_form')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        } else {
            $('#message').html('<h6 class="text-danger">Remplissez tous les champs</h6>');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var depart_id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_depart.php",
            method: "POST",
            data: { depart_id: depart_id, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#ModalDep').modal('show');
                $('.modal-title').text('Editer un departement');
                $('#dep_id').val(data.dep_id);
                $('#depart').val(data.depart);
                $('#action').val("Modifier");
                $('#operation').val("modifier");

            }
        });

    });

    $(document).on('click', '.suppr', function() {
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('.modal-title').text('Confirmation');
        $('#supprModal').modal('show');

    });

    $(document).on('submit', '#confirm', function(e) {
        e.preventDefault();
        $.ajax({
            url: "action_depart.php",
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