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
$sql = "SELECT * FROM birth_table WHERE username = '$username' AND Birth_status = 'approved' AND Payment = 'paid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['b_id'];
   
    $fname = $row['f_name'];
    $mname = $row['m_name'];
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
} else {

    $message = "You have no ready birth certficate . check your application status in my application section:";
    

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Print Birth Certificate</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'children_page.php'; ?>
    <style>
            body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
 </style>
<style>
    *{
        margin: 0;
        padding: 0;
    }

        .not-registered {
            font-size: 24px;
            color: red;
            margin-top: 20px;
        }
        td {
        padding: 10px 0; /* Adjust as needed */
    }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: none;
    }
    .imgg{
            padding-top:5px;
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
         
<div style="border: 10px solid blue; padding: 10px; width: 90%; margin: auto; background-color:white;margin-top:20px;">
<center>
    <div>
        <img src="SASA.png" style="display: inline-block; width: 10%; height: auto; margin-right: 60px;">
        <img src="ASAS.png" style="display: inline-block; width: 10%; height: auto;">
    </div>
</center>
<center>
    <h2><font size="6" color="green"><?= __('Federal Democratic Republic of Ethiopia Vital Event Registration Agency')?> </font></h2>
    <h2><font size="6" color="green"><?= __('Birth Certificate')?></font></h2>
</center>
<div style="background-color:rgba(106, 164, 194, 0.72); padding: 10px;">
        <table style="width: 100%;">
            <tr>
                <td><strong><?= __('Birth Identification Number')?>:</strong></td>
                <td><?php echo $id; ?></td>
            </tr>
          
            <tr>
                <td><strong><?= __('Name')?>:</strong></td>
                <td><?php echo $fname; ?></td>
                <td><strong><?= __('Father Name')?>:</strong></td>
                <td><?php echo $mname; ?></td>
                <td><strong><?= __('Grandfather Name')?>:</strong></td>
                <td><?php echo $mmname; ?></td>
            </tr>
     
            <tr>
                <td><strong><?= __('Nationality')?>:</strong></td>
                <td><?php echo $nationality; ?></td>
                <td><strong><?= __('Gender')?>:</strong></td>
                <td><?php echo $sex; ?></td>
                <td><strong><?= __('Registration date')?>:</strong></td>
                <td><?php echo $Registration_date; ?></td>
            </tr>
      
            <tr>
                <td><strong><?= __('Region')?>:</strong></td>
                <td><?php echo $Birth_Region; ?></td>
                <td><strong><?= __('Zone')?>:</strong></td>
                <td><?php echo $Birth_Zone; ?></td>
                <td><strong><?= __('Kebele')?>:</strong></td>
                <td><?php echo $Birth_kebele; ?></td>
            </tr>
    
            <tr>
                <td><strong><?= __("Mother's First Name")?>:</strong></td>
                <td><?php echo $Mother_fname; ?></td>
                <td><strong><?= __("Mother's Middle Name")?>:</strong></td>
                <td><?php echo $Mother_mname; ?></td>
                <td><strong><?= __("Husband's Name")?>:</strong></td>
                <td><?php echo $Mother_lname; ?></td>
         
            </tr>
      
            <tr>
                <td><strong><?= __("Father's First Name")?>:</strong></td>
                <td><?php echo $father_fname; ?></td>
                <td><strong><?= __("Father's Middle Name")?>:</strong></td>
                <td><?php echo $father_mname; ?></td>
                <td><strong><?= __("Father's Last Name")?>:</strong></td>
                <td><?php echo $father_lname; ?></td>
            </tr>
         
            <tr>
                <td><strong><?= __('Birth date')?>:</strong></td>
                <td><?php echo $birthdate; ?></td>
                <td><strong><?= __("Mother's Nationality")?>:</strong></td>
                <td><?php echo $mother_natinality; ?></td>
                <td><strong><?= __("Father's Nationality")?>:</strong></td>
                <td><?php echo $father_natinality; ?></td>
            </tr>
   
            <tr>
                <td><strong><?= __('Name of Civil Registrar')?>:</strong></td>
                <td><?php echo $civil_registarar_fname; ?></td>
                <td><strong><?= __('Father Name')?>:</strong></td>
                <td><?php echo $civil_registarar_mname; ?></td>
                <td><strong><?= __('Grandfather Name')?>:</strong></td>
                <td><?php echo $civil_registarar_lname; ?></td>
            </tr>
        
        </table>
    </div>
    <div style="border-top: 2px solid black; margin-top: 20px; padding-top: 10px; text-align: center;">
        <p><?= __('This certificate')?>.</p>
        <p><?= __('This is a temporary computer-generated certificate')?>.</p>
    </div>
</div><br>

<center><a href="download_certificate_birth.php" class="btn btn-primary"><?= __('Download Certificate')?></a></center>

<?php endif; ?>
</body>
</html>





