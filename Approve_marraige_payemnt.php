<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
} elseif($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['unread_count10'])) {
    $unread_count10 = $_SESSION['unread_count10'];
  } else {
    $unread_count10 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count10 FROM payemnt WHERE event_type = 'marriage' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count10 = $unread_row['unread_count10'];
} else {
    $unread_count10 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count10'] = $unread_count10;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE payemnt SET c_status='read' WHERE event_type = 'marriage' and c_status='unread'";
mysqli_query($conn, $update_status_sql);
$sql = "SELECT mt.*, p.Payemnt_link
        FROM marriage_table AS mt
        JOIN payemnt AS p ON mt.username = p.username
        WHERE mt.Marriage_status = 'approved' AND mt.Payemnt = 'unpaid' AND p.event_type = 'marriage'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE marriage_table SET Payemnt = 'paid' WHERE m_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant payment approved successfully.</div>'; // Display success message
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
            $mail->Subject = "Marriage Certificate Ready";
            $mail->Body = "Congratulations, your marriage certificate is ready. You can now download it from the system.";
            
            try {
                $mail->send();
            } catch (Exception $e) {
               
            }
        }
      
    }
}


if (isset($_GET['delete_username'])) {
    $delete_username = $_GET['delete_username'];
    $sqlDelete = "DELETE FROM payemnt WHERE username = '$delete_username' AND event_type = 'marriage'";
    $resultDelete = mysqli_query($conn, $sqlDelete);

    if ($resultDelete) {
        $message = '<div class="alert alert-success">payment deleted successfully.</div>';
        // Fetch email
        $sql_get_email = "SELECT email FROM marriage_table WHERE username = '$delete_username'";
        $result_get_email = mysqli_query($conn, $sql_get_email);
        if ($result_get_email) {
            $row = mysqli_fetch_assoc($result_get_email);
            $email = $row['email'];
            if ($email) {
                // Send email after deletion
                $mail = require __DIR__ . "/mailer.php";
                $mail->setFrom("noreply@example.com");
                $mail->addAddress($email);
                $mail->Subject = "Marriage Payment Request Deleted";
                $mail->Body = "Your marriage payment request has been deleted from the system.";
                try {
                    $mail->send();
                } catch (Exception $e) {
                  
                }
            }
        }
     
    } else {
        $message = "Error deleting record: " . mysqli_error($conn);
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Requests</title>
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
<div class="container-fluid">
        <div class="table-container">
<h5><center><?= __('Payment Request')?></center></h5>

        <?php if (!empty($message)): ?>
    <div id="errorMessage" class="alert"><?php echo $message; ?></div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
            window.location.href = "Approve_marraige_payemnt.php";
        }
    }, 4000);
</script>
            <table border="1px">
                <tr>
                    <th>No</th>
                    <th><?= __('Username')?></th>
                    <th><?= __("Husband's Name")?></th>
                    <th><?= __("Wife's Name")?></th>
                    <th><?= __('Payment URL')?></th>
                    <th><?= __('Action')?></th>
                </tr>

                <?php 
                    $count = 1;
                if ($result->num_rows > 0) {
                    while ($info = $result->fetch_assoc()) {
                ?>

                <tr>
                <td><?php echo $count; ?></td>
                    <td class="td_tale"><?php echo $info['username'] ?></td>
                    <td class="td_tale"><?php echo "{$info['Hasband_fname']} {$info['Hasband_mname']} {$info['Hasband_lname']}" ?></td>
                    <td class="td_tale"><?php echo "{$info['Wife_fname']} {$info['Wife_mname']} {$info['Wife_lname']}" ?></td>
                    <td class="td_talee">
                        <a href="<?php echo $info['Payemnt_link']; ?>"><?php echo $info['Payemnt_link']; ?></a>
                    </td>
                    <td class="td_tale">
                        <a onClick="return confirm('Are You Sure To Reject this record?');" href='Approve_marraige_payemnt.php?delete_username=<?php echo $info['username']; ?>' class='btn btn-danger'>Rejact</a>
                        &nbsp;&nbsp;&nbsp;
                        <a onClick="javascript:return confirm('Are You Sure To Approve this marriage payment?');" href='Approve_marraige_payemnt.php?approve_id=<?php echo $info['m_id'] ?>' class='btn btn-success'>Approve</a>
                    </td>
                </tr>
                
                <?php } ?>
                
                <?php } else { ?>
                
                <tr>
                    <td colspan="6" class="not-registered"><?= __('No new Request found')?>.</td>
                </tr>
                
                <?php } ?>
            </table>
        </div>
    </div>

</body>
</html>
