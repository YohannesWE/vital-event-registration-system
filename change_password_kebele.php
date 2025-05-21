
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
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
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Retrieve the user's current password from the user table
    $query = "SELECT password FROM user WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);

        // Verify the old password
        if ($old_password === $row['password']) {
            // Check if the new password and confirm password match
            if ($new_password === $confirm_password) {
                // Update the password in the user table
                $sql = "UPDATE user SET password = '$new_password' WHERE username = '$username'";

                if (mysqli_query($conn, $sql)) {
                    $message = 'Password changed successfully';
                } else {
                    $message = 'Error: ' . mysqli_error($conn);
                }
            } else {
                $message = 'New password and confirm password do not match';
            }
        } else {
            $message = 'Incorrect old password';
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
    <title>Change Password</title>
    <?php include 'admin_css.php'; ?>
    <style>
      
      body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
 
        .containert {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color:rgba(0, 111, 170, 0.47);
            font-weight: bold;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color:rgba(0, 111, 170, 0.47);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color:rgba(0, 111, 170, 0.27);
        }
    </style>
</head>
<body>

    <?php if (isset($message)) : ?>
        <div style="text-align: center; color: red;"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="containert">
        <h5><center>Change Password</center></h5>
        <form method="POST" action="">
            <div>
                <label for="old_password">Old Password:</label>
                <input type="password" name="old_password" required>
            </div>
            <div>
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" title="Password must contain at least one letter, one number, and be at least 6 characters long" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" title="Password must contain at least one letter, one number, and be at least 6 characters long" required><br>
            </div><br>
            <input type="submit" name="submit" value="Change Password">
        </form>
    </div>

</body>
</html>
