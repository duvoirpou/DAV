$(document).ready(function () {

    afficheFact();

    function afficheFact() {
        $.ajax({
            type: "POST",
            url: "affiche_regl_fact.php",
            success: function (data) {
                $('tbody').html(data);
            }
        });
    }

    $(document).on('click','.regler', function (e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var action = 'afficher';


        $.ajax({
            url:"action_regler_fact.php",
            method:"POST",
            data:{id:id,action:action},
            dataType:"JSON",
            success:function(rep){

                $('#Modregle').modal('show');
                $('#id_cache').val(rep.id_cache);
                $('#id_cmd').val(rep.facture);
                $('#mont_ch').val(rep.montant);
                $('#payer').val(rep.avance);
                $('#reste').val(rep.reste);
                $('#id_cl').val(rep.id_cl);
                $('#action').val('update');

            }
        });

    });

    $(document).on('submit','#form_vrmt', function (event) {

        event.preventDefault();

        var versement = $('#versement').val();

        if(versement=='')
        {
            var versement ='renseignez le champs';

            $('#erreur_vers').text(versement);
            $('#versement').css('border-color','#cc0000');

        }
        else
        {
            $('#erreur_vers').text('');
            $('#versement').css('border-color','');

        }

        if(versement !=''){

            var data = $(this).serialize();
            console.log(data);

            $.ajax({
                url:"action_regler_fact.php",
                method:"POST",
                data:data,
                success: function (response) {

                    $('#message').html(response);
                    $('#form_vrmt')[0].reset();



                }
            });

        }


    });

});