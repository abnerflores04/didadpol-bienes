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
        $consulta = "SELECT * FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id=te.exp_id INNER JOIN tbl_usuario tu  ON teu.usu_id=tu.usu_id WHERE teu.usu_id= $_SESSION[id_spm]";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

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
        $tabla .= '</tbody>
        </table>
        </div>';
        return $tabla;
    }
    // Controlador para listar los reportes de expediente con filtro legal
    public function listar_exp_reportes_leg_f()
    {
        $tabla = '';
        $consulta = "SELECT * FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id=te.exp_id INNER JOIN tbl_usuario tu  ON teu.usu_id=tu.usu_id WHERE teu.usu_id= $_SESSION[id_spm]";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
<<<<<<< Updated upstream
=======
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta2 = "SELECT * FROM tbl_feriado ORDER BY feriado_fecha ASC";
        $conexion = mainModel2::conectar();
        $datos2 = $conexion->query($consulta2);
        $datos2 = $datos2->fetchAll();
        foreach ($datos2 as $rows2) {
            array_push($feriados, $rows2['feriado_fecha']);
        }

>>>>>>> Stashed changes

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
            </td> 
            </tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
    // Controlador para listar los reportes de expediente
    public function listar_exp_reportes2_invest($filtros)
    {
        $tabla = '';
<<<<<<< Updated upstream
        $consulta = "SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, tbf.fec_asignacion, te.fecha_final_i_pre, te.diligencias_invest, tep.est_proceso_descrip, te.fecha_final_i, tbf.fec_remision_secretaria, te.observacion FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON teu.usu_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_est_proceso tep ON te.est_proceso_id = tep.est_proceso_id WHERE te.investigador_id = $_SESSION[id_spm] ".$filtros." GROUP BY ta.n_art AND ta.art_descrip, ttf.tipo_falta_descrip";
=======
        $consulta = "SELECT * FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id=te.exp_id INNER JOIN tbl_usuario tu  ON teu.usu_id=tu.usu_id INNER JOIN tbl_bitacora_fechas tbf  ON teu.exp_id=tbf.exp_id WHERE teu.usu_id= $_SESSION[id_spm]";
>>>>>>> Stashed changes
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

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
                    <th style="vertical-align:middle;">ESTADO ACTUAL DEL PROCESO</th>
                    <th style="vertical-align:middle;">FECHA FINALIZACION INVESTIGACIÓN</th>
                    <th style="vertical-align:middle;">FECHA REMISION SECRETARIA</th>
                    <th style="vertical-align:middle;">OBSEVACIONES</th>
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
                
            </td> 
            </tr>';
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
        $consulta = "SELECT te.num_exp, te.fecha_inicio_exp, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, ta.n_art, tbf.fec_asigna_legal, te.fecha_aud_desc, te.comparecio, te.fecha_dias_tec_legal, tres.resolve, te.num_resolve, trec.recomen, tbf.fec_devolucion, te.folio, te.remision_mp_tsc, tu.usu_nombre FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON teu.usu_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_resoluciones tres ON tres.resolve_id = te.resolve_id INNER JOIN tbl_recomen trec ON trec.recomen_id = te.recomen_id WHERE teu.usu_id= $_SESSION[id_spm]";
        $conexion = mainModel2::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
<<<<<<< Updated upstream
        
=======
        //guardar los fecha de feriados o vacaciones en el array feriados
        $feriados = [];
        $consulta2 = "SELECT * FROM tbl_feriado ORDER BY feriado_fecha ASC";
        $conexion = mainModel2::conectar();
        $datos2 = $conexion->query($consulta2);
        $datos2 = $datos2->fetchAll();
        foreach ($datos2 as $rows2) {
            array_push($feriados, $rows2['feriado_fecha']);
        }


>>>>>>> Stashed changes
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



            $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_inicio_exp'])) . '</td>
                <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';

            $tabla .= '<td  style="font-size: 20px;"class=" text-center">';
            $tabla .= '<span class="text-center">'. $rows['nombre_investigado'] . '</span></td>';

            $tabla .= '<td  style="font-size: 20px;"class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['rango_id']   . '</span></td>';
            
            $tabla .= '<td  style="font-size: 20px;"class=" text-center">';
            $tabla .= '<span class="badge badge badge-dark">' . $rows['tipo_falta_id']   . '</span></td>';

            $tabla .= '  <td>
            </td> 
            </tr>';
        }
        $tabla .= ' </tbody>
        </table>
        </div>';
        return $tabla;
    }
}