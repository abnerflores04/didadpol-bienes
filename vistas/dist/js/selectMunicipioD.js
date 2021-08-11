$(function() {
    $("#lista_dd").change(function() {
        $("#lista_dd option:selected").each(function() {
            depto_id = $(this).val();
            $.post("../modelos/getMunicipiosD.php", { depto_id: depto_id }, function(data) {
                $("#lista_md").html(data);
            });
        });
    })
});