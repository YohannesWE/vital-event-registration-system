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

// Initialize the SQL query with conditions for both child and applicant usertypes
$sql = "SELECT * FROM marriage_table WHERE Marriage_status = 'approved' and Payemnt ='paid'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>make appointment</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
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
        .message {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        /* Button styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color:rgba(0, 111, 170, 0.18);
        }
        .search {
            align: right;
        }
    </style>
</head>
<body>
<h5><center><?= __('Appointment List')?></center></h5>
<div class="containert">
    <div class="container-fluid">
        <div class="table-container">
        
            <div class="search">
              
            </div>
          

            <table>
                <?php
                // Check if the message parameter is set in the URL
                if (isset($_GET['message'])) {
                    // Display the message
                    echo "<p style='padding: 10px 15px; margin-bottom: 15px; border-radius: 5px; background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6;'>" . htmlspecialchars($_GET['message']) . "</p>";

                }
                ?>
                <thead>
                <tr>
                    <th><?= __('Marriage ID')?></th>
                    <th><?= __('Username')?></th>
                    <th><?= __("Husband's Name")?></th>
                    <th><?= __("Wife's Name")?></th>
                    <th><?= __('Account Status')?></th>
                    <th><?= __('Action')?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($result) == 0): ?>
                    <tr>
                        <td colspan="6"><?= __('No Ready unscheduled  marriage certificate found')?>.</td>
                    </tr>
                <?php else: ?>
                    <?php while ($info = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $info['m_id']; ?></td>
                            <td><?php echo $info['username']; ?></td>
                            <td class="td_tale"><?php echo "{$info['Hasband_fname']} {$info['Hasband_mname']} {$info['Hasband_lname']}"; ?></td>
                            <td class="td_tale"><?php echo "{$info['Wife_fname']} {$info['Wife_mname']} {$info['Wife_lname']}"; ?></td>
                            <td><?php echo $info['Marriage_status']; ?></td>
                            <td>
                            <a href="make_appointemnt_marriage.php?username=<?php echo $info['username']; ?>" style="display: inline-block; padding: 10px 20px; background-color: green; color: white; text-decoration: none; border-radius: 5px;"><?= __('Make Appointment')?></a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
