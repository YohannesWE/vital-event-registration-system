<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Initialize the message variable
$message = "";

// Check if "k_id_no" is provided in the GET parameters
if(isset($_GET['k_id_no'])) {
    $k_id_no = $_GET['k_id_no'];

    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "vital_event");

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement to delete record
    $sql = "DELETE FROM death_table WHERE k_id_no = '$k_id_no'";

    // Execute SQL statement
    if (mysqli_query($conn, $sql)) {
        // Set success message
        $message = "Vital event death application deleted successfully";
    } else {
        // Set error message
        $message = "Error deleting application: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Set message if "k_id_no" is not provided
    $message = "Kebele ID number not provided";
}

// Redirect to the view page with the message
header("Location: view_vital_event_man_death.php?message=" . urlencode($message));
exit();
?>
