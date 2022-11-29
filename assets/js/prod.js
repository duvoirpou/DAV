$(document).ready(function(){

     $('#prod-edit').on('submit', function(e){
            e.preventDefault();
            
            var id_prod = $('#id_prod').val();
            var desc = $('#desc').val();
            var id_cat = $('#id_cat').val();
            var prix = $('#prix').val();
            

            $.ajax({
                type: "POST",
                url: "server.php?p=edit",
                data:{desc:desc, id_cat:id_cat, prix:prix, id_prod:id_prod},
                dataType:'JSON',
                success: function(data){

                    afficheProd();
                }

            });

        });    

});