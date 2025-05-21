<?php 
  include_once('languge.php');
  include('scroll_css.php');
?>
<?php
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'Civil_registrar' || $_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'child') {
    header("Location: login.php");
    exit();
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applicant Page</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Custom styles */
    .jumbotron {
      background-color:rgba(73, 140, 184, 0.47);
    }

    html, body {
      height: 100%;
      margin: 0;
    }

    .navbar {
      font-size: 16px;
    }

    .navbar-brand {
      font-weight: bold;
      margin-left: 0;
     
    }

    .navbar-nav .nav-link {
      line-height: 30px;
      font-weight: bold;

    }

    .custom-navbar {
      background-color: #0a0d36;
      color:white;
    }

    .content-wrap {
      min-height: calc(100vh - 136px);
      padding-bottom: 60px;
    }

    footer {
      width: 100%;
      padding: 10px 0;
      background-color:rgb(0, 110, 185);
      color: white;
      text-align: center;
      position: relative;
      bottom: 0;
      border-bottom: solid 1px black;
      border-bottom-left-radius: 50px;
      border-bottom-right-radius: 50px;
    }

    .profile-picture {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
    }
    .navbar-nav .nav-link {
  line-height: 50px;
  font-weight: bold;
  white-space: nowrap; /* Prevent line breaks */
  margin-left: 10px;
}
.dropdown-menu {
    background-color:rgb(0, 110, 185);
  }
  .dropdown-item {
    color: white;
    
  }
  .navbar-nav .nav-link:hover {
     
      background-color: white;
      color: black !important;
      border-radius: 20px;
    }
    /* Hide the dropdown icon for "Vital Event Request" link */

    td {
        padding: 10px 0; /* Adjust as needed */
        background-color:rgb(255, 255, 255);
    }

  </style>
</head>
<?php include 'header1.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container-secondary">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link active" href="applicant.php"><?= __('Home')?></a>
        </li>
 
      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Register vital Event')?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="register_vital_event_birth.php"><?= __('Birth Application')?></a>
            <a class="dropdown-item" href="child.php"><?= __('Child Birth Application')?></a>
            <a class="dropdown-item" href="register_vital_event_divorce.php"><?= __('Divorce Application')?></a>
            <a class="dropdown-item" href="register_vital_event_merrage.php"><?= __('Marriage Application')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
      </li>

      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('My application')?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="view_birth_application.php"><?= __('Birth Application')?></a>
            <a class="dropdown-item" href="view_divorce_application.php"><?= __('Divorce Application')?></a>
            <a class="dropdown-item" href="view_marriage_application.php"><?= __('Marriage Application')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
      </li>
    
      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Print certificate')?>
          </a> 
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="print_vital_event_birth.php"><?= __('Birth Certificate')?></a>
            <a class="dropdown-item" href="print_vital_event_divorce.php"><?= __('Divorce Certificate')?></a>
            <a class="dropdown-item" href="print_vital_event_merrage.php"><?= __('Marriage Certificate')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
              
      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?= __('Feedbacks')?>
          </a> 
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="feedback.php"><?= __('Send Feedback')?></a>
            <a class="dropdown-item" href="view_replay message.php"><?= __('View feedback')?></a>
           
        
            <div class="dropdown-divider"></div>
        
          </div>
      </li>
      

          
      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Send payment')?>
          </a> 
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="send_payemnt_birth.php"><?= __('Birth Payment')?></a>
            <a class="dropdown-item" href="send_payemnt_divorce.php"><?= __('Divorce Payment')?></a>
            <a class="dropdown-item" href="send_payemnt_marrige.php"><?= __('Marriage Payment')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link active" href="view_appointemnt.php"><?= __('View appointment')?></a>
        </li>
        <li class="nav-item dropdown">
    <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?= __('Logout')?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="logout.php"><?= __('Logout')?></a>
        <a class="dropdown-item" href="change_password.php"><?= __('Change Password')?></a>
        <div class="dropdown-divider"></div>
    </div>
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
