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
$sql = "SELECT * FROM divorce_table WHERE username = '$username'";
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





    $wife_birth_place=$row['wife_birth_place'];
    $hasband_birth_date=$row['hasband_birth_date'];
    $wife_birth_date=$row['wife_birth_date'];
    $haseband_birth_place=$row['husband_birth_place'];

    $Divorce_Zone=$row['Divorce_Zone'];
    $payment = $row['Payment'];
} else {
    echo '<script class="not-registered">alert("you are not register divorce event."); window.location.href = "applicant.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL EVENT birth application</title>
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
   

        <center><h5>My Divorce Application</h5>
            <div class="container-fluid">
   
   <div class="table-container">
            <table border="1px">
                <tr>
                <th class="tt">Date of Divorce</th>
        
                <th class="tt">Wife Birth Place</th>
<th class="tt">Husband Birth Place</th>
<th class="tt">Wife Birth Date</th>
<th class="tt">Husband Birth Date</th>

<th class="tt">Number of Children</th>




                </tr>

                <tr>
                <td class="td_tale">
                        <?php echo $Divorce_date; ?>
                    </td>
                    
                    <td class="td_tale">
                        <?php echo $wife_birth_place; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $haseband_birth_place; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $wife_birth_date; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $hasband_birth_date; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $numberOfChildren; ?>
                    </td>
                 
                 

                </tr>
            </table>
        </center>
</div>
</div>
</div>
</body>

</html>