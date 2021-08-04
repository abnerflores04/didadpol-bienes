<?php
require_once('../vistas/plugins/tcpdf/tcpdf.php');
require_once '../modelos/conectar2.php';
$d = $_GET["d"];
$u = $_GET["u"];
if ($d != '') {
    $filtros = ' AND te.depto_id=' . $d;
} elseif ($d == '' || $d == null) {
    $filtros = ' ';
}
/*$query = "SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, tbf.fec_asignacion, te.fecha_final_i_pre, te.diligencias_invest, tep.est_proceso_descrip, te.fecha_final_i, tbf.fec_remision_secretaria, te.observacion, CONCAT(tu.usu_nombre, ' ', tu.usu_apellido) as nombre FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON te.investigador_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_est_proceso tep ON te.est_proceso_id = tep.est_proceso_id WHERE te.investigador_id =" . $u . $filtros . " GROUP BY te.exp_id, ta.n_art AND ta.art_descrip, ttf.tipo_falta_descrip";*/
$query="SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, tbf.fec_asignacion, te.fecha_final_i_pre, te.diligencias_invest, tep.est_proceso_descrip, te.fecha_final_i, tbf.fec_remision_secretaria, te.observacion, CONCAT(tu.usu_nombre, ' ', tu.usu_apellido) as nombre FROM  tbl_exp te INNER JOIN tbl_usuario tu ON te.investigador_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id  INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_est_proceso tep ON te.est_proceso_id = tep.est_proceso_id WHERE te.investigador_id = $u " . $filtros;
$consulta = $conexion->prepare($query);
$consulta->execute();

$query2 = "SELECT CONCAT(u.usu_nombre, ' ', u.usu_apellido) as nombre FROM tbl_usuario u WHERE u.rol_id = 4";
$consulta2 = $conexion->prepare($query2);
$consulta2->execute();

$i = 1;


class MYPDF extends TCPDF {

    //Page header
    public function Header() {
       // Logo
       $image_file =  '../vistas/plugins/tcpdf/examples/images/logo final.jpg';
       $image_file2 =  '../vistas/plugins/tcpdf/examples/images/secretaria-de-salud-logo.jpg';
       
       $this->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
       $this->Image($image_file2, 260, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Ln(7);
        $this->Cell(0, 16, 'DIRECCIÓN DE ASUNTOS DISCIPLINARIOS POLICIALES', 0,1, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 12, 'REPORTE DE EXPEDIENTES INVESTIGACIÓN', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 8, 'Fecha: '. date('d/m/Y'), 0, 1, 'L', 0, '', 0, false, 'M', 'M');
        
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('L', 'mm', 'Legal');

// add a page
$pdf->AddPage();

$pdf->Ln(10);
$html='<table >
<tr>
    <th width="80px" ><br /><br /><br />N° Expediente</th>
    <th width="120px"><br /><br /><br />Nombre Completo</th>
    <th width="70px"><br /><br /><br />Cargo</th>
    <th width="50px"><br /><br />Fecha conocimiento DIDADPOL</th>
    <th width="45px"><br /><br />Finalización de 75 días</th>
    <th width="45px"><br /><br />Fecha de asignación de expediente</th>
    <th width="45px">Fecha finalización de investigación preliminar</th>
    <th width="80px"><br /><br /><br />Diligencias investigativas practicadas</th>
    <th width="80px"><br /><br /><br />Estado actual del proceso</th>
    <th width="45px"><br /><br />Fecha Remisión Secretaria</th>
    <th width="125px"><br /><br /><br />Observación</th>
</tr>';

while($fila=$consulta->fetch()){
    $invest = $fila['nombre'];
$html.='
<tr>
    <td >'.$fila['num_exp'].'</td>
    <td>'.$fila['nombre_investigado'].'</td>
    <td>'.
     $fila['rango_descripcion']   .'</td>
    <td>'. date('d/m/Y', strtotime($fila['fec_conocimiento'])) . '</td>
    <td>'. date('d/m/Y', strtotime($fila['fecha_final_exp'])) .'</td>
    <td>'.$fila['fec_asignacion'] .'</td>
    <td>'.$fila['fecha_final_i_pre'].'</td>
    <td>'.$fila['diligencias_invest'].'</td>
    <td>'.$fila['est_proceso_descrip'].'</td>
    <td>'.$fila['fec_remision_secretaria'].'</td>
    <td>'.$fila['observacion'].'</td>
</tr>';
}
$html.='
</table>
<style>
table{
    border:1px solid #000000;
}
th {
    border:1px solid #000000;
    text-align:center;
    background-color: hsla(130, 20%, 90%, 0.5);
    
    
    
}
td{
    text-align:center;
    border:1px solid #000000;
}

</style>
';




$pdf->Ln(30);
$pdf->SetFont('helvetica', 'I', 6.6);
$pdf->WriteHTML($html,1,0,1,0);

$pdf->Ln(30);
$pdf->MultiCell(100, 1, '__________________________________________________________', 0, 'C', false, 0);
$pdf->MultiCell(260, 3, '__________________________________________________________', 0, 'C', false, 1);
$pdf->MultiCell(100, 0, 'Abog. ' . $invest, 0, 'C', false, 0);
while($fila2=$consulta2->fetch()){
    $pdf->MultiCell(260, 0, 'Abog. ' . $fila2['nombre'], 0, 'C', false, 1);
    $pdf->MultiCell(100, 0, 'Investigador', 0, 'C', false, 0);
}
$pdf->MultiCell(260, 0, 'Gerente de Investigación', 0, 'C', false, 1);
date_default_timezone_set('America/Tegucigalpa'); 
$pdf->Ln(5);
$pdf->MultiCell(260, 0, $DateAndTime = date('m-d-Y h:i a', time()), 0, 'L', false, 1);

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>