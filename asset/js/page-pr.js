function next(str){
            var n = str;
            $.ajax({
                type: "GET",
                url: "server.php",
                data: "n="+n,
                success: function(data){
                    afficheProd();
                } 

            }); 
        }