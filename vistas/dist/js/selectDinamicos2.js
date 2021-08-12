$(function() {
    $("#listas").change(function() {
        $("#listas option:selected").each(function() {
            seccion_id = $(this).val();
            $.post("../modelos/getUnidad.php", {
                seccion_id: seccion_id
            }, function(data) {
                $("#listau").html(data);
            });
        });
    });


});