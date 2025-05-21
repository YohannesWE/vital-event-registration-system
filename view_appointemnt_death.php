<?php
session_start();

if (!isset($_SESSION["k_id_no"])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$k_id_no = $_SESSION["k_id_no"];
$sql = "SELECT * FROM appointment WHERE k_id_no = '$k_id_no'";
$result = mysqli_query($conn, $sql);

// Check for SQL query errors
if (!$result) {
    die("Error executing the query: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL appointment page</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_death.php'; ?>
    <style>
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        
        .message {
            background-color:rgba(144, 188, 211, 0.27);
           
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
                                <th class="tt"><?= __('Kebele Id Number')?></th>
                                <th class="tt"><?= __('Event Type')?></th>
                                <th class="tt"><?= __('Appointment Date')?></th>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td class="td_table"><?php echo $row['A_id']; ?></td>
                                    <td class="td_table"><?php echo $row['k_id_no']; ?></td>
                                    <td class="td_table"><?php echo $row['event_type']; ?></td>
                                    <td class="td_table"><?php echo $row['appointment_date']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>
            <?php else : ?>
                <h5 class="message"><?= __('There are no scheduled appointments for you')?>.</h5>
            <?php endif; ?>
        </center>
    </div>
</body>

</html>
