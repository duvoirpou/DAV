$(document).ready(function(){

    $('#creer').click(function(){

        $('#form_cy')[0].reset();
        $('.modal-title').text('Créer un cycle');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');

    });

    var dataTable = $('#tabCy').DataTable({
        "processing":true,
        "serverSide":true,
        "ajax":{
            url:"liste_cycle.php",
            method: "POST"
        }

    });


    $(document).on('submit','#form_cy', function(event){
        event.preventDefault();

        var lib_cy = $('#lib_cy').val();

        if(lib_cy != '')
        {
            $.ajax({
                url: "action_cycle.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success: function(data)
                {
                    $('#message').html(data);
                    $('#form_cy')[0].reset();
                    dataTable.ajax.reload();
                }
            })
        }
        else
        {
            $('#message').html('<h6 class="text-danger">Remplissez le champs</h6>');
        }

    });


    $(document).on('click', '.edit', function(){
        $('#message').html('');
        var id_cy = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_cycle.php",
            method: "POST",
            data: {id_cy:id_cy,operation:operation},
            dataType: "JSON",
            success: function(data){

                $('#ModalCy').modal('show');
                $('.modal-title').text('Editer un cycle');
                $('#id_cy').val(data.id_cy);
                $('#lib_cy').val(data.lib_cy);
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
            url: "action_cycle.php",
            method: "POST",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success: function(data){

                $('#avert').html('');
                $('#confirmation').html(data);
                dataTable.ajax.reload();

            }
        });

    });

});













