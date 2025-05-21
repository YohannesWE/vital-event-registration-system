
<?php
session_start();

error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='manger'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='customer'){
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

$m_id = $_GET['m_id'];

$sql = "SELECT * FROM marriage_table WHERE m_id = '$m_id'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    die('Query Error: ' . mysqli_error($conn));
}

if($_GET['c_id']){
    $t_id=$_GET['c_id'];
    $sql2="DELETE FROM marriage_table WHERE m_id='$t_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
      header('location:Vital_event_Requset_marriage.php');
    }
}
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE marriage_table SET Marriage_status = 'approved' WHERE m_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $sql4 = "SELECT email FROM marriage_table WHERE m_id = '$approve_id'";
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
    
    your marriage application is sucessfully approve  you can procced to appropret payemnt
    
    END;
    
    try {
    
        $mail->send();
    
    } catch (Exception $e) {
    
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    
    }
    
    }
    
    echo "Message sent, please check your inbox.";

    }

    else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL EVENT REQUEST</title>
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



    <h5><center>Marriage Requests</center></h5>
  
    <div class="container-fluid">
   
    
   <div class="table-container">
            <table border="1px">
                <tr>
                  
                    <th>Wife Natinality</th>
                    <th>Hasband Natinality</th>
                    <th>hasband Birth place</th>
                    <th>Wife Birth Place</th>
                    <th>Hasband Birth Date</th>
                    <th>Wife Birth Date</th>
                    <th>Registration Date</th>
   
                    
                </tr>
                <?php $count = 1;
                while ($info = $result->fetch_assoc()) {
                    ?>
                    <tr>
     
                       
                        <td><?php echo $info['Husband_Natinality']; ?></td>
                        <td><?php echo $info['wife_Natinality']; ?></td>
                        <td><?php echo $info['husband_birth_place']; ?></td>
                        <td><?php echo $info['wife_birth_place']; ?></td>
                        <td><?php echo $info['hasband_birth_date']; ?></td>
                        <td><?php echo $info['wife_birth_date']; ?></td>
                        <td><?php echo $info['Registration_date	']; ?></td>
                    </tr>
                    <?php
              
                }
                ?>
            </table>
        </div>
    </div>

</body>
</html>
