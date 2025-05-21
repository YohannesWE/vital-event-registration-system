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
    $sql = "SELECT * FROM birth_table WHERE username = '$username'";
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
      

    $f_name = $_POST["f_name"];
    $m_name = $_POST["m_name"];
    $l_name = $_POST["l_name"];
    $Mother_fname = $_POST["Mother_fname"];
    $Mother_mname = $_POST["Mother_mname"];
    $Mother_lname = $_POST["Mother_lname"];
    $father_fname = $_POST["father_fname"];
    $father_mname = $_POST["father_mname"];
    $father_lname = $_POST["father_lname"];
    $sex = $_POST["sex"];

    $Birthdate = $_POST["Birthdate"];
    $Nationality = $_POST["Nationality"];

 
    $mother_natinality = $_POST["mother_natinality"];
    $father_natinality = $_POST["father_natinality"];
        // Update user data in database
        $update_sql = "UPDATE birth_table SET f_name = '$f_name', m_name = '$m_name', l_name = '$l_name', Mother_fname = '$Mother_fname', Mother_mname = '$Mother_mname', Mother_lname = '$Mother_lname', father_fname = '$father_fname', father_mname = '$father_mname', father_lname = '$father_lname', sex = '$sex', Birthdate = '$Birthdate', Nationality = '$Nationality', mother_natinality = '$mother_natinality' WHERE username = '$username'";
        
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

       <center> <h2>Birth Update Form</h2>
       <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php else: ?></center>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="username">username :</label>
                    <input type="text" name="Username" id="Username" maxlength="50" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>" readonly required>

                    </div>
                </div>
             
                <div class="col-md-6">
    <div class="form-group">
        <label for="Birthdate">Birth date:</label>
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
                    <label for="f_name">First Name:</label>
                    <input type="text" name="f_name" id="f_name" minlength="3" pattern="[A-Za-z]+"  maxlength="50" title="Please enter a text only" required>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="m_name">Middle Name:</label>
                <input type="text" name="m_name" id="m_name" minlength="3" pattern="[A-Za-z]+"  title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="l_name">Last Name:</label>
                <input type="text" name="l_name" id="l_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Mother_fname">Mother's First Name:</label>
                    <input type="text" name="Mother_fname" id="Mother_fname" minlength="3"  pattern="[A-Za-z]+" title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Mother_mname">Mother's Middle Name:</label>
                <input type="text" name="Mother_mname" id="Mother_mname" minlength="3"  pattern="[A-Za-z]+" title="Please enter a text only" maxlength="30" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="Mother_lname">Mother's Last Name:</label>
                <input type="text" name="Mother_lname" id="Mother_lname" minlength="3"  pattern="[A-Za-z]+" title="Please enter a text only" maxlength="35" required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                   <label for="father_fname">Father's First Name:</label>
                <input type="text" name="father_fname" id="father_fname" minlength="3"  pattern="[A-Za-z]+" title="Please enter a text only" maxlength="25" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="father_mname">Father's Middle Name:</label>
                <input type="text" name="father_mname" id="father_mname" minlength="3"  pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="father_lname">Father's Last Name:</label>
                <input type="text" name="father_lname" id="father_lname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="15" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                        <label for="sex">Gender:</label>
                        <select name="sex" id="sex" required>
                            <option value="">Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
    <div class="col-md-4">
    <div class="form-group">
        <label for="Nationality">Nationality:</label>
        <select id="Nationality" name="Nationality" required>
            <option value="">Select a country</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
        </select>
    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label for="mother_nationality">Mother's Nationality:</label>
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
        
                <div class="col-md-4">
    <div class="form-group">
        <label for="father_nationality">Father's Nationality:</label>
        <select name="father_natinality" id="father_natinality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>

            </div>



           
         






            <center>   <div class="form-">
    <input type="submit" name="submit" value="Submit" class="btn btn-success">
  
</div></center>
        </form>
        <?php endif; ?>
    </div>

</body>
</html>