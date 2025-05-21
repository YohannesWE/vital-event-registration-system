<?php
session_start();
error_reporting(0);

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

  

if (isset($_SESSION['unread_count4'])) {
    $unread_count4 = $_SESSION['unread_count4'];
  } else {
    $unread_count4 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count4 FROM user WHERE states = 'pending' and usertype='applicant' AND c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count4 = $unread_row['unread_count4'];
} else {
    $unread_count4 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count4'] = $unread_count4;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE user SET c_status='read' WHERE usertype='applicant' and c_status='unread'";
mysqli_query($conn, $update_status_sql);

$sql = "SELECT * FROM user WHERE states = 'pending' and usertype = 'applicant'";
$result = mysqli_query($conn, $sql);

$message = ''; // Initialize message variable

if ($_GET['c_id']) {
    $t_id = $_GET['c_id'];
    
    // First, retrieve the email and name of the user
    $user_query = "SELECT email, full_name, middle_name, last_name FROM user WHERE id='$t_id'";
    $user_result = mysqli_query($conn, $user_query);
    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $row = mysqli_fetch_assoc($user_result);
        $email = $row['email'];
        $first_name = $row['full_name'];
        $middle_name = $row['middle_name'];
        $last_name = $row['last_name'];

        // Now delete the user account
        $delete_query = "DELETE FROM user WHERE id='$t_id'";
        $result2 = mysqli_query($conn, $delete_query);
        if ($result2) {
            $message = '<div class="alert alert-success">applicant account deleted successfully.</div>';

            // Now you have the email, proceed to send the message
            if (isset($email)) {
                // Send the message
                $mail = require __DIR__ . "/mailer.php";
                $mail->setFrom("noreply@example.com");
                $mail->addAddress($email);
                $mail->Subject = "Account Deletion";
                $mail->Body = <<<END
Dear $first_name $middle_name $last_name,

Your account has been deleted.
If you believe this is an error, please contact support.
END;

                try {
                    $mail->send();
            
                } catch (Exception $e) {
                 
                }
            }
        } else {

        }
    } else {
        $message = '<div class="alert alert-success">unable to delate.</div>';
    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE user SET states = 'approved' WHERE id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant account approved successfully.</div>'; // Display success message
        $sql4 = "SELECT email, full_name, middle_name, last_name FROM user WHERE id = '$approve_id'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4) {
            

            $row = mysqli_fetch_assoc($result4);
            $email = $row['email'];
            $first_name = $row['full_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];

            if (isset($email)) {
                $mail = require __DIR__ . "/mailer.php";
                $mail->setFrom("noreply@example.com");
                $mail->addAddress($email);
                $mail->Subject = "Account approval";
                $mail->Body = <<<END
Dear $first_name $middle_name $last_name,
Congratulations, your account has been approved; you can now access our services.
END;

                try {
                    $mail->send();
              
                } catch (Exception $e) {
                  
                }
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
        <h5><center><?= __('Applicant Account Request')?></center> </h5>
        <?php if (!empty($message)): ?>
    <div id="errorMessage" class="alert"><?php echo $message; ?></div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
            window.location.href = "Account_Requset.php";
        }
    }, 4000);
</script>

        <table>
            <tr>
                <th>NO</th>
                <th><?= __('Kebele Id Number/fayeda')?></th>
                <th><?= __('Name')?></th>
                <th><?= __('Username')?></th>
                <th><?= __('Email')?></th>
                <th><?= __('Gender')?></th>
                <th><?= __('Keble ID/fayeda Photo')?></th>
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
                        <td><?php echo implode(' ', array_filter([$info['full_name'], $info['middle_name'], $info['last_name']])); ?></td>
                        <td><?php echo $info['username']; ?></td>
                        <td><?php echo $info['email']; ?></td>
                        <td><?php echo $info['sex']; ?></td>
                        <td class="td_talee">
                            <a href="<?php echo $info['k_id']; ?>" target="_blank">
                                <img src="s.png" alt="PDF Icon">
                            </a>
                        </td>
                        <td class="td_taleee">
                            <?php
                            echo "<a onClick=\"javascript:return confirm('Are You Sure To Reject applicant');\" href='Account_Requset.php?c_id={$info['id']}' class='btn btn-danger'>Reject applicant</a>";
                            echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve applicant?');\" href='Account_Requset.php?approve_id={$info['id']}' class='btn btn-success'>Approve applicant</a>";
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
