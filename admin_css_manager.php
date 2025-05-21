<?php 
  include_once('languge.php');
  include('scroll_css.php');
?>
<?php
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'Civil_registrar' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'child') {
    header("Location: login.php");
    exit();
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager Page</title>
  <link rel="stylesheet" href="bootstrap.min.css">

  <?php include 'header1.php'; ?>

</head>

<style>

  body 
  {
     background-color:rgba(0, 111, 170, 0.47);
  }
    /* Custom styles */
    .jumbotron {
      background-color:rgba(0, 111, 170, 0);
    }

    html, body {
      height: 100%;
      margin: 0;
    }

    .navbar {
      font-size: 15px;
    }

    .navbar-brand {
      font-weight: bold;
      margin-left: 0;
     
    }

    .navbar-nav .nav-link {
      line-height: 26px;
      font-weight: bold;

    }

    .custom-navbar {
      background-color:rgba(0, 0, 0, 0.84);
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
    background-color: #f1f1f1;
    color: black;
}

.language-dropdown:hover .language-options {
    display: block;
}

  </style>
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container-secondary">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link active" href="manager.php"><?= __('Home')?></a>
        </li>

     
        <li class="nav-item">
          <a class="nav-link active" href="take_backup.php"><?= __('Database Backup')?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Generate Report')?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Genarte_Report.php"><?= __('Birth Report')?></a>
            <a class="dropdown-item" href="genrate_report_death.php"><?= __('Death Report')?></a>
            <a class="dropdown-item" href="genrate_report_divorce.php"><?= __('Divorce Report')?></a>
            <a class="dropdown-item" href="genrate_report_marriage .php"><?= __('Marriage Report')?></a>
            <a class="dropdown-item" href="genrate_report_user.php"><?= __('User Report')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="view_customer_man.php"><?= __('View Applicant')?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Applicants Application')?> 
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="view_vital_event_man_birth.php"><?= __('Birth Application')?></a>
            <a class="dropdown-item" href="view_vital_event_man_death.php"><?= __('Death Application')?></a>
            <a class="dropdown-item" href="view_vital_event_man_divorce.php"><?= __('Divorce Application')?></a>
            <a class="dropdown-item" href="view_vital_event_man_Marriage.php"><?= __('Marriage Application')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
          <li class="nav-item">
          <a class="nav-link active" href="update payment.php"><?= __('Payment Info')?></a>
        </li>
        </li>
     
        <li class="nav-item">
          <a class="nav-link active" href="View_comment.php"><?= __('View Comments')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="mange_user_manager.php"><?= __('Manage User')?></a>
        </li>

        <li class="nav-item dropdown">
    <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?= __('Logout')?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="logout.php"><?= __('Logout')?></a>
        <a class="dropdown-item" href="change_password_man.php"><?= __('Change Password')?></a>
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