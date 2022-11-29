$(document).ready(function () {

    aff();

    function aff() {

        $.ajax({
           url: "affiche_valide.php",
           type: "POST",
           success: function (data) {
               $('#affiche').html(data);
           }
        });

    }

$(document).on('submit','#form_valide', function(event){

    event.preventDefault();

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
        var donnee = $(this).serialize();
        console.log(donnee);

        $.ajax({
            url:"action_vente.php",
            method:"POST",
            data:donnee,
            success: function(data){
                $('#message').html(data);

                $('#form_valide')[0].reset();

                aff();

                setTimeout(function(){
                    $('#message').empty();
                },5000);



            }
        });
    }

    });
});
