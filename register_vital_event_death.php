<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('languge.php');
$message = ""; // Initialize message variable
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Generate a unique viewer ID
do {
    $view_code = generateViewerID(); // Call a function to generate a unique viewer ID
    $existingViewCodeQuery = "SELECT * FROM death_table WHERE view_code = '$view_code'";
    $existingViewCodeResult = mysqli_query($conn, $existingViewCodeQuery);
} while (mysqli_num_rows($existingViewCodeResult) > 0);

// Function to generate a unique viewer ID
function generateViewerID() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = 6;
    $viewerID = '';
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $viewerID .= $characters[$randomIndex];
    }
    return $viewerID;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {

    $k_id_no = $_POST["k_id_no"];
    $view_code = $_POST["view_code"];
    $f_name = $_POST["f_name"];
    $m_name = $_POST["m_name"];
    $l_name = $_POST["l_name"];
    $email=$_POST["email"];
    $Sex = $_POST["Sex"];
    $Nationality = $_POST["Nationality"];
    $Death_date = $_POST["Death_date"];
    $Birth_date = $_POST["Birth_date"];
    $Death_kebele = "wereda 02";
    $Marriage_status = $_POST["Marriage_status"];
    $child_number = $_POST["child_number"];
    $death_Region = "Addis Ababa";
    $death_Zone ="Addis Ababa";
    $registration_date = $_POST["Registration_date"];
    $Death_states = "pending";
    $death_country = "Ethiopia";
    $death_woreda = "kirkos";
    $Payemnt = "unpaid";
    $f_status = "unread";
    $r_fname = $_POST["r_fname"];
    $r_mname = $_POST["r_mname"];

    $Death_place = $_POST["Death_place"];
    $Relationship_type = $_POST["Relationship_type"];
    $file = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $dst = "./death_paper/" . $file;
    $dst_db = "death_paper/" . $file;
    move_uploaded_file($_FILES['image']['tmp_name'], $dst);

    // Check if the event already exists with the same k_id_no
    $existingEventQuery = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no'";
    $existingEventResult = mysqli_query($conn, $existingEventQuery);

    if (mysqli_num_rows($existingEventResult) > 0) {
        $message = "This user has already registered for this event.";
     
        // You can choose to handle this case as per your requirements.
    } else {
        // Check if the event already exists with the same k_id_no and view_code
        $existingEventQuery = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no' AND view_code = '$view_code'";
        $existingEventResult = mysqli_query($conn, $existingEventQuery);

        if (mysqli_num_rows($existingEventResult) > 0) {
            $message = "This user has already registered for this event with the same view code.";
           
            // You can choose to handle this case as per your requirements.
        } else {
            // Check if the view code already exists in the birth table
            $existingViewCodeQuery = "SELECT * FROM death_table WHERE view_code = '$view_code'";
            $existingViewCodeResult = mysqli_query($conn, $existingViewCodeQuery);

            if (mysqli_num_rows($existingViewCodeResult) > 0) {
                $message = "This view code has already been taken. Please try another.";
              
                // You can choose to handle this case as per your requirements.
            } else {
                $sql = "INSERT INTO death_table (k_id_no, view_code, email,f_name, m_name, l_name, Sex, Nationality, Death_date,registration_date,Birth_date,death_country,death_woreda,death_Region,death_Zone,Death_kebele, Marriage_status, child_number,r_fname , r_mname,Relationship_type , Death_place,Death_paper, Death_states, Payemnt,c_status) VALUES ('$k_id_no', '$view_code', '$email','$f_name', '$m_name', '$l_name', '$Sex', '$Nationality', '$Death_date', ' $registration_date','$Birth_date','$death_country' ,'$death_woreda','$death_Region','$death_Zone','$Death_kebele', '$Marriage_status', '$child_number',' $r_fname' ,' $r_mname ','$Relationship_type', '$Death_place','$dst_db', '$Death_states', '$Payemnt','$f_status')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $message = "Application submitted successfully.";
                   
                } else {
                    // Display specific error message if insertion fails
                    $message = "Failed to submit application.";
                   
                }
            }
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Death</title>

    <?php
    include 'scroll_css.php';
    ?>
    <?php
    include 'head_login.php';
    ?>
    <style>
        body {
            background-color:rgba(20, 2, 2, 0.44);
   
        }

        .container {
            max-width: 90%;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 2px;
        }
        .form-groupck   {
            padding: 20px;
            margin-bottom: 8px;
        }
        

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color:black;
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
        .form-group textarea{
            height: 50px;
        }
        .form-group button {
            background-color: #45a049;
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
    background-color: #f8d7da; /* Error message background color */
    border: 1px solid #f5c6cb; /* Error message border color */
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}
/* Register Button - Green */
.custom-register-btn {
    
    background-color: #6c757d; /* Bootstrap's secondary gray */
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    margin-left: 10px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.custom-register-btn:hover {
    background-color:rgb(0, 0, 0); /* Darker green */
}

/* Back Button - Gray/Blue */
.custom-back-btn {
    background-color: #6c757d; /* Bootstrap's secondary gray */
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    margin-left: 10px;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.custom-back-btn:hover {
    background-color: #5a6268; /* Darker gray */
}
.language-dropdown {
    position: relative;
    display: inline-block;
    margin: 4px;
    position: fixed;
    top: 120px;
    right: 20px;
    z-index: 1000;
    font-family: sans-serif;

}

.language-dropdown button {
    background-color: rgb(0, 110, 185);
    color: white;
    padding: 10px 10px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    border-radius: 40px;
}

.language-dropdown button:hover {
    background-color: rgb(73, 139, 184);
}

.language-options {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 100px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
    z-index: 10;
    border-radius: 4px;
    margin-top: 5px;
    
}

.language-options a {
    color: gray;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.language-options a:hover {
    background-color: #f1f1f1;
    color: black;
}

.language-dropdown:hover .language-options {
    display: block;
}
    </style>
</head>

<body>
<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="register_vital_event_death_am.php?lang=am_ET">አማ</a>
        <a href="register_vital_event_death.php?lang=en_US">En</a>
        <a href="register_vital_event_death_or.php?lang=or_ET">AO</a>
    </div>
    </div>
<div class="container" style="max-width: 960px;">
    <center>
        <h5 class="my-4"><?= __('Register Death Form')?></h5>
    </center>
       <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php else: ?></center>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kebele-id-number/fayeda"><?= __('Deceased Kebele ID/fayeda Number')?>:</label>
                      
                        <input type="text" name="k_id_no" id="k_id_no" required>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                        <label for="view-code"><?= __('Viewer ID')?>:</label>
                        <input type="text" name="view_code" id="view_code" value="<?php echo $view_code; ?>" required readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email"><?= __('Email(your)')?>:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="f_name"><?= __('Deceased First Name')?>:</label>
                        <input type="text" name="f_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" id="f_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="m_name"><?= __('Deceased Middle Name')?>:</label>
                        <input type="text" name="m_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" id="m_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="l_name"><?= __('Deceased Last Name')?>:</label>
                        <input type="text" name="l_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" id="l_name" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Sex"><?= __('Gender')?>:</label>
                        <select name="Sex" id="Sex" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
    <div class="form-group">
        <label for="Nationality"><?= __('Nationality')?>:</label>
        <select name="Nationality" id="Nationality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
    <label for="Birth_date"><?= __('Birth date')?>:</label>
        <input type="date" name="Birth_date" id="Birth_date" maxlength="15" required>
    </div>
</div>

<script>
    // Get today's date in the format yyyy-mm-dd
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to today
    document.getElementById('Birth_date').setAttribute('max', today);
</script>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Death_date"><?= __('Date of death')?> :</label>
                        <input type="date" name="Death_date" id="Death_date" required>
                    </div>
                    <script>
    // Get today's date in the format yyyy-mm-dd
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to today
    document.getElementById('Death_date').setAttribute('max', today);
</script>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Death_place"><?= __('Place of Death')?>:</label>
                        <input type="text" name="Death_place"  id="Death_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Death_place"><?= __('Registration date')?>:</label>
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
                  
                        <input type="text" id="dateField" name="Registration_date" required readonly>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6">
        <div class="form-group">
            <label for="Marriage_status"><?= __('Marital status')?>:</label>
            <select name="Marriage_status" id="Marriage_status" required>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
                <!-- Add more options as needed -->
            </select>
        </div>
    </div>
                
              
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="child_number"><?= __('Number of child')?>:</label>
                        <input type="text" name="child_number" id="child_number" pattern="\b([1-9]|[1-3][0-9]|40)\b" title="Please enter a number between 1 and 40">
                    </div>
                </div>
            </div>
    
          
          

            <div class="row">
         
         <div class="col-md-4">
             <div class="form-group">
             <label for="r_fname"><?= __('Registrant')?>:</label>
         <input type="text" name="r_fname" id="r_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" >
             </div>
         </div>
         <div class="col-md-4">
         <div class="form-group">
             <label for="r_mname"><?= __('Father Name')?>:</label>
         <input type="text" name="r_mname" id="r_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" >
             </div>
         </div>
     
         <div class="col-md-4">
    <div class="form-group">
        <label for="Relationship_type"><?= __('Relationship type')?>:</label>
        <select name="Relationship_type" id="Relationship_type" required>
            <option value="">Select...</option>
            <option value="Wife">Wife</option>
            <option value="Hasband">Hasband</option>
            <option value="Spouse">Spouse</option>
            <option value="Child">Child</option>
            <option value="Parent">Parent</option>
            <option value="Sibling">Sibling</option>
            <option value="Grandparent">Grandparent</option>
            <option value="Grandchild">Grandchild</option>
            <option value="police">police</option>
            <option value="Other">Other</option>
        </select>
    </div>
</div>

     </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="file_upload"><?= __('Upload Deceased')?>:</label>
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

<div class="form-groupck">
    <div style="display: flex; align-items: center; justify-content: flex-start;">
        <input type="checkbox" name="certification" id="certification" required style="margin-right: 0px;">
        <label for="certification"><?= __('I certify') ?>.</label>
    </div>
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
            <center>
  <div class="form-group">
    <input type="submit" name="submit" value="Register" class="custom-register-btn">
    <a href="index.php" class="custom-back-btn"><?= __('Back')?></a>
  </div>
</center>
        </form>
        <?php endif; ?>
    </div>

</body>
</html>