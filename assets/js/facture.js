function imprAch(){
            var id_liv = str;
        
            $.ajax({
                type: "POST",
                url: "print_ach.php",
                data:"id_liv="+id_liv,
                success: function(data){
                    alert('id_liv');
                   
                }

            });
        }


       
