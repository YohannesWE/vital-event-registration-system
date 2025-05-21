<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'Civil_registrar') {
    header("location:login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE usertype != 'applicant'";
$result = mysqli_query($conn, $sql);

if ($_GET['c_id']) {
    $t_id = $_GET['c_id'];
    $sql2 = "DELETE FROM user WHERE id='$t_id'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        header('location: View_account.php');
    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    // Fetch user data
    $fetch_sql = "SELECT * FROM user WHERE id='$approve_id'";
    $fetch_result = mysqli_query($conn, $fetch_sql);
    if ($fetch_result && mysqli_num_rows($fetch_result) > 0) {
        $user_data = mysqli_fetch_assoc($fetch_result);
        // Toggle user state between 'deactivated' and 'pending'
        $new_state = $user_data['states'] == 'deactivated' ? 'approved' : 'deactivated';
        $sql3 = "UPDATE user SET states='$new_state' WHERE id='$approve_id'";
        $result3 = mysqli_query($conn, $sql3);
        if ($result3) {
            header('location: View_account.php');
        }
    } else {
        // Redirect if user not found
        header('location: View_account.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Account</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_admin.php'; ?>
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


    <center><h5><?= __('User List')?></h5></center>
    <table>
        <tr>
            <th><?= __('ID')?></th>
            <th><?= __('Name')?></th>
            <th><?= __('Username')?></th>
            <th><?= __('Email')?></th>
            <th><?= __('Phone')?></th>
            
            <th><?= __('User Type')?></th>
            <th><?= __('Action')?></th>
        </tr>
        <?php 
        while($info = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $info['id']; ?></td>
            <td><?php echo $info['full_name']; ?></td>
            <td><?php echo $info['username']; ?></td>
            <td><?php echo $info['email']; ?></td>
            <td><?php echo $info['phone']; ?></td>
            
            <td><?php echo $info['usertype']; ?></td>
            <td>
    <?php
    if ($info['states'] == 'deactivated') {
        echo "<a onClick=\"return confirm('Are You Sure To Approve this User?');\" href='View_account.php?approve_id={$info['id']}' class='btn btn-success'>Approve</a>";
    } else {
        echo "<a onClick=\"return confirm('Are You Sure To Deactivate this User?');\" href='View_account.php?approve_id={$info['id']}' class='btn btn-primary'>Deactivate</a>";
    }
    ?>
    
    <a href='update_user.php?id=<?php echo $info['id']; ?>' class='btn btn-secondary'>Update</a>
    <a href='view_user.php?id=<?php echo $info['id']; ?>' class='btn btn-success'>view user</a>
</td>

        <?php
        }
        ?>
    </table>
</div>
</div>

</body>
</html>
