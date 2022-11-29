$(document).ready(function(){

    $('#creer').click(function(){

        $('#form_prof')[0].reset();
        $('.modal-title').text('ajouter un enseignant');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#image').html('');


    });

    var dataTable = $('#tabEns').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"liste_enseignant.php",
            method: "POST"
        },
        "columnDefs":[
            {
                "target": [1,5,6],
                "orderable":false
            },
        ],


    });




    $(document).on('submit','#form_prof', function(event){
        event.preventDefault();

        var noms = $('#nom_prof').val();
        var prenoms = $('#prenom_prof').val();
        var date_naiss = $('#date_naiss').val();
        var lieu_naiss = $('#lieu_naiss').val();
        var sexe = $('#sexe').val();
        var adresse = $('#adresse').val();
        var tele = $('#tele').val();
        var sitfam = $('#sitfam').val();
        var charge = $('#charge').val();
        var diplome = $('#diplome').val();
        var specialite = $('#specialite').val();
        var an_diplome = $('#an_diplome').val();
        var ecole_diplome = $('#ecole_diplome').val();
        var departement = $('#departement').val();
        var matiere = $('#matiere').val();
        var extension = $('#photo').val().split('.').pop().toLowerCase();
        if(extension != '')
        {
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
            {

                $('#message').html('<h6 class="text-danger">Format d\'image invalide</h6>');
                $('#photo').val('');
                return false;
            }
        }


        if(noms != '' && prenoms != '' && date_naiss != '' && lieu_naiss != '' && sexe !='' && adresse != '' && tele != '' && sitfam != '' && charge != '' &&  diplome != '' && specialite != '' && an_diplome != ''
            && ecole_diplome != '' && departement != '' && matiere != '') {


            $.ajax({
                url: "action_enseignant.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#message').html(data);
                    // $('#inscrire_form')[0].reset();
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            $('#message').html('<div class="text-danger font-italic">Remplissez tous les champs</div>');
        }

    });


    $(document).on('click', '.edit', function(){
        $('#message').html('');
        var id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_enseignant.php",
            method: "POST",
            data: { id : id, operation : operation },
            dataType: "JSON",
            success: function(data){
                console.log(data);

                $('#modalEns').modal('show');
                $('.modal-title').text("Edition d'un enseignant");
                $('#ens_id').val(data.id);
                $('#nom_prof').val(data.noms);
                $('#prenom_prof').val(data.prenoms);
                $('#date_naiss').val(data.date_naiss);
                $('#lieu_naiss').val(data.lieu_naiss);
                $('#sexe').val(data.sexe);
                $('#adresse').val(data.adresse);
                $('#tele').val(data.tele);
                $('#annee_scolaire').val(data.annee_scolaire);
                $('#sitfam').val(data.sitfam);
                $('#charge').val(data.charge);
                $('#diplome').val(data.diplome);
                $('#specialite').val(data.specialite);
                $('#an_diplome').val(data.an_diplome);
                $('#departement').val(data.departement);
                $('#matiere').val(data.matiere);
                $('#image').html(data.image);
                $('#action').val("Modifier");
                $('#operation').val("modifier");
            }
        });

    });

    $(document).on('click', '.suppr', function(){
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('#supprModal').modal('show');

    });

    $(document).on('submit', '#confirm', function (e) {
        e.preventDefault();
        $.ajax({
            url: "action_enseignant.php",
            method: "POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success: function(data){
                $('#avert').html('');
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});












