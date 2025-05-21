<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='customer'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='kebele employee'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
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

// Database connection
$conn = mysqli_connect("localhost", "root", "", "vital_event");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Report generation
$totalBirths = $totalApproved = $totalPending = $totalPaid = $totalUnpaid = 0;

// Total number of births
$totalBirthsQuery = "SELECT COUNT(*) AS total_births FROM birth_table";
$totalBirthsResult = mysqli_query($conn, $totalBirthsQuery);
if ($totalBirthsResult && mysqli_num_rows($totalBirthsResult) > 0) {
    $totalBirthsRow = mysqli_fetch_assoc($totalBirthsResult);
    $totalBirths = $totalBirthsRow['total_births'];
}

// Total number of approved registrations
$totalApprovedQuery = "SELECT COUNT(*) AS total_approved FROM birth_table WHERE Birth_status = 'approved'";
$totalApprovedResult = mysqli_query($conn, $totalApprovedQuery);
if ($totalApprovedResult && mysqli_num_rows($totalApprovedResult) > 0) {
    $totalApprovedRow = mysqli_fetch_assoc($totalApprovedResult);
    $totalApproved = $totalApprovedRow['total_approved'];
}

// Total number of pending registrations
$totalPendingQuery = "SELECT COUNT(*) AS total_pending FROM birth_table WHERE Birth_status = 'pending'";
$totalPendingResult = mysqli_query($conn, $totalPendingQuery);
if ($totalPendingResult && mysqli_num_rows($totalPendingResult) > 0) {
    $totalPendingRow = mysqli_fetch_assoc($totalPendingResult);
    $totalPending = $totalPendingRow['total_pending'];
}

// Total number of paid registrations
$totalPaidQuery = "SELECT COUNT(*) AS total_paid FROM birth_table WHERE Payment = 'paid'";
$totalPaidResult = mysqli_query($conn, $totalPaidQuery);
if ($totalPaidResult && mysqli_num_rows($totalPaidResult) > 0) {
    $totalPaidRow = mysqli_fetch_assoc($totalPaidResult);
    $totalPaid = $totalPaidRow['total_paid'];
}

// Total number of unpaid registrations
$totalUnpaidQuery = "SELECT COUNT(*) AS total_unpaid FROM birth_table WHERE Payment = 'unpaid'";
$totalUnpaidResult = mysqli_query($conn, $totalUnpaidQuery);
if ($totalUnpaidResult && mysqli_num_rows($totalUnpaidResult) > 0) {
    $totalUnpaidRow = mysqli_fetch_assoc($totalUnpaidResult);
    $totalUnpaid = $totalUnpaidRow['total_unpaid'];
}
// Total number of certified users (both approved and paid)
$totalCertifiedQuery = "SELECT COUNT(*) AS total_certified FROM birth_table WHERE Birth_status = 'approved' AND Payment = 'paid'";
$totalCertifiedResult = mysqli_query($conn, $totalCertifiedQuery);
if ($totalCertifiedResult && mysqli_num_rows($totalCertifiedResult) > 0) {
    $totalCertifiedRow = mysqli_fetch_assoc($totalCertifiedResult);
    $totalCertified = $totalCertifiedRow['total_certified'];
}

// Form submission handling
$message = "";
if (isset($_POST['submit'])) {
    // Handle form submission
    // Your form processing code goes here
    // Example: Insert data into database
    $message = "Form submitted.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manger Page</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
    <!-- Latest compiled and minified CSS -->
   
</head>

<body>
    <h5><center><?= __('Birth Report')?></center></h5>

    <table border="1">
        <tr>
            <th><?= __('Total Number of Births')?></th>
            <td><?php echo $totalBirths; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Approved Registrations')?></th>
            <td><?php echo $totalApproved; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Pending Registrations')?></th>
            <td><?php echo $totalPending; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Paid Registrations')?></th>
            <td><?php echo $totalPaid; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Unpaid Registrations')?></th>
            <td><?php echo $totalUnpaid; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Certified Users')?></th>
            <td><?php echo $totalCertified; ?></td>
        </tr>
    </table>
</body>
</html>
