$(document).ready(function(){

    afficheVente();


    function afficheVente(){
        $.ajax({
            url: "liste_vente.php",
            method: "POST",
            success: function(data){
                $('tbody').html(data);
            }
        });
    }

        var form = $('#form_client');

     $(form).on('submit',function(e){
        e.preventDefault();

        var id_client = $('#client_id').val() ,erreur_client = $('#erreur_client'), message_erreur='' ;

        if(id_client==''){
            message_erreur = 'selectionnez le client';
            $(erreur_client).text(message_erreur);
            $(id_client).css('border-color','#cc0000');
        }
        else
        {
            message_erreur ='';
             $(erreur_client).text(message_erreur);
             $(id_client).css('border-color','');
        }

        if(id_client!=''){

           var donnee = $(this).serialize();
           $.ajax({

                url:"actionvente.php",
                method:"POST",
                data:donnee,
                success: function(data){

                    afficheVente();

                $('#message').html(data);
                
                $(form)[0].reset();

                    
                setTimeout(function(){
                        $('#message').html('');
                    },5000);
                }    
                    
           });
        }


     });

});