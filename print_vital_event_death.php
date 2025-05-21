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
    $Death_age = $row['death_country'];
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
    <?php 
    // include 'scroll_css.php'; 
    ?>
    <?php include 'admin_css_death.php'; ?>
    <style>

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
        td {
        padding: 10px 0; /* Adjust as needed */
    }
    .language-dropdown {
    position: relative;
    display: inline-block;
    margin: 4px;
    position: fixed;
    top: 76px;
    right: 20px;
    z-index: 1000;
    font-family: sans-serif;

}

.language-dropdown button {
    background-color: rgb(0, 110, 185);
    color: white;
    padding: 10px 10px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

.language-dropdown button:hover {
    background-color: rgb(73, 139, 184);
}

.language-options {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 100px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
    z-index: 10;
    border-radius: 4px;
    margin-top: 5px;
    
}

.language-options a {
    color: gray;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.language-options a:hover {
    background-color: #f1f1f1;
    color: black;
}

.language-dropdown:hover .language-options {
    display: block;
}
</style>

</head>
<body>
<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="index_am.php?lang=am_ET">አማ</a>
        <a href="index.php?lang=en_US">En</a>
        <a href="index_or.php?lang=or_ET">AO</a>
    </div>
    </div>
<div class="container-fluid">

    
    <div class="table-container">

<center>
<?php if (isset($message)) : ?>
            <div class="not-registered"><?php echo $message; ?></div>
        <?php else : ?>
            

            <div style="border: 10px solid blue; padding: 10px; width: 90%; margin: auto; background-color:white;margin-top:20px;">
<center>
    <div>
        <img src="SASA.png" style="display: inline-block; width: 10%; height: auto; margin-right: 60px;">
        <img src="ASAS.png" alt="Digital Stamp" style="
    position: absolute;
    bottom: 60px;
    right: 250px;
    width: 120px;
    height: auto;
    opacity: 0.9;
    z-index: 10;
">    </div>
</center>
<center>
<h2><font size="6" color="green"><?= __('Federal Democratic Republic of Ethiopia Vital Event Registration Agency')?> </font></h2>
    <h1><font size="6" color="green"><?= __('Death Certificate')?></font></h1>
</center>
    <div style="background-color: #f0f0f0; padding: 10px;">
        <table style="width: 100%; ">
            <tr>
                <td><strong><?= __('Death Identification Number')?>:</strong></td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td><strong><?= __('Deceased Name')?>:</strong></td>
                <td><?php echo $fname; ?></td>
                <td><strong><?= __("Father Name")?>:</strong></td>
                <td><?php echo $mname; ?></td>
                <td><strong><?= __("Grandfather Name")?>:</strong></td>
                <td><?php echo $lname; ?></td>
            </tr>
            <tr>
                <td><strong><?= __('Date of death')?>:</strong></td>
                <td><?php echo $Death_date; ?></td>
                <td><strong><?= __('country')?>:</strong></td>
                <td><?php echo $Death_age; ?></td>
                <td><strong><?= __('Place of Death')?>:</strong></td>
                <td><?php echo $Death_place; ?></td>
            </tr>
            <tr>
                <td><strong><?= __('Nationality')?>:</strong></td>
                <td><?php echo $Nationality; ?></td>
                <td><strong><?= __('Gender')?>:</strong></td>
                <td><?php echo $Sex; ?></td>
                <td><strong><?= __('Registration date')?>:</strong></td>
                <td><?php echo $registration_date; ?></td>
            </tr>
            <tr>
                <td><strong><?= __('Region')?>:</strong></td>
                <td><?php echo $death_Region; ?></td>
                <td><strong><?= __('Zone')?>:</strong></td>
                <td><?php echo $death_Zone; ?></td>
                <td><strong><?= __('Kebele')?>:</strong></td>
                <td><?php echo $Death_kebele; ?></td>
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
</div><br>



<center>
<a href="download_certificate_death.php" class="btn btn-primary"><?= __('Download Certificate')?></a></center>
</center>
<?php endif; ?>
        </div>

</div>
</body>
</html>