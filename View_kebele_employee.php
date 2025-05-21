<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='manger'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='kebele employee'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='customer'){
    header("location:login.php");
}
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>




<?php


// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin  Page</title>
    <?php
    include 'admin_css.php';
    ?>
</head>
<body>
  <header class="header">
    <a href=""> Admin  Page </a>
    <div class="logout">
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
  </header>
  <aside>
    <ul class="ui">
        <li>
            <a href="Register_kebele_Employee.php">Register kebele Employee</a>
        </li>
        <li>
            <a href="View_kebele_employee.php">View kebele Employee</a>
        </li>
        <li>
            <a href="view_customer.php">view Customer </a>
        </li>
      

    </ul>
  </aside>
  <div class="content">
   <h1>
here are kebele employee list
   </h1>
  </div>
</body>
</html>