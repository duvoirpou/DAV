$(document).ready(function(){

                liste();

            function liste(){

                $.ajax({
                url: "affiche_achat.php",
                method: "POST",
                success: function(data){

                    $('#liste').html(data);
                   
                }
            });
 
            }

    $('#form_achat').on('submit', function(event){
        event.preventDefault();
        var erreur_produit='';
        var erreur_qte='';

        if($('#id_prod').val()==''){
            erreur_produit = 'selectionnez le produit';
            $('#erreur_produit').text(erreur_produit);
            $('#id_prod').css('border-color','#cc0000');
        }
        else
        {
            erreur_produit ='';
             $('#erreur_produit').text(erreur_produit);
             $('#id_prod').css('border-color','');
        }

        if($('#qte').val()==''){
            erreur_qte = 'entrez la quantité';
            $('#erreur_qte').text(erreur_qte);
            $('#qte').css('border-color','#cc0000');
        }
        else
        {
            erreur_qte ='';
             $('#erreur_qte').text(erreur_qte);
             $('#qte').css('border-color','');
        }


        if(erreur_produit=='' && erreur_qte==''){

           
           // $('#form_action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({

                url:"action_achat.php",
                method:"POST",
                data:form_data,
                success: function(data){
                     $('#message').html(data);
                    
                    $('#form_achat')[0].reset();
                    $('#prod').val('');
                    $('#prod').html('');
                    $('#action').val('ajout');
                    $('#produit').val('Ajouter');
                    $('#hidden_id').val('');

                     liste();

                    setTimeout(function(){
                            $('#message').empty();
                        },5000);
                   

                    
                }
            });
        }


    });


    $(document).on('click','.edit', function(){
        var id = $(this).attr('id');
        var action = 'afficher';
        $.ajax({
            url:"action_achat.php",
            method: "POST",
            data: {id:id, action:action},
            dataType: "JSON",
            success: function(reponse){
                $('#prod').val(reponse.id_prod);
                $('#qte').val(reponse.qte);
                $('#prod').html('<span>'+reponse.desc+'</span>');
                $('#action').val('modifier');
                $('#hidden_id').val(id);
                $('#produit').val('Modifier');
                
                 liste();
            }
        });
    });

        $('#delete_message').dialog({
            autoOpen:false,
            modal:true,
            buttons: {

                Ok: function(){
                    var id = $(this).data("id"); 
                    var action = 'supprimer';
                    console.log(id);
                    $.ajax({
                        url: "action_achat.php",
                        method : "POST",
                        data:{id:id,action:action},
                        success: function(data){

                           $('#delete_message').dialog('close'); 

                            liste();
                        } 

                    });
                },
                Annuler: function(){
                    $(this).dialog('close');
                }
            }
        });

    $(document).on('click','.del', function(){
         var id = $(this).attr("id");

         $('#delete_message').data('id',id).dialog('open');



    });

});