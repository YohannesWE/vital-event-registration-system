<?php
session_start();
$message = ""; // Initialize message variable
// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'Civil_registrar' || $_SESSION['usertype'] == 'admin') {
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
    header("Location: login.php");
    exit;
}
$currentUsername = $_SESSION['username'];
$existingEventQuery = "SELECT * FROM divorce_table WHERE username = '$currentUsername'";
$existingEventResult = mysqli_query($conn, $existingEventQuery);
if (mysqli_num_rows($existingEventResult) > 0) {
    $message = "you are already registered for this event.";
  
    // You can choose to handle this case as per your requirements.
}
// Get the current username from the session


// Check if the form is submitted
if (isset($_POST['submit'])) {   
    $sql = "SELECT email FROM user WHERE username = '$currentUsername'"; // Replace with your actual table and column names
    $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
    
       
   
    $username = $_POST['username'];
$hasband_fname = $_POST['Hasband_fname'];
$hasband_mname = $_POST['Hasband_mname'];
$hasband_lname = $_POST['Hasband_lname'];
$wife_fname = $_POST['wife_fname'];
$wife_mname = $_POST['wife_mname'];
$Registration_date = $_POST['Registration_date'];
$wife_lname = $_POST['wife_lname'];
$Hasband_natinality = $_POST['Hasband_natinality'];
$wife_natinality = $_POST['wife_natinality'];
$Divorce_date = $_POST['Divorce_date'];
$Divorce_Region = "Oromia";
$Divorce_Zone = "North shewa";
$Divorce_woreda = "fiche";
$f_status = "unread";

$divorce_kebele = "Ganda chefee";
$number_of_child = $_POST['Number_of_child'];
$husband_birth_place = $_POST['husband_birth_place'];

$wife_birth_place = $_POST['wife_birth_place'];
$hasband_birth_date = $_POST['hasband_birth_date'];
$wife_birth_date = $_POST['wife_birth_date'];


$Divorce_country =  "Ethiopia";
$divorce_states = "pending";
$Payemnt = "unpaid";

// Accessing file upload data
$file = $_FILES['image']['name'];
$fileType = $_FILES['image']['type'];
$dst = "./divorce_paper/" . $file;
$dst_db = "divorce_paper/" . $file;


    move_uploaded_file($_FILES['image']['tmp_name'], $dst);
} else {
    $message = "Failed to retrieve email from the database.";

    exit();
}

    // Check if the event already exists with the same username
    $existingEventQuery = "SELECT * FROM divorce_table WHERE username = '$currentUsername'";
    $existingEventResult = mysqli_query($conn, $existingEventQuery);
    if (mysqli_num_rows($existingEventResult) > 0) {
        $message = "you are already registered for this event.";
      
        // You can choose to handle this case as per your requirements.
    } else {
        $sql = "INSERT INTO divorce_table (username,email, Registration_date,Hasband_fname, Hasband_mname, Hasband_lname, wife_fname, wife_mname, wife_lname,Husband_Natinality, wife_Natinality,wife_birth_place,hasband_birth_date,wife_birth_date,husband_birth_place,Divorce_date,Divorce_Region,Divorce_country,Divorce_woreda,Divorce_Zone,Divorce_kebele, Number_of_child, Divorce_paper, Divorce_states, Payment,c_status)
        VALUES ('$username', '$email','$Registration_date','$hasband_fname', '$hasband_mname', '$hasband_lname', '$wife_fname', '$wife_mname', '$wife_lname','$Hasband_natinality','$wife_natinality','$wife_birth_place','$hasband_birth_date','$wife_birth_date','$husband_birth_place','$Divorce_date', '$Divorce_Region','$Divorce_country','$Divorce_woreda','$Divorce_Zone','$divorce_kebele', '$number_of_child', '$dst_db', '$divorce_states', '$Payemnt','$f_status')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $message = "Application submitted successfully.";
           
           
        } else {
            $message = "Failed to submit application.";
           
          
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
    include 'scroll_css.php';
    ?>
    <?php include 'admin_css1_applicant.php'; ?>
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
       <center> <h5><?= __('Divorce Registertion Form')?></h5>
       <?php if (!empty($message)): ?>
        <div class="alert alert-danger45"><?php echo $message; ?></div>
    <?php else: ?></center>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="username"><?= __('Username')?>:</label>
                <input type="text" name="username" id="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"  readonly required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="Registration_date"><?= __('Registration date')?>:</label>
                    <input type="text" id="dateField" name="Registration_date" required readonly>


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
                    <label for="Hasband_fname"><?= __("Husband's First Name")?>:</label>
                <input type="text" name="Hasband_fname" id="Hasband_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only"  required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Hasband_mname"><?= __("Husband's Middle Name")?>:</label>
                <input type="text" name="Hasband_mname" id="Hasband_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Hasband_lname"><?= __("Husband's Last Name")?>:</label>
                <input type="text" name="Hasband_lname"  id="Hasband_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_fname"><?= __("Wife's First Name")?>:</label>
                <input type="text" name="wife_fname" id="wife_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_mname"><?= __("Wife's Middle Name")?>:</label>
                <input type="text" name="wife_mname" id="wife_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_lname"><?= __("Wife's Last Name")?>:</label>
                <input type="text" name="wife_lname" id="wife_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>

           
            <div class="row">
          
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="husband_birth_place"><?= __('Place of Birth')?> :</label>
        <input type="text" id="husband_birth_place" name="husband_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
               
            </div>
            
            <div class="row">
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="wife_birth_place"><?= __('Place of Birth')?> :</label>
        <input type="text" id="wife_birth_place" name="wife_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
               
            </div>
           

            <div class="row">
            <div class="col-md-4">
    <div class="form-group">
        <label for="Husband_nationality"><?= __("Husband's Nationality")?>:</label>
        <select name="Hasband_natinality" id="Hasband_natinality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="other">other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="wife_nationality"><?= __("Wife's Nationality")?>:</label>
        <select name="wife_natinality" id="wife_natinality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="other">other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>


                <div class="col-md-4">
    <div class="form-group">
    <label for="Divorce_date"><?= __('Divorce date')?>:</label>
        <input type="date" name="Divorce_date" id="Divorce_date" maxlength="15" required>
    </div>
</div>

<script>
    // Get today's date in the format yyyy-mm-dd
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to today
    document.getElementById('Divorce_date').setAttribute('max', today);
</script>

</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                   <label for="place_of_divorce"><?= __('Place of divorce dissloved')?>:</label>
                <input type="text" name="place_of_divorce" id="place_of_divorce" maxlength="25" pattern="[A-Za-z]+" title="Please enter valid place of divorce alphabetic characters only"  requird>
                    </div>
                </div>
               
        
                <div class="col-md-6">
             
                <div class="form-group">
                    <label for="Number_of_child"><?= __('Number of child')?>:</label>
                <input type="text" name="Number_of_child" id="Number_of_child" pattern="[0-9]|[1-4][0-9]|50" title="Please enter a valid childran number between 0 and 50" required>
                </div>
                </div>
            </div>

        
        
         
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                     <label for="Divorce_paper"><?= __('Divorce Paper (PDF)')?>:</label>
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