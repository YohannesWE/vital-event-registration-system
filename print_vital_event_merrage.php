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
    $Hasband_age = $row['hasband_birth_date'];
    $wife_age = $row['wife_birth_date'];
    $Hasband_natinality = $row['Hasband_natinality'];
    $wife_natinality = $row['wife_natinality'];
    $marriage_Region = $row['marriage_Region'];
    $marriage_Zone = $row['marriage_Zone'];
    $marriage_kebele = $row['marriage_kebele'];
    $Marrage_date = $row['Marrage_date'];
    $Marrage_condition = $row['Marrage_condition'];
    $Marriage_country = $row['Marriage_country'];
    $Registration_date = $row['Registration_date'];
    $civil_registarar_fname = $row['civil_registarar_fname'];
    $civil_registarar_mname = $row['civil_registarar_mname'];
    $civil_registarar_lname = $row['civil_registarar_lname'];
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
  
    <?php include 'admin_css1_applicant.php'; ?>
    <style>
    *{
        margin: 0;
        padding: 0;
    }
    body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
            .not-registered {
    text-align: center;
    font-size: 18px;
    color: #333;
    padding: 20px;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 400px;
    transition: all 0.3s ease;
}
*{
        margin: 0;
        padding: 0;
    }
    body {
                background-color:rgba(255, 255, 255, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
            .not-registered {
    text-align: center;
    font-size: 18px;
    color: #333;
    padding: 20px;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 400px;
    transition: all 0.3s ease;
}
        .imgg{
            padding-top:5px;
        }
        
        td {
        padding: 10px 0; /* Adjust as needed */
        border: none;
    }
        
       
</style>
</head>
<body>


<div class="container-fluid">

    
    <div class="table-container">

<center>
<?php if (isset($message)) : ?>
            <div class="not-registered"><?php echo $message; ?></div>
        <?php else : ?></center>
        



            <div style="border: 10px solid blue; padding: 10px; width: 100%; margin: auto; background-color:white;margin-top:20px;">
  <center>  
  <div>
        <img src="SASA.png" style="display: inline-block; width: 10%; height: auto; margin-right: 20px;">
        <img src="ASAS.png" alt="Digital Stamp" style="
    position: relative;
    bottom: -570px;
    right: 10px;
    width: 155px;
    height: 100;
    opacity: 0.9;
    z-index: 10;">    
    </div>
    <center>
</center>
<center>
<h2><font size="6" color="green"><?= __('Federal Democratic Republic of Ethiopia Vital Event Registration Agency')?></font></h2>
    <h1><font size="6" color="green"><?= __('Marriage Certificate')?></font></h1>
</center>


    <div style="background-color:rgba(255, 255, 255, 0.72); padding: 10px;">
        <table style="width: 100%;">
            <tr>
                <td><strong><?= __('Marriage Identification Number')?>:</strong></td>
                <td><?php echo $m_id; ?></td>
            </tr>
            <tr>
                <td><strong><?= __("Husband's First Name")?>:</strong></td>
                <td><?php echo $Hasband_fname; ?></td>
                <td><strong><?= __("Husband's Middle Name")?>:</strong></td>
                <td><?php echo $Hasband_mname; ?></td>
                <td><strong><?= __("Husband's Last Name")?>:</strong></td>
                <td><?php echo $Hasband_lname; ?></td>
            </tr>
            <tr>
                <td><strong><?= __("Wife's First Name")?>:</strong></td>
                <td><?php echo $Wife_fname; ?></td>
                <td><strong><?= __("Wife's Middle Name")?>:</strong></td>
                <td><?php echo $Wife_mname; ?></td>
                <td><strong><?= __("Wife's Last Name")?>:</strong></td>
                <td><?php echo $Wife_lname; ?></td>
            </tr>
            <tr>
                <td><strong><?= __('Husband Birth date')?></strong></td>
                <td><?php echo $Hasband_age; ?></td>
                <td><strong><?= __('Wife Birth date')?>:</strong></td>
                <td><?php echo $wife_age; ?></td>
                <td><strong><?= __('Date of Marriage')?> :</strong></td>
                <td><?php echo $Marrage_date; ?></td>
            </tr>
            <tr>
                <td><strong><?= __("Husband's Nationality")?>:</strong></td>
                <td><?php echo $Hasband_natinality; ?></td>
                <td><strong><?= __("Wife's Nationality")?>:</strong></td>
                <td><?php echo $wife_natinality; ?></td>
                <td><strong><?= __('Registration date')?>  :</strong></td>
                <td><?php echo $Registration_date; ?></td>
            </tr>
            <tr>
                <td><strong><?= __('Name of Civil Registrar')?>:</strong></td>
                <td><u><?php echo $civil_registarar_fname; ?></u></td>
                <td><strong><?= __('Father Name')?>:</strong></td>
                <td><u><?php echo $civil_registarar_mname; ?></u></td>
                <td><strong><?= __('Grandfather Name')?>:</strong></td>
                <td><u><?php echo $civil_registarar_lname; ?></u></td>
            </tr>
        </table>
    </div>
    <div style="border-top: 2px solid black; margin-top: 20px; padding-top: 10px; text-align: center;">
        <p><?= __('This certificate')?>.</p>
        <p><?= __('This is a temporary computer-generated certificate')?>.</p>
    </div>
</div>



 <center>
    <a href="download_certificate_merraige.php" class="btn btn-primary"><?= __('Download Certificate')?></a>
    </center>
    <?php endif; ?>
        </div>

    </div>
</body>
</html>


