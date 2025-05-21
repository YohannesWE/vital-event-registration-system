<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'manger' || $_SESSION['usertype'] == 'kebele employee' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = ""; // Initialize an empty message variable

// Handling the form submission
if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $feedback_message = $_POST['feedback_message'];
    $feedback_date = date("Y-m-d");
    $f_status = "Pending";
    $replay="0";
    // Inserting the feedback into the database
    $sql = "INSERT INTO feedback_table (username, feedback_date, feedback_message, f_status,replay) 
            VALUES ('$username', '$feedback_date', '$feedback_message', '$f_status','$replay')";

    if (mysqli_query($conn, $sql)) {
        $message = "Feedback submitted successfully.";
    } else {
        $message = "Error: " . mysqli_error($conn);
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
    <title>Send Feedback</title>
    <style>
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        .containert {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 111, 170, 0.54);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
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
        .message {
            text-align: center;
            margin-top: 10px;
            padding: 5px;
            background-color: #dff0d8; /* Green background */
            border: 1px solid #3c763d; /* Green border */
            color: #3c763d; /* Green text */
            border-radius: 5px;
        }
    </style>
    <script>
        // Function to remove the message after 4 seconds
        setTimeout(function() {
            var messageElement = document.querySelector('.message');
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }, 4000);
    </script>
</head>
<body>

    <div class="containert">
        <h5><center><?= __('Feedback Form')?></center></h5>
        <!-- Display the message here -->
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username"><?= __('Username')?>:</label>
            <input type="text" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly required>
            <label for="feedback_message"><?= __('Feedback Message')?>:</label>
            <textarea name="feedback_message" rows="5" required></textarea><br><br><br>
           <center> <input type="submit" name="submit" value="<?= __('Submit')?>">
         </center>
        </form>
    </div>
</body>
</html>
