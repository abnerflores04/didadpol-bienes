const formularios_ajax = document.querySelectorAll(".FormulariosAjax");

function enviar_formulario_ajax(e) {
    e.preventDefault();
    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");

    let encabezados = new Headers();
    let config = {
        method: method,
        headers: encabezados,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }
    let texto_alerta;
    if (tipo === "save") {
        texto_alerta = "LOS DATOS QUEDARAN GUARDADOS EN EL SISTEMA"
    } else if (tipo === "delete") {
        texto_alerta = "LOS DATOS SERÁN ELIMINADOS COMPLETAMENTE DEL SISTEMA";
    } else if (tipo === "update") {
        texto_alerta = "LOS DATOS SERÁN ACTUALIZADOS";
    } else if (tipo === "search") {
        texto_alerta = "SE ELIMINARÁ EL TERMINO DE BÚSQUEDA Y TENDRÁS QUE ESCRIBIR UNO NUEVO";
    } else if (tipo === "loans") {
        texto_alerta = "DESEA REMOVER LOS DATOS SELECCIONADOS PARA PRÉSTAMOS O RESERVACIONES";
    } else {
        texto_alerta = "QUIERES REALIZAR LA OPERACIÓN SOLICITADA";
    }
    Swal.fire({
        title: 'ESTAS SEGURO',
        text: texto_alerta,
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            fetch(action, config)
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
        }
    });
}
formularios_ajax.forEach(formularios => {
    /*escuchando o esperando un evento a ejucutar*/
    formularios.addEventListener("submit", enviar_formulario_ajax);
});

function alertas_ajax(alerta) {
    if (alerta.Alerta === "simple") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'ACEPTAR'
        });
    } else if (alerta.Alerta === "recargar") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'ACEPTAR'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    } else if (alerta.Alerta === "limpiar") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            type: alerta.Tipo,
            confirmButtonText: 'ACEPTAR'
        }).then((result) => {
            if (result.value) {
                document.querySelector(".FormulariosAjax").reset();
            }
        });
    } else if (alerta.Alerta === "redireccionar") {
        window.location.href = alerta.URL;
    }

}