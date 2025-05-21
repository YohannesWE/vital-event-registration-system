<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "vital_event");
include('languge.php');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = ""; // Variable to store messages

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $view_code = $_POST["view_code"];
    $k_id_no = $_POST["k_id_no"];
    
    // Check if the event exists with the provided view code and k_id_no
    $existingEventQuery = "SELECT * FROM death_table WHERE view_code = '$view_code' AND k_id_no = '$k_id_no'";
    $existingEventResult = mysqli_query($conn, $existingEventQuery);

    if (mysqli_num_rows($existingEventResult) > 0) {
        // Check if the Death_states column is set to "pending"
        $pendingQuery = "SELECT * FROM death_table WHERE view_code = '$view_code' AND k_id_no = '$k_id_no' AND Death_states = 'pending'";
        $pendingResult = mysqli_query($conn, $pendingQuery);

        if (mysqli_num_rows($pendingResult) > 0) {
            $message = "Your request is not approved yet. It is under process.";
        } else {
            $message = "Your request has already been approved.";
            $_SESSION['k_id_no'] = $k_id_no;
            $_SESSION['view_code'] = $view_code;
            header("Location: view_death_dashbored.php");
            exit();
        }
    } else {
        // Check if the view_code is invalid
        $existingViewCodeQuery = "SELECT * FROM death_table WHERE view_code = '$view_code'";
        $existingViewCodeResult = mysqli_query($conn, $existingViewCodeQuery);

        if (mysqli_num_rows($existingViewCodeResult) == 0) {
            $message = "Error! Invalid view code.";
        } else {
            // Check if the k_id_no is not registered
            $existingKIdNoQuery = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no'";
            $existingKIdNoResult = mysqli_query($conn, $existingKIdNoQuery);

            if (mysqli_num_rows($existingKIdNoResult) == 0) {
                $message = "There is no registered death event for this user.";
            } else {
                // Display message for incorrect combination
                $message = "Incorrect   viewer code or kebele ID number.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Death Application</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <?php include 'scroll_css.php'; ?>
    <?php include 'head_login or.php'; ?>
    <style>
    .message-container {
        margin-top: 20px;
        padding: 10px;
        background-color:rgba(0, 111, 170,);
        color: #721c24;
        border: 1px solid rgba(0, 111, 170,);
        border-radius: 5px;
        text-align: center;
    }
</style>

    <style>
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        label {
            color:black;
            padding: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            color: black;
        }
        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
            margin-top: 10px;
        }
        .form-group input[type="submit"] {
            width: auto;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
            background-color:rgb(0, 0, 0);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }
        .form-group input[type="submit"] {
            width: auto;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group input[type="submit"]:hover {
            background-color:rgb(22, 64, 31);
        }
        .back-btn {
            background-color: #dc3545;
            margin-right: 10px;
        }
        .back-btn:hover {
            background-color: #c82333;
        }
        .message-container {
            margin-top: 20px;
            text-align: center;
        }
        .container{
            margin-top: 40px;
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
        <a href="view_death_check_am.php?lang=am_ET">አማ</a>
        <a href="view_death_check.php?lang=en_US">En</a>
        <a href="view_death_check_or.php?lang=or_ET">AO</a>
    </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h4 class="text-center"><?= __('View Death Application')?></h4>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="message-container">
                        <?php echo $message; ?>
                    </div>
                        <div class="form-group">
                            <label for="view_code"><?= __('Enter your viewer code')?>:</label><br>
                            <input type="text" id="view_code" name="view_code" placeholder="Enter viewer code" required>
                        </div>
                        <div class="form-group">
                            <label for="k_id_no"><?= __('Enter the kebele id of the deceased person')?>:</label>
                            <input type="text" id="k_id_no" name="k_id_no" placeholder="Enter kebele id number" required>
                        </div>
                        <center>
                            <div class="form-group">
                                <input type="submit" name="submit" value="<?= __('View Death Application')?>">
                                <input type="submit" name="submit" value="<?= __('Back')?>" onclick="redirectToLogin()">
                            </div>
                        </center>
                    </form>
                 
                </div>
            </div>
        </div>
    </div>
    <script>
        function redirectToLogin() {
            window.location.href = "index_or.php";
        }
    </script>
</body>
</html>
