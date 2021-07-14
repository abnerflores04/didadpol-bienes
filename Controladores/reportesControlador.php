<?php
if ($peticionAjax) {
    require_once "../modelos/reporteModelo.php";
} else {
    require_once "./modelos/reporteModelo.php";
}
class reportesControlador extends reporteModelo
{
    // Controlador para listar los reportes de expediente con filtro invest
    public function listar_exp_reportes_invest_f()
    {
        $tabla = '';
        $consulta = "SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, tbf.fec_asignacion, te.fecha_final_i_pre, te.diligencias_invest, tep.est_proceso_descrip, te.fecha_final_i, tbf.fec_remision_secretaria, te.observacion FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON teu.usu_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_est_proceso tep ON te.est_proceso_id = tep.est_proceso_id WHERE te.investigador_id = $_SESSION[id_spm] GROUP BY ta.n_art AND ta.art_descrip;";
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
                    <th style="vertical-align:middle;">NOMBRE COMPLETO</th>            
                    <th style="vertical-align:middle;">RANGO</th>            
                    <th style="vertical-align:middle;">TIPO FALTA</th>
                    <th style="vertical-align:middle;">FECHA ASIGNACION DE EXPEDIENTE AL INVESTIGADOR</th>
                    <th style="vertical-align:middle;">FECHA FINALIZACION INVESTIGACIÓN PRELIMINAR</th>
                    <th style="vertical-align:middle;">DILIGENCIAS INVESTIGATIVAS PRACTICADAS</th>
                    <th style="vertical-align:middle;">ESTADO ACTUAL DEL PROCESO</th>
                    <th style="vertical-align:middle;">FECHA FINALIZACION INVESTIGACIÓN</th>
                    <th style="vertical-align:middle;">FECHA REMISION SECRETARIA</th>
                    <th style="vertical-align:middle;">OBSEVACIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';


            $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_conocimiento'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';

            
            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="text-center">' . $rows['nombre_investigado'] . '</span></td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['rango_descripcion'] . '</span></td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['tipo_falta_descrip']   . '</span></td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_asignacion'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_final_i_pre'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['diligencias_invest'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['est_proceso_descrip'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_final_i'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_remision_secretaria'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['observacion'] . '</td>';

            $tabla .= '</tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
    // Controlador para listar los reportes de expediente con filtro legal
    public function listar_exp_reportes_leg_f()
    {
        $tabla = '';
        $consulta = "SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, ta.n_art, tbf.fec_asigna_legal, te.fecha_aud_desc, te.comparecio, te.fecha_dias_tec_legal, tres.resolve, te.num_resolve, trec.recomen, tbf.fec_devolucion, te.folio, te.remision_mp_tsc, CONCAT(tu.usu_nombre, ' " ."', tu.usu_apellido) AS nombre FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON teu.usu_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_resoluciones tres ON tres.resolve_id = te.resolve_id INNER JOIN tbl_recomen trec ON trec.recomen_id = te.recomen_id WHERE te.tecnico_legal = $_SESSION[id_spm] GROUP BY ta.n_art AND ta.art_descrip";
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
                    <th style="vertical-align:middle;">NOMBRE COMPLETO</th>            
                    <th style="vertical-align:middle;">RANGO</th>
                    <th style="vertical-align:middle;">TIPO FALTA</th>
                    <th style="vertical-align:middle;">ART.</th>
                    <th style="vertical-align:middle;">FECHA ASIGNACION TEC. LEGAL</th>
                    <th style="vertical-align:middle;">FECHA AUDIENCIA</th>
                    <th style="vertical-align:middle;">COMPARECIO</th>
                    <th style="vertical-align:middle;">FINILIZACION 3 DIAS TECNICO LEGAL</th>
                    <th style="vertical-align:middle;"> X </th>
                    <th style="vertical-align:middle;">N° DOCUMENTO</th>
                    <th style="vertical-align:middle;">RECOMENDACION</th>
                    <th style="vertical-align:middle;">DEVOLUCION DE EXPEDIENTE</th>
                    <th style="vertical-align:middle;">FOLIOS</th>
                    <th style="vertical-align:middle;">MP Y/O TSC</th>
                    <th style="vertical-align:middle;">TECNICO LEGAL</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';



            $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_conocimiento'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['nombre_investigado'] .' </td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['rango_descripcion']   . '</span></td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['tipo_falta_descrip']   . '</span></td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['n_art']   . '</span></td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_asigna_legal']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_aud_desc']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['comparecio']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_dias_tec_legal']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['resolve']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['num_resolve']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['recomen']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_devolucion']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['folio']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['remision_mp_tsc']   . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['nombre']   . '</td>';

            $tabla .= '</tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
    // Controlador para listar los reportes de expediente
    public function listar_exp_reportes2_invest()
    {
        $tabla = '';
        $consulta = "SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, tbf.fec_asignacion, te.fecha_final_i_pre, te.diligencias_invest, tep.est_proceso_descrip, te.fecha_final_i, tbf.fec_remision_secretaria, te.observacion FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON teu.usu_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_est_proceso tep ON te.est_proceso_id = tep.est_proceso_id WHERE te.investigador_id = $_SESSION[id_spm] GROUP BY ta.n_art AND ta.art_descrip;";
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
                    <th style="vertical-align:middle;">NOMBRE COMPLETO</th>            
                    <th style="vertical-align:middle;">RANGO</th>            
                    <th style="vertical-align:middle;">TIPO FALTA</th>
                    <th style="vertical-align:middle;">FECHA ASIGNACION DE EXPEDIENTE AL INVESTIGADOR</th>
                    <th style="vertical-align:middle;">FECHA FINALIZACION INVESTIGACIÓN PRELIMINAR</th>
                    <th style="vertical-align:middle;">DILIGENCIAS INVESTIGATIVAS PRACTICADAS</th>
                    <th style="vertical-align:middle;">ESTADO ACTUAL DEL PROCESO</th>
                    <th style="vertical-align:middle;">FECHA FINALIZACION INVESTIGACIÓN</th>
                    <th style="vertical-align:middle;">FECHA REMISION SECRETARIA</th>
                    <th style="vertical-align:middle;">OBSEVACIONES</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';


            $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_conocimiento'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';

            
            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="text-center">' . $rows['nombre_investigado'] . '</span></td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['rango_descripcion'] . '</span></td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['tipo_falta_descrip']   . '</span></td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_asignacion'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_final_i_pre'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['diligencias_invest'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['est_proceso_descrip'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_final_i'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_remision_secretaria'] . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['observacion'] . '</td>';

            $tabla .= '</tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
    // Controlador para listar los reportes de expediente
    public function listar_exp_reportes2_leg()
    {
        $tabla = '';
        $consulta = "SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, ta.n_art, tbf.fec_asigna_legal, te.fecha_aud_desc, te.comparecio, te.fecha_dias_tec_legal, tres.resolve, te.num_resolve, trec.recomen, tbf.fec_devolucion, te.folio, te.remision_mp_tsc, CONCAT(tu.usu_nombre, ' " ."', tu.usu_apellido) AS nombre FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON teu.usu_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_resoluciones tres ON tres.resolve_id = te.resolve_id INNER JOIN tbl_recomen trec ON trec.recomen_id = te.recomen_id WHERE te.tecnico_legal = $_SESSION[id_spm] GROUP BY ta.n_art AND ta.art_descrip";
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
                    <th style="vertical-align:middle;">NOMBRE COMPLETO</th>            
                    <th style="vertical-align:middle;">RANGO</th>
                    <th style="vertical-align:middle;">TIPO FALTA</th>
                    <th style="vertical-align:middle;">ART.</th>
                    <th style="vertical-align:middle;">FECHA ASIGNACION TEC. LEGAL</th>
                    <th style="vertical-align:middle;">FECHA AUDIENCIA</th>
                    <th style="vertical-align:middle;">COMPARECIO</th>
                    <th style="vertical-align:middle;">FINILIZACION 3 DIAS TECNICO LEGAL</th>
                    <th style="vertical-align:middle;"> X </th>
                    <th style="vertical-align:middle;">N° DOCUMENTO</th>
                    <th style="vertical-align:middle;">RECOMENDACION</th>
                    <th style="vertical-align:middle;">DEVOLUCION DE EXPEDIENTE</th>
                    <th style="vertical-align:middle;">FOLIOS</th>
                    <th style="vertical-align:middle;">MP Y/O TSC</th>
                    <th style="vertical-align:middle;">TECNICO LEGAL</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($datos as $rows) {
            $tabla .= '<tr>
                <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';



            $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_conocimiento'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['nombre_investigado'] .' </td>';

            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['rango_descripcion']   . '</span></td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['tipo_falta_descrip']   . '</span></td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['n_art']   . '</span></td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_asigna_legal']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_aud_desc']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['comparecio']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fecha_dias_tec_legal']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['resolve']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['num_resolve']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['recomen']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['fec_devolucion']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['folio']   . '</td>';
           
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['remision_mp_tsc']   . '</td>';
            
            $tabla .= '<td class=" text-center">';
            $tabla .= $rows['nombre']   . '</td>';

            $tabla .= '</tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
}