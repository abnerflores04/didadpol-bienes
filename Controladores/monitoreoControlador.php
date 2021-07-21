<?php
if ($peticionAjax) {
    require_once "../modelos/monitoreo.php";
} else {
    require_once "./modelos/monitoreo.php";
}
class monitoreoControlador extends monitoreoModelo
{
    /* controlador para listar expedientes*/
    public function listar_monitoreo_exp_controlador()
    {
        $tabla = '';
        $consulta = 'SELECT e.num_exp, e.fecha_inicio_exp, e.fecha_final_exp, CONCAT(u.usu_nombre, " ", u.usu_apellido) as nombre, s.seccion_nombre, un.unidad_nombre FROM tbl_exp e INNER JOIN tbl_exp_usu eu ON e.exp_id = eu.exp_id INNER JOIN tbl_usuario u ON eu.usu_id = u.usu_id INNER JOIN tbl_seccion s ON u.seccion_id = s.seccion_id INNER JOIN tbl_unidad un ON u.unidad_id = un.unidad_id';
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
                <th style="vertical-align:middle;">FECHA FINAL EXPEDIENTE</th>
                <th style="vertical-align:middle;">NOMBRE</th>
                <th style="vertical-align:middle;">SECCIÓN</th>
                <th style="vertical-align:middle;">UNIDAD</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';
                
            $tabla .= ' 
            <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_inicio_exp'])) . '</td>
            <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';
            
            $tabla .= '<td style="font-size: 18px;">' . $rows['nombre'] . '</span></td>';
            
            $tabla .= '<td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['seccion_nombre'] . '</span></td>';
            
            $tabla .= '<td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['unidad_nombre'] . '</span></td>';
            $tabla .= '</tr>';
        }
        $tabla .= '</tbody>
        </table>
        </div>';
        return $tabla;
    }

}