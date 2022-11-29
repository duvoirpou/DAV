$(document).ready(function () {
    $(document).on('submit', '#form', function (e) {
        e.preventDefault();

        var id_matiere = $('#id').val();
        var id_classe = $('#id_classe').val();
        var id_trim = $('#id_trm').val();
        var id_cont = $('#id_cont').val();
        var annee_scolaire = $('#annee_scolaire').val();

        if (id_matiere != '' && id_classe != '' && id_trim != '' && id_cont != '' && annee_scolaire != '') {
            $('#info').html('');

            $.ajax({
                url: "action_notes_eval.php",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (reponse) {
                    $('#contenu').html(reponse);
                }
            });
        } else {
            $('#info').html('<h5 class="text-danger">remplissez tous les champs</h5>');
        }
    });
});