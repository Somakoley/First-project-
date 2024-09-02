<?php
require('fpdf/fpdf.php'); // Adjust the path based on where you place fpdf.php

// Create a new FPDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font for the main text
$pdf->SetFont('Arial', '', 12);

// Dynamic HTML content to be converted to PDF
$html_content = '<p><span style="font-family: helvetica, arial, sans-serif; font-size: 14pt;"><em>jkkjdsjkajdsk flksdalklsadk</em></span></p>';

// Function to convert HTML to PDF cell content
function htmlToPdfCell($pdf, $html) {
    // Remove unwanted tags and convert necessary tags
    $html = strip_tags($html, '<em><strong><b><i><u>');

    // Output HTML content in a specific cell
    $pdf->MultiCell(0, 10, $html);
}

// Place HTML content into a specific cell (adjust x, y, and width as needed)
$pdf->SetXY(10, 30); // Set position
$pdf->SetWidths(array(100)); // Set width of cell
htmlToPdfCell($pdf, $html_content); // Call function to convert HTML to PDF cell content

// Output the PDF as a file (for download, for example)
$pdf->Output('output.pdf', 'D');
?>
