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
$sql = "SELECT * FROM birth_table WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['b_id'];
    $fname = $row['f_name'];
    $mname = $row['m_name'];
    $lname = $row['l_name'];
    $motherfname = $row['Mother_fname'];
    $mothermname = $row['Mother_mname'];
   
    $motherlname = $row['Mother_lname'];
    $father_fname = $row['father_fname'];
    $father_mname = $row['father_mname'];
    $father_lname = $row['father_lname'];

    $mother_natinality = $row['mother_natinality'];
    $father_natinality = $row['father_natinality'];
    $father_lname = $row['father_lname'];
    $father_lname = $row['father_lname'];
    $sex=$row['sex'];


    $Registration_date = $row['Registration_date'];
    $birthdate = $row['Birthdate'];
    $nationality = $row['Nationality'];
    $birthregion = $row['Birth_kebele'];
    $birthcity = $row['father_mname'];
    $birth_states = $row['Birth_status'];
    $paymnt_states = $row['Payment'];
} else {
    echo '<script class="not-registered">alert("you are not register birth event."); window.location.href = "applicant.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Birth Application</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css1_applicant.php'; ?>

<style>
       body {
                background-color:rgba(73, 140, 184, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
</style>
</head>

<body>
  
 
<div class="container-fluid">
        
            <h5><center>My Birth Application</h5></center>

            <div class="container-fluid">
   
   
   <div class="table-container">
            <table border="1px">
                <tr>
                <th class="tt">
                        Father Name
                    </th>
                    <th class="tt">
                        GenderS
                    </th>
                    <th class="tt">
                 Date of Birth 
                    </th>
                    <th class="tt">
                    Nationality
                    </th>
                    <th class="tt">
                  Mother Nationality
                    </th>
                    <th class="tt">
            Father Nationality
                    </th>
                    <th class="tt">
                 Registartion Date
                    </th>
                    
             
                </tr>

                <tr>
                

                <td class="td_tale"><?php echo "$father_fname $father_mname $father_lname"; ?></td>

                    <td class="td_tale">
                        <?php echo "$sex"; ?>
                    </td>

                    <td class="td_tale">
                        <?php echo $birthdate; ?>
                    </td>

                    <td class="td_tale">
                        <?php echo $nationality; ?>
                    </td>

                    <td class="td_tale">
                        <?php echo $mother_natinality; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo "$father_natinality"; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo "$Registration_date"; ?>
                    </td>
                   

                
                </tr>
            </table>
        </center>
        </div>
    </div>
</div>
</body>

</html>