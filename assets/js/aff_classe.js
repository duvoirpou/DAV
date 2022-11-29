$(document).ready(function(){

    $('#creer').click(function(){

        $('#form')[0].reset();
        $('.modal-title').text('Affectez une classe');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');
    });

    var dataTable = $('#tAffClasse').DataTable({
        "processing":true,
        "serverSide":true,
        "ajax":{
            url:"liste_aff_classe.php",
            method: "POST"
        }
    });

    $(document).on('submit','#form', function(event){
        event.preventDefault();

        var matricule_prof = $('#matricule_prof').val();
        var id_cy = $('#id_cy').val();
        var id_niv = $('#id_niv').val();
        var id_classe = $('#id_classe').val();
        var id_matiere = $('#id_matiere').val();
        var volume_hor = $('#volume_hor').val();
        var taux_hor = $('#taux_hor').val();
        var annee_scolaire = $('#annee_scolaire').val();

        if(matricule_prof != '' && id_cy != '' && id_niv != '' && id_classe != '' && id_matiere != '' && volume_hor != '' && taux_hor != '' && annee_scolaire != ''  )
        {
            $.ajax({
                url: "action_aff_classe.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success: function(data)
                {
                    $('#message').html(data);
                    $('#form')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        }
        else
        {
            $('#message').html('<h6 class="text-danger">Remplissez tous les champs</h6>');
        }

    });

    $(document).on('click', '.edit', function(){
        $('#message').html('');
        var id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_aff_classe.php",
            method: "POST",
            data: {id:id,operation:operation},
            dataType: "JSON",
            success: function(data){

                $('#modalForm').modal('show');
                $('.modal-title').text('Editer un niveau');
                $('#id').val(data.id);
                $('#matricule_prof').val(data.matricule_prof);
                $('#id_cy').val(data.id_cy);
                $('#id_niv').val(data.id_niv);
                $('#id_classe').val(data.id_classe);
                $('#id_matiere').val(data.id_matiere);
                $('#volume_hor').val(data.volume_hor);
                $('#taux_hor').val(data.taux_hor);
                $('#annee_scolaire').val(data.annee_scolaire);
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
            url: "action_aff_classe.php",
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