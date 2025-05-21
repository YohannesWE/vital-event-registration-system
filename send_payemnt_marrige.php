<?php
session_start();

$message = ""; // Initialize message variable

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'Civil_registrar' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user has already made a payment
$username = $_SESSION['username'];

// Check if the user has already made a payment for marriage
$check_payment_query = "SELECT * FROM payemnt WHERE username = '$username' AND event_type = 'marriage '";
$check_payment_result = mysqli_query($conn, $check_payment_query);

// If payment exists, display message
if (mysqli_num_rows($check_payment_result) > 0) {
    $message = "You have already made a payemnt for marriage.";
} else {
    // Fetch the marriage status from the database
    $marriage_status_query = "SELECT Marriage_status FROM marriage_table WHERE username = '$username'";
    $marriage_status_result = mysqli_query($conn, $marriage_status_query);

    // Check if the query was successful
    if ($marriage_status_result) {
        // Check if any rows were returned
        if (mysqli_num_rows($marriage_status_result) > 0) {
            // Fetch the row as an associative array
            $marriage_status_row = mysqli_fetch_assoc($marriage_status_result);

            // Check if the 'Marriage_status' key exists in the fetched row
            if (isset($marriage_status_row['Marriage_status'])) {
                // Retrieve the marriage status
                $marriage_status = $marriage_status_row['Marriage_status'];

                // Proceed based on the marriage status
                if ($marriage_status == 'pending') {
                    $message = "You are not eligible for payemnt because your marriage status is pending.";
                } elseif ($marriage_status == 'approved') {
                    // Handling the form submission
                    if (isset($_POST['submit'])) {
                        $feedback_message = $_POST['feedback_message'];
                        $feedback_date = date("Y-m-d");
                        $f_status = "marriage ";
                        $c_status = "unread";
                        // Validate the URL
                        if (!filter_var($feedback_message, FILTER_VALIDATE_URL)) {
                            $message = "Invalid URL format.";
                        } else {
                            // Inserting the feedback into the database
                            $sql = "INSERT INTO payemnt (username, event_type, payemnt_date, payemnt_link,c_status) 
                                    VALUES ('$username','$f_status', '$feedback_date', '$feedback_message','$c_status')";

                            if (mysqli_query($conn, $sql)) {
                                $message = "Payment successfully sent.";
                            } else {
                                $message = "Error: " . mysqli_error($conn);
                            }
                        }
                    }
                } else {
                    $message = "Invalid marriage status.";
                }
            } else {
                $message = "Marriage status column not found.";
            }
        } else {
            $message = "No marriage application found for the applicant.";
        }
    } else {
        $message = "Error fetching marriage status: " . mysqli_error($conn);
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
    <?php include 'admin_css1_applicant.php'; ?>
    <title>Send Payment</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }


        .containert {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 111, 170, 0);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 111, 170, 0.47);
        }

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

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    </div>
  
     

<div class="containert">
    <h5><center><?= __('Send Payment Form')?></center></h5>

    <?php if (!empty($message)): ?>
        <div class="alert alert-danger45"><?php echo $message; ?></div>
    <?php else: ?>
        <form method="POST" action="">
        <p><?= __('Check payment amounts')?> <a href="payment_info.php">here</a> <?= __('before making payment')?>.</p>
            <label for="username"><?= __('Username')?>:</label>
            <input type="text" name="username"
                   value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly required>

            <label for="feedback_message"><?= __('Payment URL')?>:</label>
            <textarea name="feedback_message" rows="5" required></textarea>
            <center>
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
                <input type="reset" name="reset" value="Reset" class="btn btn-success">
            </center>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
