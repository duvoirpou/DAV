$(document).ready(function() {

    var dataTable = $('#tabRepart').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_repart_prg.php",
            type: "POST"
        }
    });


    $('#creer').click(function() {
        $('#form_prg')[0].reset();
        $('.modal-title').text('Repartir le programme de cours');
        $('#action').val("Valider");
        $('#operation').val("ajouter");
        $('#info').html('');
    });


    $(document).on('submit', '#form_prg', function(e) {
        e.preventDefault();


        var id_trim = $('#id_trim').val();
        var mois = $('#mois').val();
        var semaine = $('#semaine').val();
        var id_prog = $('#id_prog').val();


        if(id_trim!='' && mois!='' && semaine!='' && id_prog!='' ) {
            $.ajax({
                url: "action_repart_prg.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#form_prg')[0].reset();
                    $('#info').html(data);
                    dataTable.ajax.reload();

                }
            });
        }
        else
        {
            $('#info').html('<h5 class="text-danger">remplissez tous les champs</h5>');
        }

    });

    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        $('#info').html('');
        var id_rep = $(this).attr('id');
        var operation = 'afficher';
        $.ajax({
            url: "action_repart_prg.php",
            method: "POST",
            data: {id_rep:id_rep, operation:operation},
            dataType: "JSON",
            success: function(rep){

                $('#ModalPrg').modal('show');
                $('.modal-title').text('Modifier la repartition');
                $('#operation').val("modifier");
                $('#id_rep').val(rep.id_rep);
                $('#id_trim').val(rep.id_trim);
                $('#mois').val(rep.mois);
                $('#semaine').val(rep.semaine);
                $('#id_prog').val(rep.id_prog);
            }
        })
    })

});