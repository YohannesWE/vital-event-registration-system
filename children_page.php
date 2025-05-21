
<?php 
  include_once('languge.php');
  include('scroll_css.php');
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>childran Page</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Custom styles */
    .jumbotron {
      background-color: #f6e9ff;
    }

    html, body {
      height: 100%;
      margin: 0;
    }

    .navbar {
      font-size: 18px;
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
      background-color: #5d5cde;
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
    background-color:#5d5cde ;
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

    

  </style>
</head>
<?php include 'header1.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container-secondry">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link active" href="children.php"><?= __('Home')?></a>
        </li>
      <li class="nav-item">
          <a class="nav-link active" href="register_vital_event_birth_child.php"><?= __('Child Birth Application')?></a>
        </li>
    
        <li class="nav-item">
          <a class="nav-link active" href="view_birth_application_child.php"><?= __('My application')?></a>
        </li>
 
       
        <li class="nav-item">
          <a class="nav-link active" href="print_vital_event_birth_child.php"><?= __('Print certificate')?></a>
        </li>

      
        
        <li class="nav-item">
          <a class="nav-link active" href="send_payemnt_birth_child.php"><?= __('Send payment')?></a>
        </li>
              
        <li class="nav-item">
          <a class="nav-link active" href="upgrade.php"><?= __('Upgrade to Applicant')?></a>
        </li>
   
        <li class="nav-item dropdown">
    <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?= __('Logout')?> 
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="logout.php"><?= __('Logout')?></a>
        <a class="dropdown-item" href="change_password_child.php"><?= __('Change Password')?></a>
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