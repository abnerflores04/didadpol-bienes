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
          $check_fecha = mainModel2::ejecutar_consulta_simple("SELECT feriado_fecha FROM tbl_feriado WHERE feriado_fecha='$fecha_feriado'");
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
  
          if (mainModel2::verificar_datos("[A-ZÁÉÍÓÚÑÜ0-9 ]{3,200}", $descrip_feriado)) {
              $alerta = [
                  "Alerta" => "simple",
                  "Titulo" => "OCURRIÓ UN ERROR INESPERADO",
                  "Texto" => "EL CAMPO DESCRIPCION DE FERIADO SOLO DEBE INCLUIR LETRAS DEBE TENER UN MÍNIMO DE 3 LETRAS",
                  "Tipo" => "error"
              ];
              echo json_encode($alerta);
              exit();
          }
  
          $datos_feriado_reg = [
              "fecha_feriado" => $fecha_feriado,
              "descrip_feriado"=>$descrip_feriado
          ];
          $agregar_feriado = feriadosModelo::agregar_feriado_modelo($datos_feriado_reg);
          if ($agregar_feriado->rowCount() == 1) {
              $alerta = [
                  "Alerta" => "limpiar",
                  "Titulo" => "feriado REGISTRADO",
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
    
    public function listar_feriados_controlador()
    {
        $tabla = '';
        $consulta = "SELECT * FROM tbl_feriado";
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
        $c=1;
        foreach ($datos as $rows) {
            
            $tabla .= '<tr>
                <td class="text-center">' . $c . '</td>
                <td>' . $rows['feriado_descrip'] . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['feriado_fecha'] )). '</td>
    
              <td>
                <div class="row">
                    <a href="' . SERVERURL . 'actualizar-feriados/' . mainModel2::encryption($rows['id_feriado']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="FormulariosAjax" action="' . SERVERURL . 'ajax/feriadosAjax.php" method="POST" data-form="delete" autocomplete="off" style="margin: 0 auto;">
                        <input type="hidden" name="id_feriado_del" value="' . mainModel2::encryption($rows['id_feriado']) . '">

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
    }

}/* fin clase */
