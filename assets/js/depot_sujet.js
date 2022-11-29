$(document).ready(function() {

    var dataTable = $('#tabCt').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "afficher_depot_sujet.php",
            type: "POST"
        }
    });


    $('#creer').click(function() {
        $('#form_ds')[0].reset();
        $('.modal-title').text('Remplir');
        $('#action').val("Valider");
        $('#operation').val("ajouter");
        $('#info').html('');
    });


    $(document).on('submit', '#form_ds', function(e) {
        e.preventDefault();

        var controle = $('#controle').val();
        var date_cont = $('#date_cont').val();
        var type_cont = $('#type_cont').val();
        var niveau = $('#niveau').val();
        var matiere = $('#matiere').val();
        var doc_auto = $('#doc_auto').val();
        var annee = $('#annee').val();
        var extension = $('#fichier').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'doc', 'docx', 'pdf', 'xls', 'xlsx']) == -1) {

                $('#info').html('<h6 class="text-danger">Format de fichier invalide</h6>');
                $('#fichier').val('');
                return false;
            }
        }


        if (controle != '' && date_cont != '' && type_cont != '' && niveau != '' && matiere != '' && doc_auto != '' && annee != '') {
            $.ajax({
                url: "action_depot_sujet.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#form_ds')[0].reset();
                    $('#info').html(data);
                    dataTable.ajax.reload();

                }
            });
        } else {
            $('#info').html('<h5 class="text-danger">remplissez tous les champs</h5>');
        }

    });

    /*$(document).on('click', '.edit', function(e) {
        e.preventDefault();
        var id_ct = $(this).attr('id');
        var operation = 'afficher';
        $.ajax({
            url: "action_cahier_texte.php",
            method: "POST",
            data: { id_ct: id_ct, operation: operation },
            dataType: "JSON",
            success: function(rep) {

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
    })*/

});