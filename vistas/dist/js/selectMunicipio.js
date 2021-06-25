$(function() {
    $("#depto").change(function() {
        $("#depto option:selected").each(function() {
            depto_id = $(this).val();
            $.post("../modelos/getMunicipios.php", { depto_id: depto_id }, function(data) {
                $("#municipio").html(data);
            });
        });
    })
});