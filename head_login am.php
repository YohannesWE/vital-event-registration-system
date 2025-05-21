<?php
include_once 'languge.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Vital Event Registration System - Register your vital events with ease.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vital Event Registration System</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <style>
    /* Custom styles */
    .jumbotron {
      background-color:rgba(0, 111, 170, 0.47);
    }

    html, body {
      height: 100%;
      margin: 0;
    }

    .navbar {
      padding: 30px 15px; /* Adjusted padding */
      font-weight:bold;
    }

    .navbar-brand {
      font-size: 22px;
      font-weight: bold;
    }

    .navbar-nav .nav-link {
      line-height: 40px;
      font-family: sans-serif;
      font-weight: bold;
      font-size: 18px; /* Increased font size */
    }

    .content-wrap {
      min-height: calc(100vh - 256px); /* Adjusted for image height */
    }

    .feature-icon {
      font-size: 64px; /* Increased icon size */
      margin-bottom: 20px;
    }

    .feature-heading {
      font-size: 25px; /* Increased heading size */
      margin-bottom: 10px;
    }

    .feature-description {
      font-size: 18px; /* Increased description size */
      color: #555;
    }

    footer {
    
      bottom: 0;
      width: 100%;
      padding: 10px 0;
      background-color:rgba(0, 111, 170, 0.47);
      color: white;
      text-align: center;
      z-index: 1000;
      border-bottom: solid 1px black;
      border-bottom-left-radius: 50px;
      border-bottom-right-radius: 50px;
    }

    footer p {
      font-size: 14px; /* Adjusted font size */
    }

    .container-fluid {
      width: 100%;
      padding-right: 14px; /* Added padding */
      padding-left: 14px; /* Added padding */
    }

    .custom-navbar {
      background-color:rgb(0, 110, 185);
    }

    .dropdown-menu {
      background-color:rgb(0, 110, 185);
    }

    .dropdown-item {
      color: white;
    }
    .navbar-nav .nav-link.login-button {
  background-color: #28a745; /* Green background color */
  color: #fff; /* White text color */
  padding: 10px 18px; /* Padding for the button */
  border-radius: 22px; /* Rounded corners */
  transition: background-color 0.3s; /* Smooth transition for background color change */
}

.navbar-nav .nav-link.login-button:hover,
.navbar-nav .nav-link.login-button:focus {
  background-color: #218838; /* Darker green on hover or focus */
}

  </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container-fluid">
  <img src="\ksw02\logo.png"width="100" height="90" title="Logo of a company" alt="Logo of a company" />  <a class="navbar-brand" href="#" style="font-weight: bold; font-size: 19px;">በቂ/ክ/ከ/ወ/02 የወሳኝ ኩነት ምዝገባ አገልግሎት ጽ/ቤት</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index_am.php"><?= __('home')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="about_us_am.php"><?= __('About')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="contactus_am.php"><?= __('Contact')?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Death Applications')?> 
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="register_vital_event_death_am.php"><?= __('Register Death Application')?></a>
            <a class="dropdown-item" href="view_death_check_am.php"><?= __('View Death Application')?></a>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="login_am.php"><?= __('Login')?></a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>

<!-- First, include jQuery -->
<script src="new/jquery-3.5.1.slim.min.js"></script>

<!-- Then, include Popper.js -->
<script src="new/popper.min.js"></script>

<!-- And finally, include Bootstrap JS -->
<script src="bootstrap.min.js"></script>