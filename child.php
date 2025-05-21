<?php
error_reporting(E_ALL);
session_start();

$message = ""; // Initialize message variable
$messageType = ""; // Initialize message type variable

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];
$k_id_no = $_SESSION['k_id'];
$sql = "SELECT email, k_id FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

$email = ""; // Initialize email variable
$k_id_no= ""; // Initialize father's photo variable

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $k_id_no = $row['k_id']; // Get father's photo
}

if (isset($_POST['signup'])) {
  
    $fullName = $_POST['full_name'];
    $middle_name = $_POST['m_name'];
    $last_name = $_POST['l_name'];
    $username = $_POST['username'];
    
    $password = $_POST['password'];
    $email = $_POST['email'];
    $religion = "religion";
    $states = "pending";
    $dstates = "undeath";
    $upgradestatus = "not_upgrade";
    $usertype = "child";
    $file = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $dst = "./child/" . $file;
    $dst_db = "child/" . $file;

    // Check if the uploaded file is a PDF
    if ($fileType !== 'application/pdf') {
        $message = "Please select a PDF file for the Birth Paper.";
        $messageType = "error";
    } else {
        move_uploaded_file($_FILES['image']['tmp_name'], $dst);

        // Check if the username already exists
        $checkQuery = "SELECT * FROM user WHERE username = '$username'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Username already exists
            $message = "Username already exists. Please choose a different username.";
            $messageType = "error";
        } else {
            // Username doesn't exist, proceed with inserting the data into the database
            // Prepare the SQL statement
            $sql = "INSERT INTO user(full_name, middle_name, last_name, username, email, usertype, religion, password, k_id_no, k_id, states, death_status, upgrade_status) VALUES ('$fullName','$middle_name','$last_name', '$username','$email ', '$usertype','$religion','$password', '$k_id_no' ,'$dst_db', '$states','$dstates','$upgradestatus')";
            if (mysqli_query($conn, $sql)) {
                $message = "Your request has been successfully submitted.";
                $messageType = "success";
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
                $messageType = "error";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Signup</title>
    <?php include 'admin_css1_applicant.php'; ?>

    <style>
           body {
            background-color:rgba(0, 111, 170, 0.47);
        
        }
     
        .containert {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
            text-align:left;
            padding: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="religion"],
        input[type="password"],
        input[type="file"] {
            width: calc(100% - 16px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 16px;
        }

     

        input[type="submit"]
         {
            width: 100%;
            background-color:rgb(0, 110, 185);
            border: none;
            color: #fff;
            padding: 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover
        :hover {
            background-color:rgb(0, 110, 185);
        }
  
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color:rgba(0, 111, 170, 0.47);
            color: #721c24;
            border-color:rgba(0, 111, 170, 0.47);
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            background-color:rgba(0, 111, 170, 0.47);
            color: #721c24;
            border-color:rgb(0, 110, 185);
        }

        .message.error {
            background-color:rgba(0, 111, 170, 0.47);
            color: #721c24;
            border-color:rgb(0, 110, 185);
            background-color:rgba(0, 111, 170, 0.47);
            color: #721c24;
            border-color:rgb(0, 110, 185);
        }

    </style>
</head>
<body>

<div class="containert">
  <center>  <?php if ($message != ""): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <center> 
    <h5><?= __('children  Signup')?></h5>
    <p><marquee><strong><?= __('Here you')?></strong></marquee></p>
   
    <form method="POST" autocomplete="off" enctype="multipart/form-data">
        <div>
            <label><?= __('Child Name')?></label>
            <input type="text" name="full_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" required>
        </div>
        <div>
            <label><?= __('Child Father name')?></label>
            <input type="text" name="m_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" required>
        </div>
        <div>
            <label><?= __('Child Grandfather name')?></label>
            <input type="text" name="l_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" required>
        </div>
        <div>
            <label><?= __('Child Username')?></label>
            <input type="text" name="username"  required>
        </div>
        <div>
            <label><?= __('Email')?></label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>
        <div>
            <label><?= __('Password')?></label>
            <input type="password" name="password" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" title="Password must contain at least one letter, one number, and be at least 6 characters long" required>
        </div>
        <div>
            <label><?= __('Childd')?></label>
            <input type="file" name="image"  id="image" accept=".pdf" required>
            <div id="errorMessage" style="color: red;"></div> <!-- Container for error message -->
        </div>
        <script>
    // Function to check the size of the uploaded file
    function checkFileSize() {
        var fileInput = document.getElementById('image');
        if (fileInput.files[0]) {
            var fileSize = fileInput.files[0].size; // Size in bytes
            var maxSizeInBytes = 1024 * 1024; // 1MB

            if (fileSize > maxSizeInBytes) {
                // Display error message
                document.getElementById('errorMessage').innerText = 'File size exceeds the limit. Please upload a file smaller than 1MB.';
                // Clear the file input to prevent submission
                fileInput.value = '';
            } else {
                // Clear error message if file size is within limit
                document.getElementById('errorMessage').innerText = '';
            }
        }
    }

    // Add event listener to the file input to check the file size on change
    document.getElementById('image').addEventListener('change', checkFileSize);
</script>
        <div class="button-container">
            <input type="submit" name="signup" value="<?= __('sign up')?>">
        </div>
    </form>
</div>

</body>
</html>
