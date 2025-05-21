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
    $sql = "SELECT * FROM marriage_table WHERE username = '$username'";
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
 
        $Marrage_date = $_POST['Marrage_date'];
        $marriage_condition = $_POST['marriage_condition'];
        $wife_birth_place = $_POST['wife_birth_place'];
        $husband_birth_place = $_POST['husband_birth_place'];
        $hasband_birth_date = $_POST['hasband_birth_date'];
        $wife_birth_date = $_POST['wife_birth_date'];

        // Construct the update query
        $update_sql = "UPDATE marriage_table SET 
            Hasband_fname = '$hasband_fname',
            hasband_mname = '$hasband_mname',
            hasband_lname = '$hasband_lname',
            wife_fname = '$wife_fname',
            wife_mname = '$wife_mname',
            wife_lname = '$wife_lname',
            Hasband_natinality = '$Hasband_natinality',
            wife_natinality = '$wife_natinality',
            husband_birth_place = '$husband_birth_place',
            wife_birth_place = '$wife_birth_place',
            hasband_birth_date = '$hasband_birth_date',
            wife_birth_date = '$wife_birth_date',
            Marrage_date = '$Marrage_date',
            Marrage_condition = '$marriage_condition'
            WHERE username = '$username'";

        // Update user data in database
        if(mysqli_query($conn, $update_sql)) {
            $message = "Record updated successfully";
        } else {
            $message = "Error updating record: " . mysqli_error($conn);
        }
    }

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
    <title>Update Record</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>
        body {
            background-color:rgba(73, 140, 184, 0.47);
            overflow-y: scroll;
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
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <center><h5>Marriage Update Form</h5></center>
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Username">Username:</label>
                        <input type="text" name="Username" id="Username" maxlength="50" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>" readonly required>
                    </div>
                </div>
               
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="hasband_fname">Husband First Name:</label>
                        <input type="text" id="hasband_fname" name="hasband_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="hasband_mname">Husband Middle Name:</label>
                        <input type="text" id="hasband_mname" name="hasband_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="hasband_lname">Husband Last Name:</label>
                        <input type="text" id="hasband_lname" name="hasband_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="wife_fname">Wife First Name:</label>
                        <input type="text" id="wife_fname" name="wife_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="wife_mname">Wife Middle Name:</label>
                        <input type="text" id="wife_mname" name="wife_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="wife_lname">Wife Last Name:</label>
                        <input type="text" id="wife_lname" name="wife_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>


            <div class="row">
            <div class="col-md-4">
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
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="wife_birth_place">Wife Birth Place:</label>
        <input type="text" id="wife_birth_place" name="wife_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
            <div class="col-md-4">
    <div class="form-group">
        <label for="Husband_natinality">Husband's Nationality:</label>
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
        <label for="wife_natinality">Wife's Nationality:</label>
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
                    <label for="husband_birth_place">Hasband Birth place:</label>
        <input type="text" id="husband_birth_place" name="husband_birth_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="marriage_date"> Date of Marriage :</label>
        <input type="date" id="Marrage_date" name="Marrage_date" required>
                    </div>
                    <script>
    // Get today's date in the format yyyy-mm-dd
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to today
    document.getElementById('Marrage_date').setAttribute('max', today);
</script>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="marriage_condition">Marital status:</label>
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
            <center>
                <div class="form-group">
                    <input type="submit" name="submit" value="update" class="btn btn-success">
                </div>
            </center>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
