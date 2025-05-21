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

$message = '';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id='$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $usertype = $_POST['usertype'];

    $update_sql = "UPDATE user SET full_name='$first_name', middle_name='$middle_name', last_name='$last_name', username='$username', email='$email', phone='$phone', usertype='$usertype' WHERE id='$user_id'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        $message = "Record updated successfully.";
    } else {
        $message = "Error updating record: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_admin.php'; ?>
    <style>
        .message {
            background-color: #f2dede;
            color: #a94442;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="table-container">
        <div class="container">
            <h5 class="mt-4 mb-45">Update User</h5>
            <?php if (!empty($message)) { ?>
                <div class="message"><?php echo $message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['full_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $row['middle_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="usertype">User Type:</label>
                    <select class="form-control" id="usertype" name="usertype" required>
                        <option value="admin" <?php if ($row['usertype'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="Civil_registrar" <?php if ($row['usertype'] == 'Civil_registrar') echo 'selected'; ?>>Civil Registrar</option>
                        <option value="manager" <?php if ($row['usertype'] == 'manager') echo 'selected'; ?>>Manager</option>
                        <option value="child" <?php if ($row['usertype'] == 'child') echo 'selected'; ?>>Child</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
