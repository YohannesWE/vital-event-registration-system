<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'manager') {
    header("location:login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'kebele employee') {
    header("location:login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'customer') {
    header("location:login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <?php include 'admin_css.php'; ?>
    <script>
        function confirmLogout() {
            var confirmLogout = confirm("Are you sure you want to logout?");
            if (confirmLogout) {
                window.location.href = "logout.php";
            }
        }
    </script>
</head>
<body>
    <header class="header">
        <a href="">Admin Page</a>
        <div class="logout">
            <a href="#" class="btn btn-primary" onclick="confirmLogout()">Logout</a>
        </div>
    </header>
    <aside>
        <ul class="ui">
            <li>
                <a href="create_account.php">Create account</a>
            </li>
            <li>
                <a href="View_account.php">View account</a>
            </li>
            <li>
                <a href="view_customer_admin.php">View Customer</a>
            </li>
            <li>
                <a href="admin.php">Back</a>
            </li>
        </ul>
    </aside>
    <div class="content">
        <h1>
            Here is admin Page
        </h1>
    </div>
</body>
</html>