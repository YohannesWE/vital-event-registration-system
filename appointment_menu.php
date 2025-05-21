<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the SQL query to select all appointments
$sql = "SELECT * FROM appointment";

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applicant</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>
  body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
        

            .message {
    padding: 10px 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    background-color: #dff0d8;
    color:rgba(10, 103, 154, 0.76);
    border: 1px solid #d6e9c6;
}


     

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: rgba(0, 111, 170, 0.87);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btn:hover {
            background-color:rgba(0, 111, 170, 0.47);
        }

        .btn-group {
            margin-bottom: 20px;
        }

        .serach {
            text-align: right;
            margin-top: 20px;
        }

        .appointment-type {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="containert">
    <div class="container-fluid">
        <div class="table-container"><center>
            <div class="btn-group">
                <a href="appointment.php" class="btn"><?= __('Birth Appointment')?></a>
                <a href="appointment_death.php" class="btn"><?= __('Death Appointment')?></a>
                <a href="appointment_divorce.php" class="btn"><?= __('Divorce Appointment')?></a>
                <a href="appointment_marriage.php" class="btn"><?= __('Marriage Appointment')?></a>
            </div><center>
            <div class="container">
    <h5><center><?= __('All Appointments')?></center></h5>
    <table>
        <thead>
            <tr>
                <th><?= __('Appointment ID')?></th>
                <th><?= __('Username')?></th>
              
                <th><?= __('Appointment Date')?></th>
                <th><?= __('Event Type')?></th>
              
                <!-- Add more table headers if needed -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Display the appointments
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['A_id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
               
                echo "<td>" . $row['appointment_date'] . "</td>";
                echo "<td>" . $row['event_type'] . "</td>";

                // Add more table cells if needed
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
        </div>
    </div>
</div>
</body>
</html>
