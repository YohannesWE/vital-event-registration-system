<?php
session_start();
$message = ""; // Initialize message variable
// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'kebele employee' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in and the username is set in the session
if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    // You can choose to handle this case as per your requirements.
    exit;
}

// Get the current username from the session
$currentUsername = $_SESSION['username'];
$existingEventQuery = "SELECT * FROM birth_table WHERE username = '$currentUsername'";
$existingEventResult = mysqli_query($conn, $existingEventQuery);
if (mysqli_num_rows($existingEventResult) > 0) {
    $message = "you are already registered for this event .";
} 
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve email from the database
    $sql = "SELECT email FROM user WHERE username = '$currentUsername'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Process form data
        $f_name = $_POST["f_name"];
        $m_name = $_POST["m_name"];
        $l_name = $_POST["l_name"];
        $Mother_fname = $_POST["Mother_fname"];
        $Mother_mname = $_POST["Mother_mname"];
        $Mother_lname = $_POST["Mother_lname"];
        $father_fname = $_POST["father_fname"];
        $father_mname = $_POST["father_mname"];
        $father_lname = $_POST["father_lname"];
        $mother_natinality = $_POST["mother_natinality"];
        $father_natinality = $_POST["father_natinality"];
        $sex = $_POST["sex"];
        $Birth_Region = "Oromia";
        $Birth_Zone = "North shewa";
        $Birthdate = $_POST["Birthdate"];
        $Nationality = $_POST["Nationality"];
        $Registration_date = $_POST["Registration_date"];
        $Birth_kebele = "Ganda chefee";
        $Birth_Country = "Ethiopia";
        $Birth_werda = "fiche";
        $Birth_status = "pending";
        $Payment = "unpaid";
        $f_status = "unread";
        $payment_amount = "30";
        $file = $_FILES['image']['name'];
        $fileType = $_FILES['image']['type'];
        $dst = "./birth_paper/" . $file;
        $dst_db = "birth_paper/" . $file;

        move_uploaded_file($_FILES['image']['tmp_name'], $dst);

        // Check if the event already exists with the same username
        $existingEventQuery = "SELECT * FROM birth_table WHERE username = '$currentUsername'";
        $existingEventResult = mysqli_query($conn, $existingEventQuery);
        if (mysqli_num_rows($existingEventResult) > 0) {
            $message = "you are already registered for this event .";
        } else {
            // Insert event data into the database
            $sql = "INSERT INTO birth_table (username,email,f_name, m_name, l_name, Mother_fname, Mother_mname, Mother_lname, father_fname, father_mname, father_lname,mother_natinality ,father_natinality,sex, Birthdate, Nationality, Registration_date,Birth_Region	, Birth_Zone,Birth_kebele, Birth_Country,Birth_werda,Birth_paper, Birth_status, Payment,c_status)
            VALUES ('$currentUsername','$email' ,'$f_name', '$m_name', '$l_name', '$Mother_fname', '$Mother_mname', '$Mother_lname', '$father_fname', '$father_mname', '$father_lname', '$mother_natinality','$father_natinality','$sex', '$Birthdate', '$Nationality', '$Registration_date','$Birth_Region', '$Birth_Zone','$Birth_kebele', '$Birth_Country','$Birth_werda','$dst_db', '$Birth_status', '$Payment','$f_status')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $message = "Application submitted successfully.";
            } else {
                $message = "Failed to submit application.";
            }
        }
    } else {
        $message = "Failed to retrieve email from the database.";

        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'scroll_css.php'; ?>
    <?php include 'children_page.php'; ?>
    <title>Register vital event</title>

   

      <style>

body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }


        label{
            font-size:18px;
        }


        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
 <script>
  // Get current date
  var currentDate = new Date();

  // Get the current date in the desired format (YYYY-MM-DD)
  var year = currentDate.getFullYear();
  var month = String(currentDate.getMonth() + 1).padStart(2, '0');
  var day = String(currentDate.getDate()).padStart(2, '0');
  var formattedDate = year + '-' + month + '-' + day;

  // Set the value of the input field
  document.getElementById("dateField").value = formattedDate;
</script>
</head>
<body>
<div class="container">
       <center> <h2><?= __('Birth Registration Form')?></h2>
       <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php else: ?></center>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="username"><?= __('Username')?> :</label>
                    <input type="text" name="Username" id="Username" maxlength="50" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"  readonly required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Registration_date"><?= __('Registration date')?>:</label>
                    <input type="text" id="dateField" name="Registration_date" required>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get current date
    var currentDate = new Date();

    // Format the date as desired (YYYY-MM-DD)
    var year = currentDate.getFullYear();
    var month = String(currentDate.getMonth() + 1).padStart(2, '0');
    var day = String(currentDate.getDate()).padStart(2, '0');
    var formattedDate = year + '-' + month + '-' + day;

    // Set the value of the input field
    document.getElementById("dateField").value = formattedDate;
  });
</script>
                    </div>
                </div>
                <div class="col-md-4">
    <div class="form-group">
        <label for="Birthdate"><?= __('Birth date')?>:</label>
        <input type="date" name="Birthdate" id="Birthdate" maxlength="15" required>
    </div>
</div>

<script>
    // Get today's date in the format yyyy-mm-dd
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to today
    document.getElementById('Birthdate').setAttribute('max', today);
</script>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="f_name"><?= __('First Name')?>:</label>
                    <input type="text" name="f_name" id="f_name" minlength="3" pattern="[A-Za-z]+" placeholder="Please enter First Name" maxlength="50" title="Please enter a text only"  required>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="m_name"><?= __('Middle Name')?>:</label>
                <input type="text" name="m_name" id="m_name" minlength="3" pattern="[A-Za-z]+" placeholder="Please enter Middle Name" title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="l_name"><?= __('Last Name')?>:</label>
                <input type="text" name="l_name" id="l_name" minlength="3" pattern="[A-Za-z]+" placeholder="Please enter Last Name" title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Mother_fname"><?= __("Mother's First Name")?>:</label>
                    <input type="text" name="Mother_fname" id="Mother_fname" minlength="3" placeholder="Please enter other's First Name" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Mother_mname"><?= __("Mother's Middle Name")?>:</label>
                <input type="text" name="Mother_mname" id="Mother_mname" minlength="3" placeholder="Please enter Middle Name" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Mother_lname"><?= __("Mother's Last Name")?>:</label>
                <input type="text" name="Mother_lname" id="Mother_lname" minlength="3" placeholder="Please enter Mother's Last Name:" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="35" required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                   <label for="father_fname"><?= __("Father's First Name")?>:</label>
                <input type="text" name="father_fname" id="father_fname" minlength="3" placeholder="Please enter Father's First Name" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="25" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="father_mname"><?= __("Father's Middle Name")?>:</label>
                <input type="text" name="father_mname" id="father_mname" minlength="3" placeholder="Please enter Father's Middle Name" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="father_lname"><?= __("Father's Last Name")?>:</label>
                <input type="text" name="father_lname" id="father_lname" minlength="3" placeholder="Please enter Father's Last Name" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="15" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                        <label for="sex"><?= __('Gender')?>:</label>
                        <select name="sex" id="sex" required>
                            <option value="">Select Gender</option>
                            <option value="Male"><?= __('Male')?></option>
                            <option value="Female"><?= __('Female')?></option>
                        </select>
                    </div>
                </div>
    <div class="col-md-4">
    <div class="form-group">
        <label for="Nationality"><?= __('Nationality')?>:</label>
        <select id="Nationality" name="Nationality" required>
            <option value="">Select a country</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
        </select>
    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label for="mother_nationality"><?= __("Mother's Nationality")?>:</label>
        <select name="mother_natinality" id="mother_natinality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>

            </div>

    


            <div class="row">
           
                <div class="col-md-12">
    <div class="form-group">
        <label for="father_nationality"><?= __("Father's Nationality")?>:</label>
        <select name="father_natinality" id="father_natinality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>

            </div>



           
         

      
      
            <div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <label for="Birth_paper"><?= __('Birth Paper from recognized legal or Religional organization')?>:</label>

            <input type="file" name="image" id="image" accept=".pdf" required>
            <div id="errorMessage" style="color: red;"></div> <!-- Container for error message -->
        </div>
    </div>
</div>
<br>
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
<div class="form-group">
        <label>
            <input type="checkbox" name="certification" id="certification" required>
            <?= __('I certify')?>
        </label>
    </div>
    <script>
        function showChatbot() {
            // Replace this with code to display the chatbot
            alert("Chatbot verification goes here!");
            // Enable the submit button if the checkbox is checked
            if (document.getElementById("certification").checked) {
                document.getElementById("submitButton").disabled = false;
            }
        }
    </script>


            <center !important>   
    <input type="submit" name="submit" value="<?= __('Register')?>" class="btn btn-success">
  
</center>
        </form>
        <?php endif; ?>
    </div>
   
</body>
</html>