<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION["username"];
$sql = "SELECT * FROM marriage_table WHERE username = '$username' AND Marriage_status = 'approved' AND Payemnt = 'paid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $m_id = $row['m_id'];
    $Hasband_fname = $row['Hasband_fname'];
    $Hasband_mname = $row['Hasband_mname'];
    $Hasband_lname = $row['Hasband_lname'];
    $Wife_fname = $row['Wife_fname'];
    $Wife_mname = $row['Wife_mname'];
    $Wife_lname = $row['Wife_lname'];

   
    $Hasband_natinality = $row['Hasband_natinality'];
    $wife_natinality = $row['wife_natinality'];
    $marriage_Region = $row['marriage_Region'];
    $marriage_Zone = $row['marriage_Zone'];
    $marriage_kebele = $row['marriage_kebele'];
    $Marrage_date = $row['Marrage_date'];
    $Marrage_condition = $row['Marrage_condition'];
    $Marriage_country = $row['Marriage_country'];
    $Marriage_paper = $row['Marriage_paper'];
    $civil_registarar_fname = $row['civil_registarar_fname'];
    $civil_registarar_mname = $row['civil_registarar_mname'];
    $civil_registarar_lname = $row['civil_registarar_lname'];
    
    mysqli_close($conn);

    // Create a new PDF instance
    $pdf = new Dompdf();

    // Start buffering the output
    ob_start();

    ?>

<style>

td {
    padding: 10px;
}
</style>
<div style="border: 5px solid blue; padding: 10px; width: 100%;  background-color:white;margin-top:2px;">
<center>
        <div>
            <?php
            // Provide the absolute paths to the images
            $imagePath1 = 'C:\xampp\htdocs\ksw02\SASA.png'; // Adjust the path as necessary
            $imagePath2 = 'C:\xampp\htdocs\ksw02\ASASnew.png'; // Adjust the path as necessary

            // Convert the images to base64 format
            $imageData1 = base64_encode(file_get_contents($imagePath1));
            $imageData2 = base64_encode(file_get_contents($imagePath2));
            ?>
            <img src="data:image/png;base64,<?php echo $imageData1; ?>" style="display: inline-block; width: 10%; height: auto; margin-right: 60px;">
            <img src="data:image/png;base64,<?php echo $imageData2; ?>" style="
        position: absolute;
        top: 74.711%;
        left: 70%;
        width: 159px;
        height: auto;
        opacity: 0.9;
        transform: translate(-50%, -50%);
        z-index: 0;
    ">

        </div>
    </center>
    <center>
  <center> <h2><font size="6" color="green"> Federal Democratic Republic of Ethiopia Vital Event Registration Agency</font></h2></center>
    <h1><font size="6" color="green">Marriage Certificate</font></h1>
</center>
    <div style="background-color: #f0f0f0; padding: 10px;">
        <table style="width: 100%;">
            <tr>
                <td><strong>Marriage Identification Number:</strong></td>
                <td><?php echo $m_id; ?></td>
            </tr>
            <tr>
                <td><strong>Husband's Name:</strong></td>
                <td><?php echo $Hasband_fname; ?></td>
                <td><strong>Father's Name:</strong></td>
                <td><?php echo $Hasband_mname; ?></td>
                <td><strong>Grandfather's Name:</strong></td>
                <td><?php echo $Hasband_lname; ?></td>
            </tr>
            <tr>
                <td><strong>Maqaa Abbaa Manaa:</strong></td>
                <td><?php echo $Hasband_fname; ?></td>
                <td><strong>Maqaa Abbaa Manaa:</strong></td>
                <td><?php echo $Hasband_mname; ?></td>
                <td><strong>Maqaa Akaakayyuu:</strong></td>
                <td><?php echo $Hasband_lname; ?></td>
            </tr>
            <tr>
                <td><strong>Wife's Name:</strong></td>
                <td><?php echo $Wife_fname; ?></td>
                <td><strong>Father's Name:</strong></td>
                <td><?php echo $Wife_mname; ?></td>
                <td><strong>Grandfather's Name:</strong></td>
                <td><?php echo $Wife_lname; ?></td>
            </tr>
            <tr>
                <td><?php echo $Wife_fname; ?></td>
                <td><?php echo $Wife_mname; ?></td>
                <td><?php echo $Wife_lname; ?></td>
            </tr>
            <tr>
            <td><strong>Husband birth date :</strong></td>
                <td><?php echo $Marrage_date; ?></td>
            <td><strong>Wife Birth Date:</strong></td>
                <td><?php echo $Marrage_date; ?></td>
                <td><strong>Date of Marriage :</strong></td>
                <td><?php echo $Marrage_date; ?></td>
            </tr>
            <tr>
                <td><?php echo $Marrage_date; ?></td>
                <td><?php echo $Marrage_date; ?></td>
                <td><?php echo $Marrage_date; ?></td>
            </tr>
            <tr>
                <td><strong>Husband Nationality:</strong></td>
                <td><?php echo $Hasband_natinality; ?></td>
                <td><strong>Wife Nationality:</strong></td>
                <td><?php echo $wife_natinality; ?></td>
                <td><strong> Registration Date :</strong></td>
                <td><?php echo $wife_natinality; ?></td>
            </tr>
            <tr>
                <td><strong>Abbaan manaa Sabummaa:</strong></td>
                <td><?php echo $Hasband_natinality; ?></td>
                <td><strong>Haadha manaa Sabummaa:</strong></td>
                <td><?php echo $wife_natinality; ?></td>
                <td><strong> Guyyaa Galmee :</strong></td>
                <td><?php echo $wife_natinality; ?></td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td><strong>Name of Civil Registrar:</strong></td>
                <td><u><?php echo $civil_registarar_fname; ?></u></td>
                <td><strong>Father's Name:</strong></td>
                <td><u><?php echo $civil_registarar_mname; ?></u></td>
                <td><strong>Grandfather's Name:</strong></td>
                <td><u><?php echo $civil_registarar_lname; ?></u></td>
            </tr>
            <tr>
                <td><strong>maqaa duraa  qonda gelmee kebjaa :</strong></td>
                <td><?php echo $civil_registarar_fname; ?></td>
                <td><?php echo $civil_registarar_mname; ?></td>
                <td><?php echo $civil_registarar_lname ?></td>
            </tr>
        </table>
    </div>
    <div style="border-top: 2px solid black; margin-top: 20px; padding-top: 10px; text-align: center;">
        <p>This certificate is issued in accordance with the regulations of the F.D.R.E vital event registration agency.</p>
        <p>This is a temporary computer-generated certificate.</p>
    </div>
</div>

    <?php

    // Get the buffered output
    $html = ob_get_clean();

    // Load HTML content into the PDF
    $pdf->loadHtml($html);

    // Set the paper size and orientation
    $pdf->setPaper('A3', 'landscape');

    // Render the PDF
    $pdf->render();

    // Output the PDF content to the browser for download
    $pdf->stream("marriage_certificate.pdf", array('Attachment' => true));
    
} else {
    mysqli_close($conn);
    echo "<script>alert('No marriage certificate found for the current user.'); window.location.href = 'Print_Certificate.php';</script>";
    exit();
}
?>
