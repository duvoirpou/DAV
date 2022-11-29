$(document).ready(function(){

          afficheFrscol();

          function afficheFrscol(){

            $.ajax({
              url: "traitementFrMois.php",
              method:"POST",
              success: function(data){
                $('#resultat').html(data);
              }

            });

          }

         

          $('#mot').keyup(function(){
            var recherche = $(this).val();
            var data = 'motclef='+recherche;
            
            if (recherche.length>1){

              $.ajax({
                type: 'POST',
                url:'traitementFrMois.php',
                data: data,
                success: function(reponse){
                  console.log(reponse);
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
                
                 afficheFrscol();
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

    $(document).on('click','#valider', function(){

      var erreur_lettre='';
        var erreur_pay='';
        
        if($('#mont_let').val()==''){
            erreur_lettre = 'entrez le montant en lettre';
            $('#erreur_lettre').text(erreur_lettre);
            $('#mont_let').css('border-color','#cc0000');
        }
        else
        {
            erreur_lettre ='';
             $('#erreur_lettre').text(erreur_lettre);
             $('#mont_let').css('border-color','');
        }

        if($('#pay').val()==''){
            erreur_pay = 'indiquez le montant versé';
            $('#erreur_pay').text(erreur_pay);
            $('#pay').css('border-color','#cc0000');
        }
        else
        {
            erreur_pay ='';
             $('#erreur_pay').text(erreur_pay);
             $('#pay').css('border-color','');
        }


        if(erreur_lettre=='' && erreur_pay==''){

           
           // $('#form_action').attr('disabled', 'disabled');
             var id_cmd = $('#id_cmd').val();
             var id_cl = $('#id_cl').val();
             var mont_ch = $('#mont_ch').val();
             var mont_let = $('#mont_let').val();
             var pay = $('#pay').val();
             var action = 'valider';
             console.log(mont_ch);
             
            $.ajax({
                url:"action_vente.php",
                method:"POST",
                data:{id_cmd:id_cmd, id_cl:id_cl, mont_ch:mont_ch, mont_let:mont_let, pay:pay, action:action},
                success: function(data){
                     $('#message').html(data);
                    
                    $('#form')[0].reset();
                    $('#action').val('ajout');
                    $('#produit').val('Ajouter');
                    $('#hidden_id').val('');

                     load_data();

                    setTimeout(function(){
                            $('#message').empty();
                        },5000);
                   

                    
                }
            });
        }

    });

});
