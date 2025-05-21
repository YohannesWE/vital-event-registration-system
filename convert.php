<?php
// Include TCPDF library
require_once 'C:\xampp\htdocs\ksw02\TCPDF-main\tcpdf.php';

// Check if file is uploaded successfully
if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    // Get temporary file name
    $tmpFile = $_FILES['photo']['tmp_name'];

    // Create new TCPDF object
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('dejavusans', '', 12);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image
    $pdf->Image($tmpFile, 10, 10, 180, 0, '', '', '', false, 300, '', false, false, 0);

    // Define output path for the PDF file
    $outputPath = $_SERVER['DOCUMENT_ROOT'] . '/ksw02/converted_photo.pdf';

    // Save the PDF to the specified output path
    $pdf->Output($outputPath, 'F');

    // Set headers to force download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="converted_photo.pdf"');
    header('Content-Length: ' . filesize($outputPath));

    // Output the PDF file
    readfile($outputPath);

    // Delete the temporary PDF file
    unlink($outputPath);

    // Stop further execution
    exit;
} else {
    // Output error message if file upload failed
    echo "Error uploading file.";
}
?>
