$(document).ready(function () {
    afficher_depense();
    function afficher_depense(){
        $.ajax({
            url:"afficher_depense.php",
            type: "POST",
            success: function (data) {

                $('tbody').html(data);

            }
        });
    }

    $(document).on('submit','#depense', function (e) {
        e.preventDefault();
        var libelle = $('#libelle').val();
        var montant = $('#montant').val();

        if(libelle !='' && montant !='')
        {
            $.ajax({
                url: "action_saisir_depense.php",
                method: "POST",
                data: $(this).serialize(),
                success: function (rep) {
                    $('#depense')[0].reset();
                    $('#msg').html(rep)
                    afficher_depense();

                }
            })
        }
        else
        {
            $('#msg').html('<h6 class="alert alert-danger">Tous les doivent être remplis !</h6>')
        }
    });
});