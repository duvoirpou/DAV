$(document).ready(function() {
 
   
    var dataTable = $('#journ').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "aff_cah_journal.php",
            method: "POST"
        }
    });


    $(document).on('click', '#inscrire', function() {
        $('#operation').val('ajouter');
        $('#action').val('VALIDER');
        $('#message').html('');
    });

//Formulaire d' inscription

   
 

    $(document).on('submit', '#inscription_form', function(event) {
        event.preventDefault();
        var data = $(this).serialize();
        console.log(data);
        var id_rep = $('#id_rep').val();
        var matricule_prof = $('#matricule_prof').val();
        var date_cours = $('#date_cours').val();
        var volume_hor = $('#volume_hor').val();

        if(id_rep !='' && matricule_prof != '' && date_cours !='' && volume_hor != '') {
            $.ajax({
                url: "action_cah_journ.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#message').html(data);
                    $('#inscription_form')[0].reset();
                    
                    
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            $('#message').html('<h5 class="alert alert-danger">Remplissez tous les champs</h5>');
        }

    });

    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var operation = 'afficher';
        $.ajax({
            url: "action_cah_journ.php",
            method: "POST",
            data: {id:id, operation:operation},
            dataType: "JSON",
            success: function(rep){

                $('#modalEl').modal('show');
                $('.modal-title').text('Modifier le cahier journal');
                $('#operation').val("modifier");
                $('#id').val(rep.id);
                $('#id_rep').val(rep.id_rep);
                $('#date_cours').val(rep.date_cours);
                $('#volume_hor').val(rep.volume_hor);
                $('#notions').val(rep.notions);
                $('#action').val('MODIFIER');

            }
        })
    })
   
});