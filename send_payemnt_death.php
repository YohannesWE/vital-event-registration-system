<?php
session_start();

$message = ""; // Initialize message variable

// Check if the user is not logged in
if (!isset($_SESSION["k_id_no"])) {
    header("Location: exit.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user has the death status column
$k_id_no = $_SESSION['k_id_no'];
$check_status_column_sql = "SHOW COLUMNS FROM death_table LIKE 'Death_states'";
$status_column_result = mysqli_query($conn, $check_status_column_sql);

if (!$status_column_result) {
    $message = "Error checking eligibility: " . mysqli_error($conn);
} else {
    $status_column = mysqli_fetch_assoc($status_column_result);
    if (!$status_column) {
        $message = "You are not eligible for payment because death status column not found.";
    } else {
        // Check if the user has the approved death status
        $check_status_sql = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no' AND Death_states = 'approved'";
        $status_result = mysqli_query($conn, $check_status_sql);

        if (!$status_result) {
            $message = "Error checking death status: " . mysqli_error($conn);
        } elseif (mysqli_num_rows($status_result) == 0) {
            $message = "You are not eligible for payment because death status is not approved.";
        } else {
            // Check if the user has already made a payment
            $check_sql = "SELECT * FROM payemnt WHERE k_id_no = '$k_id_no' AND event_type = 'death'";
            $check_result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                $message = "You have already made a payment for death.";
            } else {
                // Handling the form submission only if the user hasn't made a payment
                if (isset($_POST['submit'])) {
                    $feedback_message = $_POST['feedback_message'];
                    $feedback_date = date("Y-m-d");
                    $f_status = "death";
                    $c_status = "unread";
                    
                    // Validate the payment URL
                    if (!filter_var($feedback_message, FILTER_VALIDATE_URL)) {
                        $message = "Invalid payment URL format.";
                    } else {
                        // Inserting the payment into the database
                        $sql = "INSERT INTO payemnt (username, k_id_no, event_type, payemnt_date, payemnt_link, c_status) 
                                VALUES ('unknown', '$k_id_no', '$f_status', '$feedback_date', '$feedback_message', '$c_status')";

                        if (mysqli_query($conn, $sql)) {
                            $message = "Payment successfully sent.";
                        } else {
                            $message = "Error: " . mysqli_error($conn);
                        }
                    }
                }
            }
        }
    }
}

// Closing the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Payment for Death</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_death.php'; ?>

    <style>
     




h2 {
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

textarea {
    resize: vertical;
    height: 100px;
}

input[type="submit"],
input[type="reset"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
    
</head>
<body>
<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="send_payemnt_death.php?lang=am_ET">አማ</a>
        <a href="send_payemnt_death.php?lang=en_US">En</a>
        <a href="send_payemnt_death.php?lang=or_ET">AO</a>
    </div>
    </div>
<div class="container">
    <h5><?= __('Send Payment Form')?></h5>
  <center>  <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php else: ?></center>
        <form method="POST" action="">
        <p><?= __('Check payment amounts')?> <a href="payment_info_death.php">here </a> <?= __('before making payment')?>.</p>
            <label for="k_id_no"><?= __('Kebele Id Number/fayeda')?>:</label>
            <input type="text" name="k_id_no" value="<?php echo isset($_SESSION['k_id_no']) ? $_SESSION['k_id_no'] : ''; ?>" readonly required>

            <label for="feedback_message"><?= __('Payment URL')?>:</label>
            <textarea name="feedback_message" rows="5" required></textarea><br><br>
            <center>
                <input type="submit" name="submit" value="<?= __('Submit')?>" class="btn btn-success">
                <input type="reset" name="reset" value="<?= __('Reset')?>" class="btn btn-success">
            </center>
        </form>
    <?php endif; ?>
</div>

</body>
</html>







