$(document).ready(function(){

    $('#creer').click(function(){

        $('#form_exam')[0].reset();
        $('.modal-title').text('Créer un examen');
        $('#action').val("ajouter");
        $('#operation').val("ajouter");
        $('#message').html('');


    });

    var dataTable = $('#tabEx').DataTable({
        "processing":true,
        "serverSide":true,
        "ajax":{
            url:"liste_examen.php",
            method: "POST"
        }

    });


    $(document).on('submit','#form_exam', function(event){
        event.preventDefault();

        var libelle = $('#libelle').val();
        var abr = $('#abr').val();

        if(libelle != '' && abr != '')
        {
            $.ajax({
                url: "action_examen.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success: function(data)
                {
                    $('#message').html(data);
                    $('#form_exam')[0].reset();
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
        var id_examen = $(this).attr("id");
        var operation = 'afficher';
        $.ajax({
            url: "action_examen.php",
            method: "POST",
            data: {id_examen:id_examen,operation:operation},
            dataType: "JSON",
            success: function(data){

                $('#ModalExam').modal('show');
                $('.modal-title').text('Editer un examen');
                $('#id_examen').val(data.id_examen);
                $('#libelle').val(data.libelle);
                $('#abr').val(data.abr);
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
            url: "action_examen.php",
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













