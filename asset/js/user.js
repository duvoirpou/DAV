$(document).ready(function(){

	$('.ajout').click(function(){
		
		$('#erreur_user').text('');
		$('#user').css('border-color','');
		$('#erreur_pass').text('');
        $('#pass').css('border-color','');
        $('#erreur_repass').text('');
        $('#repass').css('border-color','');
		$('#erreur_type').text('');
        $('#type').css('border-color','');
	});

	$('#form_user').on('submit', function(event){
        event.preventDefault();
        var erreur_user='';
        var erreur_pass='';
        var erreur_repass='';
        var erreur_type='';
        var erreur_mdp='';
        

        if($('#user').val()==''){
            erreur_user = 'entrez le nom d\'utilisateur';
            $('#erreur_user').text(erreur_user);
            $('#user').css('border-color','#cc0000');
        }
        else
        {
            erreur_user ='';
             $('#erreur_user').text(erreur_user);
             $('#user').css('border-color','');
        }

        if($('#pass').val()==''){
            erreur_pass = 'entrez le mot de passe';
            $('#erreur_pass').text(erreur_pass);
            $('#pass').css('border-color','#cc0000');
        }
        else
        {
            erreur_pass ='';
             $('#erreur_pass').text(erreur_pass);
             $('#pass').css('border-color','');
        }

        if($('#repass').val()==''){
            erreur_repass = 'repetez le mot de passe';
            $('#erreur_repass').text(erreur_repass);
            $('#repass').css('border-color','#cc0000');
        }
        else
        {
            erreur_repass ='';
             $('#erreur_repass').text(erreur_repass);
             $('#repass').css('border-color','');
        }

        if($('#type').val()==''){
            erreur_type = 'selectionnez le type d\'utilisateur';
            $('#erreur_type').text(erreur_type);
            $('#type').css('border-color','#cc0000');
        }
        else
        {
            erreur_type ='';
             $('#erreur_type').text(erreur_type);
             $('#type').css('border-color','');
        }

        
        if(erreur_user=='' && erreur_pass=='' && erreur_repass=='' && erreur_type==''){

        	if($('#pass').val()!=$('#repass').val()){

        		erreur_mdp = 'les mots mots de passe ne correspondent pas';

        		$('#erreur_mdp').text(erreur_mdp);
        	}


        	if($('#pass').val()==$('#repass').val()){

        		$('#erreur_mdp').text('');
       
		            $('#form_action').attr('disebled', 'disebled');
		            var form_data = $(this).serialize();
		       
		            $.ajax({

		                url:"action_user.php",
		                method:"POST",
		                data:form_data,
		                success: function(data){

	                     $('#action_message').html(data);
	                    
	                    $('#form_user')[0].reset();

	                        
	                    setTimeout(function(){
	                            $('#action_message').html('');
	                        },5000);
	                           
	                }
           	    });
		    }        

        }
    });


	$('#userTable').DataTable({
        "processing" : true,
        "serverSide" : true,
        "ajax" : {
            url : "liste_user.php",
            type : "post"
        }

    });

});