<?php
require_once __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', true);

// Rest of your code...
if (isset($_POST['submit'])) {
    // Create a new PDF instance
    $pdf = new Dompdf\Dompdf();
    $pdf->loadHtml('
      
    A paragraph is defined as “a group of sentencs a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one
   
         
    ');

    // Set the paper size and orientation (optional)
    $pdf->setPaper('A4', 'portrait');

    // Render the PDF
    $pdf->render();

    // Generate a unique filename for the downloaded PDF
    $filename = 'death_certificate.pdf';

    // Send the PDF to the browser for download
    $pdf->stream($filename, array('Attachment' => true));
}
?>