$(function() {
    $("#lista1").change(function() {
        $("#lista1 option:selected").each(function() {
            seccion_id = $(this).val();
            $.post("../modelos/getUnidad.php", { seccion_id: seccion_id }, function(data) {
                $("#lista2").html(data);
            });
        });
    })
});