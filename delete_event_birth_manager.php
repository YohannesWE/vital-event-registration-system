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
    $sql = "DELETE FROM birth_table WHERE username = '$username'";

    // Execute SQL statement
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Birth application deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting record: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    $_SESSION['message'] = "Username not provided";
}

// Redirect to another page
header("Location: view_vital_event_man_birth.php?message=" . urlencode($_SESSION['message']));
exit();
?>
