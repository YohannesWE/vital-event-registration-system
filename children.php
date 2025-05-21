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
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start the session




$currentUsername = $_SESSION['username'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'scroll_css.php'; ?>
    <?php include 'children_page.php'; ?>
    <title>children page</title>
    <style>
  body {
                background-color: #f6e9ff;

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
            .equal-image {
      height: 90%;
      width: 90%;
      object-fit: cover;
    }
  </style>
</head>

<body>
<div style="background-color:white; width:30%;">
<a class="btn btn-primary" href="children.php?lang=en_US" style="margin-left: 10px;">English</a>

<a class="btn btn-secondary " href="children.php?lang=or_ET" style="margin-left: 10px;">afaan oromo</a>
</div>



  <div class="content-wrap">
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <h2 class="display-4"><?= __('Welcomee')?>, <?php echo $currentUsername; ?>!!</h2>
      <h2 class="display-4" > <?= __('head')?></h2>
      
      <h2 class="lead"><?= __('This is your personalized children Page')?>.</h2>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <img src="applicants1.jpg" class="img-responsive equal-image" alt="Image 1">
      </div>
      <div class="col-md-6">
        <img src="applicantss2.webp" class="img-responsive equal-image" alt="Image 2">
      </div>
    
    </div>
  </div><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
      <img src="applicantss3.webp" class="img-responsive equal-image" alt="Image 3">
      </div>
      <div class="col-md-6">
        <img src="merriag.jpg" class="img-responsive equal-image" alt="Image 2">
      </div>
    </div>
  </div>

  <footer class="text-light text-center py-2 mt-4">
  <p>&copy;<?= __('2024 Child Portal')?> </p>
</footer>
</body>

</html>






































































