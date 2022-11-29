$(document).ready(function(){

    afficher_produit();

    var dataTable = $('#produits').DataTable(); 

    function afficher_produit()
    {
        $.ajax({
            url: 'server_side/affiche_produit_categorie.php',
            type: 'POST',
            success : function(rep)
            {
                $('#liste_prod').html(rep);
            }
        })
    }


    $(document).on('click', '#add',function(){
        $('#Modal_prod').modal('show');
        $('.modal-title').text('Ajouter un produit');

        $('#erreur_produit').text('');
        $('#description').css('border-color', '');

        $('#erreur_cat').text('');
        $('#id_cat').css('border-color', '');

        $('#erreur_prix').text('');
        $('#prix').css('border-color', '');
    });

    $('#form_prod').on('submit', function(event){
        event.preventDefault();
        var erreur_produit='';
        var erreur_cat='';
        var erreur_prix='';

        if($('#description').val()==''){
            erreur_produit = 'le nom du produit requis';
            $('#erreur_produit').text(erreur_produit);
            $('#description').css('border-color','#cc0000');
        }
        else
        {
            erreur_produit ='';
             $('#erreur_produit').text(erreur_produit);
            $('#description').css('border-color','');
        }

        if($('#id_cat').val()==''){
            erreur_cat = 'selectionnez la catégorie';
            $('#erreur_cat').text(erreur_cat);
            $('#id_cat').css('border-color','#cc0000');
        }
        else
        {
            erreur_cat ='';
             $('#erreur_cat').text(erreur_cat);
             $('#id_cat').css('border-color','');
        }

        if($('#prix').val()==''){
            erreur_prix = 'le prix du produit requis';
            $('#erreur_prix').text(erreur_prix);
            $('#prix').css('border-color','#cc0000');
        }
        else
        {
            erreur_prix ='';
             $('#erreur_prix').text(erreur_prix);
             $('#prix').css('border-color','');
        }

        if(erreur_produit=='' && erreur_cat=='' && erreur_prix==''){

           
           // $('#form_action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({

                url:"server_side/action_produit.php",
                method:"POST",
                data:form_data,
                success: function(data){
                     $('#message').html(data);
                    
                    $('#form_prod')[0].reset();

                    dataTable.ajax.reload();


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
            url:"action_produit.php",
            method: "POST",
            data: {id:id, action:action},
            dataType: "JSON",
            success: function(reponse){
                $('#desc').val(reponse.desc);
                $('#id_cat').val(reponse.id_cat);
                $('#prix').val(reponse.prix);
                $('#user_dialog').attr('title','Modif produit');
                $('#action').val('modifier');
                $('#hidden_id').val(id);
                $('#form_action').val('Modifier');
                $('#user_dialog').dialog('open');
                
            }
        });
    });


});

    