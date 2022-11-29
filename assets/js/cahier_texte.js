$(document).ready(function() {

    var dataTable = $('#tabCt').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "afficher_cahier_texte.php",
            type: "POST"
        }
    });


    $('#creer').click(function() {
        $('#form_ct')[0].reset();
        $('.modal-title').text('Remplir le cahier de texte');
        $('#action').val("Valider");
        $('#operation').val("ajouter");
        $('#info').html('');
    });
    

    $(document).on('submit', '#form_ct', function(e) {
        e.preventDefault();

        var id_classe = $('#id_classe').val();
        var id_matiere = $('#id_matiere').val();
        var chapitre = $('#chapitre').val();
        var titre_chapitre = $('#titre_chapitre').val();
        var notions = $('#notions').val();
        var volume_hor = $('#volume_hor').val();
        var heure_debut = $('#heure_debut').val();
        var annee_scolaire = $('#annee_scolaire').val();
        var obs = $('#obs').val();

        if(id_classe!='' && id_matiere!='' && chapitre!='' && titre_chapitre!='' && notions!='' && volume_hor!='' && heure_debut!='' && obs!='' && annee_scolaire!='') {
            $.ajax({
                url: "action_cahier_texte.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#form_ct')[0].reset();
                    $('#info').html(data);
                    dataTable.ajax.reload();

                }
            });
        }
        else
        {
            $('#info').html('<h5 class="text-danger">remplissez tous les champs</h5>');
        }

    });

    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id_ct = $(this).attr('id');
        var operation = 'afficher';
        $.ajax({
            url: "action_cahier_texte.php",
            method: "POST",
            data: {id_ct:id_ct, operation:operation},
            dataType: "JSON",
            success: function(rep){

                $('#ModalPrg').modal('show');
                $('.modal-title').text('Modifier un programme');
                $('#operation').val("modifier");
                $('#id_ct').val(rep.id_ct);
                $('#id_classe').val(rep.id_classe);
                $('#id_matiere').val(rep.id_matiere);
                $('#chapitre').val(rep.chapitre);
                $('#titre_chapitre').val(rep.titre_chapitre);
                $('#notions').val(rep.notions);
                $('#volume_hor').val(rep.volume_hor);
                $('#heure_debut').val(rep.heure_debut);
                $('#annee_scolaire').val(rep.annee_scolaire);
                $('#obs').val(rep.obs);

            }
        })
    })

});