$(document).ready(function(){

    charge_list();

    function charge_list()
    {
        $.ajax({
            url:"list.php",
            method:"POST",
            success:function(data){
                $('#list').html(data);
            }
        })
    }

    $('#message').dialog({
        autoOpen: false,
        width: 400
    });

    $('#ajout').click(function(){

         $('#message').attr('title','Donnée ajoutée');
         $('#action').val('insert');
         $('#form_action').val('Insert');
         $('#commande')[0].reset();
         $('#form_action').attr('disabled',false);
         $('#message').dialog('open');
    });

    $('#commande').on('submit', function(event){
        event.preventDefault();
        var erreur_client ='';
        var erreur_date ='';
        if($('#id').val() == '')
        {
            erreur_client ='selection du client requise';
            $('#erreur_client').text(erreur_client);
            $('#id').css('border-color','#cc0000');

        }
        else
        {
            erreur_client ='';
            $('#erreur_client').text(erreur_client);
            $('#id').css('border-color','');

        }

        if($('#date').val() == '')
        {
            erreur_date ='selection de la date requise';
            $('#erreur_date').text(erreur_date);
            $('#date').css('border-color','#cc0000');

        }
        else
        {
            erreur_date ='';
            $('#erreur_date').text(erreur_date);
            $('#date').css('border-color','');

        }

        if(erreur_client == '' || erreur_date  == '')
        {

           return false;
        }
        else
        {
            $('#form_action').attr('disabled','disabled');

            var form_data = $(this).serialize();
            $.ajax({
                 url: "actionvente.php",
                 method: "POST",
                 data: form_data,
                 success:function(data)
                 {
                    $('#message').dialog('close');
                    $('#action_alert').html(data);
                    $('#action_alert').dialog('open');
                    charge_list();
                 }

            });

        }

    });

     $('#action_alert').dialog({

        autoOpen: false
     });

});