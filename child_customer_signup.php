<?php
  
  $conn = mysqli_connect("localhost", "root", "", "vital_event");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_POST['signup'])) {
      $fullName = $_POST['full_name'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $password = $_POST['password'];
      $religion = $_POST['religion'];
      $states = "pending";
      $usertype = "applicant";
      $file = $_FILES['image']['name'];
      $fileType = $_FILES['image']['type'];
      $dst = "./image/" . $file;
      $dst_db = "image/" . $file;

      // Check if the uploaded file is a PDF
      if ($fileType !== 'application/pdf') {
          echo '<script>alert("Please select a PDF file for the Kebele ID.");</script>';
          exit;
      }

      move_uploaded_file($_FILES['image']['tmp_name'], $dst);

      // Check if theusername already exists
      $checkQuery = "SELECT * FROM user WHERE username = '$username'";
      $checkResult = mysqli_query($conn, $checkQuery);

      if (mysqli_num_rows($checkResult) > 0) {
          // Username already exists
          echo '<script>alert("Username already exists. Please choose a different username.");</script>';
      } else {
          // Username doesn't exist, proceed with inserting the data into the database
          // Prepare the SQL statement
          $sql = "INSERT INTO user (full_name, username, email, usertype, phone,religion, password, k_id, states) VALUES ('$fullName', '$username', '$email', '$usertype', '$phone', '$religion','$password', '$dst_db', '$states')";

          $result = mysqli_query($conn, $sql);
          if ($result) {
              echo '<script>alert("Your request has been successfully submitted.");</script>';
          }
      }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customer Signup</title>
    <link rel="stylesheet" type="text/css" href="user.css">
    <style>
        body {
       
            justify-content: center;
            align-items: center;

            background-color: #f6e9ff;
         
        }

        .admission_form {

            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
   
        }

        h1 {
            color: #007bff;
            font-size: 24px;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="religion"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        input[type="submit"]
         {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover
        :hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>

    <div class="admission_form">
        <h1> Signup page </h1>
        <form method="POST" autocomplete="off" enctype="multipart/form-data">
            <div>
                <label>Full Name</label>
                <input type="text" name="full_name" required>
            </div><br>
            <div>
                <label>Username</label>
                <input type="text" name="username" id="Username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"  readonly required>
            </div><br>
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div><br>
            <div>
                <label>Phone number</label>
                <input type="number" name="phone" required min="0" minlength="10">
            </div><br>
            <div>
                <label>Religion</label>
                <input type="religion" name="religion" required>
            </div><br>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div><br>
            <div>
                <label>Scanned Kebele ID (PDF Only)</label>
                <input type="file" name="image" accept=".pdf" required>
            </div><br>
            <div class="button-container">
                <input type="submit" name="signup" value="Sign Up">
               
            </div>
          
        </form>
    </div>


</body>
</html>