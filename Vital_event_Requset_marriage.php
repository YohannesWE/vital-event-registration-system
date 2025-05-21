<?php
session_start();

error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
} elseif($_SESSION['usertype'] == 'manger') {
    header("location:login.php");
} elseif($_SESSION['usertype'] == 'customer') {
    header("location:login.php");
} elseif($_SESSION['usertype'] == 'admin') {
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



  

  if (isset($_SESSION['unread_count3'])) {
    $unread_count3 = $_SESSION['unread_count3'];
  } else {
    $unread_count3 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count3 FROM marriage_table WHERE c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count3 = $unread_row['unread_count3'];
} else {
    $unread_count3 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count3'] = $unread_count3;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE marriage_table SET c_status='read' WHERE c_status='unread'";
mysqli_query($conn, $update_status_sql);

$sql = "SELECT * FROM marriage_table WHERE Marriage_status = 'pending'";
$result = mysqli_query($conn, $sql);

if(isset($_GET['c_id'])) {
    $t_id = $_GET['c_id'];
    $sql_fetch_email = "SELECT email FROM marriage_table WHERE m_id='$t_id'";
    $result_fetch_email = mysqli_query($conn, $sql_fetch_email);
    $row_fetch_email = mysqli_fetch_assoc($result_fetch_email);
    $email = $row_fetch_email['email'];
    
    $sql2 = "DELETE FROM marriage_table WHERE m_id='$t_id'";
    $result2 = mysqli_query($conn, $sql2);
    
    if($result2 && $email) {
        $message = '<div class="alert alert-success">applicant application deleted successfully.</div>';
        $mail = require __DIR__ . "/mailer.php";
          
        $mail->setFrom("noreply@example.com");
        $mail->addAddress($email);
        $mail->Subject = "Marriage Application Deleted";
        $mail->Body = "Your marriage application has been deleted by the admin.";

        try {
            $mail->send();
        
        } catch (Exception $e) {
         
        }
    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE marriage_table SET Marriage_status = 'approved', civil_registarar_fname = '$civil_registrarr_fname',civil_registarar_mname = '$civil_registrarr_mname' ,civil_registarar_lname = '$civil_registrarr_lname' WHERE m_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant application approved successfully.</div>'; // Display success message
        $sql4 = "SELECT email FROM marriage_table WHERE m_id = '$approve_id'";
        $result4 = mysqli_query($conn, $sql4);
        
        if (!$result4) {
            die("Query failed: " . mysqli_error($conn));
        }
        
        $row = mysqli_fetch_assoc($result4);
        $email = $row['email'];
        
        if ($email) {
            $mail = require __DIR__ . "/mailer.php";
            
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Marriage Application Approved";
            $mail->Body = "Your marriage application has been approved. You can proceed with the appropriate payment.";

            try {
                $mail->send();

            } catch (Exception $e) {
           
            }
        }
    } else {
  
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
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        .message {
            background-color:rgba(0, 111, 170, 0.47);
            color: #3c763d;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #d6e9c6;
        }
    </style>  
</head>
<body>

<?php if(isset($message)) { ?>
    <div class="message" id="successMessage"><?php echo $message; ?></div>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById("successMessage");
            if (successMessage) {
                successMessage.style.display = "none";
                window.location.href = "Vital_event_Requset_marriage.php";
            }
        }, 4000);
    </script>
<?php } ?>
<?php if(isset($error_message)) { ?>
    <div class="message" id="errorMessage"><?php echo $error_message; ?></div>
    <script>
        setTimeout(function() {
            var errorMessage = document.getElementById("errorMessage");
            if (errorMessage) {
                errorMessage.style.display = "none";
                window.location.href = "Vital_event_Requset_marriage.php";
            }
        }, 4000);
    </script>
<?php } ?>

<h5><center><?= __('All Marriage Requests')?></center></h5>

<div class="container-fluid">
    <div class="table-container">
        <table border="1px">
            <tr>
                <th>NO</th>
                <th><?= __('Username')?></th>
                <th><?= __("Husband's Name")?></th>
                <th><?= __("Wife's Name")?></th>
                <th><?= __('Date of Marriage')?></th>
                <th><?= __('Marriage Paper')?></th>
                <th><?= __('More Details')?></th>
                <th><?= __('Action')?></th>
            </tr>
            <?php
            $count = 1;
            if ($result->num_rows > 0) {
                while ($info = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $info['username']; ?></td>
                        <td><?php echo "{$info['Hasband_fname']} {$info['Hasband_mname']} {$info['Hasband_lname']}"; ?></td>
                        <td><?php echo "{$info['Wife_fname']} {$info['Wife_mname']} {$info['Wife_lname']}"; ?></td>
                        <td><?php echo $info['Marrage_date']; ?></td>
                        <td>
                            <a href="<?php echo $info['Marriage_paper']; ?>" target="_blank">
                                <img src="s.png" alt="PDF Icon" width="100" height="70">
                            </a>
                        </td>
                        <td class="td_tale"><a href="Vital_event_Requset_marriage2.php?m_id=<?php echo $info['m_id']; ?>" class="btn btn-primary"><?= __('More Details')?></a></td>
                        <td>
                            <?php
                            echo "<a onClick=\"javascript:return confirm('Are You Sure To reject this marriage event');\" href='Vital_event_Requset_marriage.php?c_id={$info['m_id']}' class='btn btn-danger'>Rejact</a>";
                            echo "&nbsp;"; // Adding space using HTML entity for non-breaking space
                            echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve this marriage event?');\" href='Vital_event_Requset_marriage.php?approve_id={$info['m_id']}' class='btn btn-success'>Approve</a>";
                            ?>
                        </td>
                    </tr>
                    <?php
                    $count++;
                }
            } else {
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
