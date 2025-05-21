
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
$d_id = $_GET['d_id'];
$sql = "SELECT * FROM death_table WHERE d_id = '$d_id'";
$result = mysqli_query($conn, $sql);
if($_GET['c_id']){
    $t_id=$_GET['c_id'];
    $sql2="DELETE FROM death_table WHERE d_id='$t_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
      header('location:Vital_event_Requset_death.php');
    }
}
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE death_table SET Death_states = 'approved' WHERE d_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $sql4 = "SELECT email FROM death_table WHERE d_id = '$approve_id'";
        $result4 = mysqli_query($conn, $sql4);
        if (!$result4) {
          die("Query failed: " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result4);
        $email = $row['email'];

         
if (isset($email)) {

    $mail = require __DIR__ . "/mailer.php";
  
    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
  
    your death application are approved you must pay approprate fee and send me link via vers 
  
    END;
  
    try {
  
        $mail->send();
  
    } catch (Exception $e) {
  
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
  
    }
  
  }
  
  echo "Message sent, please check your inbox.";
  
    }

}
?>
    <style>
        body{
            background-color: #f6e9ff;
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vital event Requset</title>
    <?php include 'scroll_css.php'; ?>
    <?php
    
    include 'admin_css.php';
    ?>
  
  <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
    </style>
        
    </style>

</head>
<body>




    <h5><center>Death application Requsets</center></h5>
    <div class="container-fluid">
   
    
   <div class="table-container">
<table border="1px">
    <tr>
   
        <th class="tt">
          Sex
        </th>
        <th class="tt">Nationality</th>
        <th class="tt">
        Deceased Age
        </th>
        <th class="tt">Marital status</th>
        <th class="tt">Number of Children</th>
        <th class="tt">Registrant's Name</th>
        <th class="tt">
       Place of Daeth
        </th>
        <th class="tt">Relationship</th>
       
    </tr>

<?php 
 $count = 1;
 if ($result->num_rows > 0) {
while($info=$result -> fetch_assoc())
{


?>

    <tr>
   

  
<td class="td_tale">
    <?php  echo"{$info['Sex']}" ?>
    </td>
    
    <td class="td_tale">
    <?php  echo"{$info['Nationality']}" ?>
    </td>

  

    <td class="td_tale">
    <?php  echo"{$info['Death_age']}" ?>
    </td>
    <td class="td_tale">
    <?php  echo"{$info['Marriage_status']}" ?>
    </td>
 
    <td class="td_tale">
    <?php  echo"{$info['child_number']}" ?>
    </td>
  
    <td class="td_tale"><?php echo "{$info['r_fname']} {$info['r_mname'] }"; ?></td>
    </td>
    <td class="td_tale">
    <?php  echo"{$info['Death_place']}" ?>
    </td>
    <td class="td_tale">
    <?php  echo"{$info['Relationship_type']}" ?>
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
   
  </div>
</div>
</body>
</html>