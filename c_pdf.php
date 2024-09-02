<?php
ob_start();
require("config.php");
require("session.php");

?> 
<?php
if (isset($_POST['std_id'])) {
	$sql = "SELECT s.*,c.col_name,c.col_logo FROM student s INNER JOIN college c ON s.col_id=c.col_id WHERE s.std_id=" . $_POST['std_id'];
	$rs = mysqli_query($conn, $sql);
	$rec = mysqli_fetch_assoc($rs);
	$file = str_replace(" ", "_", $rec['std_name']);
	$upd = mysqli_query($conn, "UPDATE `student` SET std_status='1' WHERE std_id=" . $_POST['std_id']) or die(mysqli_error($conn));
	require("fpdf/fpdf.php");
	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddFont('radagund', '', 'Blenda-Script.php');
	$pdf->AddFont('helveticabi', '', 'helveticabi.php');
	$pdf->AddFont('helveticai', '', 'helveticai.php');
	$pdf->AddFont('copper', '', 'CopperplateGothicBold.php');
	$pdf->AddFont('certificate', '', 'CERTIFICATE 400.php');
	$pdf->AddFont('Chalisa', '', 'Chalisa_Octavia.php');
	$pdf->AddFont('Cambria', '', 'Cambria.php');
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(false);
	$pdf->SetTitle('Digital Certificate');
	$pdf->SetAuthor('Euphoria GenX');
	$pdf->SetCreator('Euphoria GenX');
	$pdf->Image('fpdf/Certificate_background.jpg', 0, 0, 297, 210, 'JPG');
// 	$pdf->Image($rec['col_logo'], 27, 60, 246, 'PNG');
	$pdf->Image('fpdf/logo.png', 118, 161, 60, 22, 'PNG', 'https://euphoriagenx.com/');
	$pdf->SetRightMargin(0);
	$pdf->SetFont('certificate', '', 45);
	$pdf->SetXY(0, 95);
	$pdf->Cell(0, 2, $rec['c_type'], 0, 0, 'C');
	$pdf->SetFont('Cambria', '', 15);
	$pdf->SetXY(0, 109);
	$pdf->Cell(0, 0, $rec['awd_to'], 0, 0, 'C');
	$pdf->SetXY(0, 118);
	$pdf->SetFont('Chalisa', '', 32);
	$pdf->Cell(0, 0, ucwords(strtolower($rec['std_name'])), 0, 0, 'C');
	$pdf->SetXY(0, 130);
	$pdf->SetFont('Arial', 'B', 15);
	$pdf->Cell(0, 0,  'of '.$rec['col_name'], 0, 0, 'C');
	$pdf->SetXY(0, 138);	
	$pdf->SetFont('Arial', '', 15);
    $pdf->Cell(0, 0, $rec['l_1'].' ' . $rec['subject'], 0, 0, 'C');
    $pdf->SetXY(0, 146);
	$pdf->SetFont('helveticabi', '', 15);
	$pdf->Cell(0, 0, $rec['l_2'], 0, 0, 'C');
	$pdf->SetFont('helveticai', '', 15);
	$pdf->SetXY(0, 154);
	$pdf->Cell(0, 0, $rec['l_3'], 0, 0, 'C');
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->SetXY(44, 172);
	$pdf->Cell(0, 0, 'Avoy Debnath', 0, 0, 'L');
	$pdf->SetXY(221, 172);
	$pdf->Cell(0, 0, 'Ankita Das', 0, 0, 'L');
	$pdf->SetXY(46, 178);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(0, 0, 'Vice President', 0, 0, 'L');
	$pdf->SetXY(208, 178);
	$pdf->Cell(0, 0, 'Sr. Manager - HR & Academics', 0, 0, 'L');
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetXY(30, 190);
	$pdf->Cell(0, 0, 'SL NO: ' . $rec['sl_no'], 0, 0, 'L');
	$pdf->SetXY(230, 190);
	$pdf->Cell(0, 0, 'Date: ' . $rec['seminar_date'], 0, 0, 'L');
	//$pdf->Output();
	$pdf->Output($file . ".pdf", 'D');
	ob_end_flush();
} else {
	header('location:view_student.php');
}
?>