
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='customer'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='kebele employee'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
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
    <title>Manger Page</title>
    <link rel="stylesheet" type="text/css" href="user.css">
     <!-- Latest compiled and minified CSS -->
     <?php
    include 'admin_css.php';
    ?>
</head>
<body>
<header class="header">
    <a href=""> Manger Page </a>
    <div class="logout">
        <a href="logout.php" class="btn btn-primary">Logout</a>
    </div>
  </header>
  <aside>
    <ul class="ui">
    <li>
            <a href="view_vital_event_man_birth.php"> Birth Event</a>
        </li>
        <li>
            <a href="view_vital_event_man_death.php"> Death Event</a>
        </li>
        <li>
            <a href="view_vital_event_man_Marriage.php">Marriage Event</a>
        </li>
        <li>
            <a href="view_vital_event_man_Divorce.php">Divorce Event</a>
        </li>
        <li>
            <a href="manger.php">Back</a>
        </li>

    </ul>
  </aside>
  <div class="content">
  <h1>
    View Vital_Event
  </h1>
  </div>
</body>
</html>