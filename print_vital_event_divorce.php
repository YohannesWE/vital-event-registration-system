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
    $Hasband_age=$row['Divorce_country'];
    $Divorce_Zone=$row['Divorce_Zone'];
    $payment = $row['Payment'];
    $civil_registarar_fname = $row['civil_registarar_fname'];
    $civil_registarar_mname = $row['civil_registarar_mname'];
    $civil_registarar_lname = $row['civil_registarar_lname'];

    mysqli_close($conn);
} else {
    $message = "Your application for a Divorce certificate is currently being processed. Please check the status of your application in the application section.";
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <?php include 'admin_css1_applicant.php'; ?>
    <title>Print Divorce Certificate</title>
    <style>
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
    right: 16px;
    width: 120px;
    height: 100;
    opacity: 0.9;
    z-index: 10;">    
    </div>
<h2><font size="6" color="green"><?= __('Federal Democratic Republic of Ethiopia Vital Event Registration Agency')?></font></h2>

<center> <h1><font size="6" color="green"><?= __('Divorce Certificate')?></font></h1></center></capitize>
</center>
    <div style="background-color:rgba(255, 255, 255, 0.72); padding: 10px;">
        <table style="width: 100%;">
        <tr>
                <td><strong><?= __('Death Identification Number')?>:</strong></td>
                <td><?php echo $diId; ?></td>
            </tr>
            <tr>
                <td><strong><?= __("Husband's Last Name")?>:</strong></td>
                <td><u><?php echo $husbandFirstName; ?></u></td>
                <td><strong><?= __("Husband's Middle Name")?>:</strong></td>
                <td><u><?php echo $husbandMiddleName; ?></u></td>
                <td><strong><?= __("Husband's Middle Name")?>:</strong></td>
                <td><?php echo $husbandLastName; ?></td>
            </tr>
            <tr>
                <td><strong><?= __("Wife's First Name")?>:</strong></td>
                <td><u><?php echo $wifeFirstName; ?></u></td>
                <td><strong><?= __("Wife's Middle Name")?>:</strong></td>
                <td><u><?php echo $wifeMiddleName; ?></u></td>
                <td><strong><?= __("Wife's Last Name")?>:</strong></td>
                <td><u><?php echo $wifeLastName; ?></u></td>
            </tr>
            <tr>
                <td><strong><?= __("Husband's Nationality")?>:</strong></td>
                <td><u><?php echo $Husband_Natinality; ?></u></td>
                <td><strong><?= __('Husband age')?>:</strong></td>
                <td><u><?php echo $Hasband_age; ?></u></td>
                <td><strong><?= __('Place of Birth')?> :</strong></td>
                <td><u><?php echo $haseband_birth_place; ?></u></td>
            </tr>
            <tr>
        
                <td><strong><?= __("Wife's Nationality")?>:</strong></td>
                <td><u><?php echo $wife_Natinality; ?></u></td>
                <td><strong><?= __('Registration date')?>:</strong></td>
                <td><u><?php echo $wife_age; ?></u></td>
                <td><strong><?= __('Place of Birth')?>:</strong></td>
                <td><u><?php echo $wife_birth_place; ?></u></td>
            </tr>
            <tr>
                <td><strong><?= __('Wife Birth date')?>:</strong></td>
                <td><u><?php echo $wife_birth_date; ?></u></td>
                <td><strong><?= __('Husband Birth date')?>:</strong></td>
                <td><u><?php echo $hasband_birth_date; ?></u></td>
                <td><strong><?= __('Divorce date')?>:</strong></td>
                <td><u><?php echo $Divorce_date; ?></u></td>
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
    </div>
</div>

 
    <center><a href="download_certificate_divorce.php" class="btn btn-primary"><?= __('Download Certificate')?></a></center>
    <?php endif; ?>
        </div>

    </div>
</body>
</html>