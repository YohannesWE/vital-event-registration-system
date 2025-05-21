<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='manager'){
    header("location:login.php");
}elseif($_SESSION['usertype']=='child'){
  header("location:login.php");
}elseif($_SESSION['usertype']=='Civil_registrar'){
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
$currentUsername = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applicant Page</title>

  <?php include 'scroll_css.php'; ?>
  <?php include 'admin_css1_applicant.php'; ?>
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
    .language-dropdown {
    position: relative;
    display: inline-block;
    margin: 4px;
    position: fixed;
    top: 100px;
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
    background-color: rgba(73, 140, 184, 0.47);
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
    background-color:rgba(73, 140, 184, 0.47);
    color: black;
}

.language-dropdown:hover .language-options {
    display: block;
}
footer {
    
    bottom: 0;
    width: 100%;
    padding: 10px 0;
    background-color:rgb(0, 110, 185);
    color: white;
    text-align: center;
    z-index: 1000;
    border-bottom: solid 1px black;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
  }

  footer p {
    font-size: 16px; /* Adjusted font size */
  }

  </style>
  
</head>
<body>
<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="applicant.php?lang=am_ET">አማ</a>
        <a href="applicant.php?lang=en_US">En</a>
        <a href="applicant.php?lang=or_ET">AO</a>
    </div>
    </div>

<div class="content-wrap">
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <h5 class="display-45"><?= __('Welcomee')?>, <?php echo $currentUsername; ?>!!</h5>
      <h5 class="lead"><?= __('This is your personalized applicant Page')?>.</h5>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <img src="wee.webp" class="img-responsive equal-image" alt="Image 1">
      </div>
      <div class="col-md-6">
        <img src="kaa.webp" class="img-responsive equal-image" alt="Image 2">
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
  <p>&copy;<?= __('2024 applicant Portal')?> </p>
</footer>




</body>
</html>
