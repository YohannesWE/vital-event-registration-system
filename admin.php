<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='manager'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='Civil_registrar'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='applicant'){
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

<?php


// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit(); // Exit to prevent further execution
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch username from the database

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'scroll_css.php'; ?>
<?php include 'admin_css_admin.php'; ?>

   <head>
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
    .language-dropdown {
    position: relative;
    display: inline-block;
    margin: 4px;
    position: fixed;
    top: 95px;
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
    background-color:rgba(0, 111, 170, 0.25);
    color: black;
}

.language-dropdown:hover .language-options {
    display: block;
}
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
        <a href="admin.php?lang=am_ET">አማ</a>
        <a href="admin.php?lang=en_US">En</a>
        <a href="admin.php?lang=or_ET">AO</a>
    </div>
    </div>

  <div class="content-wrap">
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">

      <h5 class="display-45"><center><?= __('Welcomee')?>, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></center> </h5>
      <h5 class="lead"><?= __('This is your personalized adminstrator page')?>.</h5>
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
  <footer class="bg-#5d5cde text-light text-center py-3">
  <p class="m-0">&copy;<?= __('2025 Admin Portal. All rights reserved')?> .</p>
</footer>



</body>
</html>
