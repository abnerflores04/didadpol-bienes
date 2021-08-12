<?php
if ($peticionAjax) {
    require_once "../modelos/feriadosModelo.php";
} else {
    require_once "./modelos/feriadosModelo.php";
}
class feriadosControlador extends feriadosModelo
{
    /* controlador agregar usuario*/
    public function agregar_feriados_controlador()
    {
        $fecha_feriado = $_POST['fecha_feriado_reg'];
        $descrip_feriado = strtoupper(mainModel2::limpiar_cadena($_POST['descrip_feriado_reg']));


        /*comprobar campos vacios*/
        if ($fecha_feriado == "" || $descrip_feriado == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*validar fecha*/
        $check_fecha = mainModel2::ejecutar_consulta_simple("SELECT fecha FROM tbl_feriados WHERE fecha='$fecha_feriado'");
        if ($check_fecha->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "LA FECHA DEL FERIADO QUE INGRESO YA ENCUENTRA REGISTRADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ0-9- ]{3,200}", $descrip_feriado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO DESCRIPCIÓN SOLO PUEDE INCLUIR LETRAS Y NUMEROS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_feriado_reg = [
            "fecha_feriado" => $fecha_feriado,
            "descrip_feriado" => $descrip_feriado
        ];
        $agregar_feriado = feriadosModelo::agregar_feriado_modelo($datos_feriado_reg);
        if ($agregar_feriado->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "FERIADO REGISTRADO",
                "Texto" => "LOS DATOS DEL FERIADO SE HAN REGISTRADO CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO REGISTRAR EL FERIADO",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*fin controlador */
    /* controlador para listar usuarios*/
    public function listar_feriados_controlador()
    {
        $tabla = '';
        $consulta = "SELECT * FROM tbl_feriados";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-feriados/" class="btn btn-primary">
        <i class="far fa-calendar-plus"></i>   Agregar feriado
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered ">

            <thead style="vertical-align:middle;">
                <tr>
                <th class="text-center" style="vertical-align:middle;">N°</th>
                <th class="text-center" style="vertical-align:middle;">DESCRIPCIÓN DEL FERIADO</th>
                <th class="text-center" style="vertical-align:middle;">FECHA DEL FERIADO</th>               
                <th class="text-center" style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';
        $c = 1;
        foreach ($datos as $rows) {

            $tabla .= '<tr>
                <td class="text-center">' . $c . '</td>
                <td>' . $rows['descripcion'] . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha'])) . '</td>
    
              <td>
                <div class="row">
                    <a href="' . SERVERURL . 'actualizar-feriados/' . mainModel2::encryption($rows['feriado_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/feriadosAjax.php" method="POST" data-form="delete" autocomplete="off" style="margin: 0 auto;">
                        <input type="hidden" name="id_feriado_del" value="' . mainModel2::encryption($rows['feriado_id']) . '">

                        <button type="submit" title="Eliminar" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>

                    </form>
                </div>
            </td> 
            </tr>';
            $c++;
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }/*fin controlador */
    public  function datos_feriado_controlador($tipo, $id)
    {
        $tipo = mainModel2::limpiar_cadena($tipo);
        $id = mainModel2::decryption($id);
        $id = mainModel2::limpiar_cadena($id);
        return feriadosModelo::datos_feriado_modelo($tipo, $id);
    }/* fin controlador datos del usuario */
    public  function actualizar_feriados_controlador()
    {
        //Recibiendo el id 
        $id = mainModel2::decryption($_POST['id_feriado_up']);
        $id = mainModel2::limpiar_cadena($id);
        //comprobar el rol
        $check_feriado = mainModel2::ejecutar_consulta_simple("SELECT * FROM tbl_feriados WHERE feriado_id=$id");
        if ($check_feriado->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE ENCONTRO FERIADO",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_feriado->fetch();
        }

        $fecha_feriado = $_POST['fecha_feriado_up'];
        $descrip_feriado = strtoupper(mainModel2::limpiar_cadena($_POST['descrip_feriado_up']));

        /*verificando datos vacios*/
        if ($fecha_feriado == "" || $descrip_feriado == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO HAS COMPLETADO TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚáéíóúñÑ0-9- ]{3,200}", $descrip_feriado)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "EL CAMPO DESCRIPCIÓN SOLO PUEDE INCLUIR LETRAS Y NUMEROS",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*validar usuario*/
        if ($fecha_feriado != $campos['fecha']) {
            $check_fecha_f = mainModel2::ejecutar_consulta_simple("SELECT fecha FROM tbl_feriados WHERE fecha='$fecha_feriado'");
            if ($check_fecha_f->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                    "Texto" => "EL FERIADO YA ESTÁ REGISTRADO",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $datos_feriado_up = [
            "feriado_id" => $id,
            "fecha_feriado" => $fecha_feriado,
            "descrip_feriado" => $descrip_feriado
        ];

        if (feriadosModelo::actualizar_feriado_modelo($datos_feriado_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "ACTUALIZADO CON ÉXITO",
                "Texto" => "LOS DATOS SE ACTUALIZARON CON ÉXITO",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                "Texto" => "NO SE HA PODIDO ACTUALIZAR LOS DATOS",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/* fin controlador actualizar usuario */
    /*controlador para eliminar feriado*/
  public  function eliminar_feriado_controlador()
  {
      /* recibiendo id */
      $id = mainModel2::decryption($_POST['id_feriado_del']);
      $id = mainModel2::limpiar_cadena($id);
      /* comprobando el feriado en bd */
      $check_feriado = mainModel2::ejecutar_consulta_simple("SELECT feriado_id FROM tbl_feriados WHERE feriado_id='$id'");
      if ($check_feriado->rowCount() <= 0) {
          $alerta = [
              "Alerta" => "simple",
              "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
              "Texto" => "EL FERIADO QUE INTENTA ELIMINAR NO EXISTE EN EL SISTEMA",
              "Tipo" => "error"
          ];
          echo json_encode($alerta);
          exit();
      }
     
      $eliminar_feriado = feriadosModelo::eliminar_feriado_modelo($id);
      if ($eliminar_feriado->rowCount() == 1) {
          $alerta = [
              "Alerta" => "recargar",
              "Titulo" => "FERIADO ELIMINADO",
              "Texto" => "EL FERIADO HA SIDO ELIMINADO CON ÉXITO",
              "Tipo" => "success"
          ];
      } else {
          $alerta = [
              "Alerta" => "simple",
              "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
              "Texto" => "NO HEMOS PODIDO ELIMINAR EL FERIADO, POR FAVOR INTENTE NUEVAMENTE",
              "Tipo" => "error"
          ];
      }
      echo json_encode($alerta);
  }/* fin controlador para eliminar rol */
}/* fin clase */
