<?php
session_start();

if (!isset($_SESSION["k_id_no"])) {
    header("Location: exit.php");
    exit();
}
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$k_id_no = $_SESSION['k_id_no'];

$sql = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no' AND Death_states = 'approved' AND Payemnt = 'paid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['d_id'];
    $fname = $row['f_name'];
    $mname = $row['m_name'];
    $lname = $row['l_name'];
    $Sex = $row['Sex'];
    $Nationality = $row['Nationality'];
    $Death_date = $row['Death_date'];
    $Death_age = $row['Death_date'];
    $death_country = $row['death_country'];
    $death_woreda = $row['death_woreda'];
    $death_Region = $row['death_Region'];
    $Death_place = $row['Death_place'];
    $death_Zone = $row['death_Zone'];
    $Death_kebele = $row['Death_kebele'];
    $Marriage_status = $row['Marriage_status'];
    $r_fname = $row['r_fname'];
    $r_mname = $row['r_mname'];

    $civil_registarar_fname = $row['civil_registarar_fname'];
    $civil_registarar_mname = $row['civil_registarar_mname'];
    $civil_registarar_lname = $row['civil_registarar_lname'];
    $registration_date = $row['registration_date'];

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
<div style="border: 5px solid blue; padding: 10px; width: 100%;  background-color:white;margin-top:20px;">

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
        top: 59%;
        left: 70%;
        width: 169px;
        height: auto;
        opacity: 0.9;
        transform: translate(-50%, -50%);
        z-index: 0;
    ">

    <!-- Certificate Text Content -->
    <div style="background-color: #f0f0f0; padding: 10px; position: relative; z-index: 1;">
        <table style="width: 100%;">
            <!-- your rows remain unchanged -->    </div></div>
    </center>
<center>
<h2><font size="6" color="green"> Federal Democratic Republic of Ethiopia Vital Event Registration Agency</font></h2>
    <h1><font size="6" color="green">Death Certificate</font></h1>
</center>
    <div style="background-color: #f0f0f0; padding: 10px;">
        <table style="width: 100%; ">
            <tr>
                <td><strong>Death Identification Number:</strong></td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td><strong>Deceased Name:</strong></td>
                <td><?php echo $fname; ?></td>
                <td><strong>Father's Name:</strong></td>
                <td><?php echo $mname; ?></td>
                <td><strong>Grandfather's Name:</strong></td>
                <td><?php echo $lname; ?></td>
            </tr>
            <tr>
                <td><strong>Date of Death:</strong></td>
                <td><?php echo $Death_date; ?></td>
                <td><strong>Birth date:</strong></td>
                <td><?php echo $Death_age; ?></td>
                <td><strong>Place of death:</strong></td>
                <td><?php echo $Death_place; ?></td>
            </tr>
            <tr>
                <td><strong>Nationality:</strong></td>
                <td><?php echo $Nationality; ?></td>
                <td><strong>Gender:</strong></td>
                <td><?php echo $Sex; ?></td>
                <td><strong>Registration Date:</strong></td>
                <td><?php echo $registration_date; ?></td>
            </tr>
            <tr>
                <td><strong>Region:</strong></td>
                <td><?php echo $death_Region; ?></td>
                <td><strong>Keebele:</strong></td>
                <td><?php echo $Death_kebele; ?></td>
            </tr>

            <tr>
                <td><strong>Name of Civil Registrar:</strong></td>
                <td><?php echo $civil_registarar_fname; ?></td>
                <td><strong>Father Name:</strong></td>
                <td><?php echo $civil_registarar_mname; ?></td>
                <td><strong>Grandfather Name:</strong></td>
                <td><?php echo $civil_registarar_lname; ?></td>
            </tr>
        </table>
    </div>
    <div style="border-top: 2px solid black; margin-top: 20px; padding-top: 10px; text-align: center;">
        <p>This certificate is issued in accordance with the regulations of the F.D.R.E vital event registration agency.</p>
        <p>This is a temporary computer-generated certificate.</p>
    </div>
</div><br>
    
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
    $pdf->stream("death_certificate.pdf", array('Attachment' => true));
   
} else {
    mysqli_close($conn);
    
    echo "<script>alert('No death certificate found for the current user.'); window.location.href = 'applicant.php';</script>";
    
    exit();
  
}
?>

