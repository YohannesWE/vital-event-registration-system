<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
} elseif ($_SESSION['usertype'] == 'manger' || $_SESSION['usertype'] == 'customer' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['unread_count9'])) {
    $unread_count9 = $_SESSION['unread_count9'];
  } else {
    $unread_count9 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count9 FROM payemnt WHERE event_type = 'divorce' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count9 = $unread_row['unread_count9'];
} else {
    $unread_count9 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count9'] = $unread_count9;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE payemnt SET c_status='read' WHERE event_type = 'divorce' and c_status='unread'";
mysqli_query($conn, $update_status_sql);
$sql = "SELECT ddt.*, p.Payemnt_link
        FROM divorce_table AS ddt
        JOIN payemnt AS p ON ddt.username = p.username
        WHERE ddt.Divorce_states = 'approved' AND ddt.Payment = 'unpaid' AND p.event_type = 'divorce'";

$result = mysqli_query($conn, $sql);
if ($result === false) {
    die('Query Error: ' . mysqli_error($conn));
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE divorce_table SET Payment = 'paid' WHERE di_id  = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant payment approved successfully.</div>'; // Display success message
        // Fetch email
        $sql4 = "SELECT email FROM divorce_table WHERE di_id = '$approve_id'";
        $result4 = mysqli_query($conn, $sql4);
        
        if (!$result4) {
            die("Query failed: " . mysqli_error($conn));
        }
        
        $row = mysqli_fetch_assoc($result4);
        $email = $row['email'];
      
        if (isset($email)) {
            // Send email
            $mail = require __DIR__ . "/mailer.php";
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Divorce Certificate Ready";
            $mail->Body = "Congratulations, your divorce certificate is ready; you can now download it from the system.";
            
            try {
                $mail->send();
              
            } catch (Exception $e) {
               
            }
        }
        
        // Update divorce_status in marriage_table
        $updateMarriageStatus = "UPDATE marriage_table SET divorced_status = 'divorced' WHERE username IN (SELECT username FROM divorce_table WHERE di_id = '$approve_id')";
        $resultUpdateMarriageStatus = mysqli_query($conn, $updateMarriageStatus);
        
        if (!$resultUpdateMarriageStatus) {
           
        }
        

    } else {
    
    }
}

// Delete functionality
if (isset($_GET['delete_username'])) {
    $delete_username = $_GET['delete_username'];
    $sqlDelete = "DELETE FROM payemnt WHERE username = '$delete_username'";
    $resultDelete = mysqli_query($conn, $sqlDelete);

    if ($resultDelete) {
        $message = '<div class="alert alert-success">applicant payment deleted successfully.</div>';
        // Send email after deletion
        $sql_get_email = "SELECT email FROM divorce_table WHERE username = '$delete_username' and event_type = 'divorce'";
        $result_get_email = mysqli_query($conn, $sql_get_email);
        if ($result_get_email) {
            $row = mysqli_fetch_assoc($result_get_email);
            $email = $row['email'];
            if ($email) {
                $mail = require __DIR__ . "/mailer.php";
                $mail->setFrom("noreply@example.com");
                $mail->addAddress($email);
                $mail->Subject = "Divorce Payment Request Deleted";
                $mail->Body = "Your divorce payment request has been deleted from the system.";
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
    <?php
    include 'scroll_css.php';
    ?>
    <?php
    include 'admin_css.php';
    ?>
    <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        .error-message {
            background-color: #f2dede;
            color: #a94442;
            border-color: #ebccd1;
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
            window.location.href = "Approve_Divorce_payemnt.php";
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
                    while($info=$result -> fetch_assoc()) {
                ?>

                <tr>
                <td><?php echo $count; ?></td>
                    <td class="td_tale"><?php echo "{$info['username']}" ?></td>
                    <td class="td_tale"><?php echo "{$info['Hasband_fname']} {$info['Hasband_mname']} {$info['Hasband_lname']}" ?></td>
                    <td class="td_tale"><?php echo "{$info['wife_fname']} {$info['wife_mname']} {$info['wife_lname']}" ?></td>
                    <td class="td_talee"><a href="<?php echo $info['Payemnt_link']; ?>"><?php echo $info['Payemnt_link']; ?></a></td>
                    <td class="td_tale">
                        <a onClick="return confirm('Are You Sure To Approve this divorce event?');" href='Approve_Divorce_payemnt.php?approve_id=<?php echo $info['di_id']; ?>' class='btn btn-success'>Approve</a>
                        <a onClick="return confirm('Are You Sure To Delete this record?');" href='Approve_Divorce_payemnt.php?delete_username=<?php echo $info['username']; ?>' class='btn btn-danger'>Rejact</a>
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
