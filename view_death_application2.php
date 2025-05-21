
<?php
session_start();

// Check if the session variable for k_id_no exists
if (!isset($_SESSION['k_id_no'])) {
    header("Location: view_death_check.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$k_id_no = $_SESSION['k_id_no'];

$sql = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['d_id'];
    $r_fname = $row['r_fname'];
    $r_mname = $row['r_mname'];
    $Relationship_type = $row['Relationship_type'];
    $motherfname = $row['Sex'];
    $mothermname = $row['Nationality'];
    $birthdate = $row['Death_date'];
    $death_age = $row['Birth_date'];
    $registration_date = $row['registration_date'];
    $Death_kebele = $row['Death_kebele'];
    $Marriage_status = $row['Marriage_status'];
    $death_Zone = $row['death_Zone'];
    $child_number = $row['child_number'];
    $birth_states = $row['Death_states'];
    $paymnt_states = $row['Payemnt'];
} else {
    $message = "You have not registered any death event.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view  Death Application</title>

    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_death.php'; ?>
</head>
<body>
<div class="container-fluid">

     
       
    <center>
        <h2> Death Application Status</h2>
        <?php if (isset($message)) : ?>
            <div class="not-registered"><?php echo $message; ?></div>
        <?php else : ?>
            <div class="container-fluid">
   
  
   <div class="table-container">
            <table border="1px">
                <tr>
               
                   
                    <th class="tt">Death Date</th>
                    <th class="tt">Registration date</th>
                    <th class="tt">Deceased Age</th>
                    <th class="tt">Marital status</th>
                
                    <th class="tt">Number of Children</th>
                    <th class="tt">Registrant's Name</th>
                    <th class="tt">Relationship</th>
                    <th class="tt">Death zone</th>
                    <th class="tt">Kebele</th>
                 
                    
                </tr>
                <tr>
               
                    <td class="td_tale"><?php echo $birthdate; ?></td>
                    <td class="td_tale"><?php echo $registration_date; ?></td>
                    <td class="td_tale"><?php echo $death_age; ?></td>
                    <td class="td_tale"><?php echo $Marriage_status; ?></td>
          
                    <td class="td_tale"><?php echo $child_number; ?></td>
                 
                    <td class="td_tale"><?php echo $r_fname . " " . $r_mname; ?></td>
                    <td class="td_tale"><?php echo $Relationship_type; ?></td>
                    <td class="td_tale"><?php echo $death_Zone; ?></td>
                    <td class="td_tale"><?php echo $Death_kebele; ?></td>
               
                    
                </tr>
            </table>
        <?php endif; ?>
    </center>
        </div>
        </div>
        </div>
</body>
</html>
