$(document).ready(function() {

    $('#inscrire').click(function() {
        $('#form_agent')[0].reset();
        $('.modal-title').text('Créer un agent');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');
        $('#image').html('');
    });


    var dataTable = $('#mydatatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_agent.php",
            type: "POST"
        }
    });

    $(document).on('submit', '#form_agent', function(event) {
        event.preventDefault();
        var data = $(this).serialize();
        console.log(data);
        var noms = $('#noms').val();
        var prenoms = $('#prenoms').val();
        var date_naiss = $('#date_naiss').val();
        var lieu_naiss = $('#lieu_naiss').val();
        var sexe = $('#sexe').val();
        var fonction = $('#fonction').val();
        var adresse = $('#adresse').val();
        var tele = $('#tele').val();
        var sitfam = $('#sitfam').val();
        var charge = $('#charge').val();
        var diplome = $('#diplome').val();
        var specialite = $('#specialite').val();
        var an_diplome = $('#an_diplome').val();
        var ecole_diplome = $('#ecole_diplome').val();
        var date_eng = $('#date_eng').val();
        var contrat = $('#contrat').val();
        var sal_base = $('#sal_base').val();
        var prime_fonction = $('#prime_fonction').val();
        var extension = $('#photo').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {

                $('#message').html('<h6 class="text-danger">Format d\'image invalide</h6>');
                $('#photo').val('');
                return false;
            }
        }

        if(noms != '' && prenoms != ''){

        $.ajax({
            url: "action_agent.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $('#message').html(data);
                $('#form_agent')[0].reset();
                dataTable.ajax.reload();
            }
        });

        }
        else
        {
            $('#message').html('<h5 class="text-danger">Tous les champs doivent être remplis</h5>');
        }

    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        $('#form_agent')[0].reset();
        var id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_agent.php",
            method: "POST",
            data: { id: id, operation: operation },
            dataType: "json",
            success: function(data) {
                $('#modalAgent').modal('show');
                $('.modal-title').text('Editer un agent');
                $('#id').val(data.id);
                $('#image').html(data.image);
                $('#noms').val(data.noms);
                $('#prenoms').val(data.prenoms);
                $('#date_naiss').val(data.date_naiss);
                $('#lieu_naiss').val(data.lieu_naiss);
                $('#sexe').val(data.sexe);
                $('#fonction').val(data.fonction);
                $('#adresse').val(data.adresse);
                $('#tele').val(data.tele);
                $('#sitfam').val(data.sitfam);
                $('#charge').val(data.charge);
                $('#diplome').val(data.diplome);
                $('#specialite').val(data.specialite);
                $('#an_diplome').val(data.an_diplome);
                $('#ecole_diplome').val(data.ecole_diplome);
                $('#date_eng').val(data.date_eng);
                $('#contrat').val(data.contrat);
                $('#sal_base').val(data.sal_base);
                $('#prime_fonction').val(data.prime_fonction);
                $('#action').val("Modifier");
                $('#operation').val("modifier");
            }
        });

    });

    $(document).on('click', '.suppr', function() {
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('#supprModal').modal('show');
        $('#confirmation').html('');

    });

    $(document).on('submit', '#confirm', function(e) {
        e.preventDefault();
        $.ajax({
            url: "action_eleve.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {


                $('#avert').html('');
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});