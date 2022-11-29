$(document).ready(function() {

    $(document).on('submit', '#form', function(e) {
        e.preventDefault();
        var donnee = $(this).serialize();
        $.ajax({
            url: "action_recouv.php",
            method: "POST",
            data: donnee,
            dataType: "JSON",
            success: function(data) {

                $('#contenu').html(data);


            }
        });

    });

});