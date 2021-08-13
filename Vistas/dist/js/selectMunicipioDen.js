$(function() {
    $("#lista_den").change(function() {
        $("#lista_den option:selected").each(function() {
            depto_id = $(this).val();
            $.post("../modelos/getMunicipiosDen.php", { depto_id: depto_id }, function(data) {
                $("#lista_mden").html(data);
            });
        });
    })
});