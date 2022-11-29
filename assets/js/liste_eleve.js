$(document).ready(function(){

    var dataTable = $('#table_el').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "afficher_eleve_classe.php",
            type: "POST"
        }
    });
     
     $(document).on('click', '.edit', function () {
        $('#message').html('');
        var mat = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "modifier_eleve.php",
            method: "POST",
            data: {
                mat: mat,
                operation: operation
            },
            dataType: "json",
            success: function (data) {

                $('#modalModif').modal('show');
                $('.modal-title').text('Editer élève');
                $('#matricule').val(data.matricule);
                $('#noms').val(data.noms);
                $('#prenoms').val(data.prenoms);
                $('#date_naiss').val(data.date_naiss);
                $('#lieu_nais').val(data.lieu_nais);
                $('#sexe').val(data.sexe);
                $('#nationalite').val(data.nationalite);
                $('#adresse').val(data.adresse);
                $('#choix').val(data.choix);
                $('#image').html(data.image);
                $('#id_classe').val(data.id_classe);
                $('#id_freq').val(data.id_freq);
                $('#reduction').val(data.reduction);
                $('#nom_pere').val(data.nom_pere);
                $('#nom_mere').val(data.nom_mere);
                $('#id_tuteur').val(data.id_tuteur);
                $('#operation').val('modifier');
                $('#action').val('Modifier');
            }
        });

    });


    $(document).on('submit','#form', function(ev){
        ev.preventDefault();

        var noms = $('#noms').val();
        var prenoms = $('#prenoms').val();
        var date_naiss = $('#date_naiss').val();
        var lieu_nais = $('#lieu_nais').val();
        var sexe = $('#sexe').val();
        var nationalite = $('#nationalite').val();
        var adresse = $('#adresse').val();
        var choix = $('#choix').val();
        var id_classe = $('#id_classe').val();
        var id_freq = $('#id_freq').val();
        var reduction = $('#reduction').val();
        var nom_pere = $('#nom_pere').val();
        var nom_mere = $('#nom_mere').val();
        var id_tuteur = $('#id_tuteur').val();
        var etat = $('#etat').val();
        var extension = $('#photo').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {

                $('#message_insc').html('<h6 class="text-danger">Format d\'image invalide</h6>');
                $('#photo').val('');
                return false;
            }
        }

        if (noms != '' && prenoms != '' && date_naiss != '' && lieu_nais != '' && sexe != '' && nationalite != '' && adresse != '' && choix != '' && id_classe != '' && id_freq != '' && nom_pere != '' && nom_mere != '' && reduction != '' && id_tuteur != '') {

            $.ajax({
            url: "modifier_eleve.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                dataTable.ajax.reload();
                $('#message').html(data); 
                

            }
        });
        }
         else
        {
           
            $('#message').html('<h5 class="text-danger">Remplissez tous les champs</h5>');
        }

    });


    //Formulaire de suppression
	
	$(document).on('click', '.suppr', function () {
        $('#message').html('');
		$('#confirmation').html('');
        var matricule = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "supprime_eleve.php",
            method: "POST",
            data: {
                matricule: matricule,
                operation: operation
            },
            dataType: "json",
            success: function (data) {

                $('#supprModal').modal('show');
                $('.modal-title').text('Avertissement');
                $('#matricule_suppr').val(data.matricule);
                $('#nom').html(data.noms);
                $('#prenom').html(data.prenoms);
                $('#classe').html(data.classe);
            }
        });

    });


   

    $(document).on('submit', '#confirm', function (e) {
        e.preventDefault();
        $.ajax({
            url: "supprime_eleve.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {


                $('#avert').html('');
                $('#nom').html('');
                $('#prenom').html('');
                $('#classe').html('');
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});