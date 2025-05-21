<?php  	include_once 'languge.php'; ?>
<?php
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = ""; // Initialize message variable

if (isset($_POST['signup'])) {
    // Retrieve form data
    $fullName = $_POST['f_name'];
    $middlename = $_POST['m_name'];
    $lastname = $_POST['l_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $religion = $_POST['religion'];
    $sex=$_POST['sex'];
    $kebele_Id_Number = $_POST['kebele_Id_Number'];
    $states = "pending";
    $death_status = "undeath";
    $usertype = "applicant";
    $upgradestatus = "upgrade";
    $file = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;
    $f_status = "unread";
    // Check if the uploaded file is a PDF
    if ($fileType !== 'application/pdf') {
        $message = "Please select a PDF file for the Kebele ID.";
    } else {
        // Check if the username already exists
        $checkQuery = "SELECT * FROM user WHERE username = '$username'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Username already exists
            $message = "Username already exists. Please choose a different username.";
        } else {
            // Check if the kebele ID number already exists
            $checkKebeleQuery = "SELECT * FROM user WHERE k_id_no = '$kebele_Id_Number'";
            $checkKebeleResult = mysqli_query($conn, $checkKebeleQuery);

            if (mysqli_num_rows($checkKebeleResult) > 0) {
                // Kebele ID number already exists
                $message = "Applicant with the provided Kebele ID number is already registered.";
            } else {
                // Kebele ID number doesn't exist, proceed with inserting the data into the database
                // Move the uploaded file to the destination folder
                move_uploaded_file($_FILES['image']['tmp_name'], $dst);

                // Prepare the SQL statement for insertion
                $sql = "INSERT INTO user (full_name, middle_name, last_name, username, email, usertype, phone, religion,sex ,password, k_id_no, k_id, states, death_status,upgrade_status,c_status) VALUES ('$fullName', '$middlename', '$lastname', '$username', '$email', '$usertype', '$phone', '$religion',' $sex','$password', '$kebele_Id_Number', '$dst_db', '$states', '$death_status','$upgradestatus','$f_status')";

                // Execute the SQL statement
                $result = mysqli_query($conn, $sql);

                // Check if the insertion was successful
                if ($result) {
                    $message = "Your request has been successfully submitted.";
                } else {
                    // Error in insertion
                    $message = "Error: " . mysqli_error($conn);
                }
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
    <title>Applicant Signup</title>

    <?php
    include 'scroll_css.php';
    ?>
    <?php
    include 'head_login or.php';
    ?>
    <style>
        /* General styling */
        body {
            background-color:rgb(0, 111, 170, 0.19);
        
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        label {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }
        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        input[type="file"],
        select {
            width: calc(100% - 16px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
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
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        /* Responsive styling */
        @media (max-width: 600px) {
            .container {
                padding: 10px;
                border-radius: 0;
            }
            h1 {
                font-size: 20px;
                margin-bottom: 20px;
            }
        }
        .message {
    color: #721c24; /* Error message text color */
    background-color: #f8d7da; /* Error message background color */
    border: 1px solid #f5c6cb; /* Error message border color */
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}
    </style>
    <style>
    /* Style the label container */
    label {
  display: inline-block;
  margin-right: 20px; /* Add some right margin for spacing between radio buttons */
}

/* Style the radio button */
input[type="radio"] {
  margin-right: 5px;
}
</style>
</head>
<body>
<div style="background-color:white; width:100%;">
<a class="btn" href="customer-signup_am.php?lang=am_ET" style="margin-left: 10px; background-color:rgb(255, 255, 255); color: gray;">አማርኛ</a>

<a class="btn" href="customer-signup_or.php?lang=or_ET" style="margin-left: 10px; background-color:rgb(0, 110, 185); color: white;">Afaan Oromo</a>

  <a class="btn" href="customer-signup.php?lang=en_US" style="margin-left: 10px; background-color:rgb(255, 255, 255); color: gray;">English</a>

</div>
    <div class="container">
    <div class="container-fluid">
    <div class="table-container">
        <h2><?= __('Applicant Signup')?></h2>
        <?php if ($message != ""): ?>
            <div id="error-message" class="alert alert-primary" role="alert">
                <?php echo $message; ?>
            </div>
            
        <?php endif; ?>
        <form method="POST" autocomplete="off" enctype="multipart/form-data">
            <label for="first_name"><?= __('First Name')?></label>
            <input type="text" name="f_name"  minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
            <label for="m_name"><?= __('Middle Name')?></label>
            <input type="text" name="m_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only">
            <label for="l_name"><?= __('Last Name')?></label>
            <input type="text" name="l_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only">
            <label for="username"><?= __('Username')?></label>
            <input type="text" name="username" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
            <label for="email"><?= __('Email')?></label>
            <input type="email" name="email" required>
            <label for="phone"><?= __('Phone number')?></label>
            <input type="tel" name="phone" pattern="^\+251\d{9}$" title="Please enter a valid phone start with +251 followed by 9 number only" required>
            <label for="religion"><?= __('Religion')?></label>
            <select name="religion" required >
                <option value="">Select Religion</option>
                <option value="christianity">Ortodox Tewahedo</option>
                <option value="islam">Islam</option>
                <option value="hinduism">Waqa</option>
                <option value="protestant">Protestant</option>
                <option value="other">Other</option>
            </select>
            <label for="sex"><?= __('Gender')?></label><br>
            <label>
            <input type="radio" name="sex" value="Male">
            <?= __('Male')?>  
           </label>
           <label>
           <input type="radio" name="sex" value="Female">
           <?= __('Female')?> 
          </label><br>
      
   
            <label for="password"><?= __('Password')?></label>
            <input type="password" name="password" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" title="Password must contain at least one letter, one number, and be at least 6 characters long" required>
            <label for="kebele_Id_Number"><?= __('Kebele Id Number')?></label>
            <input type="text" name="kebele_Id_Number" minlength="12" maxlength="12" required>
            <label for="image"><?= __('Scanned Kebele ID (PDF Only)')?></label>
            <input type="file" name="image" id="image" accept=".pdf" required>
            <div id="errorMessage" style="color: red;"></div> <!-- Container for error message -->
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
            <input type="submit" name="signup" value="<?= __('signup')?>">
        </form>
        <div class="login-link">
            <p><?= __('I have an account')?>? <a href="login_or.php"><?= __('Login')?></a></p>
            <p><?= __('here you can change to pdf')?>? <a href="make_pdf.php"><?= __('Make PDF')?></a></p>
        </div>
        </div>
        </div>
    </div>
    <script>
    setTimeout(function(){
        var errorMessage = document.getElementById('error-message');
        if (errorMessage !== null) {
            errorMessage.remove();
        }
    }, 3000); // 3000 milliseconds = 3 seconds
</script>

</body>
</html>

