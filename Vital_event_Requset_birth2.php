
<?php
session_start();
error_reporting(0);


// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='manager'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='applicant'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$b_id = $_GET['b_id'];
$sql = "SELECT * FROM birth_table WHERE b_id = '$b_id'";
$result = mysqli_query($conn, $sql);
if($_GET['c_id']){
    $t_id=$_GET['c_id'];
    $sql2="DELETE FROM birth_table WHERE b_id='$t_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
      header('location:Vital_event_Requset_birth.php');
    }
}
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE birth_table SET Birth_status = 'approved' WHERE b_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
       
        $sql4 = "SELECT email FROM birth_table WHERE b_id = '$approve_id'";
        $result4 = mysqli_query($conn, $sql4);
        if (!$result4) {
          die("Query failed: " . mysqli_error($conn));
    }

    

    else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    $row = mysqli_fetch_assoc($result4);
    $email = $row['email'];

    
    
if (isset($email)) {

    $mail = require __DIR__ . "/mailer.php";
    
    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
    
    your  certficate is approved you must pay and send me yor link
    
    END;
    
    try {
    
        $mail->send();
    
    } catch (Exception $e) {
    
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    
    }
    
    }
    
    echo "Message sent, please check your inbox.";
    header("Location: Vital_event_Requset_birth.php"); 

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL EVENT REQUSET</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
   
    <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
    </style>
    
</head>
<body>

 

    <h5><center>View All birth Requset</center></h5>
 
    
    <div class="container-fluid">
   
    
   <div class="table-container">
<table>
    <tr>
   
        <th class="tt">
        Father Name
        </th>
        <th class="tt">
        Sex
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
   
   
    <?php
$count = 1;
if ($result->num_rows > 0) {
    while ($info = $result->fetch_assoc()) {
        ?>
        <tr>
           
          
            <td class="td_tale"><?php echo "{$info['father_fname']} {$info['father_mname']} {$info['father_lname']}"; ?></td>
            </td>
            <td class="td_tale">
                <?php echo "{$info['sex']}" ?>
            </td>
            <td class="td_tale">
                <?php echo "{$info['Nationality']}" ?>
            </td>
            <td class="td_tale">
                <?php echo "{$info['mother_natinality']}" ?>
            </td>
            <td class="td_tale">
                <?php echo "{$info['father_natinality']}" ?>
            </td>
            <td class="td_tale">
                <?php echo "{$info['Registration_date']}" ?>
            </td>
          
        
      
        </tr>
        <?php
        $count++;
    }
} else {
    ?>
    <tr>
        <td colspan="13" style="text-align: center;">No records found.</td>
    </tr>
    <?php
}
?>

</table>
    </center>
  </div></div>
</body>
</html>