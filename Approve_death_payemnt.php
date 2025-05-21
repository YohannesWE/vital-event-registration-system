<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['unread_count8'])) {
    $unread_count8 = $_SESSION['unread_count8'];
  } else {
    $unread_count8 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count8 FROM payemnt WHERE event_type = 'death' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count8 = $unread_row['unread_count8'];
} else {
    $unread_count8 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count8'] = $unread_count8;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE payemnt SET c_status='read' WHERE event_type = 'death' and c_status='unread'";
mysqli_query($conn, $update_status_sql);
$sql = "SELECT dt.*, p.Payemnt_link
        FROM death_table AS dt
        JOIN payemnt AS p ON dt.k_id_no = p.k_id_no
        WHERE dt.Death_states = 'approved' AND dt.Payemnt = 'unpaid' AND p.event_type = 'death'";
$result = mysqli_query($conn, $sql);

$message = ""; // Initialize message variable

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE death_table SET Payemnt = 'paid' WHERE d_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        
        $message = '<div class="alert alert-success">Applicant payment approved successfully.</div>'; // Display success message
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
            $mail->Subject = "Certificate notification";
            $mail->Body = "Congratulations, your death certificate is ready; you can now download it from the system.";

            try {
                $mail->send();
               
            } catch (Exception $e) {
              
            }
        }
    }
}

// Delete functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM payemnt WHERE k_id_no = '$delete_id'";
    $result_delete = mysqli_query($conn, $sql_delete);
    if ($result_delete) {
        $message = '<div class="alert alert-success">applicant payment deleted successfully.</div>';
        // Send email after deletion
        $sql_get_email = "SELECT email FROM death_table WHERE k_id_no = '$delete_id' and event_type = 'death'";
        $result_get_email = mysqli_query($conn, $sql_get_email);
        if ($result_get_email) {
            $row = mysqli_fetch_assoc($result_get_email);
            $email = $row['email'];
            if ($email) {
                $mail = require __DIR__ . "/mailer.php";
                $mail->setFrom("noreply@example.com");
                $mail->addAddress($email);
                $mail->Subject = "Death Payment Request Deleted";
                $mail->Body = "Your death payment request has been deleted from the system.";
                try {
                    $mail->send();
                } catch (Exception $e) {
                    $message = "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                }
            }
        }
        
    } else {
        $message = "Failed to delete death payment request.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civil Registrar Page</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
   
    <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        .message {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
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
            window.location.href = "Approve_death_payemnt.php";
        }
    }, 4000);
</script>
            <table>
                <tr>
                <th>NO</th>
                    <th><?= __('Kebele Id Number')?></th>
                    <th class="tt"><?= __('Name')?></th>
                    <th class="tt"><?= __('Payment URL')?></th>
                    <th class="tt"><?= __('Action')?></th>
                </tr>

                <?php 
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($info = $result->fetch_assoc()) {
                ?>
                    <tr>
                    <td><?php echo $count; ?></td>
                        <td><?php echo $info['k_id_no']; ?></td>
                        <td><?php echo "{$info['f_name']} {$info['m_name']} {$info['l_name']}"; ?></td>
                        <td><a href="<?php echo $info['Payemnt_link']; ?>"><?php echo $info['Payemnt_link']; ?></a></td>
                        <td>
                            <a onClick="return confirm('Are You Sure To Approve this death event?');" href="Approve_death_payemnt.php?approve_id=<?php echo $info['d_id']; ?>" class="btn btn-success">Approve</a>
                            <a onClick="return confirm('Are You Sure To reject this death payment?');" href="Approve_death_payemnt.php?delete_id=<?php echo $info['k_id_no']; ?>" class="btn btn-danger">Rejact</a>
                        </td>
                    </tr>
                <?php
                  $count++;
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="5" class="not-registered"><?= __('No new Request found')?>.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
