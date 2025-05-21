<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$username = $_GET["username"];
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
    $Hasband_age = $row['Hasband_age'];
    $wife_age = $row['wife_age'];
    $Hasband_natinality = $row['Hasband_natinality'];
    $wife_natinality = $row['wife_natinality'];
    $marriage_Region = $row['marriage_Region'];
    $marriage_Zone = $row['marriage_Zone'];
    $marriage_kebele = $row['marriage_kebele'];
    $Marrage_date = $row['Marrage_date'];
    $Marrage_condition = $row['Marrage_condition'];
    $Marriage_country = $row['Marriage_country'];
    $Marriage_paper = $row['Marriage_paper'];
   

    mysqli_close($conn);
} else {
    $message = "Your application for a marriage certificate is currently being processed. Please check the status of your application in the application section.";
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Marriage Certificate</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
    <style>
    *{
        margin: 0;
        padding: 0;
    }
    body {
                background-color: #f6e9ff;

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
        .not-registered {
            font-size: 24px;
            color: red;
            margin-top: 20px;
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
        <img src="ASAS.png" style="display: inline-block; width: 10%; height: auto;">
    </div>
</center>
<center>
<h2><font size="6" color="green"> Federal Democratic Republic of Ethiopia Vital Event Registration Agency</font></h2>
    <h1><font size="6" color="green">Marriage Certificate</font></h1>
</center>

<div style="border: 2px solid black; padding: 20px; width: 80%; margin: auto;">
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
                <td><strong>Wife's Name:</strong></td>
                <td><?php echo $Wife_fname; ?></td>
                <td><strong>Father's Name:</strong></td>
                <td><?php echo $Wife_mname; ?></td>
                <td><strong>Grandfather's Name:</strong></td>
                <td><?php echo $Wife_lname; ?></td>
            </tr>
            <tr>
                <td><strong>Husband age:</strong></td>
                <td><?php echo $Hasband_age; ?></td>
                <td><strong>Wife age:</strong></td>
                <td><?php echo $wife_age; ?></td>
                <td><strong>Date of Marriage :</strong></td>
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
                <td><strong>Region:</strong></td>
                <td><?php echo $marriage_Region; ?></td>
                <td><strong>Zone:</strong></td>
                <td><?php echo $marriage_Zone; ?></td>
                <td><strong> kebele :</strong></td>
                <td><?php echo $marriage_kebele; ?></td>
            </tr>
          
        </table>
    </div>
    <div style="border-top: 2px solid black; margin-top: 20px; padding-top: 10px; text-align: center;">
        <p>This certificate is issued in accordance with the regulations of the F.D.R.E vital event registration agency.</p>
        <p>This is computer genrated certificate .</p>
    </div>
</div>



 
    <?php endif; ?>
        </div>

    </div>
</body>
</html>


