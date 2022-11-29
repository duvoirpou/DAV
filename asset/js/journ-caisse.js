$(document).ready(function(){

    afficheJc();

    function afficheJc() {

        $.ajax({
            url:"affiche_journ_caisse.php",
            method:"POST",
            success:function (data) {
                $('tbody').html(data);
            }
        });

    }
    
        $(document).on('submit','#rech_form', function(event){
            
            event.preventDefault();
            var dat = $('#date_sel').val();
            if(dat =='')
            {
                $('#info').text('selectionnez la date');
                $('#date_sel').css('border-color','#cc0000');
            }
            else
            {
                $('#info').text('');
                $('#date_sel').css('border-color','');
            }
            
            if(dat!='')
                {
                    var data = $(this).serialize();
                       console.log(data);         
                    $.ajax({
                        url: "affiche_journ_caisse.php",
                        method:"POST",
                        data: data,
                        success: function(){
                            
                            afficheJc();
                            
                        }
                    });
                }    
            
        
        
        });


});