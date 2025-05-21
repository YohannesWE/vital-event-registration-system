<?php
session_start();
error_reporting(0);
include_once 'languge.php'; 
// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("location:login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_SESSION['unread_count5'])) {
    $unread_count5 = $_SESSION['unread_count5'];
  } else {
    $unread_count5 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count5 FROM user WHERE states = 'pending' and usertype='child' AND c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count5 = $unread_row['unread_count5'];
} else {
    $unread_count5 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count5'] = $unread_count5;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE user SET c_status='read' WHERE c_status='unread'";
mysqli_query($conn, $update_status_sql);
$sql = "SELECT * FROM user WHERE states = 'pending' AND usertype = 'child' AND death_status = 'undeath'";
$result = mysqli_query($conn, $sql);

$message = ''; // Initialize message variable

if ($_GET['c_id']) {
    $t_id = $_GET['c_id'];
    $sql2 = "DELETE FROM user WHERE id='$t_id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        $message = '<div class="alert alert-success">applicant account deleted successfully.</div>';
        // Send email after deletion
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
            $mail->Subject = "Account Deletion";
            $mail->Body = "Dear $first_name $middle_name $last_name,\n\nYour child account has been deleted.";

            try {
                $mail->send();
              
            } catch (Exception $e) {
               
            }
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">Failed to find user email for sending deletion notification.</div>';
        }
    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE user SET states = 'approved' WHERE id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant account approved successfully.</div>'; // Display success message
        $sql4 = "SELECT email FROM user WHERE id = '$approve_id'";
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
            $mail->Subject = "Account approval";
            $mail->Body = "Dear $first_name $middle_name $last_name,\n\nYour child account has been approved succfully know you can access oyr system using child account.";

            try {
                $mail->send();
              
            } catch (Exception $e) {
               
            }
        }
    }
}
// Set message in session and unset it after displaying
if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civil registrar Page</title>
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
        <h5><center><?= __('Child Account Request')?></center></h5>
        <?php if (!empty($message)): ?>
    <div id="errorMessage" class="alert"><?php echo $message; ?></div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
            window.location.href = "Account_Requset_child.php";
        }
    }, 4000);
</script>
        <table>
            <tr>
                <th>NO</th>
                <th><?= __('Name')?></th>    
                <th><?= __('Username')?></th>
                <th><?= __('Father kebele id')?></th>
                <th><?= __('Birth Paper')?></th>
                <th><?= __('Action')?></th>
            </tr>
            <?php
            $count = 1;
            if ($result->num_rows > 0) {
                while ($info = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $info['full_name'] . ' ' . $info['middle_name'] . ' ' . $info['last_name']; ?></td>

                        <td><?php echo $info['username']; ?></td>
                        <td class="td_talee">
                            <a href="<?php echo $info['k_id_no']; ?>" target="_blank" >
                                <img src="s.png" alt="PDF Icon">
                            </a>
                        </td>
                        <td class="td_talee">
                            <a href="<?php echo $info['k_id']; ?>" target="_blank" >
                                <img src="s.png" alt="PDF Icon">
                            </a>
                        </td>
                        <td class="td_taleee">
                            <?php
                            echo "<a onClick=\"javascript:return confirm('Are You Sure To Reject child');\" href='Account_Requset.php?c_id={$info['id']}' class='btn btn-danger'>Reject</a>";
                            echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve child?');\" href='Account_Requset.php?approve_id={$info['id']}' class='btn btn-success'>Approve</a>";
                            ?>
                        </td>
                    </tr>
                    <?php
                    $count++;
                }
            } else {
                ?>
                <tr>
                    <td colspan="8" class="not-registered"><?= __('No new Request found')?>.</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
