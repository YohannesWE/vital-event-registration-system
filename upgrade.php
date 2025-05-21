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


$message = ""; // Initialize message variable

if (isset($_POST['signup'])) {
    // Retrieve form data
    $username = $_SESSION['username']; // Keep username from session
    $fullName = $_POST['f_name'];
    $middlename = $_POST['m_name'];
    $lastname = $_POST['l_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $religion = $_POST['religion'];
    $kebele_Id_Number = $_POST['kebele_Id_Number'];
    $states = "approved";
    $death_status = "undeath";
    $f_status = "unread";
    $usertype = "child";
    $upgradestatus = "upgrade";
    $file = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $dst = "./image/" . $file;
    $dst_db = "image/" . $file;

    // Check if the uploaded file is a PDF
    if ($fileType !== 'application/pdf') {
        $message = "Please select a PDF file for the Kebele ID.";
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
            $sql8 = "UPDATE user SET username = '$username', full_name = '$fullName', middle_name = '$middlename', last_name = '$lastname', email = '$email', phone = '$phone', religion = '$religion', password = '$password', k_id_no = '$kebele_Id_Number', k_id = '$dst_db', states = '$states', death_status = '$death_status', upgrade_status = '$upgradestatus', c_status ='$f_status' WHERE username  = '$username'";

            // Execute the SQL statement
            $result8 = mysqli_query($conn, $sql8);

            // Check if the insertion was successful
            if ($result8) {
                $message = "Your request has been successfully submitted.";
            } else {
                // Error in insertion
                $message = "Error: " . mysqli_error($conn);
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
    <title>Child Page</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'children_page.php'; ?>
    <style>
             body {
                background-color:rgba(73, 140, 184, 0.47);
                overflow-y: scroll; /* Always show vertical scrollbar */
        
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

        form input[type="text"],
form input[type="email"],
form input[type="number"],
form select,
form input[type="password"],
form input[type="file"] {
    width: calc(100% - 16px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
    box-sizing: border-box;
    font-size: 16px;
}

/* Additional styling for select element */
form select {
    width: calc(100% - 22px); /* Adjust width for select to match other inputs */
}


        .button-container {
            display: flex;
            justify-content: space-between;
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

        .form-container select {
            width: 350px;
        }

        input[type="submit"]:hover :hover {
            background-color: #0069d9;
            border-radius: 40px;
        }

  

        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
<div class="containert">
<div class="container-fluid">
    <div class="table-container">
    <center>
   <h2><?= __('child upgrade page')?></h2>
       <marquee> <h5><?= __('Here you can')?></h5></marquee>
        <?php if ($message != ""): ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="POST" autocomplete="off" enctype="multipart/form-data">
            <div>
                <label for="first_name" active><?= __('First Name')?></label>
                <input type="text" name="f_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" minlength="2">
            </div><br>
            <div>
                <label><?= __('Middle Name')?></label>
                <input type="text" name="m_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" minlength="2">
            </div><br>
            <div>
                <label><?= __('Last Name')?></label>
                <input type="text" name="l_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" minlength="2">
            </div><br>
            <div>
                <label><?= __('Username')?></label>
                <input type="text" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly> <!-- Display username from session in a read-only field -->                               
            </div><br>
            <div>
                <label><?= __('Email')?></label>
                <input type="email" name="email" minlength="3"    required>
            </div><br>
            <div>
                <label><?= __('Phone number')?></label>
                <input type="number" name="phone" pattern="^\+251\d{9}$" required  minlength="10">
            </div><br>
            <div>
                <label><?= __('Username')?></label>
                <select name="religion" class="s" required >
                    <option value="">Select Religion</option>
                    <option value="christianity">Christian</option>
                    <option value="islam">Islam</option>
                    <option value="waqa">waqa</option>
                    <option value="protestant">protestant</option>
                    <option value="other">Other</option>
                </select>
            </div><br>
            <div>
                <label><?= __('Password')?></label>
                <input type="password" name="password" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,}$" title="Password must contain at least one letter, one number, and be at least 6 characters long"  required>
            </div><br>
            <div >
                <label><?= __('Kebele ID Number')?></label><br>
                <input type="text" name="kebele_Id_Number" required>
                
            </div>

            <div >
                <label style="margin-right: 10px;"><?= __('Kebele ID (PDF Only)')?></label><br>
                <input type="file" name="image" id="image" accept=".pdf" required>
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
                <input type="submit" name="signup" value="<?= __('Upgrade')?>">
            </div><br>
        </form>
        </div>
        </div>
    </div>
</body>
</html>
