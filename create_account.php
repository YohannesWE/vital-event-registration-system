

<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant') {
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signup'])) {
    $fullName = $_POST['full_name'];
    $middlename = $_POST['m_name'];
    $lastname = $_POST['l_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $states = "approved";
    $upgradestatus = "upgrade";
    $dstates = "undeath";
    $usertype = $_POST["User_Type"];
   
    
    // Check if the username already exists
    $checkQuery = "SELECT * FROM user WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Username already exists
        $message = "Username already exists. Please choose a different username.";
    } else {
        // Username doesn't exist, proceed with inserting the data into the database
        // Prepare the SQL statement
        $sql = "INSERT INTO user (full_name,middle_name,last_name, username, email, usertype, phone, password, states,death_status,upgrade_status) VALUES ('$fullName', '$middlename','$lastname','$username', '$email', '$usertype', '$phone', '$password', '$states','$dstates','$upgradestatus')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message = "The account has been successfully created.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
  
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_admin.php'; ?>
    <style>
             body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }

        .admission_form {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
         width: 800px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            height: 40px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

     
    </style>
   
</head>
<body>
<div class="container">
    <div class="admission_form">
        <h5><center><?= __('Create Account')?></center></h5>
        <script>
    // Function to show message after h2 and redirect after 4 seconds
    function showMessageAndRedirect(message) {
        var messageDiv = document.createElement('div');
        messageDiv.innerHTML = '<p style="background-color: #4CAF50; color: white; padding: 10px; text-align: center;">' + message + '</p>';
        var form = document.querySelector('.admission_form');
        form.insertBefore(messageDiv, form.querySelector('h2').nextSibling); // Insert after h2
        setTimeout(function() {
            messageDiv.remove();
            window.location.href = 'create_account.php'; // Change this to your desired redirection URL
        }, 4000);
    }

    <?php if(isset($message)) { ?>
        // Call the function to show message if PHP variable $message is set
        showMessageAndRedirect("<?php echo $message; ?>");
    <?php } ?>
</script>

        <form method="POST" autocomplete="off" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label"><?= __('First Name')?></label>
                <input type="text" name="full_name" class="form-control" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
            </div>
            <div class="form-group">
                <label class="form-label"><?= __('Middle Name')?></label>
                <input type="text" name="m_name" class="form-control" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
            </div>
            <div class="form-group">
                <label class="form-label"><?= __('Last Name')?></label>
                <input type="text" name="l_name" class="form-control" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required >
            </div>
            <div class="form-group">
                <label class="form-label"><?= __('Username')?></label>
                <input type="text" name="username" class="form-control" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
            </div>
            <div class="form-group">
                <label class="form-label"><?= __('Email')?></label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="phone"><?= __('Phone number')?></label>
            <input type="tel" name="phone" pattern="^\+251\d{9}$" title="Please enter a valid phone start with +251 followed by 9 number only" required>
            </div>
            <div class="form-group">
    <label class="form-label"><?= __('Gender')?></label>
    <select name="sex" class="form-control" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="male"><?= __('Male')?></option>
        <option value="female"><?= __('Female')?></option>
      
    </select>
</div>

            <div class="form-group">
                <label class="form-label"><?= __('User Type')?></label>
                <select name="User_Type" class="form-control" required>
                    <option value="">Select User Type</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="Civil_registrar">Civil registrar</option>
                    
                </select>
            </div>
            <div class="form-group">
                <label class="form-label"><?= __('Password')?></label>
                <input type="password" name="password" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" title="Password must contain at least one letter, one number, and be at least 6 characters long" class="form-control" required>
            </div>
            <div class="button-container">
                <input type="submit" name="signup" value="<?= __('Create Account')?>" class="btn btn-primary">
              
            </div>
        </form>
    </div>
</div>
</body>
</html>
