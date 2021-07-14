<?php
require('../vistas/plugins/fpdf/fpdf.php');
require_once '../modelos/conectar2.php';

    $d=$_GET["d"];
    $u=$_GET["u"];
    if ( $d!='') {
        $filtros=' AND te.depto_id='.$d;
    }elseif($d=='' ||$d==null) {
        $filtros=' ';
    }
    $query="SELECT te.num_exp, tbf.fec_conocimiento, te.fecha_final_exp, te.nombre_investigado, tr.rango_descripcion, ttf.tipo_falta_descrip, tbf.fec_asignacion, te.fecha_final_i_pre, te.diligencias_invest, tep.est_proceso_descrip, te.fecha_final_i, tbf.fec_remision_secretaria, te.observacion FROM tbl_exp_usu teu INNER JOIN tbl_exp te ON teu.exp_id = te.exp_id INNER JOIN tbl_usuario tu ON teu.usu_id = tu.usu_id INNER JOIN tbl_rango tr ON tr.rango_id = te.rango_id INNER JOIN tbl_tipo_falta ttf ON ttf.tipo_falta_id = te.tipo_falta_id INNER JOIN tbl_articulo ta ON ta.tipo_falta_id = ttf.tipo_falta_id INNER JOIN tbl_bitacora_fechas tbf ON tbf.exp_id = te.exp_id INNER JOIN tbl_est_proceso tep ON te.est_proceso_id = tep.est_proceso_id WHERE te.investigador_id =". $u. $filtros." GROUP BY ta.n_art AND ta.art_descrip, ttf.tipo_falta_descrip";
    $consulta=$conexion->prepare($query);
$consulta->execute();
      $i=1;      
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
   
   
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(75);
    // Título
    // Logo
   // $this->Image('../vistas/reportes/logo.png',250,8,25,25);
    $this->Cell(125,15,utf8_decode('CLÍNICA MÉDICA HOMEOPATICA CLIME HOME'),0,0,'C');
    // Salto de línea
    $this->Ln(10);
    $this->SetFont('Arial','',12);
    $this->Cell(270,15,utf8_decode('BÍTACORA DEL SISTEMA'),0,0,'C');
    //$this->Cell(270,15,utf8_decode('BÍTACORA DEL SISTEMA'),0,0,'C');
    $this->Ln(10);
    $this->Cell(20,15,'FECHA: ',0,0,'L',0);
    $this->Cell(25,15,date('Y/m/d'),0,0,'L',0);
    $this->Cell(18,15,'HORA: ',0,0,'L',0);
    $this->SetFont('Arial','',12);
    $this->Cell(25,15,date('H:i:s'),0,0,'L',0);
    $this->Ln(20);
    $this->SetFont('Arial','B',12);
    $this->SetFillColor(45,65,84);
    $this->SetTextColor(255,255,255);
    $this->Cell(20,8,utf8_decode('No. Expediente'),0,0,'C',1);
    $this->Cell(95,8,utf8_decode('Fecha Conocimiento DIDADPOL'),0,0,'C',1);
    $this->Cell(95,8,utf8_decode('Fecha final expediente'),0,1,'C',1);
    
    
    

    

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF('L','mm','legal');
$pdf->AddPage();
$pdf->SetMargins(10,10,10,10);
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);
    

while($fila=$consulta->fetch()){
     if($i%2==0){
        $pdf->SetFillColor(243,243,243);
    }else{
        $pdf->SetFillColor(255,255,255);
    }
        

       
    
    $pdf->Cell(40,8,utf8_decode($fila['num_exp']),0,0,'C',1);
    $pdf->Cell(60,8,utf8_decode(date('d/m/Y', strtotime($fila['fec_conocimiento']))),0,1,'C',1);
 
    $i++;
   }
   

$pdf->Output('D','reporte.pdf');



?>