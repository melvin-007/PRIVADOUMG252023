<?php
require('../../backend/fpdf/fpdf.php');
date_default_timezone_set('America/El_Salvador');

//podemos definir el ancho en una variable para que no les cueste cambiarlo despues
$ancho = 5;

//definimos la orientacion de la pagina y el array indica el tamaño de la hoja
$pdf=new FPDF('P','mm',array(80,150));
$pdf->AddPage(); 
$pdf->SetFont('Arial','B',5);   

// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(60,4,'solucionesrobitasdeguatemala@gmail.com',0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(60,4,'',0,1,'C');
$pdf->Cell(60,4,', 1',0,1,'C');
$pdf->Cell(60,4,'Guatemala',0,1,'C');
$pdf->Cell(60,4,'22554436',0,1,'C');
$pdf->Cell(60,4,'solucionesroboticasdeguatemala@gmail.com',0,1,'C');


$pdf->setX(5);
//              Encabezado

$pdf->Cell(20, 7, utf8_decode('Productos'),0,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Cliente'),0,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Total'),0,1,'C',0);

//              DATOS


$pdf->setX(5);

require '../../backend/config/Conexion.php';
$id = $_GET['id'];

$stmt = $connect->prepare("SELECT * FROM pedidos WHERE pedidos.idord= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();


while($row = $stmt->fetch()){


$pdf-> Multicell(20,5,utf8_decode($row['total_products']),0,'L',0);
   
    $pdf->Multicell(20,5,utf8_decode($row['nomcl']),0,0,'L',0);
    $pdf->cell(20,5,'S/'.($row['total_price']),0,1,'R',0);

$pdf->Ln(5);
//              TOTAL
$pdf->setX(5);
$pdf->SetFont('Arial','B',8); 
$pdf->Cell(45,5,'TOTAL',0,0,'L',0);

$pdf->SetFont('Arial','',8);
$pdf->Cell(10,5,'S/'.($row['total_price']));



    


}


$pdf->Ln(10);
$pdf->SetFont('Arial','B',8);
$pdf->setX(15);
$pdf->Cell(5,$ancho+6,utf8_decode('¡GRACIAS POR TU COMPRA!'));

$pdf->Output();
?>


