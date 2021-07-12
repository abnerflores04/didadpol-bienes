<?php
if ($peticionAjax) {
    require_once "../modelos/reporteModelo.php";
} else {
    require_once "./modelos/reporteModelo.php";
}
class reportesControlador extends reporteModelo
{
    // Controlador para listar los reportes de expediente
    public function listar_exp_reportes()
    {
        $tabla = '';
        $consulta = "SELECT * FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id=te.exp_id INNER JOIN tbl_usuario tu  ON teu.usu_id=tu.usu_id WHERE teu.usu_id= $_SESSION[id_spm]";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta2 = "SELECT * FROM tbl_feriado ORDER BY feriado_fecha ASC";
        $conexion = mainModel2::conectar();
        $datos2 = $conexion->query($consulta2);
        $datos2 = $datos2->fetchAll();
        foreach ($datos2 as $rows2) {
            array_push($feriados, $rows2['feriado_fecha']);
        }


        $tabla .= '<div class="table-responsive">
        <br><br>
        <table id="example1" class=" table table-striped table-bordered">

            <thead style="vertical-align:middle;">
                <tr>
                <th style="vertical-align:middle;">N° EXPEDIENTE</th>
    
                <th style="vertical-align:middle;">FECHA CONOCIMIENTO DIDADPOL</th>
                <th style="vertical-align:middle;">FECHA FINAL EXPEDIENTE </th>
                <th style="vertical-align:middle;">VIGENCIA DEL EXPEDIENTE </th>
                <th style="vertical-align:middle;">VIGENCIA PROCESO INVESTIGACION </th>
                <th style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $dias = mainModel2::getWorkingDays(date('Y-m-d'), $rows['fecha_final_exp'], $feriados);
            $dias2 = mainModel2::getWorkingDays(date('Y-m-d'), $rows['fecha_final_i'], $feriados);

            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';



            $tabla .= ' 
                
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_inicio_exp'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';

            if ($dias >= 60) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-success">';
                $dias = $dias . ' DÍAS';
            } elseif ($dias >= 40 && $dias <= 59) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-warning">';
                $dias = $dias . ' DÍAS';
            } elseif ($dias >= 1 && $dias <= 39) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                $dias = $dias . ' DÍAS';
            } elseif ($dias2 <= 0) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                $dias = 'PLAZO TERMINADO';
            }

            $tabla .= '<span class="badge badge badge-dark">' . $dias . '</span></td>';

            if ($dias2 >= 21) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-success">';
                $dias2 = $dias2 . ' DÍAS';
            } elseif ($dias2 >= 6 && $dias2 <= 20) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-warning">';
                $dias2 = $dias2 . ' DÍAS';
            } elseif ($dias2 >= 1 && $dias2 <= 5) {
                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-danger">';
                $dias2 = $dias2 . ' DÍAS';
            } elseif ($dias2 <= 0) {

                $tabla .= '<td  style="font-size: 20px;"class=" text-center bg-secondary">';
                $dias2 = 'PLAZO TERMINADO';
            }
            $tabla .= '<span class="badge badge badge-dark">' . $dias2 . '</span></td>
                ';



            $tabla .= '  <td>
                <div class="row">
                    <a href="' . SERVERURL . 'ver-info-exp-i/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-dark btn-sm" title="Ver información completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>
                </div>
            </td> 
            </tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
}