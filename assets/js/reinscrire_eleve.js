$(document).on('submit', '#form', function (event) {
       
        var noms_el = $('#noms_el').val();
        var prenoms_el = $('#prenoms_el').val();
        // var date_naiss = $('#date_naiss').val();
        //  var lieu_nais = $('#lieu_nais').val();
        var sexe_el = $('#sexe_el').val();
        var nationalite = $('#nationalite').val();
        // var adresse = $('#adresse').val();
        // var choix_el = $('#choix_el').val();
        //var annee_scolaire = $('#annee_scolaire').val();
        //var id_cy = $('#id_cy').val();
        //var id_niveau = $('#id_niveau').val();
        var id_classe = $('#id_classe').val();
        var id_freq = $('#id_freq').val();
        // var reduction = $('#reduction').val();
        // var nom_pere = $('#nom_pere').val();
        // var nom_mere = $('#nom_mere').val();
        // var id_tuteur = $('#id_tuteur').val();
        //var extension = $('#photo').val().split('.').pop().toLowerCase();
        //if (extension != '') {
        //   if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {

        //      $('#message_insc').html('<h6 class="text-danger">Format d\'image invalide</h6>');
        //      $('#photo').val('');
        //      return false;
        //  }
        // }

        if (noms_el != '' && prenoms_el != ''  && id_classe != '' && id_freq != '') {
            
        } else {
             event.preventDefault();
            $('#message').html('<h5 class="alert alert-danger">Remplissez tous les champs</h5>');
        }

    });
