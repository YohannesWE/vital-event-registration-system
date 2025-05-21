<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
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

// Initialize message variables
$message = '';

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
    <?php include 'scroll_css.php'; ?>
    <?php include 'children_page.php'; ?>
    <style>
       body{
    background-color: #f6e9ff;
    overflow-y: scroll; /* Always show vertical scrollbar */
  }

        h2 {
            text-align: center;
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
            background-color: #5d5cde;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #4948ac;
        }
        *{
        margin: 0;
        padding: 0;
    }
    .containert {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }  
          #message {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="containert">
        <!-- Display message here -->
    
        
        <h2>Change Password</h2>
        <?php if (!empty($message)): ?>
    <div id="errorMessage" class="alert"><?php echo $message; ?></div>
<?php endif; ?>
<script>
    setTimeout(function() {
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
            window.location.href = "change_password_child.php";
        }
    }, 4000);
</script>
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
