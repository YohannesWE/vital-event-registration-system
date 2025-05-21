<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['username'])) {
    $username = $_GET['username'];

    // Establish connection to database
    $conn = mysqli_connect("localhost", "root", "", "vital_event");

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch user data from database
    $sql = "SELECT * FROM divorce_table WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch user data
    } else {
        echo "User not found";
        exit();
    }

    // Check if update form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $hasband_fname = $_POST['hasband_fname'];
        $hasband_mname = $_POST['hasband_mname'];
        $hasband_lname = $_POST['hasband_lname'];
        $wife_fname = $_POST['wife_fname'];
        $wife_mname = $_POST['wife_mname'];
        $wife_lname = $_POST['wife_lname'];
        $Hasband_natinality = $_POST['Hasband_natinality'];
        $wife_natinality = $_POST['wife_natinality'];
        $Divorce_date = $_POST['Divorce_date'];
        $number_of_child = $_POST['number_of_child'];
        $husband_birth_place = $_POST['husband_birth_place'];

$wife_birth_place = $_POST['wife_birth_place'];
$hasband_birth_date = $_POST['hasband_birth_date'];
$wife_birth_date = $_POST['wife_birth_date'];

        // Update user data in database
        $update_sql = "UPDATE divorce_table 
                       SET hasband_fname='$hasband_fname', 
                           hasband_mname='$hasband_mname', 
                           hasband_lname='$hasband_lname', 
                           wife_fname='$wife_fname', 
                           wife_mname='$wife_mname', 
                           wife_lname='$wife_lname', 
                           Husband_Natinality='$Hasband_natinality', 
                           wife_Natinality='$wife_natinality', 
                           wife_birth_place='$wife_birth_place',
                           hasband_birth_date='$hasband_birth_date',
                           wife_birth_date='$wife_birth_date',
                           wife_birth_date='$wife_birth_date',
                           husband_birth_place='$husband_birth_place', 
                           Divorce_date='$Divorce_date', 
                           number_of_child='$number_of_child' 
                       WHERE username='$username'";

        // Execute the update query
        if(mysqli_query($conn, $update_sql)) {
            $message = "Application updated successfully";
        } else {
            $message = "Error updating record: " . mysqli_error($conn);
        }
    } // Closing curly brace for checking if update form is submitted

    // Close database connection
    mysqli_close($conn);
} else {
    echo "Username not provided";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <title>Update Record</title>
    <style>
        body {
            background-color:rgba(73, 140, 184, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        input[type="checkbox"] {
            margin-right: 5px; /* Adjust as needed */
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
            background-color: #f8d7da; /* Error message background color */
            border: 1px solid #f5c6cb; /* Error message border color */
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <center><h2>Divorce Update Form</h2></center>
    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php else: ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="Username" id="Username" maxlength="50" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>" readonly required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="hasband_fname">Husband's First Name:</label>
                    <input type="text" name="hasband_fname" id="hasband_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter text only" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="hasband_mname">Husband's Middle Name:</label>
                    <input type="text" name="hasband_mname" id="hasband_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter text only" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="hasband_lname">Husband's Last Name:</label>
                    <input type="text" name="hasband_lname"  id="hasband_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter text only" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="wife_fname">Wife's First Name:</label>
                    <input type="text" name="wife_fname" id="wife_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter text only" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="wife_mname">Wife's Middle Name:</label>
                    <input type="text" name="wife_mname" id="wife_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter text only" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="wife_lname">Wife's Last Name:</label>
                    <input type="text" name="wife_lname" id="wife_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter text only" required>
                </div>
            </div>
        </div>

                 
        <div class="row">
          
          <div class="col-md-6">
              <div class="form-group">
              <label for="hasband_birth_date">Husband Birth date:</label>
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
              <label for="usernamee">Place of Birth :</label>
  <input type="text" id="husband_birth_place" name="husband_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
              </div>
          </div>
         
      </div>
      
      <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <label for="wife_birth_date">Wife Birth date:</label>
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
              <label for="wife_birth_place"> Place of Birth:</label>
  <input type="text" id="wife_birth_place" name="wife_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
              </div>
          </div>
         
      </div>
     

      <div class="row">
      <div class="col-md-4">
<div class="form-group">
  <label for="Husband_nationality">Husband's Nationality:</label>
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
  <label for="wife_nationality">Wife's Nationality:</label>
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
<label for="Divorce_date">Divorce date:</label>
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
                    <label for="place_of_divorce">Place of Divorce Dissolved:</label>
                    <input type="text" name="place_of_divorce" id="place_of_divorce"  minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="number_of_child">Number of Children:</label>
                    <input type="text" name="number_of_child" id="number_of_child" pattern="[0-9]|[1-4][0-9]|50" title="Please enter a valid childran number between 0 and 50" required>
                </div>
            </div>
        </div>
        <center>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-success">
            </div>
        </center>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
