<?php  	include_once 'languge.php'; ?>
<!DOCTYPE html>
<html lang="en">
<html lang="am_ET">
<html lang="or_ET">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Vital Event Registration</title>
    <?php
    include 'scroll_css.php';
    ?>
    <?php
    include 'head_login am.php';
    ?>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      background-color: rgba(0, 111, 170, 0.47);
      font-family: 'Segoe UI', sans-serif;
      overflow-y: scroll;
      
    }
    .about-us {
      padding: 50px;
      
    }
    .about-us h1 {
      font-size: 26px;
      margin-bottom: 15px;
      text-align: center;
      color: #003366;
      margin-top: 30px;
    }
    .about-us p {
      text-align: center;
      margin-bottom: 15px;
      font-size: 16px;
    }
    .about-us ul {
      margin: 0 auto 20px;
      padding-left: 40px;
      font-size: 16px;
      line-height: 1.6;
    }
    .about-us ul li {
      margin-bottom: 10px;
    }
    .team-members {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }
    .team-member {
      flex: 0 0 250px;
      background-color: rgba(0, 110, 185, 0.1);
      padding: 20px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    }
    .team-member img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    footer {
      margin-top: 30px;
      background-color: rgb(0, 110, 185);
      color: white;
      text-align: center;
      padding: 12px 0;
      border-bottom-left-radius: 50px;
      border-bottom-right-radius: 50px;
    }
    .language-bar {
      background-color: white;
      padding: 10px;
    }
    .language-bar .btn {
      margin-left: 10px;
      font-weight: bold;
    }
    .about-us ul {
    color:rgb(0, 102, 255);
    text-align: center;
    padding: 0px;
    padding-left: 320px;
    
  }
  .about-us ul li {
    list-style: disc;
    padding-left: 40px;
    font-size: 16px;
    color: black;
    text-align: left;
    margin-top: -8px;
  }
  h1 {
    font-size: 22px;
    margin-bottom: 10px;
    text-align: center;
    color: black;
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
<body>
<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="about_us_am.php?lang=am_ET">አማ</a>
        <a href="about_us.php?lang=en_US">En</a>
        <a href="about_us_or.php?lang=or_ET">AO</a>
    </div>
    </div>
<section class="about-us">
        <div class="container">
            <h1><?= __('About Vital Event Registration')?></h1>
            <p><?= __('Welcome to')?>.</p>
            
            <h1><?= __('Our Mission')?></h1>
            <p><?= __('Our mission is')?>.</p>
            
            <h1><?= __('Our Services')?></h1>
            <p><?= __('At Vital Event')?>:
            <ul>
                <li><a href="birth_registration.php"><?= __('Birth Registration') ?></a></li>
                <li><a href="marriage_registration.php"><?= __('Marriage Registration') ?></a></li>
                <li><a href="death_registration.php"><?= __('Death Registration') ?></a></li>
                <li><a href="Divorce_registration.php"><?= __('Divorce Registration') ?></a></li>
</ul></p>
            <h1><?= __('Meet Our Team')?></h1>
            <div class="team-members">
                <!-- Add team member profiles here -->
                <div class="team-member">
                    <img src="myp.jpg" alt="Team Member 1">
                    <h3>አቶ ዮሀንስ ወ/ጊዮርጊስ</h3>
                    <p><?= __('Role: Manager')?> </p>
                    <p><?= __('With over')?></p>
                </div>
                <!-- Add more team member profiles as needed -->
                <div class="team-member">
                    <img src="taye.png" alt="Team Member 2">
                    <h3>አቶ ታዬ ግርማ</h3>
                    <p><?= __('Role: CivilRregistrar')?></p>
                    <p><?= __('With over')?></p>
                </div>
            </div>
        </div>
    </section>
 
<footer class="text-light text-center py-2 mt-4">
  <h6>&copy; <?= __('2024 Kirkos Subcity wereda 02 Vital Event Registration System')?></h6>
</footer>
</body>
</html>
