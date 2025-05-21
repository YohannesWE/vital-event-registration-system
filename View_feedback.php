<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit();
}

// Establishing a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "vital_event";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize delete message
$deleteMessage = "";

if (isset($_POST['delete'])) {
    $feedback_id = $_POST['feedback_id'];
    // Delete the feedback from the database
    $delete_sql = "DELETE FROM feedback_table WHERE f_id = $feedback_id";
    if (mysqli_query($conn, $delete_sql)) {
        // Set delete message
        $deleteMessage = "Feedback deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Retrieving pending feedback from the feedback_table
$sql = "SELECT * FROM feedback_table WHERE replay='0' ORDER BY feedback_date DESC";
$result = mysqli_query($conn, $sql);

// Updating the status of viewed feedback to "Viewed"
$updateSql = "UPDATE feedback_table SET f_status = 'Viewed' WHERE f_status = 'Pending'";
mysqli_query($conn, $updateSql);

// Closing the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>

    <style>
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }

        .no-feedback {
            margin-bottom: 20px;
            padding: 10px;
            background-color:rgba(0, 111, 170, 0.47);
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: #fff;
        }

        .delete-message {
            padding: 10px;
            background-color: #4CAF50;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: #fff;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function confirmDelete(feedback_id) {
            if (confirm("Are you sure you want to delete this feedback?")) {
                document.getElementById('deleteForm' + feedback_id).submit();
            }
        }
    </script>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
</head>
<body>

<?php
// Display delete message if set
if (!empty($deleteMessage)) {
    echo '<div class="delete-message">' . $deleteMessage . '</div>';
}
?>

<h5><center>Applicant Feedbacks</center></h5>
<div class="container-fluid">
    <div class="table-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Feedback ID</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>Feedback</th>
                    <th>Action</th>
                  </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['f_id'] . "</td>";
                echo "<td>" . $row['feedback_date'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['feedback_message'] . "</td>";
                echo '<td>
                        <a href="replay_comment.php?f_id=' . urlencode($row['f_id']) . '" class="btn btn-primary">Reply</a>
                        <button onclick="confirmDelete(' . $row['f_id'] . ')" class="btn btn-danger">Delete</button>
                        <form id="deleteForm' . $row['f_id'] . '" method="post" style="display: none;">
                            <input type="hidden" name="feedback_id" value="' . $row['f_id'] . '">
                            <input type="hidden" name="delete">
                        </form>
                      </td>';
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<script>showAlert();</script>";
            echo "<div class='no-feedback'>No new feedback available.</div>";
        }
        ?>
    </div>
</div>

</body>
</html>
