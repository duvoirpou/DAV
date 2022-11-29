$(document).ready(function () {

    afficher_commande();

    var dataTable = $('#affiche_produit').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "produit_commande.php",
            type: "post"
        }

    });


    function afficher_commande (){
         $.ajax({
             url: "commande.php",
             method: "POST",
             success: function (data) {
                 $('#commande').html(data);
             }
         });
    }


    $(document).on('click', '.commander', function () {
        $('#msg').html("");
        $('#message').html("");
        $('#btn_print').html("");
        var id_prod=$(this).attr('id');

         $.ajax({
             url: "select_produit.php",
             method: "POST",
             data: {
                 id_prod: id_prod
             },
             dataType: "JSON",
             success: function (rep) {

                 $('#id_prod').val(rep.id_prod);
                 $('#prix').val(rep.prix);
                 $('#produit').val(rep.description);
                 $('#modalCmd').modal('show');

             }
         });


       });


       $(document).on('submit', '#form', function(ev){

        ev.preventDefault();

        var qte = $('#qte').val();
        var id_prod = $('#id_prod').val();
        var prix = $('#prix').val();

        if (qte != '' && id_prod != '' && prix != '')
        {
             var data = $(this).serialize();
            
             $.ajax({
                 url: "panier.php",
                 method: "POST",
                 data: data,
                 success: function (response) {
                     $('#modalCmd').modal('hide');
                     $('#msg').html(response);
                     $('#form')[0].reset();
                      afficher_commande();



                 }
             });

        }
        else
        {
            $('#msg').html('<div class="text-danger">Remplissez tous les champs</div>'); 
        }

       });


       $(document).on('click', '.supprimer', function () {

           var id_panier = $(this).attr('id');
           var action ='supprimer';
            console.log(id_panier);

           $.ajax({
               url: "panier.php",
               method: "POST",
               data: {
                   id_panier: id_panier, action: action
               },
               
               success: function (rep) {

                 afficher_commande();
                 

               }
           });


       });


       $(document).on('submit', '#valider', function (ev) {

           ev.preventDefault();

           var description = $('#description').val();
           var qte = $('#qte').val();
           var pu = $('#pu').val();
           var pt = $('#pt').val();
           var total = $('#total').val();

           if (qte != '' && pu != '' && pt != '' && total != '' && description !='') {
               var data = $(this).serialize();

               $.ajax({
                   url: "validation.php",
                   method: "POST",
                   data: data,
                   dataType:"JSON",
                   success: function (response) {

                       $('#message').html(response.message);
                       $('#btn_print').html(response.bouton);
                       $('#form')[0].reset();
                       afficher_commande();
                       

                   }
               });

           }
           else{
               $('#message').html('<div class="text-danger">Validation impossible, la commande est vide</div>'); 
           }

       });


       $(document).on('click', '#annuler',function(){

           
            var action = 'annuler';


            $.ajax({
                url: "panier.php",
                method: "POST",
                data: {
                   
                    action: action
                },

                success: function (rep) {

                    afficher_commande();


                }
            });

       });

    $(document).on('click' ,'.impr', function () {
        var printdata = $(this).attr('id');
        $.post('recu.php', printdata, function () {
        });
        return false;
    });
   


});


