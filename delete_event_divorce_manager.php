<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Check if username is passed through GET method
if(isset($_GET['username'])) {
    $username = $_GET['username'];

    // Establish connection to database
    $conn = mysqli_connect("localhost", "root", "", "vital_event");

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement to delete record
    $sql = "DELETE FROM divorce_table WHERE username = '$username'";

    // Execute SQL statement
    if (mysqli_query($conn, $sql)) {
        $message = "vital event divorce application deleted successfully";
    } else {
        $message = "Error deleting application: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    $message = "Username not provided";
}
header("Location: view_vital_event_man_Divorce.php?message=" . urlencode($message));
?>