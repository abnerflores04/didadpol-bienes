$(function() {
    $('.lista_a').select2();
    $('.lista_a').select2({
        width: 'resolve',
        theme: 'bootstrap4',

    });
    $("#lista_f").change(function() {
        $("#lista_f option:selected").each(function() {
            tipo_falta_id = $(this).val();
            $.post("../modelos/getArticulos.php", { tipo_falta_id: tipo_falta_id }, function(data) {
                $("#lista_a").html(data);
            });
        });
    })
});