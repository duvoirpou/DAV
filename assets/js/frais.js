$(document).ready(function() {

    $('#inscrire').click(function() {
        $('#form_frais')[0].reset();
        $('.modal-title').text('ajouter les frais');
        $('#action').val("valider");
        $('#operation').val("ajouter");
        $('#message').html('');
    });

    var dataTable = $('#tabFrais').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "liste_frais.php",
            type: "POST"
        }
    });


    $(document).on('submit', '#form_frais', function(e) {
        e.preventDefault();

        var id_niv = $('#id_niv').val();
        var id_freq = $('#id_freq').val();
        var insc_ch = $('#insc_ch').val();
        var reinsc_ch = $('#reinsc_ch').val();
        var centre = $('#centre').val();
        var fr_ecolage = $('#fr_ecolage').val();

        if (id_niv != '' && id_freq != '' && insc_ch != '' && reinsc_ch != '' && centre != '' && fr_ecolage != '') {

            var data = $(this).serialize();
            $.ajax({
                url: "action_frais.php",
                method: "POST",
                data: data,
                success: function(rep) {

                    $('#message').html(rep);
                    $('#form_frais')[0].reset();
                    dataTable.ajax.reload();

                }
            });
        } else {
            $('#message').html('<h5 class="text-danger">Remplissez tous les champs</h5>');
        }
    });


    $(document).on('click', '.edit', function() {
        $('#message').html('');
        var code = $(this).attr('id');

        var operation = 'afficher';

        $.ajax({
            url: "action_frais.php",
            method: "POST",
            data: { code: code, operation: operation },
            dataType: "JSON",
            success: function(rep) {
                $('#modalFrais').modal('show');
                $('#code').val(rep.code);
                $('#id_niv').val(rep.id_niv);
                $('#id_freq').val(rep.id_freq);
                $('#insc_ch').val(rep.insc_ch);
                $('#centre').val(rep.centre);
                $('#reinsc_ch').val(rep.reinsc_ch);
                $('#fr_ecolage').val(rep.fr_ecolage);
                $('.modal-title').text('modifier les frais');
                $('#action').val("valider");
                $('#operation').val("modifier");

            }

        });

    });





});