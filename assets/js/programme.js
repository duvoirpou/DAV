$(document).ready(function() {

    var dataTable = $('#tabPrg').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_prg_cours.php",
            type: "POST"
        }
    });


    $('#creer').click(function() {
        $('#form_prg')[0].reset();
        $('.modal-title').text('Ajouter un programme');
        $('#action').val("Valider");
        $('#operation').val("ajouter");
        $('#info').html('');
    });
    

    $(document).on('submit', '#form_prg', function(e) {
        e.preventDefault();

        var id_classe = $('#id_classe').val();
        var id_matiere = $('#id_matiere').val();
        var chapitre = $('#chapitre').val();
        var titre_chapitre = $('#titre_chapitre').val();
        var annee_scolaire = $('#annee_scolaire').val();
        var obs = $('#obs').val();

        if(id_classe!='' && id_matiere!='' && chapitre!='' && titre_chapitre!=''  && obs!='' && annee_scolaire!='') {
            $.ajax({
                url: "save_prog_cours.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#form_prg')[0].reset();
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
        var id_prog = $(this).attr('id');
        var operation = 'afficher';
        $.ajax({
            url: "save_prog_cours.php",
            method: "POST",
            data: {id_prog:id_prog, operation:operation},
            dataType: "JSON",
            success: function(rep){

                $('#ModalPrg').modal('show');
                $('.modal-title').text('Modifier un programme');
                $('#operation').val("modifier");
                $('#id_prog').val(rep.id_prog);
                $('#id_classe').val(rep.id_classe);
                $('#id_matiere').val(rep.id_matiere);
                $('#chapitre').val(rep.chapitre);
                $('#titre_chapitre').val(rep.titre_chapitre);
                $('#annee_scolaire').val(rep.annee_scolaire);
                $('#obs').val(rep.obs);

            }
        })
    })

});