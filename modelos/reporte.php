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

/*$query = "SELECT te.exp_id, te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion,ttf.tipo_falta_id, ttf.tipo_falta_descrip, tbf.fec_asigna_legal, te.fecha_aud_desc, te.comparecio, te.fecha_dias_tec_legal, tres.resolve, te.num_resolve, trec.recomen, tbf.fec_devolucion, te.folio, te.remision_mp_tsc, CONCAT(tu.usu_nombre, ' " . "', tu.usu_apellido) AS nombre, tu.usu_identidad FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON te.tecnico_legal = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_exp_art tea ON te.exp_id = tea.exp_id INNER JOIN tbl_articulo ta ON ta.art_id = tea.art_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_resoluciones tres ON tres.resolve_id = te.resolve_id INNER JOIN tbl_recomen trec ON trec.recomen_id = te.recomen_id WHERE te.tecnico_legal =" . $u . " GROUP BY tea.exp_id, ta.n_art AND ttf.tipo_falta_descrip;";*/
$query="SELECT te.exp_id,te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_id,ttf.tipo_falta_descrip, tbf.fec_asigna_legal, te.fecha_aud_desc, te.comparecio, te.fecha_dias_tec_legal, tres.resolve, te.num_resolve, trec.recomen, tbf.fec_devolucion, te.folio, te.remision_mp_tsc, CONCAT(tu.usu_nombre, ' " . "', tu.usu_apellido) AS nombre,tu.usu_identidad FROM  tbl_exp te INNER JOIN tbl_usuario tu ON te.tecnico_legal = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_resoluciones tres ON tres.resolve_id = te.resolve_id INNER JOIN tbl_recomen trec ON trec.recomen_id = te.recomen_id WHERE te.tecnico_legal =".$u;
$consulta = $conexion->prepare($query);
$consulta->execute();
$i = 1;


class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file =  '../vistas/plugins/tcpdf/examples/images/logo final.jpg';
        $image_file2 =  '../vistas/plugins/tcpdf/examples/images/secretaria-de-salud-logo.jpg';

        $this->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Image($image_file2, 260, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Ln(7);
        $this->Cell(0, 16, 'DIRECCI??N DE ASUNTOS DISCIPLINARIOS POLICIALES', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 12, 'REPORTE DE EXPEDIENTES LEGAL', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 8, 'Fecha: ' . date('d/m/Y'), 0, 1, 'L', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('L', 'mm', 'legal');





// add a page
$pdf->AddPage();
$pdf->Ln(10);

$html = '<style>
table{
    border:1px solid #000000;
}
.header-color{
    background-color: hsla(130, 20%, 90%, 0.5);;
}
th,td{
    border:1px solid #000000;
    text-align:center;
}
.wNExp {
    width: 73px;
}
.wNombre {
    width: 80px;
}
.wFecha {
    width: 60px;
}
.w30 {
    width: 30px;
}
.firma_uno p {
    color:red;
    position:absolute;
    left:520px;
    margin:200px;
}
.firma_dos p {
    position: fixed;
    top: 80px;
    left: 10px;
    background: blue;
}
</style>';
$html .= '<table >
<tr class="header-color">
    <th class="wNExp">N?? EXPEDIENTE</th>
    <th class="wFecha">CONOCIMIENTO DIDADPOL</th>
    <th class="wFecha">FECHA FINAL EXPEDIENTE</th>
    <th class="wNombre">INVESTIGADO</th>            
    <th class="wFecha">RANGO</th>
    <th>FALTA</th>
    <th class="w30">ART.</th>
    <th>ASIGNACION TEC. LEGAL </th>
    <th class="wFecha">FECHA A. D.</th>
    <th class="wFecha">DEVOLUCI??N DE EXPEDIENTE</th>
    <th class="w30">COMPARECIO</th>
    <th>N?? DOCUMENTO</th>
    <th>RECOMEN.</th>
    <th class="w30">FOLIOS</th>
    <th class="w30">MP Y/O TSC</th>
</tr>';

while ($fila = $consulta->fetch()) {
    $tecnico = $fila['nombre'];
    $tecnico_dni = $fila['usu_identidad'];
    $sCompa = "No";
    $sRMT = "No";
    if ($fila['comparecio'] == 1) {
        $sCompa = "Si";
    }
    if ($fila['remision_mp_tsc'] == 1) {
        $sRMT = "Si";
    }
    if ($fila['resolve'] == 'N?? de Dictamen') {
        $doc = "D-" . $fila['num_resolve'];
    } else {
        $doc = "A-" . $fila['num_resolve'];
    }


    $html .= '
<tr>
    <td>' . $fila['num_exp'] . '</td>
    <td>' . date('d/m/Y', strtotime($fila['fec_conocimiento'])) . '</td>
    <td>' . date('d/m/Y', strtotime($fila['fecha_final_exp'])) . '</td>
    <td>' . $fila['nombre_investigado'] . '</td>
    <td>' . $fila['rango_descripcion'] . '</td>
    <td>' . $fila['tipo_falta_descrip'] . '</td>
    <td>'.$fila['tipo_falta_id'];

    $query3 = "SELECT te.exp_id, ta.tipo_falta_id,ta.n_art FROM tbl_exp_art tea inner join tbl_articulo ta on tea.art_id=ta.art_id INNER join tbl_exp te on tea.exp_id=te.exp_id where te.exp_id='$fila[exp_id]'";
    $consulta3 = $conexion->prepare($query3);
    $consulta3->execute();
    $campos = $consulta3->fetchAll();
    
    foreach ($campos as $campo) {
        $html .= ' # ' . $campo['n_art'] . " ";
    }

    $html .= '</td>
    <td>' . $fila['fec_asigna_legal'] . '</td>
    <td>' . date('d/m/Y', strtotime($fila['fecha_aud_desc'])) . '</td>
    <td>' . date('d/m/Y', strtotime($fila['fecha_dias_tec_legal'])) . '</td>
    <td>' . $sCompa . '</td>
    <td>' . $doc . '</td>
    <td>' . $fila['recomen'] . '</td>
    <td>' . $fila['folio'] . '</td>
    <td>' . $sRMT . '</td>
</tr>';
}
$html .= '</table>';

$pdf->Ln(30);
$pdf->SetFont('helvetica', 'I', 6.6);
$pdf->WriteHTMLCell(0, 0, '', '', $html, 0, 1);
$pdf->MultiCell(280, 1, 'Por medio del presente, declaro que la informaci??n proporcionada es fidedigna en caso contrario, soy conciente que la Direcci??n de Asuntos Disciplinarios Policiales deducira la responsabilidad correspondiente.', 0, 'C', false, 1);
$pdf->Ln(30);
$pdf->MultiCell(280, 1, '__________________________________________________________', 0, 'C', false, 1);
$pdf->MultiCell(280, 3, 'Abog. ' . $tecnico, 0, 'C', false, 1);
$pdf->MultiCell(280, 5, $tecnico_dni, 0, 'C', false, 1);
$pdf->MultiCell(280, 4, 'Especialista T??cnico Legal', 0, 'C', false, 1);
date_default_timezone_set('America/Tegucigalpa');
$pdf->MultiCell(280, 0, $DateAndTime = date('m-d-Y h:i a', time()), 0, 'C', false, 1);

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
