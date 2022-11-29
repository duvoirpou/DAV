$(document).ready(function() {

    $('#creer').click(function() {

        $('#form_emp')[0].reset();
        $('.modal-title').text('Créer un emploi du temps');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#image').html('');

    });

    var dataTable = $('#tabEmp').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "emptemps.php",
            type: "POST"
        }
    });


    $(document).on('submit', '#form_emp', function(event) {
        event.preventDefault();

        var matricule_ens = $('#matricule_ens').val();
        var jours = $('#jours').val();
        var horaire = $('#horaire').val();
        var id_matiere = $('#id_matiere').val();
        var id_classe = $('#id_classe').val();
        var an_scol = $('#an_scol').val();


        if (matricule_ens != '' && jours != '' && horaire != '' && id_matiere != '' && id_classe != '' && an_scol != '') {
            $.ajax({
                url: "action_emptemps.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#message').html(data);
                    $('#form_emp')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        } else {
            $('#message').html('<h6 class="text-danger">Remplissez tous les champs</h6>');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var id_emp = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_emptemps.php",
            method: "POST",
            data: { id_emp: id_emp, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#ModalEmp').modal('show');
                $('.modal-title').text('Editer un emploi du temps');
                $('#emp_id').val(data.id_emp);
                $('#jours').val(data.jours);
                $('#horaire').val(data.horaire);
                $('#id_classe').val(data.id_classe);
                $('#id_matiere').val(data.id_matiere);
                $('#matricule_ens').val(data.matricule_ens);
                $('#an_scol').val(data.an_scol);
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
            url: "action_emptemps.php",
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