<?php
session_start();
error_reporting(0);
$message = ''; // Initialize message variable
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

if (isset($_SESSION['unread_count'])) {
    $unread_count = $_SESSION['unread_count'];
  } else {
    $unread_count = 0; // Default to 0 if the session variable is not set
  }
// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count FROM birth_table WHERE Birth_status = 'pending' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count = $unread_row['unread_count'];
} else {
    $unread_count = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count'] = $unread_count;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE birth_table SET c_status='read' WHERE c_status='unread'";
mysqli_query($conn, $update_status_sql);

$sql = "SELECT * FROM birth_table WHERE Birth_status = 'pending'";
$result = mysqli_query($conn, $sql);

if ($_GET['c_id']) {
    $t_id = $_GET['c_id'];
    $sql2 = "DELETE FROM birth_table WHERE b_id='$t_id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        $message = '<div class="alert alert-success">applicant application deleted successfully.</div>';
        // Send email after deletion
        $email_query = "SELECT email, f_name, m_name, l_name FROM birth_table WHERE b_id='$t_id'";
        $email_result = mysqli_query($conn, $email_query);
        if ($email_result && mysqli_num_rows($email_result) > 0) {
            $row = mysqli_fetch_assoc($email_result);
            $email = $row['email'];
            $first_name = $row['f_name'];
            $middle_name = $row['m_name'];
            $last_name = $row['l_name'];

            // Send the email
            $mail = require __DIR__ . "/mailer.php";
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Birth Event Deleted";
            $mail->Body = "Dear $first_name $middle_name $last_name,\n\nYour birth event has been deleted.";

            if ($mail->send()) {
               
            } else {
               
        } 
    }}
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE birth_table SET Birth_status = 'approved', civil_registarar_fname = '$civil_registrarr_fname',civil_registarar_mname = '$civil_registrarr_mname' ,civil_registarar_lname = '$civil_registrarr_lname' WHERE b_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant application approved successfully.</div>'; // Display success message
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
            $mail->Subject = "Password Reset";
            $mail->Body = <<<END
            Your application is accepted. You must pay and send me your link.
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
    
    <h5><center><?= __('Applicant Birth Requests')?></center></h5>
 
  <div class="container-fluid">
    <div class="table-container">
 
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
                    <th><?= __('Username')?></th>
                    <th><?= __('Name')?></th>
                    <th><?= __('Mother Name')?></th>
                    <th><?= __('Birth date')?></th>
                    <th><?= __('Birth Paper')?></th>
                    <th><?= __('More Details')?></th>
                    <th><?= __('Action')?></th>
                </tr>
                <?php
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($info = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td class="td_tale"><?php echo $count; ?></td>
                    <td class="td_tale"><?php echo $info['username']; ?></td>
                    <td class="td_tale"><?php echo $info['f_name'] . ' ' . $info['m_name'] . ' ' . $info['l_name']; ?></td>

                    <td class="td_tale"><?php echo "{$info['Mother_fname']} {$info['Mother_mname']} {$info['Mother_lname']}"; ?></td>
                    <td class="td_tale"><?php echo $info['Birthdate']; ?></td>
                    <td class="td_talee">
                        <a href="<?php echo $info['Birth_paper']; ?>" target="_blank">
                            <img src="s.png" alt="PDF Icon">
                        </a>
                    </td>
                    <td class="td_tale">
                        <a href="Vital_event_Requset_birth2.php?b_id=<?php echo $info['b_id']; ?>" class="btn btn-success"><?= __('More Details')?></a>
                    </td>
                    <td class="td_tale">
                        <a onClick="return confirm('Are You Sure To Delete this birth event?');" href='Vital_event_Requset_birth.php?c_id=<?php echo $info['b_id']; ?>' class='btn btn-danger'><?= __('Reject')?></a>
                        <a onClick="return confirm('Are You Sure To Approve this birth event?');" href='Vital_event_Requset_birth.php?approve_id=<?php echo $info['b_id']; ?>' class='btn btn-success'><?= __('Approve')?></a>
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
