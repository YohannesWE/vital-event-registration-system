<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manger' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count_child FROM birth_table 
                     INNER JOIN user ON birth_table.username = user.username 
                     WHERE birth_table.c_status='unread' AND user.usertype = 'child'";

$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count_child = $unread_row['unread_count_child'];
} else {
    $unread_count_child = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count_child'] = $unread_count_child;
// Mark comments as read when the manager views them

$update_status_sql = "UPDATE birth_table 
                      INNER JOIN user ON birth_table.username = user.username 
                      SET birth_table.c_status='read' 
                      WHERE birth_table.c_status='unread' AND user.usertype='child'";

mysqli_query($conn, $update_status_sql);

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

$sql = "SELECT bt.* FROM birth_table bt 
        JOIN user u ON bt.username = u.username 
        WHERE bt.Birth_status = 'pending' AND u.usertype = 'child'";

$result = mysqli_query($conn, $sql);

if ($_GET['c_id']) {
    $t_id = $_GET['c_id'];
    $sql2 = "DELETE FROM birth_table WHERE b_id='$t_id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        $message = "The birth application has been successfully deleted.";
     
    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE birth_table SET Birth_status = 'approved', civil_registarar_fname = '$civil_registrarr_fname',civil_registarar_mname = '$civil_registrarr_mname' ,civil_registarar_lname = '$civil_registrarr_lname' WHERE b_id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        $message = "The birth application has been successfully updated.";

    } else {
        echo "Error updating record: " . mysqli_error($conn);
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
 <h5><center>Child Birth Requests</center></h5>
   
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
            window.location.href = "Vital_event_Requset_child.php";
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
                    <a href="Vital_event_Requset_child2.php?b_id=<?php echo $info['b_id']; ?>" class="btn btn-success"><?= __('More Details')?></a>
                    </td>
                    <td class="td_tale">
                        <a onClick="return confirm('Are You Sure To Delete this birth event?');" href='Vital_event_Requset_child.php?c_id=<?php echo $info['b_id']; ?>' class='btn btn-danger'><?= __('Reject')?></a>
                        <a onClick="return confirm('Are You Sure To Approve this birth event?');" href='Vital_event_Requset_child.php?approve_id=<?php echo $info['b_id']; ?>' class='btn btn-success'><?= __('Approve')?></a>
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
