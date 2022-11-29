function selectDate() {
    var date_dep = document.getElementById("date_dep").value;

    $.ajax({
        url: "action_depense_date.php",
        type: "POST",
        dataType: "JSON",
        data: {
            date_dep: date_dep
        },
        success: function (data) {

            $('#content').html(data);

        }
    });
}
