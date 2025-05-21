<?php 
  include_once('languge.php');

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applicant Page</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <?php include 'header1.php'; ?>
  <style>
    /* Custom styles */
    .jumbotron {
      background-color:rgba(0, 111, 170, 0.19);
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
  
.language-dropdown {
    position: relative;
    display: inline-block;
    margin: 4px;
    position: fixed;
    top: 76px;
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
    border-radius: 4px;
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
          <a class="nav-link active" href="view_death_dashbored.php"><?= __('Home')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="view_death_application.php"><?= __('View Death Application')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="print_vital_event_death.php"><?= __('Print Death Certificate')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="send_payemnt_death.php"><?= __('Send payment')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="view_appointemnt_death.php"><?= __('View appointment')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="exit.php"><?= __('Logout')?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

</footer>

<!-- First, include jQuery -->
<script src="new/jquery-3.5.1.slim.min.js"></script>

<!-- Then, include Popper.js -->
<script src="new/popper.min.js"></script>

<!-- And finally, include Bootstrap JS -->
<script src="bootstrap.min.js"></script>