$(document).ready(function () {

    liste_controle_agent();

  function liste_controle_agent(){

      $.ajax({
          url: "liste_controle_agent.php",
          type: "POST",
          dataType: "JSON",
          success: function(rep){
              $('#liste_presence').html(rep);
          }
      });

  }


$(document).on('submit', '#form', function (e) {
   e.preventDefault()

    var heure = $('#heure').val();
    var mention = $('#mention').val();
    var obs = $('#obs').val();

    if(heure!='' && mention!='' && obs!='')
    {
        $('#info').html('');

        $.ajax({
            url: "action_controle_agent.php",
            method: "POST",
            data: $(this).serialize(),
            success: function(reponse){
                $('#info').html(reponse);
                $('#form')[0].reset();
                liste_controle_agent();
            }
        });
    }
    else
    {
        $('#info').html('<h5 class="alert alert-danger">Remplissez tous les champs</h5>');

    }

});

});