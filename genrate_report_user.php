<?php
session_start();

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
$totalUsers = $totalApplicants = $totalChildren = $totalAdmins = $totalManagers = $totalRegistrars = 0;

// Total number of users
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM user";
$totalUsersResult = mysqli_query($conn, $totalUsersQuery);
if ($totalUsersResult && mysqli_num_rows($totalUsersResult) > 0) {
    $totalUsersRow = mysqli_fetch_assoc($totalUsersResult);
    $totalUsers = $totalUsersRow['total_users'];
}

// Total number of applicants
$totalApplicantsQuery = "SELECT COUNT(*) AS total_applicants FROM user WHERE usertype = 'applicant'";
$totalApplicantsResult = mysqli_query($conn, $totalApplicantsQuery);
if ($totalApplicantsResult && mysqli_num_rows($totalApplicantsResult) > 0) {
    $totalApplicantsRow = mysqli_fetch_assoc($totalApplicantsResult);
    $totalApplicants = $totalApplicantsRow['total_applicants'];
}

// Total number of children
$totalChildrenQuery = "SELECT COUNT(*) AS total_children FROM user WHERE usertype = 'child'";
$totalChildrenResult = mysqli_query($conn, $totalChildrenQuery);
if ($totalChildrenResult && mysqli_num_rows($totalChildrenResult) > 0) {
    $totalChildrenRow = mysqli_fetch_assoc($totalChildrenResult);
    $totalChildren = $totalChildrenRow['total_children'];
}

// Total number of admins
$totalAdminsQuery = "SELECT COUNT(*) AS total_admins FROM user WHERE usertype = 'admin'";
$totalAdminsResult = mysqli_query($conn, $totalAdminsQuery);
if ($totalAdminsResult && mysqli_num_rows($totalAdminsResult) > 0) {
    $totalAdminsRow = mysqli_fetch_assoc($totalAdminsResult);
    $totalAdmins = $totalAdminsRow['total_admins'];
}

// Total number of managers
$totalManagersQuery = "SELECT COUNT(*) AS total_managers FROM user WHERE usertype = 'manager'";
$totalManagersResult = mysqli_query($conn, $totalManagersQuery);
if ($totalManagersResult && mysqli_num_rows($totalManagersResult) > 0) {
    $totalManagersRow = mysqli_fetch_assoc($totalManagersResult);
    $totalManagers = $totalManagersRow['total_managers'];
}

// Total number of civil registrars
$totalRegistrarsQuery = "SELECT COUNT(*) AS total_registrars FROM user WHERE usertype = 'Civil_registrar'";
$totalRegistrarsResult = mysqli_query($conn, $totalRegistrarsQuery);
if ($totalRegistrarsResult && mysqli_num_rows($totalRegistrarsResult) > 0) {
    $totalRegistrarsRow = mysqli_fetch_assoc($totalRegistrarsResult);
    $totalRegistrars = $totalRegistrarsRow['total_registrars'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Report</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
 
</head>
<body>
<h5><center><?= __('User Report')?></center></h5>
    <table border="1">
        <tr>
            <th><?= __('Total Number of Users')?></th>
            <td><?php echo $totalUsers; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Applicants')?></th>
            <td><?php echo $totalApplicants; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Children')?></th>
            <td><?php echo $totalChildren; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Admins')?></th>
            <td><?php echo $totalAdmins; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Managers')?></th>
            <td><?php echo $totalManagers; ?></td>
        </tr>
        <tr>
            <th><?= __('Total Number of Civil Registrars')?></th>
            <td><?php echo $totalRegistrars; ?></td>
        </tr>
    </table>

</body>
</html>
