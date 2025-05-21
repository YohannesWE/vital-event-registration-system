<?php
session_start();



$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$username = $_GET["username"];
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
 
    <?php include 'admin_css_manager.php'; ?>
<style>
    *{
        margin: 0;
        padding: 0;
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

.not-registered:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.not-registered p {
    margin-top: 10px;
    color: #666;
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
                background-color: #f6e9ff;

            overflow-y: scroll; /* Always show vertical scrollbar */
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


<div style="border: 10px solid blue; padding: 20px; width: 100%; margin: auto; background-color:white;margin-top:20px;">
<center>
    <div>
        <img src="SASA.png" style="display: inline-block; width: 10%; height: auto; margin-right: 60px;">
        <img src="ASAS.png" style="display: inline-block; width: 10%; height: auto;">
    </div>
</center>
<center>
    <h2><font size="6" color="green"> Federal Democratic Republic of Ethiopia Vital Event Registration Agency</font></h2>
    <h2><font size="6" color="green">Birth Certificate</font></h2>
</center>
<div style="background-color: #f0f0f0; padding: 10px;">
        <table style="width: 100%;">
            <tr>
                <td><strong>Birth Identification Number:</strong></td>
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
                <td><strong>Nationality:</strong></td>
                <td><?php echo $nationality; ?></td>
                <td><strong>Sex:</strong></td>
                <td><?php echo $sex; ?></td>
                <td><strong>Registration Date:</strong></td>
                <td><?php echo $Registration_date; ?></td>
            </tr>
            <tr>
                <td><strong>Region:</strong></td>
                <td><?php echo $Birth_Region; ?></td>
                <td><strong>Zone:</strong></td>
                <td><?php echo $Birth_Zone; ?></td>
                <td><strong>Kebele:</strong></td>
                <td><?php echo $Birth_kebele; ?></td>
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
                <td><strong>Father First Name:</strong></td>
                <td><?php echo $father_fname; ?></td>
                <td><strong>Father Middle Name:</strong></td>
                <td><?php echo $father_mname; ?></td>
                <td><strong>Father Last Name:</strong></td>
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


<?php endif; ?>
</div>

</>
</body>
</html>





