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
$sql = "SELECT * FROM birth_table WHERE username = '$username' AND Birth_status = 'approved' AND Payment = 'paid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['b_id'];
    $fname = $row['f_name'];
    $mname = $row['father_fname'];
    $mmname = $row['l_name'];
    $Mother_fname = $row['Mother_fname'];
    $Mother_mname = $row['Mother_mname'];
    $Mother_lname = $row['Mother_lname'];
    $Registration_date = $row['Registration_date'];
    $birthdate = $row['Birthdate'];
    $nationality = $row['Nationality'];
    $birthregion = $row['Birth_kebele'];
    $sex = $row['sex'];
    $father_lname = $row['father_lname'];
    $father_mname = $row['father_mname'];
    $father_fname = $row['father_fname'];
    $Birth_Region = $row['Birth_Region'];
    $Birth_Zone = $row['Birth_Zone'];
    $Birth_kebele = $row['Birth_kebele'];
    $mother_natinality = $row['mother_natinality'];
    $father_natinality = $row['father_natinality'];
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
            padding: 7px;
        }
        .certificate-container {
            border: 5px solid blue;
            padding: 8px;
            width: 100%;
            background-color: white;
            margin-top: 20px;
            position: relative;
        }
        .header-image {
            display: inline-block;
            width: 8%;
            height: auto;
            margin-right: 60px;
        }
        .background-image {
            position: absolute;
            top: 25%;
            left: 25%;
            width: 225px;
            height: auto;
            opacity: 0.1;
            transform: translate(-50%, -50%);
            z-index: -1; /* Background image, low priority */
        }
        .stamp-image {
            position: absolute;
            top: 76%; /* Fixed vertical position */
            left: 72%; /* Fixed horizontal position */
            width: 160px; /* Adjust width as needed */
            height: auto;
            transform: translate(-50%, -50%); /* Center it properly */
            z-index: 9999; /* Very high priority, in front of everything */
            opacity: 0.5; /* Adjust opacity for watermark effect */
        }
        .content {
            z-index: 1; /* Ensure content is on top of background but below the stamp */
        }
    </style>

    <div class="certificate-container">
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
                <img src="data:image/png;base64,<?php echo $imageData1; ?>" class="header-image">
                <!-- Background image with opacity -->
                <img src="data:image/png;base64,<?php echo $imageData1; ?>" class="background-image">
                <!-- Stamp image placed in front of content with z-index 9999 -->
                <img src="data:image/png;base64,<?php echo $imageData2; ?>" class="stamp-image">
            </div>
        </center>
        <center>
            <h2><font size="6" color="green">Federal Democratic Republic of Ethiopia Vital Event Registration Agency</font></h2>
            <h2><font size="6" color="green">Birth Certificate</font></h2>
        </center>
        <div style="background-color: #f0f0f0; padding: 10px;" class="content">
            <table style="width: 100%;">
                <tr>
                    <td><strong>Birth Identification Number:</strong></td>
                    <td><?php echo $id; ?></td>
                </tr>
                <tr>
                    <td><strong>Lakkoofsa Eenyummaa Dhalootaa:</strong></td>
                    <td><?php echo $id; ?></td>
                </tr>
                <tr>
                    <td><strong>Name:</strong></td>
                    <td><?php echo $fname; ?></td>
                    <td><strong>Father's Name:</strong></td>
                    <td><?php echo $mname; ?></td>
                    <td><strong>Grandfather's Name:</strong></td>
                    <td><?php echo $mmname; ?></td>
                </tr>
                <tr>
                    <td><strong>Maqaa:</strong></td>
                    <td><?php echo $fname; ?></td>
                    <td><strong>Maqaa Abbaa:</strong></td>
                    <td><?php echo $mname; ?></td>
                    <td><strong>Maqaa Akaakayyuu:</strong></td>
                    <td><?php echo $mmname; ?></td>
                </tr>
                <tr>
                    <td><strong>Nationality:</strong></td>
                    <td><?php echo $nationality; ?></td>
                    <td><strong>Sex:</strong></td>
                    <td><?php echo $sex; ?></td>
                    <td><strong>Registration Date:</strong></td>
                    <td><?php echo $Registration_date; ?></td>
                </tr>
                <tr>
                    <td><strong>Lammummaa:</strong></td>
                    <td><?php echo $nationality; ?></td>
                    <td><strong>koorniyaa:</strong></td>
                    <td><?php echo $sex; ?></td>
                    <td><strong>Guyyaa Galmee:</strong></td>
                    <td><?php echo $Registration_date; ?></td>
                </tr>
                <tr>
                    <td><strong>Mother First Name:</strong></td>
                    <td><?php echo $Mother_fname; ?></td>
                    <td><strong>Mother Middle Name:</strong></td>
                    <td><?php echo $Mother_mname; ?></td>
                    <td><strong>Mother Last Name:</strong></td>
                    <td><?php echo $Mother_lname; ?></td>
                </tr>
                <tr>
                    <td><strong>Haadha Maqaa Duraa:</strong></td>
                    <td><?php echo $Mother_fname; ?></td>
                    <td><strong>Maqaa Giddugaleessaa Haadha:</strong></td>
                    <td><?php echo $Mother_mname; ?></td>
                    <td><strong>Haadha Maqaa Dhumaa:</strong></td>
                    <td><?php echo $Mother_lname; ?></td>
                </tr>
                <tr>
                    <td><strong>Father First Name:</strong></td>
                    <td><?php echo $father_fname; ?></td>
                    <td><strong>Father Middle Name:</strong></td>
                    <td><?php echo $father_mname; ?></td>
                    <td><strong>Father Last Name:</strong></td>
                    <td><?php echo $father_lname; ?></td>
                </tr>
                <tr>
                    <td><strong>Abbaa Maqaa Duraa:</strong></td>
                    <td><?php echo $father_fname; ?></td>
                    <td><strong>Abbaa Maqaa Giddugaleessaa:</strong></td>
                    <td><?php echo $father_mname; ?></td>
                    <td><strong>Maqaa Dhumaa Abbaa:</strong></td>
                    <td><?php echo $father_lname; ?></td>
                </tr>
                <tr>
                    <td><strong>Date of Birth:</strong></td>
                    <td><?php echo $birthdate; ?></td>
                    <td><strong>Mother Nationality:</strong></td>
                    <td><?php echo $mother_natinality; ?></td>
                    <td><strong>Father Nationality:</strong></td>
                    <td><?php echo $father_natinality; ?></td>
                </tr>
                <tr>
                    <td><strong>Guyyaa Dhalootaa:</strong></td>
                    <td><?php echo $birthdate; ?></td>
                    <td><strong>Haadha Sabummaa:</strong></td>
                    <td><?php echo $mother_natinality; ?></td>
                    <td><strong>Abbaa Sabummaa:</strong></td>
                    <td><?php echo $father_natinality; ?></td>
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
        <div style="border-top: 1px solid black; margin-top: 19px; padding-top: 8px; text-align: center;">
            <p>This certificate is issued in accordance with the regulations of the F.D.R.E vital event registration agency.</p>
            <p>This is a temporary computer-generated certificate.</p>
            <p>Kun ragaa yeroof kompiitaraan hojjetameedha.</p>
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
    $pdf->stream("birth_certificate.pdf", array('Attachment' => true));
} else {
    mysqli_close($conn);
    echo "<script>alert('No birth certificate found for the current user.'); window.location.href = 'applicant.php';</script>";
    exit();
}
?>
