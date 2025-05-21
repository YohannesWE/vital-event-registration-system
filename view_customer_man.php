<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit; // Prevent further execution if not logged in
} elseif ($_SESSION['usertype'] == 'civil_registrar' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("location:login.php");
    exit; // Prevent further execution if unauthorized user
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM user WHERE usertype='applicant' OR usertype='child'";
$result = mysqli_query($conn, $sql);
// Handle search functionality
if (isset($_GET['search'])) {
    $searchKeyword = $_GET['search'];
    $sql = "SELECT * FROM user WHERE (usertype='applicant' OR usertype='child') AND (full_name LIKE '%$searchKeyword%' OR username LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%' OR phone LIKE '%$searchKeyword%')";
} else {
    $sql = "SELECT * FROM user WHERE usertype='applicant' OR usertype='child'";
}

// Deletion logic
$message = ""; // Initialize message variable
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $delete_sql = "DELETE FROM user WHERE id='$user_id'";
    if (mysqli_query($conn, $delete_sql)) {
        $message = "User deleted successfully.";
    } else {
        $message = "Error occurred while deleting user.";
    }
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applicants</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
</head>
<body>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="table-container">
            <h5><center><?= __('ALL APPLICANTS')?></center></h5>
            <?php if (!empty($message)) { ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php } ?>
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search by name, username, email, or phone">
                <input type="submit" value="Search" class="btn btn-primary">
                <a href="view_customer_man.php" class="btn btn-primary"><?= __('Return to All List')?></a>
            </form>
            <table border="1px">
                <tr>
                    <th class="tt"><?= __('Id')?></th>
                    <th class="tt"><?= __('Full Name')?></th>
                    <th class="tt"><?= __('Username')?></th>
                    <th class="tt"><?= __('Email')?></th>
                    <th class="tt"><?= __('Phone')?></th>
                    <th class="tt"><?= __('Status')?></th>
                    <th class="tt"><?= __('Action')?></th>
                </tr>

                <?php while ($info = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="td_tale" width="100px"><?php echo $info['id']; ?></td>
                        <td class="td_tale"><?php echo $info['full_name']; ?></td>
                        <td class="td_tale"><?php echo $info['username']; ?></td>
                        <td class="td_tale"><?php echo $info['email']; ?></td>
                        <td class="td_tale"><?php echo $info['phone']; ?></td>
                        <td class="td_tale"><?php echo $info['states']; ?></td>
                        <td class="td_tale">
                            <form method="POST" action="">
                                <input type="hidden" name="user_id" value="<?php echo $info['id']; ?>">
                                <button type="submit" class="btn btn-danger" name="delete_user" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
