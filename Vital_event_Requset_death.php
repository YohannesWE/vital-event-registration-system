<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manger') {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'customer') {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit;
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

if (isset($_SESSION['unread_count1'])) {
    $unread_count = $_SESSION['unread_count1'];
  } else {
    $unread_count = 0; // Default to 0 if the session variable is not set
  }
  

  if (isset($_SESSION['unread_count1'])) {
    $unread_count1 = $_SESSION['unread_count1'];
  } else {
    $unread_count1 = 0; // Default to 0 if the session variable is not set
  }
  

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count1 FROM death_table WHERE c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count1 = $unread_row['unread_count1'];
} else {
    $unread_count1 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count1'] = $unread_count1;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE death_table SET c_status='read' WHERE c_status='unread'";
mysqli_query($conn, $update_status_sql);


$sql = "SELECT * FROM death_table WHERE Death_states = 'pending'";
$result = mysqli_query($conn, $sql);

// Initialize the message variable
$message = '';
$civil_registarar_fname = $_SESSION['full_name'];
$civil_registarar_mname = $_SESSION['middle_name'];
$civil_registarar_lname = $_SESSION['last_name'];
if ($_GET['c_id']) {
    $t_id = $_GET['c_id'];
    $sql2 = "DELETE FROM death_table WHERE d_id='$t_id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        $message = '<div class="alert alert-success">applicant application deleted successfully.</div>';
        // Send email after deletion
        $email_query = "SELECT email, f_name, m_name, l_name FROM death_table WHERE d_id='$t_id'";
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
            $mail->Subject = "Death Event Deleted";
            $mail->Body = "Dear $first_name $middle_name $last_name,\n\nYour death event has been deleted.";

            if ($mail->send()) {
                
            } else {
                
            }
        } else {
           
        }
    } else {
        $message = "Failed to delete death event.";
    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE death_table SET Death_states = 'approved', civil_registarar_fname = '$civil_registrarr_fname',civil_registarar_mname = '$civil_registrarr_mname' ,civil_registarar_lname = '$civil_registrarr_lname' WHERE d_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $message = '<div class="alert alert-success">Applicant application approved successfully.</div>'; // Display success message
        $sql4 = "SELECT email FROM death_table WHERE d_id = '$approve_id'";
        $result4 = mysqli_query($conn, $sql4);
        if (!$result4) {
            die("Query failed: " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result4);
        $email = $row['email'];
        $first_name = $row['f_name'];
        $middle_name = $row['m_name'];
        $last_name = $row['l_name'];
        if (isset($email)) {

            $mail = require __DIR__ . "/mailer.php";

            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Death Application Approved";
            $mail->Body = <<<END

            Dear $first_name $middle_name $last_name,

Your death application has been approved. Please proceed to pay the appropriate fee and send the payment confirmation link via email.

Thank you,
Kirkos Subcity Wereda 02 Vital Event Registration System
END;

            try {

                $mail->send();

            } catch (Exception $e) {

              

            }

        }

        
  
    } else {
        $message = "Failed to approve death event.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vital Event Request</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        /* Container styles */
        .containert {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .th {
            background-color:rgb(0, 110, 185);
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Button styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color:rgba(0, 111, 170, 0.47);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color:rgb(39, 169, 82);
        }
        .serach{
        align-items:right;
        }

    </style>
</head>
<body>
    <h5><center><?= __('Death Application Requests')?></center></h5>
    <!-- Display message above the table -->
    <?php if (!empty($message)): ?>
    <div id="errorMessage" class="alert"><?php echo $message; ?></div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
            window.location.href = "Vital_event_Requset_death.php";
        }
    }, 4000);
</script>
    <div class="container-fluid">
        <div class="table-container">
            <table border="1px">
                <tr>
                    <th class="tt">NO</th>
                    <th class="tt"><?= __('Kebele Id Number/fayeda')?></th>
                    <th class="tt"><?= __('Deceased Name')?></th>
                    <th class="tt"><?= __('Date of death')?></th>
                    <th class="tt"><?= __('Death Paper')?></th>
                    <th class="tt"><?= __('More Details')?></th>
                    <th class="tt"><?= __('Action')?></th>
                </tr>
                <?php
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($info = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="td_tale"><?php echo $count; ?></td>
                            <td class="td_tale"><?php echo "{$info['k_id_no']}" ?></td>
                            <td class="td_tale"><?php echo "{$info['f_name']} {$info['m_name']} {$info['l_name']}"; ?></td>
                            <td class="td_tale"><?php echo "{$info['Death_date']}" ?></td>
                            <td class="td_talee">
                                <a href="<?php echo $info['Death_paper']; ?>" target="_blank">
                                    <img src="s.png" alt="PDF Icon" width="100" height="80">
                                </a>
                            </td>
                            <td class="td_tale">
                                <a href="Vital_event_Requset_death2.php?d_id=<?php echo $info['d_id']; ?>"
                                   class="btn btn-primary"><?= __('More Details')?></a>
                            </td>
                            <td class="td_taleee">
                                <?php
                                echo "<a onClick=\"javascript:return confirm('Are You Sure To Delete this death event');\" href='Vital_event_Requset_death.php?c_id={$info['d_id']}' class='btn btn-danger'>Rejact </a>";
                                echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve this death event?');\" href='Vital_event_Requset_death.php?approve_id={$info['d_id']}' class='btn btn-success'>Approve</a>";
                                ?>
                            </td>
                        </tr>
                        <?php
                        $count++;
                    }
                } else {
                    ?>
                    <tr>
                    <td colspan="9" class="not-registered"><?= __('No new Request found')?>.</td>                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
