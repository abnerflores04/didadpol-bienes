<script>
    let btnSalir = document.querySelector(".btn-exit-system");
    btnSalir.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿QUIERES SALIR DEL SISTEMA?',
            text: "LA SESIÓN ACTUAL SE CERRARÁ Y SALDRÁS DEL SISTEMA",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SALIR',
            cancelButtonText: 'NO, CANCELAR'
        }).then((result) => {
            if (result.value) {

                let url = '<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo $lc->encryption($_SESSION['token_spm']); ?>';
                let usuario = '<?php echo $lc->encryption($_SESSION['usuario_spm']); ?>';

                let datos = new FormData();
                datos.append("token", token);
                datos.append("usuario", usuario);

                fetch(url, {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        return alertas_ajax(respuesta);
                    });
            }
        });
    });
</script>