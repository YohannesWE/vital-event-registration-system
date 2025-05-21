<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "vital_event";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the username
$username = $_SESSION["username"];

// Fetch feedbacks along with their replies for the logged-in user
$sql = "SELECT * FROM feedback_table WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    die("Error preparing the query: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedbacks</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css1_applicant.php'; ?>
    <style>
    body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
    </style>
</head>
<body>
    <div class="container">
        <h5><center>View Feedbacks</center></h5>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Feedback ID</th>
                        <th>username</th>
                        <th>Feedback Message</th>
                        <th>Reply Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['f_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['feedback_message']; ?></td>
                            <td><?php echo $row['replay'] ? $row['replay'] : 'No reply yet'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p><center>No feedbacks found for <?php echo $username; ?></center></p>
        <?php endif; ?>
    </div>
</body>
</html>
