
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
$di_id = $_GET['di_id'];

$sql = "SELECT * FROM divorce_table WHERE di_id = '$di_id'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    die('Query Error: ' . mysqli_error($conn));
}


if($_GET['c_id']){
    $t_id=$_GET['c_id'];
    $sql2="DELETE FROM divorce_table WHERE di_id ='$t_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
      header('location:Vital_event_Requset_divorce.php');
    }
}
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE divorce_table SET Divorce_states = 'approved' WHERE di_id  = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $sql4 = "SELECT email FROM divorce_table WHERE di_id = '$approve_id'";
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
    
    your divorce application is sucessfully approve  you can procced to appropret payemnt
    
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
?><!DOCTYPE html>
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



    <h5><center>All Divorce Requests</center></h5> 
   
   <div class="container-fluid">
   <div class="table-container">
            <table border="1px">
                <tr>
                <th class="tt"style="width:10px;">Registration Date</th>
                    <th class="tt"style="width:10px;">Wife Birth Place </th>
                    <th class="tt"style="width:10px;">Wife Birth Date</th>
                    <th class="tt"style="width:10px;">Husband Birth Place</th>
                    <th class="tt"style="width:10px;">Husband Birth Date</th>
                    <th class="tt"style="width:10px;">Number of Child</th>
          
                </tr>
                <?php
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($info = $result->fetch_assoc()) {
                        ?>
                        <tr>
                        <td class="td_tale"><?php echo "{$info['Registration_date']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['wife_birth_place']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['wife_birth_date']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['husband_birth_place']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['hasband_birth_date']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['Number_of_child']}" ?></td>
                           
                        </tr>
                        <?php
                        $count++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9" style="text-align: center;">No records found.</td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
  
</body>
</html>
