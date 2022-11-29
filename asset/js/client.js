$(document).ready(function(){
    
    afficheClient();


        function afficheClient(){
            $.ajax({
                url: "affiche_client.php",
                method: "POST",
                success: function(data){
                    $('tbody').html(data);
                }
            });
        }

       $('#client_dialog').dialog({
        autoOpen:false,
        width: 400
    });    

    $('#ajouter').click(function(){
        $('#client_dialog').attr('title','Ajout client');
        $('#action').val('insert');
        $('#form_action').val('ajouter');
        $('#client_form')[0].reset();
        $('#form_action').attr('disabled', false);
        $('#client_dialog').dialog('open');
    });

    $('#client_form').on('submit', function(event){
        event.preventDefault();
        var erreur_cat='';
        

        if($('#nom').val()==''){
            erreur_nom = 'le nom du client requis';
            $('#erreur_nom').text(erreur_nom);
            $('#nom').css('border-color','#cc0000');
        }
        else
        {
            erreur_nom ='';
             $('#erreur_nom').text(erreur_nom);
             $('#nom').css('border-color','');
        }

        if($('#tel').val()==''){
            erreur_tel = 'Indiquez le numero de téléphone';
            $('#erreur_tel').text(erreur_tel);
            $('#tel').css('border-color','#cc0000');
        }
        else
        {
            erreur_tel ='';
             $('#erreur_tel').text(erreur_tel);
             $('#tel').css('border-color','');
        }

        
        if(erreur_nom=='' && erreur_tel==''){
       
            $('#form_action').attr('disebled', 'disebled');
            var form_data = $(this).serialize();
         
            $.ajax({

                url:"action_client.php",
                method:"POST",
                data:form_data,
                success: function(data){

                     $('#action_alert').append('<div class="text-success">'+data+'</div>');
                    
                    $('#client_form')[0].reset();

                        afficheClient();
                        
                    setTimeout(function(){
                            $('#action_alert').empty();
                        },5000);
                           
                }
            });
        }
    });



    $(document).on('click','.edit', function(){
        var id = $(this).attr('id');
        var action = 'afficher';
        $.ajax({
            url:"action_client.php",
            method: "POST",
            data: {id:id, action:action},
            dataType: "JSON",
            success: function(reponse){
                $('#nom').val(reponse.nom);
                $('#tel').val(reponse.tel);
                $('#client_dialog').attr('title','Modif categorie');
                $('#action').val('modifier');
                $('#hidden_id').val(id);
                $('#form_action').val('Modifier');
                $('#client_dialog').dialog('open');
                
            }
        });
    });
jQuery(document).ready(function(){
    jQuery("#target-content").load("affiche_client.php?page=1");
    jQuery("#pagination li").on('click',function(e){
    e.preventDefault();    
    
    jQuery('#target-content').html('loading...');
    jQuery("#pagination li").removeClass('active');
    jQuery(this).addClass('active');
    var pageNum = this.id;        
    jQuery('#target-content').load('affiche_client.php?page='+pageNum);  

    }); 

    });                                                                                          
    
});

