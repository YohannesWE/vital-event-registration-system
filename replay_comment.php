<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the reply message is set and not empty
    if (isset($_POST["reply_message"]) && !empty(trim($_POST["reply_message"]))) {
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

        // Get the username and reply message from the form
        $username = $_SESSION["username"];
        $replyMessage = $_POST["reply_message"];
        $f_id = $_POST["f_id"]; // Assuming f_id is the ID of the feedback being replied to

        // Prepare and execute the SQL query to update the feedback with the reply message
  // Prepare and execute the SQL query to update the feedback with the reply message
$sql = "UPDATE feedback_table SET replay = ? WHERE f_id = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "si", $replyMessage, $f_id);
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $successMessage = "Reply sent successfully.";
        } else {
            $errorMessage = "No rows were affected by the update.";
        }
    } else {
        $errorMessage = "Error executing the query: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
} else {
    $errorMessage = "Error preparing the query: " . mysqli_error($conn);
}
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Feedback</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <div class="container">
        <h2>Reply to Feedback</h2>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="reply_message">Reply Message:</label>
                <textarea class="form-control" name="reply_message" id="reply_message" rows="5"></textarea>
            </div>
            <input type="hidden" name="f_id" value="<?php echo isset($_GET['f_id']) ? htmlspecialchars($_GET['f_id']) : ''; ?>">

            <button type="submit" class="btn btn-primary">Submit Reply</button>
        </form>
    </div>
</body>
</html>
