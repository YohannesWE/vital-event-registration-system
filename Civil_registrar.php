<?php
session_start();
$username = $_SESSION["username"];


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Civil Registrar Page</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <?php include 'scroll_css.php'; ?>
  <?php include 'admin_css.php'; ?>
  <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
  
        }
    </style>
      <style>
  body {
                background-color:rgba(0, 111, 170, 0.47);

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
<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="Civil_registrar.php?lang=am_ET">አማ</a>
        <a href="Civil_registrar.php?lang=en_US">En</a>
        <a href="Civil_registrar.php?lang=or_ET">AO</a>
    </div>
    </div>

<div class="content-wrap">
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">

      <h5 class="display-45"><?= __('Welcomee')?>, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>!</h5>
      <h5 class="lead"><?= __('This is your personalized civil Registrar page')?>.</h5>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <img src="civil_2.jpg" class="img-responsive equal-image" alt="Image 1">
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

<footer class="bg-#5d5cde text-light text-center">
  <p>&copy; 2024 Civil Registrar Portal</p>
</footer>



</body>
</html>
