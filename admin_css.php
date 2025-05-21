<?php 
  include_once('languge.php');

?>
<?php

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'child') {
    header("Location: login.php");
    exit();
}

$count_unread_sql = "SELECT COUNT(*) AS unread_count FROM birth_table WHERE c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count = $unread_row['unread_count'];
} else {
    $unread_count = 0; // Default to 0 if there's an error
}
//child


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count_child FROM birth_table 
                     INNER JOIN user ON birth_table.username = user.username 
                     WHERE birth_table.c_status='unread' AND user.usertype = 'child'";

$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
    $unread_row = mysqli_fetch_assoc($count_unread_result);
    $unread_count_child = $unread_row['unread_count_child'];
} else {
    $unread_count_child = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count_child'] = $unread_count_child;
// Mark comments as read when the manager views them

//death

if (isset($_SESSION['unread_count1'])) {
  $unread_count1 = $_SESSION['unread_count1'];
} else {
  $unread_count1 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count1 FROM death_table WHERE c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count1 = $unread_row['unread_count1'];
} else {
  $unread_count1 = 0; // Default to 0 if there's an error
}

//divorce

if (isset($_SESSION['unread_count2'])) {
  $unread_count2 = $_SESSION['unread_count2'];
} else {
  $unread_count2 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count2 FROM divorce_table WHERE c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count2 = $unread_row['unread_count2'];
} else {
  $unread_count2 = 0; // Default to 0 if there's an error
}
//marriage

if (isset($_SESSION['unread_count3'])) {
  $unread_count3 = $_SESSION['unread_count3'];
} else {
  $unread_count3 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count3 FROM marriage_table WHERE c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count3 = $unread_row['unread_count3'];
} else {
  $unread_count3 = 0; // Default to 0 if there's an error
}

//account requst
if (isset($_SESSION['unread_count4'])) {
  $unread_count4 = $_SESSION['unread_count4'];
} else {
  $unread_count4 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count4 FROM user WHERE states = 'pending' and usertype='applicant' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count4 = $unread_row['unread_count4'];
} else {
  $unread_count4 = 0; // Default to 0 if there's an error
}
//child account


if (isset($_SESSION['unread_count5'])) {
  $unread_count5 = $_SESSION['unread_count5'];
} else {
  $unread_count5 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count5 FROM user WHERE states = 'pending' AND usertype='child' AND c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count5 = $unread_row['unread_count5'];
} else {
  $unread_count5 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count5'] = $unread_count5;
// Mark comments as read when the manager views them
//birth paymnt

if (isset($_SESSION['unread_count7'])) {
  $unread_count7 = $_SESSION['unread_count7'];
} else {
  $unread_count7 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count7 FROM payemnt WHERE event_type = 'birth' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count7 = $unread_row['unread_count7'];
} else {
  $unread_count7 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count7'] = $unread_count7;
//approve birth payemnt

if (isset($_SESSION['unread_count8'])) {
  $unread_count8 = $_SESSION['unread_count8'];
} else {
  $unread_count8 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count8 FROM payemnt WHERE  event_type = 'death' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count8 = $unread_row['unread_count8'];
} else {
  $unread_count8 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count8'] = $unread_count8;

//approve divorce

if (isset($_SESSION['unread_count9'])) {
  $unread_count9 = $_SESSION['unread_count9'];
} else {
  $unread_count9 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count9 FROM payemnt WHERE event_type = 'divorce' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count9 = $unread_row['unread_count9'];
} else {
  $unread_count9 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count9'] = $unread_count9;

//marriage

if (isset($_SESSION['unread_count10'])) {
  $unread_count10 = $_SESSION['unread_count10'];
} else {
  $unread_count10 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count10 FROM payemnt WHERE event_type = 'marriage' and c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count10 = $unread_row['unread_count10'];
} else {
  $unread_count10 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count10'] = $unread_count10;
//upgrade
if (isset($_SESSION['unread_count55'])) {
  $unread_count55 = $_SESSION['unread_count55'];
} else {
  $unread_count55 = 0; // Default to 0 if the session variable is not set
}


// Count the number of unread comments for the manager
$count_unread_sql = "SELECT COUNT(*) AS unread_count55 FROM user WHERE states = 'approved' and usertype='child' AND upgrade_status='upgrade' AND c_status='unread'";
$count_unread_result = mysqli_query($conn, $count_unread_sql);

if ($count_unread_result) {
  $unread_row = mysqli_fetch_assoc($count_unread_result);
  $unread_count55 = $unread_row['unread_count55'];
} else {
  $unread_count55 = 0; // Default to 0 if there's an error
}
$_SESSION['unread_count55'] = $unread_count55;

//sum
$result1 = $unread_count4 + $unread_count5 + $unread_count55;
$result2 = $unread_count + $unread_count_child + $unread_count1 + $unread_count2 + $unread_count3;
$result3 = $unread_count7 + $unread_count8 + $unread_count9 +$unread_count10 ;
//upgrade

mysqli_close($conn); // Close the database connection
?>



<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'header1.php'; ?>
  <link rel="stylesheet" href="bootstrap.min.css">



  <style>
    /* Custom styles */
    .jumbotron {
      background-color:rgba(0, 111, 170, 0);
    }

    html, body {
      height: 100%;
      margin: 0;
    }

    .navbar {
      font-size: 14px;
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
      background-color:rgba(0, 0, 0, 0.81);
      color:white;
    }

    .content-wrap {
      min-height: calc(100vh - 136px);
      padding-bottom: 6px;
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
    background-color:rgb(0, 0, 0);
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
</head>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container-secondary">
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
          <a class="nav-link active" href="Civil_registrar.php"><?= __('Home')?></a>
        </li>
      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Account Request')?>(<?php echo $result1; ?>)
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Account_Requset.php"><?= __('Account Request')?>(<?php echo $unread_count4; ?>)</a>
            <a class="dropdown-item" href="Account_Requset_child.php"><?= __('Child Account Request')?>(<?php echo $unread_count5; ?>)</a>
            <a class="dropdown-item" href="upgrade_requset.php"><?= __('Account upgrade Request')?>(<?php echo $unread_count55; ?>)</a>

            <div class="dropdown-divider"></div>
        
          </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Vital Event Request')?>(<?php echo $result2; ?>)
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Vital_event_Requset_birth.php"><?= __('Birth Application')?>Birth Application(<?php echo $unread_count; ?>)</a>
            <a class="dropdown-item" href="Vital_event_Requset_child.php"><?= __('Child Birth Application')?>(<?php echo $unread_count_child; ?>)</a>
            <a class="dropdown-item" href="Vital_event_Requset_death.php"><?= __('Death Application')?>(<?php echo $unread_count1; ?>)</a>
            <a class="dropdown-item" href="Vital_event_Requset_divorce.php"><?= __('Divorce Application')?>(<?php echo $unread_count2; ?>)</a>
            <a class="dropdown-item" href="Vital_event_Requset_marriage.php"><?= __('Marriage Application')?>(<?php echo $unread_count3; ?>)</a>
        
            <div class="dropdown-divider"></div>
        
          </div>
  </li>

  <li class="nav-item">
          <a class="nav-link active" href="view_customer_kebele.php"><?= __('View Applicant')?></a>
        </li>

  
        <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Applicants Application')?>  
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="view_vital_event_civil_registrar_birth.php"><?= __('Birth Application')?></a>
            <a class="dropdown-item" href="view_vital_event_civil_registrar_death.php"><?= __('Death Application')?></a>
            <a class="dropdown-item" href="view_vital_event_civil_registrar_divorce.php"><?= __('Divorce Application')?></a>
            <a class="dropdown-item" href="view_vital_event_civil_registrar_marriage.php"><?= __('Marriage Application')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
      </li>
      
      <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Comment')?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Send_comment.php"><?= __('Send Comment')?></a>
            <a class="dropdown-item" href="view_replay_message1.php"><?= __('Manger Response')?></a>
        
            <div class="dropdown-divider"></div>
        
          </div>
      </li>
        <li class="nav-item">
          <a class="nav-link active" href="View_feedback.php"><?= __('View Feedback')?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link  active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= __('Approve Payment')?> (<?php echo $result3; ?>)
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Approve_birth_payemnt.php"><?= __('Birth Payment')?>(<?php echo $unread_count7; ?>)</a>
            <a class="dropdown-item" href="Approve_death_payemnt.php"><?= __('Death payment')?>(<?php echo $unread_count8; ?>)</a>
            <a class="dropdown-item" href="Approve_Divorce_payemnt.php"><?= __('Divorce Payment')?>(<?php echo $unread_count9; ?>)</a>
            <a class="dropdown-item" href="Approve_marraige_payemnt.php"><?= __('Marriage Payment')?>(<?php echo $unread_count10; ?>)</a>
        
            <div class="dropdown-divider"></div>
        
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="appointment_menu.php"><?= __('Give Appointment')?></a>
        </li>
        <li class="nav-item dropdown">
    <a class="nav-link active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?= __('Logout')?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="logout.php"><?= __('Logout')?></a>
        <a class="dropdown-item" href="change_password_kebele.php"><?= __('Change Password')?></a>
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