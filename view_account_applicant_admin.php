<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant') {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the SQL query with conditions for both child and applicant usertypes
$sql = "SELECT * FROM user WHERE usertype IN ('child', 'applicant')";

// Check if search form is submitted and search term is set
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    // Modify SQL query to search for users by k_id_no and apply search term filtering
    $sql .= " AND username LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applicant</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_admin.php'; ?>
    <style>

        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
 
        /* Container styles */
        .containert {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color:rgb(0, 110, 185);
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Button styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color:rgb(0, 110, 185);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color:rgba(0, 111, 185, 0.33);
        }
        .serach{
            align-items :right;
        }
    </style>
</head>
<body>

<div class="containert">
<div class="container-fluid">
    <div class="table-container">
    <h5><center><?= __('Applicant List')?></center></h5>
    <div clas="serach">
    <form method="POST" action="">
      
        <input type="text" id="search" name="search" placeholder="Enter username...">
        <button type="submit" class="btn"><?= __('Search')?></button>
        <?php if (isset($_POST['search']) && !empty($_POST['search'])): ?>
        <a href="view_account_applicant_admin.php" class="btn"><?= __('Show All Applicants')?></a>
    <?php endif; ?>
    </form>
    </div>
    <table>
    <thead>
        <tr>
            <th><?= __('Username')?>ID</th>
            <th><?= __('Name')?></th>
            <th><?= __('Username')?></th>
            <th><?= __('Email')?></th>
            <th><?= __('Phone')?></th>
            <th><?= __('Account Status')?></th>
            <th><?= __('Vital Event Info')?></th>
        </tr>
    </thead>
    <tbody>
        <?php while ($info = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $info['id']; ?></td>
                <td class="td_tale"><?php echo "{$info['full_name']} {$info['middle_name']} {$info['last_name']}"; ?></td>
                <td><?php echo $info['username']; ?></td>
                <td><?php echo $info['email']; ?></td>
                <td><?php echo $info['phone']; ?></td>
                <td><?php echo $info['states']; ?></td>
                <td>
                <a class="btn btn-primary" href="view_vital_event_info_admin.php?user_id=<?php echo $info['username']; ?>"><?= __('view')?></a>

                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</div>
            </div></div>
</body>
</html>
