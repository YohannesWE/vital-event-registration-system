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
$sql = "SELECT * FROM divorce_table WHERE username = '$username' AND Divorce_states = 'approved' AND Payment = 'paid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $diId = $row['di_id'];
    $husbandFirstName = $row['Hasband_fname'];
    $husbandMiddleName = $row['Hasband_mname'];
    $husbandLastName = $row['Hasband_lname'];
    $wifeFirstName = $row['wife_fname'];
    $wifeMiddleName = $row['wife_mname'];
    $wifeLastName = $row['wife_lname'];
    $divorceKebele = $row['Divorce_kebele'];
    $numberOfChildren = $row['Number_of_child'];
    $Divorce_date = $row['Divorce_date'];
    $divorcePaper = $row['Divorce_paper'];
    $divorceStates = $row['Divorce_states'];
    $Husband_Natinality=$row['Husband_Natinality'];
    $wife_Natinality=$row['wife_Natinality'];
    $Divorce_Region=$row['Divorce_Region'];
    $divorceKebele = $row['Divorce_kebele'];
    $wife_birth_place=$row['wife_birth_place'];
    $hasband_birth_date=$row['hasband_birth_date'];
    $wife_birth_date=$row['wife_birth_date'];
    $haseband_birth_place=$row['husband_birth_place'];
    $wife_age=$row['Registration_date'];
    $Hasband_age=$row['Divorce_woreda'];
    $Divorce_Zone=$row['Divorce_Zone'];
    $payment = $row['Payment'];
    $civil_registarar_fname = $row['civil_registarar_fname'];
    $civil_registarar_mname = $row['civil_registarar_mname'];
    $civil_registarar_lname = $row['civil_registarar_lname'];
    
    $birthregion = $row['Divorce_states'];
    $birthzone = $row['Payment'];
    

    mysqli_close($conn);

    // Create a new PDF instance
    $pdf = new Dompdf();

    // Start buffering the output
    ob_start();
    ?>

<style>

td {
    padding: 6px;
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
        top: 76%;
        left: 70%;
        width: 159px;
        height: auto;
        opacity: 0.9;
        transform: translate(-50%, -50%);
        z-index: 0;
    ">

    <!-- Certificate Text Content -->
         <h2><font size="6" color="green"> Federal Democratic Republic of Ethiopia Vital Event Registration Agency</font></h2> </center>
<center> <h1><font size="6" color="green">Divorce Certificate</font></h1></center>
    <div style="background-color:rgb(255, 255, 255); padding: 15px;">
    <table style="width: 100%;">
        <tr>
                <td><strong>Divorce Identification Number:</strong></td>
                <td><?php echo $diId; ?></td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td><strong>Husband's Name:</strong></td>
                <td><u><?php echo $husbandFirstName; ?></u></td>
                <td><strong>Husband's Father's Name:</strong></td>
                <td><u><?php echo $husbandMiddleName; ?></u></td>
                <td><strong>Husband's Grandfather's Name:</strong></td>
                <td><?php echo $husbandLastName; ?></td>
            </tr>
            <tr>
                <td><u><?php echo $husbandFirstName; ?></u></td>
                <td><u><?php echo $husbandMiddleName; ?></u></td>
                <td><?php echo $husbandLastName; ?></td>
            </tr>
            <tr>
                <td><strong>Wife's Father Name:</strong></td>
                <td><u><?php echo $wifeFirstName; ?></u></td>
                <td><strong>Wife's Father Name:</strong></td>
                <td><u><?php echo $wifeMiddleName; ?></u></td>
                <td><strong>Wife's Grandfather's Name:</strong></td>
                <td><u><?php echo $wifeLastName; ?></u></td>
            </tr>
            <tr>
                <td><u><?php echo $wifeFirstName; ?></u></td>
                <td><u><?php echo $wifeMiddleName; ?></u></td>
                <td><u><?php echo $wifeLastName; ?></u></td>
            </tr>
            <tr>
                <td><strong>Husband Nationality:</strong></td>
                <td><u><?php echo $Husband_Natinality; ?></u></td>
                <td><u><?php echo $Hasband_age; ?></u></td>
                <td><strong>place of Birth :</strong></td>
                <td><u><?php echo $haseband_birth_place; ?></u></td>
            </tr>
            <tr>
                <td><u><?php echo $Husband_Natinality; ?></u></td>
                <td><u><?php echo $Hasband_age; ?></u></td>
                <td><u><?php echo $haseband_birth_place; ?></u></td>
            </tr>
            <tr>
        
                <td><strong>wife Nationality:</strong></td>
                <td><u><?php echo $wife_Natinality; ?></u></td>
                <td><strong>Registration date:</strong></td>
                <td><u><?php echo $wife_age; ?></u></td>
                <td><strong>place of birth :</strong></td>
                <td><u><?php echo $wife_birth_place; ?></u></td>
            </tr>
            <tr>
        
        <td><u><?php echo $wife_Natinality; ?></u></td>
        <td><u><?php echo $wife_age; ?></u></td>
        <td><u><?php echo $wife_birth_place; ?></u></td>
    </tr>
            <tr>
                <td><strong>wife birth date:</strong></td>
                <td><u><?php echo $wife_birth_date; ?></u></td>
                <td><strong>Husband birth Date:</strong></td>
                <td><u><?php echo $hasband_birth_date; ?></u></td>
                <td><strong>Date of divorce:</strong></td>
                <td><u><?php echo $Divorce_date; ?></u></td>
            </tr>
            <tr>
                <td><u><?php echo $wife_birth_date; ?></u></td>
                <td><u><?php echo $hasband_birth_date; ?></u></td>
                <td><u><?php echo $Divorce_date; ?></u></td>
            </tr>
        
     
           
            <tr>
                <td><strong>Name of Civil Registrar:</strong></td>
                <td><u><?php echo $civil_registarar_fname; ?></u></td>
                <td><strong>Father's Name:</strong></td>
                <td><u><?php echo $civil_registarar_lname; ?></u></td>
            </tr>
            <tr>
                <td><?php echo $civil_registarar_fname; ?></td>
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
     $pdf->stream($username , array('Attachment' => true));

} else {
    mysqli_close($conn);
    
    echo "<script>alert('No divorce certificate found for the current user.'); window.location.href = 'Print_Certficate.php';</script>";
    
    exit();
  
}
?>