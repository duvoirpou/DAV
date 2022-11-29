$(document).ready(function(){

          load_data();

          function load_data(){

            $.ajax({
              url: "affiche_vente.php",
              method:"POST",
              success: function(data){
                $('#listeVente').html(data); 
              }

            });

          }

          $('#resultat').html('');

          $('#recherche').keyup(function(){
            var recherche = $(this).val();
            var data = 'motclef='+recherche;

            if (recherche.length=1){

              $.ajax({
                type: 'POST',
                url:'rechercheProduit.php',
                data: data,
                success: function(reponse){

                  $('#resultat').html(reponse);

                }
              });

            }
          });

           $(document).on('click','.produit', function(e){
            e.preventDefault();
            var id_prod = $(this).attr('id');
            var action = 'select';
              $.ajax({
                url:"action_vente.php",
                method: "POST",
                data:{id_prod:id_prod, action:action},
                dataType:"JSON",
                success: function(rep){
                  $('#id_prod').val(rep.id_prod);
                  $('#recherche').val(rep.desc);
                  $('#resultat').html('');
                     
                   
                }

              });  
           
          });


          $('#form').on('submit', function(event){
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
                url:"action_vente.php",
                method:"POST",
                data:form_data,
                success: function(data){
                     $('#message').html(data);
                    
                    $('#form')[0].reset();
                    $('#id_prod').val('');
                    $('#action').val('ajout');
                    $('#produit').val('Ajouter');
                    $('#produit').addClass("btn btn-success btn-sm");
                    $('#hidden_id').val('');
                    $('#recherche').val('');


                     load_data();

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
            url:"action_vente.php",
            method: "POST",
            data: {id:id, action:action},
            dataType: "JSON",
            success: function(reponse){
                $('#erreur_produit').text('');
                $('#erreur_qte').text('');
                $('#id_prod').css('border-color','');
                $('#qte').css('border-color','');
                $('#id_prod').val(reponse.id_prod);
                $('#qte').val(reponse.qte);
                $('#prod').html('<span>'+reponse.desc+'</span>');
                $('#action').val('modifier');
                $('#hidden_id').val(id);
                $('#produit').val('Modifier');
                $('#produit').removeClass("btn btn-success btn-sm");
                $('#produit').addClass("btn btn-primary btn-sm");
                
                 load_data();
            }
        });
    });

          $('#recherche').click(function(){
               $('#form')[0].reset();
                    $('#id_prod').val('');
                    $('#action').val('ajout');
                    $('#produit').val('Ajouter');
                    $('#produit').addClass("btn btn-success btn-sm");
                    $('#hidden_id').val('');
                    $('#recherche').val('');
                    $('#erreur_produit').text('');
                    $('#erreur_qte').text('');
                    $('#id_prod').css('border-color','');
                    $('#qte').css('border-color','');
                    $('#resultat').html('');
           
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
                        url: "action_vente.php",
                        method : "POST",
                        data:{id:id,action:action},
                        success: function(data){

                           $('#delete_message').dialog('close'); 

                            load_data();
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
