
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




//

// Report generation
$totalMarriages = $totalPending = $totalApproved = $totalPaid = $totalUnpaid = $totalCertified = 0;

// Total number of marriages
$totalMarriagesQuery = "SELECT COUNT(*) AS total_marriages FROM marriage_table";
$totalMarriagesResult = mysqli_query($conn, $totalMarriagesQuery);
if ($totalMarriagesResult && mysqli_num_rows($totalMarriagesResult) > 0) {
    $totalMarriagesRow = mysqli_fetch_assoc($totalMarriagesResult);
    $totalMarriages = $totalMarriagesRow['total_marriages'];
}

// Total number of pending marriages
$totalPendingQuery = "SELECT COUNT(*) AS total_pending FROM marriage_table WHERE Marriage_status = 'pending'";
$totalPendingResult = mysqli_query($conn, $totalPendingQuery);
if ($totalPendingResult && mysqli_num_rows($totalPendingResult) > 0) {
    $totalPendingRow = mysqli_fetch_assoc($totalPendingResult);
    $totalPending = $totalPendingRow['total_pending'];
}

// Total number of approved marriages
$totalApprovedQuery = "SELECT COUNT(*) AS total_approved FROM marriage_table WHERE Marriage_status = 'approved'";
$totalApprovedResult = mysqli_query($conn, $totalApprovedQuery);
if ($totalApprovedResult && mysqli_num_rows($totalApprovedResult) > 0) {
    $totalApprovedRow = mysqli_fetch_assoc($totalApprovedResult);
    $totalApproved = $totalApprovedRow['total_approved'];
}

// Total number of paid marriages
$totalPaidQuery = "SELECT COUNT(*) AS total_paid FROM marriage_table WHERE Payemnt = 'paid'";
$totalPaidResult = mysqli_query($conn, $totalPaidQuery);
if ($totalPaidResult && mysqli_num_rows($totalPaidResult) > 0) {
    $totalPaidRow = mysqli_fetch_assoc($totalPaidResult);
    $totalPaid = $totalPaidRow['total_paid'];
}

// Total number of unpaid marriages
$totalUnpaidQuery = "SELECT COUNT(*) AS total_unpaid FROM marriage_table WHERE Payemnt = 'unpaid'";
$totalUnpaidResult = mysqli_query($conn, $totalUnpaidQuery);
if ($totalUnpaidResult && mysqli_num_rows($totalUnpaidResult) > 0) {
    $totalUnpaidRow = mysqli_fetch_assoc($totalUnpaidResult);
    $totalUnpaid = $totalUnpaidRow['total_unpaid'];
}

// Total number of certified marriages (both approved and paid)
$totalCertifiedQuery = "SELECT COUNT(*) AS total_certified FROM marriage_table WHERE Marriage_status = 'approved' AND Payemnt = 'paid'";
$totalCertifiedResult = mysqli_query($conn, $totalCertifiedQuery);
if ($totalCertifiedResult && mysqli_num_rows($totalCertifiedResult) > 0) {
    $totalCertifiedRow = mysqli_fetch_assoc($totalCertifiedResult);
    $totalCertified = $totalCertifiedRow['total_certified'];
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
     <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
    </style>
</head>



<body>

<h5><center><?= __('Marriage Registration')?></center></h5>
    
  
    <table border="1">
        <tr>
            <th><?= __('Total Number of Marriages')?></th>
            <td><?php echo $totalMarriages; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Pending Marriages')?></th>
            <td><?php echo $totalPending; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Approved Marriages')?></th>
            <td><?php echo $totalApproved; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Paid Marriages')?></th>
            <td><?php echo $totalPaid; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Unpaid Marriages')?></th>
            <td><?php echo $totalUnpaid; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Certified Marriages')?></th>
            <td><?php echo $totalCertified; ?></td>
        </tr>
    </table>
</body>
</html>


