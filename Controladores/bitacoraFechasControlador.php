<?php
if ($peticionAjax) {
    require_once "../modelos/bitacoraFechasModelo.php";
} else {
    require_once "./modelos/bitacoraFechasModelo.php";
}
class bitacoraControlador extends bitacoraModelo
{
     /* controlador para listar expedientes*/
     public function listar_bitacora_exp_controlador()
     {
         $tabla = '';
         $consulta = "SELECT e.num_exp, bf.fec_conocimiento, e.fecha_final_exp, bf.fec_emision, bf.fec_admision, bf.fec_asignacion, bf.fec_emision_invest, bf.fec_act_apertura, bf.fec_comunicacion, bf.fec_recep_invest, bf.fec_infor_cierre, bf.fec_val_dirreccion, bf.fec_recep_secretaria, bf.fecha_citacion, bf.fec_remision_secretaria, bf.fec_asigna_legal, bf.fec_entrega_dicta, bf.fec_remi_direccion, bf.fec_memorandum FROM tbl_bitacora_fechas bf INNER JOIN tbl_exp e ON bf.exp_id = e.exp_id";
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
 
         <a href="' . SERVERURL . 'registro-exp-investigacion/" class="btn btn-primary">
             <i class="fas fa-plus"></i> Nuevo Expediente
         </a>
 
 
         <br><br>
         <table id="example1" class=" table table-striped table-bordered">
 
             <thead style="vertical-align:middle;">
                 <tr>
                 <th style="vertical-align:middle;">N° EXPEDIENTE</th>
                 <th style="vertical-align:middle;">FECHA CONOCIMIENTO DIDADPOL</th>
                 <th style="vertical-align:middle;">FECHA FINAL EXPEDIENTE</th>
                 <th style="vertical-align:middle;">FECHA EMISION DENUNCIAS </th>
                 <th style="vertical-align:middle;">FECHA ADMISIÓN INVESTIGACIÓN</th>
                 <th style="vertical-align:middle;">FECHA ASIGNACIÓN INVESTIGADOR</th>
                 <th style="vertical-align:middle;">FECHA EMISIÓN INVESTIGACIÓN</th>
                 <th style="vertical-align:middle;">FECHA AUTO APERTURA</th>
                 <th style="vertical-align:middle;">FECHA COMUNICACIÓN</th>
                 <th style="vertical-align:middle;">FECHA RECEPCIÓN INVESTIGACIÓN</th>
                 <th style="vertical-align:middle;">FECHA INFORME DE INVESTIGACIÓN</th>
                 <th style="vertical-align:middle;">FECHA VALIDACIOÓN DIRECCIÓN</th>
                 <th style="vertical-align:middle;">FECHA RECEPCIÓN SECRETARÍA</th>
                 <th style="vertical-align:middle;">FECHA CITACIÓN</th>
                 <th style="vertical-align:middle;">FECHA REMISIÓN SECRETARÍA A LEGAL</th>
                 <th style="vertical-align:middle;">FECHA ASIGNACIÓN TÉCNICO LEGAL</th>
                 <th style="vertical-align:middle;">FECHA ENTREGA DICTAMEN (REAL)</th>
                 <th style="vertical-align:middle;">FECHA REMISIÓN DIRECCIÓN</th>
                 <th style="vertical-align:middle;">FECHA MEMORANDUM</th>
                 </tr>
             </thead>
             <tbody>';
 
         foreach ($datos as $rows) {
             $tabla .= '<tr>
                 <td style="font-size: 18px;"><span class="badge badge badge-dark">' . $rows['num_exp'] . '</span></td>';
 
 
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_conocimiento'])) . '</td>
             <td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_final_exp'])) . '</td>';
             
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_emision'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_admision'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_asignacion'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_emision_invest'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_act_apertura'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_comunicacion'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_recep_invest'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_infor_cierre'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_val_dirreccion'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_recep_secretaria'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fecha_citacion'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_remision_secretaria'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_asigna_legal'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_entrega_dicta'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_remi_direccion'])) . '</td>';
             $tabla .= '<td class="text-center">' . date('d/m/Y', strtotime($rows['fec_memorandum'])) . '</td>';
         }
         $tabla .= ' </tbody>
         </table>
         </div>';
         return $tabla;
     }
}