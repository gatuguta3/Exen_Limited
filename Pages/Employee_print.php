<?php 
require 'connect.php';
require('fpdf/fpdf.php');

$pdf= new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','BU',20);
$pdf->SetXY(80,10);
$pdf->Cell(0,10,'Employee List',0,1,'L',false);

$width_cell = array(20,20,22,20,20,35,30,15,13);
$pdf->SetFont('Arial','B',9);

$pdf->SetFillColor(193,229,252);



$pdf->Cell($width_cell[0],10,'Employee Id',0,0,'C',true);
$pdf->Cell($width_cell[1],10,'First name',0,0,'C',true);
$pdf->Cell($width_cell[2],10,'Last name',0,0,'C',true);
$pdf->Cell($width_cell[3],10,'Id no',0,0,'C',true);
$pdf->Cell($width_cell[4],10,'Phone number',0,0,'C',true);
$pdf->Cell($width_cell[5],10,'Email address',0,0,'C',true);
$pdf->Cell($width_cell[6],10,'Role',0,0,'C',true);
$pdf->Cell($width_cell[7],10,'Date Hired',0,0,'C',true);
$pdf->Cell($width_cell[8],10,'Gender',0,1,'C',true);


$pdf->SetFont('Arial','','8');
$pdf->SetFillColor(235,236,236);
$fill=false;
$sql="SELECT * FROM employee_details";
$result = $conn->query($sql);

foreach($dbo=$result as $row) {
    
    $pdf->Cell($width_cell[0],10,$row['Emp_Id'],0,0,'C',$fill);
    $pdf->Cell($width_cell[1],10,$row['Emp_Firstname'],0,0,'C',$fill);
    $pdf->Cell($width_cell[2],10,$row['Emp_lastname'],0,0,'C',$fill);
    $pdf->Cell($width_cell[3],10,$row['Emp_national_Id'],0,0,'C',$fill);
    $pdf->Cell($width_cell[4],10,$row['Emp_Phonenumber'],0,0,'C',$fill);
    $pdf->Cell($width_cell[5],10,$row['Emp_emailAddress'],0,0,'C',$fill);
    $pdf->Cell($width_cell[6],10,$row['Emp_role'],0,0,'C',$fill);
    $pdf->Cell($width_cell[7],10,$row['Emp_dateofbirth'],0,0,'C',$fill);
    $pdf->Cell($width_cell[8],10,$row['Emp_gender'],0,1,'C',$fill);
    
}



$pdf->Output();