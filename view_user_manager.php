<?php
session_start();
error_reporting(0);

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
} elseif ($_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'Civil_registrar') {
    header("location:login.php");
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id='$user_id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // Handle error if user data is not found
        echo "User not found.";
        exit; // Stop further execution
    }
} else {
    // Handle error if user ID is not provided
    echo "User ID not provided.";
    exit; // Stop further execution
}

// Function to generate a printable page
function generatePrintablePage($data) {
    echo "<h2>Ganda chefee keble vital event registartion office </h2>";
    echo "<h2>User Information</h2>";
    echo "<p><strong>Full Name:</strong> " . $data['full_name'] . "</p>";
    echo "<p><strong>Username:</strong> " . $data['username'] . "</p>";
    echo "<p><strong>Email:</strong> " . $data['email'] . "</p>";
    echo "<p><strong>Phone:</strong> " . $data['phone'] . "</p>";
    echo "<p><strong>User Type:</strong> " . $data['usertype'] . "</p>";
    echo "<p><strong>password:</strong> " . $data['password'] . "</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .user-info {
            margin: 0 auto;
            width: 50%;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }
        .user-info p {
            margin: 10px 0;
        }
        .print-btn {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        .print-btn button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
        <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
</head>
<body>
    <div class="user-info">
        <?php
        // Output the user information if available
        if (!empty($row)) {
            generatePrintablePage($row);
        } else {
            echo "User information not available.";
        }
        ?>
    </div><br>
    <center>
    <a href="download_user.php?id=<?php echo $user_id; ?>" class="btn btn-primary">Download</a>

    </center>
</body>
</html>
