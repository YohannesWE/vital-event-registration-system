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
} else {


    $message = "Your application for a birth certificate is currently being processed. Please check the status of your application in the application section.";
    

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Print Birth Certificate</title>
 
    <?php include 'admin_css1_applicant.php'; ?>
<style>
    
    *{
        margin: 30;
        padding: 0;
    }

.not-registered {
    text-align: center;
    font-size: 18px;
    color: rgb(255, 255, 255);
    padding: 20px;
    background-color:rgb(255, 255, 255);
    border: 1px solid rgb(255, 255, 255);
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 600px;
    transition: all 0.3s ease;
}

.not-registered:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.not-registered p {
    margin-top: 10px;
    color: rgb(255, 255, 255);
}

.not-registered a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.not-registered a:hover {
    color: #0056b3;
}

td {
        padding: 10px 0; /* Adjust as needed */
        
    }
    body {
            background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
            .language-dropdown {
    position: relative;
    display: inline-block;
    margin: 4px;
    position: fixed;
    top: 120px;
    right: 20px;
    z-index: 1000;
    font-family: sans-serif;

}
.not-registered {
    text-align: center;
    font-size: 18px;
    color: #333;
    padding: 20px;
    background-color: #f8f9fa;
    border: 1px solid rgb(255, 255, 255);
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 400px;
    transition: all 0.3s ease;
}
        td {
        padding: 10px 0; /* Adjust as needed */
        background-color:rgb(255, 255, 255);
        border: none;
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
    background-color: rgb(255, 255, 255);
    color: white;
    padding: 10px 10px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

.language-dropdown button:hover {
    background-color: rgb(255, 255, 255);
}

.language-options {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 100px;
    box-shadow: 0px 4px 8px rgb(255, 255, 255);
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

<div class="container-fluid">

    
<div class="table-container">
<center>
<?php if (isset($message)) : ?>
    <div class="not-registered"><?php echo $message; ?></div>
<?php else : ?>
</center>


<div style="border: 10px solid blue; padding: 10px; width: 100%; margin: auto; background-color:white;margin-top:20px;">
<center>
<div>
        <img src="SASA.png" style="display: inline-block; width: 10%; height: auto; margin-right: 20px;">
        <img src="ASASnew.png" alt="Digital Stamp" style="
    position: relative;
    bottom: -645px;
    right: 16px;
    width: 120px;
    height: 100;
    opacity: 0.9;
    z-index: 10;">    
    </div>
</center>
<center>
    <h2><font size="6" color="green"><?= __('Federal Democratic Republic of Ethiopia Vital Event Registration Agency')?> </font></h2>
    <h2><font size="6" color="green"><?= __('Birth Certificate')?></font></h2>
</center>
<div style="background-color:rgba(255, 255, 255, 0.72); padding: 10px;">
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
            </tr>
    
            <tr>
                <td><strong><?= __("Mother's First Name")?>:</strong></td>
                <td><?php echo $Mother_fname; ?></td>
                <td><strong><?= __("Mother's Middle Name")?>:</strong></td>
                <td><?php echo $Mother_mname; ?></td>
                <td><strong><?= __("Mother's Last Name")?>:</strong></td>
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
</div>

</>
</body>
</html>





