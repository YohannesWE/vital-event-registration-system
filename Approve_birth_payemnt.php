

<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

  

if (isset($_SESSION['unread_count7'])) {
    $unread_count7 = $_SESSION['unread_count7'];
  } else {
    $unread_count7 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count7 FROM payemnt WHERE event_type = 'birth' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count7 = $unread_row['unread_count7'];
} else {
    $unread_count7 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count7'] = $unread_count7;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE payemnt SET c_status='read' WHERE event_type = 'birth' and c_status='unread'";
mysqli_query($conn, $update_status_sql);

$sql = "SELECT bt.*, p.Payemnt_link
        FROM birth_table AS bt
        JOIN payemnt AS p ON bt.username = p.username
        WHERE bt.Birth_status = 'approved' AND bt.Payment = 'unpaid' AND p.event_type = 'birth' ";
$result = mysqli_query($conn, $sql);

if (!$result) {
    $errorMessage = mysqli_error($conn);
    echo "Error: " . $errorMessage;
}

$message = ""; 

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql2 = "UPDATE birth_table SET Payment ='paid' WHERE b_id = '$approve_id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        $message = '<div class="alert alert-success">Applicant payment approved successfully.</div>'; // Display success message
        $sql4 = "SELECT email FROM birth_table WHERE b_id = '$approve_id'";
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
            $mail->Body = <<<END

Congratulations, your birth certificate is ready; you can now download it from the system.

END;

            try {

                $mail->send();

              

            } catch (Exception $e) {

              

            }
        }
    }
}

// Delete functionality
if (isset($_GET['delete_username'])) {
    $delete_username = $_GET['delete_username'];
    $sql_select = "SELECT * FROM payemnt WHERE username = '$delete_username' and event_type = 'birth'";
    $result_select = mysqli_query($conn, $sql_select);
    if ($result_select) {
        $deleted_record = mysqli_fetch_assoc($result_select);
        $Payemnt_link = $deleted_record['Payemnt_link']; // Get payment link from the database
        $k_id_no = "k_id_no";
        $event_type = "birth";
        $status = "1";
        $date = "2";
        $sql3 = "DELETE FROM payemnt WHERE username = '$delete_username'";
        $result3 = mysqli_query($conn, $sql3);
        if ($result3) {
            $message = '<div class="alert alert-success">applicant payment deleted successfully.</div>';
            $sql_insert = "INSERT INTO reject_payment (username, k_id_no, event_type,Payemnt_link,payemnt_date,status)
            VALUES ('$delete_username', '$k_id_no','$event_type','$Payemnt_link',' $date','$status')";

            $result_insert = mysqli_query($conn, $sql_insert);
            if ($result_insert) {
                $sql4 = "SELECT email FROM birth_table WHERE username = '$delete_username'";
                $result4 = mysqli_query($conn, $sql4);
                if ($result4) {
                    $row = mysqli_fetch_assoc($result4);
                    $email = $row['email'];
                    if ($email) {
                        $mail = require __DIR__ . "/mailer.php";
                        $mail->setFrom("noreply@example.com");
                        $mail->addAddress($email);
                        $mail->Subject = "Birth Payment Request Deleted";
                        $mail->Body = "Your birth payment request has been deleted from the system.";
                        try {
                            $mail->send();
                         
                        } catch (Exception $e) {
                          
                        }
                    }
                }
            } else {
              
            }
        } else {
            $message = "Failed to delete birth payment request for username $delete_username.";
        }
    } else {
        $message = "Failed to retrieve record for deletion.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth payment Request</title>
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
            window.location.href = "Approve_birth_payemnt.php";
        }
    }, 4000);
</script>
    
        <table border="1">
            <tr>
                <th>NO</th>
                <th><?= __('Username')?></th>
                <th><?= __('Name')?></th>
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
                        <td><?php echo "{$info['username']}" ?></td>
                        <td><?php echo "{$info['f_name']} {$info['m_name']} {$info['l_name']}" ?></td>
                        <td><a href="<?php echo $info['Payemnt_link']; ?>"><?php echo $info['Payemnt_link']; ?></a></td>
                        <td>
                            <?php echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve this birth payment?');\" href='Approve_birth_payemnt.php?approve_id={$info['b_id']}' class='btn btn-success'>Approve</a>"; ?>
                            <?php echo "<a onClick=\"javascript:return confirm('Are You Sure To delete this birth payment?');\" href='Approve_birth_payemnt.php?delete_username={$info['username']}&Payemnt_link={$info['Payemnt_link']}' class='btn btn-danger'>Rejact</a>"; ?>
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
