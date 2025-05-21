<?php 
  include('languge.php');
  include('scroll_css.php');
?>
<?php
    include 'head_login.php';
    ?>
  <meta charset="UTF-8">
  <meta name="description" content="Vital Event Registration System - Register your vital events with ease.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vital Event Registration System</title>
  
    <meta http-equiv='refresh' content='120'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <style>
        /* Style for panel */
        #panel {
            background-color: #f8f9fa;
            border: 1px solidrgb(0, 128, 255);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(255, 0, 0, 0.1);
        }

        /* Style for size2 */
        .size2 {
            font-size: 18px;
            margin-top: 20px;
            text-align: center;
        }

        /* Style for dark color */
        .dark {
            color:rgb(0, 110, 185); /* Dark text color */
            font-weight: bold;
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
         body {
            background-color:rgba(0, 111, 170, 0.19);
   
        }
    /* Custom styles */
    .jumbotron {
      background-color:rgba(0, 111, 170, 0.19);
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
      min-height: calc(100vh - 136px); /* Adjusted for image height */
    }

    .feature-icon {
      font-size: 19px; /* Increased icon size */
      margin-bottom: 20px;
    }

    .feature-heading {
      font-size: 20px; /* Increased heading size */
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

    .container-fluid {
      width: 100%;
      padding-right: 15px; /* Added padding */
      padding-left: 15px; /* Added padding */
    }

    .custom-navbar {
      background-color:#006eb9;
    }

    .dropdown-menu {
      background-color:#006faa;
    }

    .dropdown-item {
      color: white;
    }
    .navbar-nav .nav-link.login-button {
  background-color: #28a745; /* Green background color */
  color: #fff; /* White text color */
  padding: 10px 20px; /* Padding for the button */
  border-radius: 25px; /* Rounded corners */
  transition: background-color 0.3s; /* Smooth transition for background color change */
}

.navbar-nav .nav-link.login-button:hover,
.navbar-nav .nav-link.login-button:focus {
  background-color: #218838; /* Darker green on hover or focus <img src="NB.jpg" alt="Header Image" style="width: 100%; height: 150px;">*/
}
.language-dropdown {
    position: relative;
    display: inline-block;
    margin: 4px;
    position: fixed;
    top: 120px;
    right: 20px;
    z-index: 1000;
    font-family: sans-serif;

}

.language-dropdown button {
    background-color: #006eb9;
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
</head>
<body>

<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="index_am.php?lang=am_ET">አማ</a>
        <a href="index.php?lang=en_US">En</a>
        <a href="index_or.php?lang=or_ET">AO</a>
    </div>
    </div>
<div class="container-fluid">

<div class="container-fluid">

<div id="panel">
    <!-- Content for panel goes here -->


<div class="size2">
    <span class="dark"><?= __('TIME')?>:</span>
    <span class="dark">
        <?php
        $Today = date('l, F d, Y');
        echo $Today;
        ?>
    </span>
</div></div>
<h3 class="text-center" style="font-size: 20px;"><strong><?= __('Welcome') ?></strong></h3>
<h3 class="text-center" style="font-size: 20px;"><strong><?= __('Register your vital events with ease') ?></strong></h3>   </div>


 </div>
<div class="content-wrap">
  <div class="jumbotron jumbotron-fluid text-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 text-center">
        <span class="feature-icon">📅</span>
        <h3 class="feature-heading"><?= __('Births')?></h3>
        <p class="feature-description"><?= __('Register births online and manage birth records securely')?>.</p>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <span class="feature-icon">⃝</span>
        <h3 class="feature-heading"><?= __('Marriages')?></h3>
        <p class="feature-description"><?= __('Record marriages and maintain marriage certificates digitally')?>.</p>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
    <span class="feature-icon">💀</span>
    <h3 class="feature-heading"><?= __('Deaths')?></h3>
    <p class="feature-description"><?= __('Submit death certificates electronically for efficient processing')?>.</p>
</div>


      <div class="col-lg-3 col-md-6 text-center">
      <span class="feature-icon">💔</span>
        <h3 class="feature-heading"><?= __('Divorces')?></h3>
        <p class="feature-description"><?= __('Apply for divorces and manage divorce documents')?>.</p>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <img src="etwe.jpg" class="img-responsive equal-image" alt="Image 1">
      </div>
      <div class="col-md-6">
        <img src="kaa.webp" class="img-responsive equal-image" alt="Image 2">
      </div>
    
    </div>
  </div><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
      <img src="mg01.jpg" class="img-responsive equal-image" alt="Image 3">
      </div>
      <div class="col-md-6">
        <img src="merriag.jpg" class="img-responsive equal-image" alt="Image 2">
      </div>
    </div>
  </div>



<footer class="text-light text-center py-2 mt-4">
  <h6>© 2025 Kirkos Sub City wereda 02 Vital Event Registration System</h6>
</footer>

<!-- Latest compiled jQuery -->
<script src="jquery-3.6.0.min.js"></script>
<!-- Latest compiled Popper.js -->
<script src="popper.min.js"></script>
<!-- Latest compiled Bootstrap JS -->
<script src="bootstrap.min.js"></script>

</body>
</html>
