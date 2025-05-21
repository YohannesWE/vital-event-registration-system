<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
} elseif ($_SESSION['usertype'] == 'manager') {
    header("location:login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_SESSION['unread_count55'])) {
    $unread_count55 = $_SESSION['unread_count55'];
  } else {
    $unread_count55 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count55 FROM user WHERE states = 'approved' and usertype='child' AND upgrade_status='upgrade' AND c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count55 = $unread_row['unread_count55'];
} else {
    $unread_count55 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count55'] = $unread_count55;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE user SET c_status='read' WHERE c_status='unread'";
mysqli_query($conn, $update_status_sql);


$sql = "SELECT * FROM user WHERE states = 'approved' AND usertype = 'child' AND upgrade_status='upgrade' AND death_status='undeath'";
$result = mysqli_query($conn, $sql);

if (isset($_GET['c_id'])) {
    $t_id = $_GET['c_id'];
    $sql = "UPDATE user SET upgrade_status = 'not_upgrade' WHERE id='$t_id'";
    $result2 = mysqli_query($conn, $sql);
    if ($result2) {
        $message = '<div class="alert alert-success">Applicant account Upgraded successfully.</div>'; // Display success message
        // Send email after rejection
        $email_query = "SELECT email, full_name, middle_name, last_name FROM user WHERE id='$t_id'";
        $email_result = mysqli_query($conn, $email_query);
        if ($email_result && mysqli_num_rows($email_result) > 0) {
            $row = mysqli_fetch_assoc($email_result);
            $email = $row['email'];
            $first_name = $row['full_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];

            // Send the email
            $mail = require __DIR__ . "/mailer.php";
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Upgrade Request Rejected";
            $mail->Body = "Dear $first_name $middle_name $last_name,\n\nYour upgrade request has been rejected.";

            if ($mail->send()) {
               
            } else {
                
            }
        } else {
           
        }


    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE user SET usertype = 'applicant', upgrade_status = 'upgrade' WHERE id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant account approved successfully.</div>'; // Display success message
        $sql4 = "SELECT email FROM user WHERE id = '$approve_id'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4 && $row = mysqli_fetch_assoc($result4)) {
            $email = $row['email'];

            $mail = require __DIR__ . "/mailer.php";
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Account approval";
            $mail->Body = "Congratulations, your account has been upgraded; you can now access the applicant page.";

            if ($mail->send()) {
               
            } else {
             
            }

            
        } else {
        
           
        }
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="table-container">
            <h5><center><?= __('Account Upgrade Request')?></center></h5>
            <?php if (!empty($message)): ?>
    <div id="errorMessage" class="alert"><?php echo $message; ?></div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
            window.location.href = "Vital_event_Requset_birth.php";
        }
    }, 4000);
</script>
     
            <table>
                <tr>
                    <th>NO</th>
                    <th><?= __('Kebele ID Number')?></th>
                    <th><?= __('Name')?></th>
                    <th><?= __('Username')?></th>
                    <th><?= __('Keble ID Photo')?></th>
                    <th><?= __('Action')?></th>
                </tr>
                <?php
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($info = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $info['k_id_no']; ?></td>
                            <td><?php echo $info['full_name'] . ' ' . $info['middle_name'] . ' ' . $info['last_name']; ?></td>

                            <td><?php echo $info['username']; ?></td>
                            <td class="td_talee">
                                <a href="<?php echo $info['k_id']; ?>" target="_blank" >
                                    <img src="s.png" alt="PDF Icon">
                                </a>
                            </td>
                            <td class="td_taleee">
                                <?php
                                echo "<a onClick=\"javascript:return confirm('Are You Sure To reject upgrade');\" href='upgrade_requset.php?c_id={$info['id']}' class='btn btn-danger'>Reject </a>";
                                echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve upgrade?');\" href='upgrade_requset.php?approve_id={$info['id']}' class='btn btn-success'>upgrade </a>";
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
