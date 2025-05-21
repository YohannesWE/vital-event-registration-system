<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// Get the username from the URL parameter
if(isset($_GET['k_id_no'])) {
    $k_id_no = $_GET['k_id_no'];
} else {
    // Handle the case where username is not provided
    echo "k_id_no is not provided.";
    exit;
}

// Function to check if a user already has an appointment for the given event type within the next 3 days
function hasExistingAppointment($k_id_no, $eventType) {
    global $conn;

    // Get current date
    $currentDate = date("Y-m-d");

    // Check for appointments for the next 3 days
    for ($i = 0; $i < 3; $i++) {
        // Calculate the date for the current iteration
        $appointmentDate = date('Y-m-d', strtotime($currentDate . " +$i day"));

        // Check if the user already has an appointment for the given event type on the current date
        $sql = "SELECT COUNT(*) AS numAppointments FROM appointment WHERE k_id_no = '$k_id_no' AND event_type = '$eventType' AND appointment_date = '$appointmentDate'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $numAppointmentsToday = $row['numAppointments'];
        
        // If the user already has an appointment for the given event type on the current date, return true
        if ($numAppointmentsToday > 0) {
            return true;
        }
    }

    // If no existing appointment is found within the next 3 days, return false
    return false;
}

// Function to schedule appointments starting after 3 days from today
function scheduleAppointments($k_id_no) {
    global $conn;

    // Get current date
    $currentDate = date("Y-m-d");

    // Calculate the date after 3 days from today
    $startDate = date('Y-m-d', strtotime($currentDate . " +3 day"));

    // Check if the user already has an appointment for the 'birth' event type after 3 days from today
    if (hasExistingAppointment($k_id_no, 'death')) {
        $message = "An appointment for the 'death' event type is already scheduled for $k_id_no after 3 days from today.";
        return $message;
    }

    // Check if the user already has an appointment for the 'birth' event type in the future
    $sql = "SELECT appointment_date FROM appointment WHERE k_id_no = '$k_id_no' AND event_type = 'death' AND appointment_date > '$currentDate' ORDER BY appointment_date ASC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $appointmentDate = $row['appointment_date'];
        $message = "An appointment for the 'death' event type is already scheduled for $k_id_no on $appointmentDate.";
        return $message;
    }

    // Schedule appointments starting after 3 days from today
    $i = 0;
    while (true) {
        // Calculate the date for the current iteration
        $appointmentDate = date('Y-m-d', strtotime($startDate . " +$i day"));

        // Check appointments for the current date
        $sql = "SELECT COUNT(*) AS numAppointments FROM appointment WHERE appointment_date = '$appointmentDate'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $numAppointmentsToday = $row['numAppointments'];
        $death = "death";

        // If today's appointments are less than 10, appoint applicant for today
        if ($numAppointmentsToday < 10) {
            // Logic to appoint applicant for the current date
            $insertSql = "INSERT INTO appointment (k_id_no, appointment_date, event_type) 
                          VALUES ('$k_id_no', '$appointmentDate', '$death')";
            mysqli_query($conn, $insertSql);
            $message = "Appointment scheduled for $k_id_no on $appointmentDate successfully!";
            return $message; // Exit the function after scheduling an appointment
        }
        
        $i++; // Increment the iteration counter
    }
}

// Call the function to schedule appointments
$message = scheduleAppointments($k_id_no);

// Display the message
header("Location: appointment_death.php?message=" . urlencode($message));

// Continue with the rest of your code
?>
