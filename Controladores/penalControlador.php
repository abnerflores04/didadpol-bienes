<?php
if ($peticionAjax) {
    require_once "../modelos/penalModelo.php";
} else {
    require_once "./modelos/penalModelo.php";
}
class penalControlador extends penalModelo
{
/* controlador para listar expedientes penal*/

    public function listar_exp_penal_controlador()
    {
        $tabla = '';
        $consulta = "SELECT p.proc_penal_id, p.nombre_procesado, p.delitos, p.victimas, f.descrip_fiscalia, j.descrip_juzg_tribu, p.exp_judicial, e.descrip_est_lab, p.fec_hechos, p.fec_ultima_act, p.descrip_ultima_act, p.est_proceso, p.oficio_solicitud FROM tbl_proc_penal p INNER JOIN tbl_fiscalia f ON p.fiscalia_id = f.fiscalia_id INNER JOIN tbl_juzg_tribu j ON j.juzg_tribu_id = p.juzg_tribu_id INNER JOIN tbl_est_lab e ON e.est_lab_id = p.est_lab_id";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        
        $tabla .= '<div class="table-responsive">

        <a href="' . SERVERURL . 'registro-exp-investigacion/" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Expediente
        </a>


        <br><br>
        <table id="example1" class=" table table-striped table-bordered">

            <thead style="vertical-align:middle;">
                <tr>
                <th style="vertical-align:middle;">N° EXPEDIENTE</th>
    
                <th style="vertical-align:middle;">NOMBRE DEL PROCESADO</th>
                <th style="vertical-align:middle;">DELITO</th>
                <th style="vertical-align:middle;">VICTIMA</th>
                <th style="vertical-align:middle;">FISCALIA</th>
                <th style="vertical-align:middle;">JUZGADO/TRIBUNAL</th>
                <th style="vertical-align:middle;">EXPEDIENTE JUDICIAL</th>
                <th style="vertical-align:middle;">ESTADO LABORAL</th>
                <th style="vertical-align:middle;">DESCRIPCION DE ESTADO LABORAL</th>
                <th style="vertical-align:middle;">FECHA DE LOS HECHOS</th>
                <th style="vertical-align:middle;">FECHA DE LA ULTIMA ACTUACION</th>
                <th style="vertical-align:middle;">DESCRIPCION ULTIMA ACTUACION</th>
                <th style="vertical-align:middle;">ESTADO DEL PROCESO</th>
                <th style="vertical-align:middle;">OFICIO DE SOLICITUD</th>
                <th style="vertical-align:middle;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['proc_penal_id'] . '</span></td>';

            $tabla .= '<td class="text-center">' . $rows['nombre_procesado'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['delitos'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['victimas'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['descrip_fiscalia'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['descrip_juzg_tribu'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['exp_judicial'] . '</td>';

            $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_hechos'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fec_ultima_act'])) . '</td>';
                
            $tabla .= '<td class="text-center">' . $rows['descrip_ultima_act'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['est_proceso'] . '</td>';

            $tabla .= '<td class="text-center">' . $rows['oficio_solicitud'] . '</td>';

            $tabla .= '  <td>
                <div class="row">
                <a href="' . SERVERURL . 'ver-info-exp-i/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-dark btn-sm" title="Ver información completa" style="margin: 0 auto;"><i class="fas fa-eye"></i></a>
                    <a href="' . SERVERURL . 'actualizar-exp-i/' . mainModel2::encryption($rows['exp_id']) . '" class="btn btn-warning btn-sm" title="Editar" style="margin: 0 auto;">
                        <i class="fas fa-edit"></i>
                    </a>
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