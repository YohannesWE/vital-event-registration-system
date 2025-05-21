
<?php
session_start();

// Check if the user is not logged in or has inappropriate user type, then redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'kebele employee' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit;
}

// Establish connection to the MySQL database
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    exit;
}

// Get the current username from the session
$currentUsername = $_SESSION['username'];

// Check if the user is already registered for the marriage event with divorce status "not_divorced"
$existingMarriageQuery = "SELECT * FROM marriage_table WHERE username = '$currentUsername' AND divorced_status = 'not_divorced'";
$existingMarriageResult = mysqli_query($conn, $existingMarriageQuery);

// If the user is already registered for the marriage event with divorce status "not_divorced", display a message
if (mysqli_num_rows($existingMarriageResult) > 0) {
    $message = "You are already registered for this event and not divorced.";
} else {
    // If the user is not already registered for the marriage event with divorce status "not_divorced", display the registration form
    if (isset($_POST['submit'])) {
        // Retrieve email from the database
        $sql = "SELECT email FROM user WHERE username = '$currentUsername'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            
            // Retrieve form data
            // Assign form data to variables here
            $hasband_fname = $_POST['hasband_fname'];
            $hasband_mname = $_POST['hasband_mname'];
            $hasband_lname = $_POST['hasband_lname'];
            $wife_fname = $_POST['wife_fname'];
            $wife_mname = $_POST['wife_mname'];
            $wife_lname = $_POST['wife_lname'];

            $Hasband_natinality = $_POST['Hasband_natinality'];
            $wife_natinality = $_POST['wife_natinality'];
                 $Registration_date = $_POST['Registration_date'];
            $marriage_Region = "Oromia";
            $marriage_Zone = "North shewa";
            $marriage_kebele = "Ganda chefee";
            $marriage_date = $_POST['marriage_date'];
            $marriage_condition = $_POST['marriage_condition'];
            $wife_birth_place = $_POST['wife_birth_place'];
            $husband_birth_place = $_POST['husband_birth_place'];
            $hasband_birth_date = $_POST['hasband_birth_date'];
            $wife_birth_date = $_POST['wife_birth_date'];
            $Marriage_country ="Ethiopia";
            $Marriage_woreda ="fiche";
            $marriage_states = "pending";
            $Payemnt = "unpaid";
            $divorce_statuss = "not_divorced";
       
            $f_status = "unread";
            $image = 'image';
            $file = $_FILES[$image]['name'];
            $fileType = $_FILES[$image]['type'];
            $dst = "./marriage_paper/" . $file;
            $dst_db = "marriage_paper/" . $file;
            move_uploaded_file($_FILES['image']['tmp_name'], $dst);
            // Proceed with insertion
          
            $sql = "INSERT INTO marriage_table (username, email,Registration_date,Hasband_fname, Hasband_mname, Hasband_lname, Wife_fname, Wife_mname, Wife_lname,Hasband_natinality,wife_natinality,husband_birth_place,wife_birth_place,hasband_birth_date,wife_birth_date, marriage_Region,marriage_Zone,marriage_kebele,Marrage_date, Marrage_condition, Marriage_country, Marriage_woreda,Marriage_paper,Marriage_status,Payemnt,divorced_status,c_status)
            VALUES ('$currentUsername','$email','$Registration_date','$hasband_fname', '$hasband_mname', '$hasband_lname', '$wife_fname', '$wife_mname', '$wife_lname', '$Hasband_natinality','$wife_natinality','$husband_birth_place','$wife_birth_place','$hasband_birth_date','$wife_birth_date',' $marriage_Region','$marriage_Zone','$marriage_kebele', '$marriage_date', '$marriage_condition', '$Marriage_country', '$Marriage_woreda', '$dst_db', '$marriage_states', '$Payemnt','$divorce_statuss','$f_status')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $message = "Application submitted successfully.";
            } else {
                $message = "Failed to submit application.";
            }
        } else {
            $message = "Failed to retrieve email from the database.";
        }
    }
}

// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register vital event</title>
   
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css1_applicant.php'; ?>
   
    
      <style>
 
    
    
        body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
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
        .message {
    color: #721c24; /* Error message text color */
    background-color:rgba(0, 111, 170, 0.47); /* Error message background color */
    border: 1px solid rgba(0, 111, 170, 0.47); /* Error message border color */
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
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

        <form method="POST" enctype="multipart/form-data">
        <center> <h5><?= __('Marriage Registartion Form')?></h5>
       <?php if (!empty($message)): ?>
        <div class="alert alert-danger45"><?php echo $message; ?></div>
    <?php else: ?></center>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="Username"><?= __('Username')?>:</label>
                    <input type="text" id="Username" name="Username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"  readonly required>
                    </div>
                </div>
                <div class="col-md-6">
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
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="hasband_fname"><?= __("Husband's First Name")?>:</label>
        <input type="text" id="hasband_fname" name="hasband_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="hasband_mname"><?= __("Husband's Middle Name")?>:</label>
        <input type="text" id="hasband_mname" name="hasband_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="hasband_lname"><?= __("Husband's Last Name")?>:</label>
        <input type="text" id="hasband_lname" name="hasband_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_fname"><?= __("Wife's First Name")?>:</label>
        <input type="text" id="wife_fname" name="wife_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_mname"><?= __("Wife's Middle Name")?>:</label>
        <input type="text" id="wife_mname" name="wife_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_lname"><?= __("Wife's Last Name")?>:</label>
        <input type="text" id="wife_lname" name="wife_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>


            <div class="row">
            <div class="col-md-4">
                    <div class="form-group">
                    <label for="hasband_birth_date"><?= __('Husband Birth date')?>:</label>
        <input type="date" id="hasband_birth_date" name="hasband_birth_date"  required>
        <script>
    // Get today's date
    var today = new Date();

    // Calculate the date 18 years ago
    var maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

    // Format the max date in yyyy-mm-dd format
    var maxDateFormatted = maxDate.toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to 18 years ago
    document.getElementById('hasband_birth_date').setAttribute('max', maxDateFormatted);
</script>
    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_birth_date"><?= __('Wife Birth date')?>:</label>
        <input type="date" id="wife_birth_date" name="wife_birth_date"  required>
     
        <script>
    // Get today's date
    var today = new Date();

    // Calculate the date 18 years ago
    var maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

    // Format the max date in yyyy-mm-dd format
    var maxDateFormatted = maxDate.toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to 18 years ago
    document.getElementById('wife_birth_date').setAttribute('max', maxDateFormatted);
</script>

               </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_birth_place"><?= __('Wife Birth Place')?>:</label>
        <input type="text" id="wife_birth_place" name="wife_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
            <div class="col-md-4">
    <div class="form-group">
        <label for="Husband_natinality"><?= __("Husband's First Name")?><?= __("Husband's Nationality")?>:</label>
        <select name="Hasband_natinality" id="Hasband_natinality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="wife_natinality"><?= __("Wife's Nationality")?>:</label>
        <select name="wife_natinality" id="wife_natinality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>
<div class="col-md-4">
                    <div class="form-group">
                    <label for="husband_birth_place"><?= __('Hasband Birth place')?>:</label>
        <input type="text" id="husband_birth_place" name="husband_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="marriage_date"><?= __('Date of Marriage')?> :</label>
        <input type="date" id="marriage_date" name="marriage_date" required>
                    </div>
                    <script>
    // Get today's date in the format yyyy-mm-dd
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to today
    document.getElementById('marriage_date').setAttribute('max', today);
</script>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="marriage_condition"><?= __('Marital status')?>:</label>
            <select id="marriage_condition" name="marriage_condition" required>
                <option value="">Select</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
             
            </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="Divorce_paper"><?= __('Marriage Paper(from legal orgnization) (PDF)')?>:</label>
                <input type="file" name="image" id="image" accept=".pdf" required>
                <div id="errorMessage" style="color: red;"></div> <!-- Container for error message -->
                    </div>
                </div>
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

<div style="display: flex; align-items: center; justify-content: flex-start;">
        <input type="checkbox" name="certification" id="certification" required style="margin-right: 0px;">
        <label for="certification"><?= __('I certify') ?>.</label>
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
         <center>   <div class="form-">
    <input type="submit" name="submit" value="<?= __('Register')?>" class="btn btn-success">
   
</div></center>
        </form>
        <?php endif; ?>
    </div>
   
</body>
</html>