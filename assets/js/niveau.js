$(document).ready(function(){

    $('#creer').click(function(){

        $('#niv_form')[0].reset();
        $('.modal-title').text('Créer un niveau');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');


    });

    var dataTable = $('#tNiveau').DataTable({
        "processing":true,
        "serverSide":true,
        "ajax":{
            url:"list_niv.php",
            method: "POST"
        }
        
    });


    $(document).on('submit','#niv_form', function(event){
        event.preventDefault();

        var lib_niv = $('#lib_niv').val();
        
        var id_cy = $('#id_cy').val();


        if(lib_niv != '' && id_cy != '')
        {
            $.ajax({
                url: "action_niveau.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success: function(data)
                {
                    $('#message').html(data);
                    $('#niv_form')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        }
        else
        {
            $('#message').html('<h6 class="text-danger">Remplissez tous les champs</h6>');
        }

    });


    $(document).on('click', '.edit', function(){
        $('#message').html('');
        var niveau_id = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_niveau.php",
            method: "POST",
            data: {niveau_id:niveau_id,operation:operation},
            dataType: "JSON",
            success: function(data){

                $('#matModal').modal('show');
                $('.modal-title').text('Editer un niveau');
                $('#niveau_id').val(data.id_niv);
                $('#lib_niv').val(data.lib_niv);
                
                $('#id_cy').val(data.id_cy);
                $('#action').val("Modifier");
                $('#operation').val("modifier");

            }
        });

    });

    $(document).on('click', '.suppr', function(){
        var id = $(this).attr("id");
        $('#id_conf').val(id);
        $('#supprModal').modal('show');

    });

    $(document).on('submit', '#confirm', function (e) {
        e.preventDefault();
        $.ajax({
            url: "action_niveau.php",
            method: "POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success: function(data){


                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});












