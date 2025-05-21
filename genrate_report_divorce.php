
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


// Report generation
$totalDivorces = $totalPending = $totalApproved = $totalPaid = $totalUnpaid = $totalCertified = 0;

// Total number of divorces
$totalDivorcesQuery = "SELECT COUNT(*) AS total_divorces FROM divorce_table";
$totalDivorcesResult = mysqli_query($conn, $totalDivorcesQuery);
if ($totalDivorcesResult && mysqli_num_rows($totalDivorcesResult) > 0) {
    $totalDivorcesRow = mysqli_fetch_assoc($totalDivorcesResult);
    $totalDivorces = $totalDivorcesRow['total_divorces'];
}

// Total number of pending divorces
$totalPendingQuery = "SELECT COUNT(*) AS total_pending FROM divorce_table WHERE Divorce_states = 'pending'";
$totalPendingResult = mysqli_query($conn, $totalPendingQuery);
if ($totalPendingResult && mysqli_num_rows($totalPendingResult) > 0) {
    $totalPendingRow = mysqli_fetch_assoc($totalPendingResult);
    $totalPending = $totalPendingRow['total_pending'];
}

// Total number of approved divorces
$totalApprovedQuery = "SELECT COUNT(*) AS total_approved FROM divorce_table WHERE Divorce_states = 'approved'";
$totalApprovedResult = mysqli_query($conn, $totalApprovedQuery);
if ($totalApprovedResult && mysqli_num_rows($totalApprovedResult) > 0) {
    $totalApprovedRow = mysqli_fetch_assoc($totalApprovedResult);
    $totalApproved = $totalApprovedRow['total_approved'];
}

// Total number of paid divorces
$totalPaidQuery = "SELECT COUNT(*) AS total_paid FROM divorce_table WHERE Payment = 'paid'";
$totalPaidResult = mysqli_query($conn, $totalPaidQuery);
if ($totalPaidResult && mysqli_num_rows($totalPaidResult) > 0) {
    $totalPaidRow = mysqli_fetch_assoc($totalPaidResult);
    $totalPaid = $totalPaidRow['total_paid'];
}

// Total number of unpaid divorces
$totalUnpaidQuery = "SELECT COUNT(*) AS total_unpaid FROM divorce_table WHERE Payment = 'unpaid'";
$totalUnpaidResult = mysqli_query($conn, $totalUnpaidQuery);
if ($totalUnpaidResult && mysqli_num_rows($totalUnpaidResult) > 0) {
    $totalUnpaidRow = mysqli_fetch_assoc($totalUnpaidResult);
    $totalUnpaid = $totalUnpaidRow['total_unpaid'];
}

// Total number of certified divorces (both approved and paid)
$totalCertifiedQuery = "SELECT COUNT(*) AS total_certified FROM divorce_table WHERE Divorce_states = 'approved' AND Payment = 'paid'";
$totalCertifiedResult = mysqli_query($conn, $totalCertifiedQuery);
if ($totalCertifiedResult && mysqli_num_rows($totalCertifiedResult) > 0) {
    $totalCertifiedRow = mysqli_fetch_assoc($totalCertifiedResult);
    $totalCertified = $totalCertifiedRow['total_certified'];
}



//
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
<h5><center><?= __('Divorce Report')?></center></h5>
    <table border="1">
        <tr>
            <th><?= __('Total Number of Divorces')?></th>
            <td><?php echo $totalDivorces; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Pending Divorces')?></th>
            <td><?php echo $totalPending; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Approved Divorces')?></th>
            <td><?php echo $totalApproved; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Paid Divorces')?></th>
            <td><?php echo $totalPaid; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Unpaid Divorces')?></th>
            <td><?php echo $totalUnpaid; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Certified Divorces')?></th>
            <td><?php echo $totalCertified; ?></td>
        </tr>
    </table>
    
</body>
</html>


