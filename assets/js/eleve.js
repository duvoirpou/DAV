$(document).ready(function () {
    var table = $('#effectif').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
        responsive: true
    } );

    affiche_tuteur();

    affiche_effectif();

    function affiche_tuteur() {

        $.ajax({
            url: "afficher_tuteur.php",
            type: "POST",
            dataType: "JSON",
            success: function (reponse) {

                $('#tuteur_fin').html(reponse);
            }
        });
    }


    function affiche_effectif() {

        $.ajax({
            url: "afficher_effectif.php",
            type: "POST",
            success: function (reponse) {

                $('tbody').html(reponse);
            }
        });
    }

    $('#inscrire').click(function () {
        $('#inscription_form')[0].reset();
        $('.modal-title').text('Inscrire un élève');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#image').html('');
        $('#message').html('');
    });

    var dataTable = $('#tabEleve').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_eleve.php",
            method: "POST"
        }
    });

    //Formulaire d' inscription

    $(document).on('submit', '#formTuteur', function (e) {
        e.preventDefault();
        var identite = $('#identite').val();
        var profession = $('#profession').val();
        var contact = $('#contact').val();
        var lien_parental = $('#lien_parental').val();
        var operation = 'tuteur';
        if (identite != '' && profession != '') {
            $.ajax({
                url: "action_eleve.php",
                method: "POST",
                data: $(this).serialize(),
                success: function (rep) {
                    affiche_tuteur();
                    $('#resultat').html(rep);
                    $('#formTuteur')[0].reset();

                }

            });
        } else {
            $('#resultat').html('<h5 class="text-danger">remplissez tous les champs</h5>');
        }

    });


    $(document).on('submit', '#inscription_form', function (event) {

        var data = $(this).serialize();
        console.log(data);
        var noms_el = $('#noms_el').val();
        var prenoms_el = $('#prenoms_el').val();
        var date_naiss = $('#date_naiss').val();
        var lieu_nais = $('#lieu_nais').val();
        var sexe_el = $('#sexe_el').val();
        var nationalite = $('#nationalite').val();
        var adresse = $('#adresse').val();
        var choix_el = $('#choix_el').val();
        var id_classe = $('#id_classe').val();
        var id_freq = $('#id_freq').val();
        var reduction = $('#reduction').val();
        var nom_pere = $('#nom_pere').val();
        var nom_mere = $('#nom_mere').val();
        var id_tuteur = $('#id_tuteur').val();
        var extension = $('#photo').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {

                $('#message_insc').html('<h6 class="text-danger">Format d\'image invalide</h6>');
                $('#photo').val('');
                return false;
            }
        }

        if (noms_el != '' && prenoms_el != '' && date_naiss != '' && lieu_nais != '' && sexe_el != '' && nationalite != '' && adresse != '' && choix_el != '' && id_classe != '' && id_freq != '' && nom_pere != '' && nom_mere != '' && reduction != '' && id_tuteur != '') {

        } else {
            event.preventDefault();
            $('#message').html('<h5 class="alert alert-danger">Remplissez tous les champs</h5>');
        }

    });

   

});