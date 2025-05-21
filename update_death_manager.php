<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['k_id_no'])) {
    $k_id_no = $_GET['k_id_no'];

    // Establish connection to database
    $conn = mysqli_connect("localhost", "root", "", "vital_event");

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch user data from database
    $sql = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no'";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if(mysqli_num_rows($result) > 0) {
        // Fetch the view_code from the database
        $row = mysqli_fetch_assoc($result);
        $view_code = $row['view_code']; // Assign view_code to $view_code
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
        $sex = $_POST["Sex"];
        $nationality = $_POST["Nationality"];
        $death_date = $_POST["Death_date"];
   
        $death_place = $_POST["Death_place"];
        $marriage_status = $_POST["Marriage_status"];
        $child_number = $_POST["child_number"];
      
        $r_fname = $_POST["r_fname"];
        $r_mname = $_POST["r_mname"];
        $relationship_type = $_POST["Relationship_type"];

        // Update user data in database
        $update_sql = "UPDATE death_table SET email='$email', f_name='$f_name', m_name='$m_name', l_name='$l_name', Sex='$sex', Nationality='$nationality', Death_date='$death_date', Death_place='$death_place', child_number='$child_number', r_fname='$r_fname', r_mname='$r_mname', Relationship_type='$relationship_type' WHERE k_id_no='$k_id_no'";

        if(mysqli_query($conn, $update_sql)) {
            $message = "Application updated successfully";
        } else {
            $message = "Error updating record: " . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
} else {
    echo "Kebele ID number not provided";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
    <title>Update Death Application</title>
    <style>
            body {
                background-color:rgba(0, 111, 170, 0.47);

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

<div class="container" style="max-width: 1000px;">
    <center>
        <h5><center>Update Death Form</center></h5>
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>
    </center>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="k_id_no">Deceased Kebele ID Number:</label>
                    <input type="text" name="Username" id="Username" maxlength="50" value="<?php echo isset($_GET['k_id_no']) ? $_GET['k_id_no'] : ''; ?>" readonly required>
                </div>
            </div>
           
            
        </div>

        <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="f_name">Deceased First Name:</label>
                        <input type="text" name="f_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" id="f_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="m_name">Deceased Middle Name:</label>
                        <input type="text" name="m_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" id="m_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="l_name">Deceased Last Name:</label>
                        <input type="text" name="l_name" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" id="l_name" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Sex">Gender:</label>
                        <select name="Sex" id="Sex" required>
                            <option value="">Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
    <div class="form-group">
        <label for="Nationality">Nationality:</label>
        <select name="Nationality" id="Nationality" required>
            <option value="" selected disabled>Select Nationality</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Other">Other</option>
            <!-- Add more options as needed -->
        </select>
    </div>
</div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Death_date"> Date of death:</label>
                        <input type="date" name="Death_date" id="Death_date" required>
                    </div>
                    <script>
    // Get today's date in the format yyyy-mm-dd
    var today = new Date().toISOString().split('T')[0];

    // Set the max attribute of the Birthdate input element to today
    document.getElementById('Death_date').setAttribute('max', today);
</script>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Death_place">Place of Death :</label>
                        <input type="text" name="Death_place"  id="Death_place" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" required>
                    </div>
                </div>
               
            </div>
            <div class="row">
            <div class="col-md-6">
        <div class="form-group">
            <label for="Marriage_status">Marital status:</label>
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
                        <label for="child_number">Number of child:</label>
                        <input type="text" name="child_number" id="child_number" pattern="\b([1-9]|[1-3][0-9]|40)\b" title="Please enter a number between 1 and 40" required>
                    </div>
                </div>
            </div>
    
          
          

            <div class="row">
         
         <div class="col-md-4">
             <div class="form-group">
             <label for="r_fname">Registrant's Name(your name):</label>
         <input type="text" name="r_fname" id="r_fname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" >
             </div>
         </div>
         <div class="col-md-4">
         <div class="form-group">
             <label for="r_mname">Father Name:</label>
         <input type="text" name="r_mname" id="r_mname" minlength="3" pattern="[A-Za-z]+" title="Please enter a text only" maxlength="50" >
             </div>
         </div>
     
         <div class="col-md-4">
    <div class="form-group">
        <label for="Relationship_type">Relationship type:</label>
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


 
            <div class="form-group">
             <input type="submit" name="submit" value="Update" class="btn btn-success">   
                
            </div>
     
    </form>
</div>

</body>
</html>
