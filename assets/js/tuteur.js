$(document).ready(function() {

    $('#creer').click(function() {

        $('#user_form')[0].reset();
        $('.modal-title').text('Créer un tuteur');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#image').html('');
        $('#message').html('');
    });

    var dataTable = $('#tTuteur').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_tuteur.php",
            type: "POST"
        }
    });


    $(document).on('submit', '#user_form', function(event) {
        event.preventDefault();

        var identite = $('#identite').val();
        var adresse = $('#adresse').val();
        var contact = $('#contact').val();
        var profession = $('#profession').val();
        var lien_parental = $('#lien_parental').val();
       

        if (identite != '' && contact != '' && profession != '' && lien_parental != ''  && adresse != '') {
            $.ajax({
                url: "action_tuteur.php",
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
        var tuteur_id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_tuteur.php",
            method: "POST",
            data: { tuteur_id: tuteur_id, operation: operation },
            dataType: "JSON",
            success: function(data) {

                $('#matModal').modal('show');
                $('.modal-title').text('Editer un tuteur');
                $('#tuteur_id').val(data.id);
                $('#adresse').val(data.adresse);
                $('#identite').val(data.identite);
                $('#contact').val(data.contact);
                $('#profession').val(data.profession);
                $('#lien_parental').val(data.lien_parental);
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
            url: "action_tuteur.php",
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