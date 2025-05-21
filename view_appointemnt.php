<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION["username"];
$sql = "SELECT * FROM appointment WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL appointment page</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css1_applicant.php'; ?>
    <style>
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        
        .message {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            max-width: 500px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <center>
            <h5><center><?= __('My Appointment')?></center></h5>
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <div class="container-fluid">
                    <div class="table-container">
                        <table border="1px">
                            <tr>
                                <th class="tt"><?= __('Appointment ID')?></th>
                                <th class="tt"><?= __('Username')?></th>
                                <th class="tt"><?= __('Event Type')?></th>
                                <th class="tt"><?= __('Appointment Date')?></th>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td class="td_table"><?php echo $row['A_id']; ?></td>
                                    <td class="td_table"><?php echo $row['username']; ?></td>
                                    <td class="td_table"><?php echo $row['event_type']; ?></td>
                                    <td class="td_table"><?php echo $row['appointment_date']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php else : ?>
                <p class="message"><?= __('There are no scheduled appointments for you') ?>.</p>            <?php endif; ?>
        </center>
    </div>
</body>

</html>
