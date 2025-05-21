<?php
session_start();
$message = ""; // Initialize message variable
// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handling the form submission
if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $feedback_message = $_POST['feedback_message'];
    $feedback_date = date("Y-m-d");
    $f_status = "unread";
    $replay = "0";

    // Inserting the feedback into the database
    $sql = "INSERT INTO comment_table (username, comment_date, comment_message, c_status, replay) 
            VALUES ('$username', '$feedback_date', '$feedback_message', '$f_status', '$replay')";

    if (mysqli_query($conn, $sql)) {
        $message = "Your comment to manager has been submitted successfully.";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
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
    <title>Send comment</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
            margin-bottom: 10px;
        }
        .containert {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(22, 62, 83, 0.47);
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
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="containert">
        <h5><center><?= __('Comment Form')?></center></h5>
        <?php if(isset($message)): ?>
            <div class="success-message"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if(isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username"><?= __('Username')?>:</label>
            <input type="text" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly required>
            <label for="feedback_message"><?= __('Comment Message')?>:</label>
            <textarea name="feedback_message" rows="5" required></textarea>
            <input type="submit" name="submit" value="<?= __('Submit')?>">
            <input type="reset" name="reset" value="<?= __('Reset')?>" class="btn btn-success">
        </form>
    </div>
</body>
</html>
