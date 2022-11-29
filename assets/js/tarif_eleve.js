$(document).ready(function () {

     var dataTable = $('#table_el_paie').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "eleve_paie_fr.php",
            type: "POST"
        }
    });


     $(document).on('click','.ed',function(){
     	var matricule = $(this).attr('id');
     	var action = "afficher";

     	$.ajax({
     		url:"action_modif_fr.php",
     		method:"POST",
     		data:{matricule:matricule, action:action},
     		dataType:"JSON",
     		success: function(rep){

     			$('#modalModif').modal('show');
     			$('.modal-title').text('Modification de la tarification');
     			$('#matricule').val(rep.matricule);
     			$('#noms').val(rep.noms);
     			$('#prenoms').val(rep.prenoms);
     			$('#classe').val(rep.classe);
                $('#insc_reinsc').val(rep.insc_reinsc);
                $('#octobre').val(rep.octobre);
                $('#novembre').val(rep.novembre);
                $('#decembre').val(rep.decembre);
                $('#janvier').val(rep.janvier);
                $('#fevrier').val(rep.fevrier);
                $('#mars').val(rep.mars);
                $('#avril').val(rep.avril);
                $('#mai').val(rep.mai);
                $('#juin').val(rep.juin);
                $('#action').val("modifier");
               
     		}
     	});

     });


     $(document).on('submit', '#form', function(ev){
     	ev.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            url: "action_modif_fr.php",
            method:"POST",
            data: data,
            success: function(result){

                $('#msg').html(result);
                dataTable.ajax.reload();

                setTimeout(function(){

                 $('#msg').html('');
                 
                  }, 3000);

            }
        });
     });

});