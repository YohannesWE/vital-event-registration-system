<?php
session_start();

if (!isset($_SESSION["k_id_no"])) {
    header("Location: exit.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$k_id_no = $_GET['k_id_no'];

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
    $Birth_date = $row['Birth_date'];
    $Death_date = $row['Death_date'];
    
    if (!empty($Birth_date) && !empty($Death_date)) {
        $birthDateTime = new DateTime($Birth_date);
        $deathDateTime = new DateTime($Death_date);
        $ageInterval = $birthDateTime->diff($deathDateTime);
        $Death_age = $ageInterval->y . ' years';
    } else {
        $Death_age = 'N/A';
    }
    $death_country = $row['death_country'];
    $death_woreda = $row['death_woreda'];
    $death_Region = $row['death_Region'];
    $death_Zone = $row['death_Zone'];
    $Death_kebele = $row['Death_kebele'];
    $Marriage_status = $row['Marriage_status'];
    $r_fname = $row['r_fname'];
    $r_mname = $row['r_mname'];

    $birthcity = $row['child_number'];

    mysqli_close($conn);
} else {
    $message = "Your application for a death certificate is currently being processed. Please check the status of your application in the application section.";
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print death Certificate</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>

        .not-registered {
            font-size: 24px;
            color: red;
            margin-top: 20px;
        }
        td {
        padding: 10px 0; /* Adjust as needed */
    }
        
</style>

</head>
<body>

<div class="container-fluid">

    
    <div class="table-container">

<center>
<?php if (isset($message)) : ?>
            <div class="not-registered"><?php echo $message; ?></div>
        <?php else : ?>
            <center>
    <div>
        <img src="SASA.png" style="display: inline-block; width: 10%; height: auto; margin-right: 60px;">
<div style="border: 2px solid black; padding: 20px; width: 80%; margin: auto; position: relative; overflow: hidden;">

    <!-- Digital Stamp (Background) -->
    <img src="ASAS.png" alt="Digital Stamp" style="
        position: absolute;
        top: 50%;
        left: 50%;
        width: 250px;
        height: auto;
        opacity: 0.1;
        transform: translate(-50%, -50%);
        z-index: 0;
    ">

    <!-- Certificate Text Content -->
    <div style="background-color: #f0f0f0; padding: 10px; position: relative; z-index: 1;">
        <table style="width: 100%;">
            <!-- your rows remain unchanged -->    </div>
</center>
<center>
<h2><font size="6" color="green"> Federal Democratic Republic of Ethiopia Vital Event Registration Agency</font></h2>
    <h1><font size="6" color="green">Death Certificate</font></h1>
</center>

<div style="border: 2px solid black; padding: 20px; width: 80%; margin: auto;">
    <div style="background-color: #f0f0f0; padding: 10px;">
        <table style="width: 100%;">
            <tr>
                <td><strong>Death Identification Number:</strong></td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td><?php echo $fname; ?></td>
                <td><strong>Father's Name:</strong></td>
                <td><?php echo $mname; ?></td>
                <td><strong>Grandfather's Name:</strong></td>
                <td><?php echo $lname; ?></td>
            </tr>
            <tr>
                <td><strong>Date of Death:</strong></td>
                <td><?php echo $Death_date; ?></td>
                <td><strong>age:</strong></td>
                <td><?php echo $Death_age; ?></td>
                <td><strong>Year:</strong></td>
                <td><?php echo $Death_age; ?></td>
            </tr>
            <tr>
                <td><strong>Nationality:</strong></td>
                <td><?php echo $Nationality; ?></td>
                <td><strong>Sex:</strong></td>
                <td><?php echo $Sex; ?></td>
                <td><strong>Registration Date:</strong></td>
                <td><?php echo $Sex; ?></td>
            </tr>
            <tr>
                <td><strong>Region:</strong></td>
                <td><?php echo $death_Region; ?></td>
                <td><strong>Zone:</strong></td>
                <td><?php echo $death_Zone; ?></td>
                <td><strong>Kebele:</strong></td>
                <td><?php echo $Death_kebele; ?></td>
            </tr>

            <tr>
                <td><strong>Name of Civil Registrar:</strong></td>
                <td><?php echo $Death_date; ?></td>
                <td><strong>Father Name:</strong></td>
                <td><?php echo $Death_date; ?></td>
                <td><strong>Grandfather Name:</strong></td>
                <td><?php echo $Death_date; ?></td>
            </tr>
        </table>
    </div>
    <div style="border-top: 2px solid black; margin-top: 20px; padding-top: 10px; text-align: center;">
        <p>This certificate is issued in accordance with the regulations of the Federal Democratic Republic of Ethiopia's Vital Events Registration Agency.</p>
        <p>This is a computer-generated certificate.</p>
    </div>
</div><br>



<center>
<a href="download_certificate_death.php" class="btn btn-primary">Download death Certificate</a></center>
</center>
<?php endif; ?>
        </div>

</div>
</body>
</html>