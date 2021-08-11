$(function() {
    $("#lista_di").change(function() {
        $("#lista_di option:selected").each(function() {
            depto_id = $(this).val();
            $.post("../modelos/getMunicipiosI.php", { depto_id: depto_id }, function(data) {
                $("#lista_mi").html(data);
            });
        });
    })
});