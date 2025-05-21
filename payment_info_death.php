<?php
session_start();
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve payment information
$sql = "SELECT * FROM payment_info";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Information</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_death.php'; ?>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= __('Vital Event Payment Information')?></h2>
        <p><?= __('Welcome to our vital event')?>.</p>

        <h2><?= __('Our Account: CBE 1000096883084')?></h2>
        <p><?= __('Please use the account')?>.</p>
        <table>
            <thead>
                <tr>
                    <th><?= __('Event Type')?> </th>
                    <th><?= __('Payment Amount')?></th>
                    <td>100 Birr</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['event_type']; ?> <?= __('Registration')?>  </td>   
                    <td><?php echo $row['amount']; ?> <?= __('Birr')?> </td>
                    <td>100 </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <h6><?= __('After making the payment, please send us the payment confirmation through our system using the provided payment link')?>.</h6>
    </div>
</body>
</html>