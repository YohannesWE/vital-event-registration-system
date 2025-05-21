<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
} elseif ($_SESSION['usertype'] == 'manger' || $_SESSION['usertype'] == 'customer' || $_SESSION['usertype'] == 'admin') {
    header("location:login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION["username"];
$sql2 = "SELECT * FROM user WHERE username ='$username'";

// Execute SQL query
$result = mysqli_query($conn, $sql2);

// Check if query executed successfully
if ($result) {
    // Fetch the row from the result set
    $row = mysqli_fetch_assoc($result);

    // Retrieve civil registrar's name
    $civil_registrarr_fname = $row['full_name'];
    $civil_registrarr_mname = $row['middle_name'];
    $civil_registrarr_lname = $row['last_name'];

    // Now you can use these variables as needed
} else {
    // Handle query error
    die('Query Error: ' . mysqli_error($conn));
}


  

  if (isset($_SESSION['unread_count2'])) {
    $unread_count2 = $_SESSION['unread_count2'];
  } else {
    $unread_count2 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count2 FROM divorce_table WHERE c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count2 = $unread_row['unread_count2'];
} else {
    $unread_count2 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count2'] = $unread_count2;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE divorce_table SET c_status='read' WHERE c_status='unread'";
mysqli_query($conn, $update_status_sql);

$sql = "SELECT * FROM divorce_table WHERE Divorce_states = 'pending'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    die('Query Error: ' . mysqli_error($conn));
}

$message = ''; // Initialize the message variable



if($_GET['c_id']){
    $t_id=$_GET['c_id'];
    
    // Fetch email before deletion
    $email_query = "SELECT email FROM divorce_table WHERE di_id='$t_id'";
    $email_result = mysqli_query($conn, $email_query);
    if ($email_result && mysqli_num_rows($email_result) > 0) {
        $row = mysqli_fetch_assoc($email_result);
        $email = $row['email'];
    }
    
    $sql2="DELETE FROM divorce_table WHERE di_id ='$t_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
        $message = '<div class="alert alert-success">applicant application deleted successfully.</div>';
        // Send email after deletion
        if (isset($email)) {
            $mail = require __DIR__ . "/mailer.php";
            
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Divorce Application Deleted";
            $mail->Body = "Dear Applicant,\n\nYour divorce application has been deleted.";
            
            if ($mail->send()) {
               
            } else {
               
            }
        } else {
          
        }
        
        // Redirect after deletion

    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE divorce_table SET Divorce_states = 'approved' , civil_registarar_fname = '$civil_registrarr_fname',civil_registarar_mname = '$civil_registrarr_mname' ,civil_registarar_lname = '$civil_registrarr_lname' WHERE di_id  = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant application approved successfully.</div>'; // Display success message
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
            $mail->Subject = "Divorce Application Approved";
            $mail->Body = <<<END

            Your divorce application has been approved. You can proceed with the appropriate payment.

            END;

            try {

                $mail->send();

            } catch (Exception $e) {

               

            }

        }

    
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
    <h5><center><?= __('All Divorce Requests')?></center></h5>  
    <?php if (!empty($message)): ?>
    <div id="errorMessage" class="alert"><?php echo $message; ?></div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
            window.location.href = "Vital_event_Requset_divorce.php";
        }
    }, 4000);
</script>
    <div class="container-fluid">
        <div class="table-container">
       
            <table border="1px">
                <tr>
                    <th class="tt">NO</th>

                    <th class="tt"><?= __('Username')?></th>
                    <th class="tt"><?= __("Husband's Name")?></th>
                    <th class="tt" ><?= __("Wife's Name")?></th>
                    <th class="tt" ><?= __('Divorce date')?></th>
                    <th class="tt" ><?= __('More Details')?></th>
                    <th class="tt"><?= __('Divorce Paper')?></th>
                    <th class="tt"><?= __('Action')?></th>
                </tr>
                <?php
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($info = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="td_tale"><?php echo $count; ?></td>
                            <td class="td_tale"><?php echo "{$info['username']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['Hasband_fname']} {$info['Hasband_mname']} {$info['Hasband_lname']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['wife_fname']} {$info['wife_mname']} {$info['wife_lname']}" ?></td>
                           
                          <td class="td_tale"><?php echo "{$info['Divorce_date']}" ?></td> <td class="td_tale"><a href="Vital_event_Requset_divorce2.php?di_id=<?php echo  $info['di_id']; ?>" class="btn btn-primary"><?= __('More Details')?></a> </td>
                               
                            <td class="td_talee">
                                <a href="<?php echo $info['Divorce_paper']; ?>" target="_blank">
                                    <img src="s.png" alt="PDF Icon" width="100px" height="100">
                                </a>
                            </td>
                            <td class="taleee" style="padding: 0; ">
                                <?php
                                echo "<a onClick=\"javascript:return confirm('Are You Sure To Delete this divorce event');\" href='Vital_event_Requset_divorce.php?c_id={$info['di_id']}' class='btn btn-danger'style='margin-right:5px;'>Rejact</a>";
                                echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve this divorce event?');\" href='Vital_event_Requset_divorce.php?approve_id={$info['di_id']}' class='btn btn-success'>approve</a>";
                                ?>
                            </td>
                        </tr>
                        <?php
                        $count++;
                        
                    }
                } else{
                    ?>
                    <tr>
                        <td colspan="9" class="not-registered"><?= __('No new Request found')?>.</td>
                        
                    </tr>
                   
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
  
</body>
</html>
