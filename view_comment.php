<?php
session_start();

// Check if the user is not logged in or not a manager
if (!isset($_SESSION["username"]) || $_SESSION['usertype'] !== 'manager') {
    header("Location: login.php");
    exit();
}

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieving pending comments from the comment_table
$sql = "SELECT * FROM comment_table WHERE replay='0' ORDER BY comment_date DESC";
$result = mysqli_query($conn, $sql);

// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count FROM comment_table WHERE replay='0' AND c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count = $unread_row['unread_count'];
} else {
    $unread_count = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count'] = $unread_count;
// Mark comments as read when the manager views them
$update_status_sql = "UPDATE comment_table SET c_status='read' WHERE replay='0' AND c_status='unread'";
mysqli_query($conn, $update_status_sql);

// Closing the database connection

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Comment Page</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
    <style>
        .no-comments {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #4CAF50;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="table-container">
        <div class="container">
            <h5><center>Civil Registrar Comments</center></h5>
            <!-- Display unread notification count -->
            <div>Unseen Comments: <?php echo $unread_count; ?></div>
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <table>
                    <tr>
                        <th>Comment ID</th>
                        <th>Date</th>
                        <th>Username</th>
                        <th>Comment Message</th>
                        <th>Reply</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['c_id']; ?></td>
                            <td><?php echo $row['comment_date']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['comment_message']; ?></td>
                            <td><a href="replay_comment1.php?c_id=<?php echo $row['c_id']; ?>" class="btn btn-primary">Reply</a></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else : ?>
                <div class='no-comments'>No new comments available.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
