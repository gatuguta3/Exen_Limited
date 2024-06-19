$sql="SELECT * FROM customer_details";
$result = $conn->query($sql);

$pdf->SetFont('Arial','','14');
$pdf->SetFillColor(235,236,236);
$fill=false;

while ($row1 = $result->fetch_assoc() as $row) {
    $pdf->Cell($width_cell[0],10,$row['Cust_Id'],1,0,'C',$fill);
    $pdf->Cell($width_cell[0],10,$row['Cust_Firstname'],1,0,'C',$fill);
    $pdf->Cell($width_cell[0],10,$row['Cust_Lastname'],1,0,'C',$fill);
    $pdf->Cell($width_cell[0],10,$row['Cust_Phonenumber'],1,0,'C',$fill);
    $pdf->Cell($width_cell[0],10,$row['Cust_Location'],1,0,'C',$fill);
    $pdf->Cell($width_cell[0],10,$row['Cust_Email'],1,0,'C',$fill);
    $pdf->Cell($width_cell[0],10,$row['Cust_Dateofbirth'],1,0,'C',$fill);
    $pdf->Cell($width_cell[0],10,$row['Cust_National_Idno'],1,1,'C',$fill);
}