$(document).ready(function(){

 $('#login_form').on('submit', function(event){
        event.preventDefault();
        var erreur_user='';
        var erreur_pass='';
        

        if($('#user').val()==''){
            erreur_user = 'indiquez le nom d\'utilsateur';
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
            erreur_pass = 'indiquez le mot de pass';
            $('#erreur_pass').text(erreur_pass);
            $('#pass').css('border-color','#cc0000');
        }
        else
        {
            erreur_pass ='';
             $('#erreur_pass').text(erreur_pass);
             $('#pass').css('border-color','');
        }

        
        if(erreur_user=='' && erreur_pass==''){
       
           
            var form_data = $(this).serialize();
            console.log(form_data);
            $.ajax({

                url:"index.php",
                method:"POST",
                data:form_data,
                success: function(data){

                     $('#message').html(data);
                    
                    $('#login_form')[0].reset();

                    
                        
                    setTimeout(function(){
                            $('#message').empty();
                        },5000);
                           
                }
            });
        }
    });
  
});
   

