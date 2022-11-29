

function selectClasse(){
    var id_classe = document.getElementById("id_classe").value;
    var operation = 'classe';
    $.ajax({
        url: "emptemps_classe.php",
        type: "POST",
        dataType: "JSON",
        data: {id_classe:id_classe, action: operation},
        success: function(data){

            $('#content').html(data);

        }
    });
}

function selectProf(){
    var matricule = document.getElementById("matricule_prof").value;
    var operation = 'prof';
    $.ajax({
        url: "emptemps_prof.php",
        type: "POST",
        dataType: "JSON",
        data: {matricule:matricule, action: operation},
        success: function(data){

            $('#content').html(data);

        }
    });
}


function imprime(){

    window.print();
}

