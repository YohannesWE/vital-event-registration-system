<?php
       include_once 'languge.php';
    include 'scroll_css.php';
 
    ?>
<!DOCTYPE html>
<html lang="en">
<html lang="am_ET">
<html lang="or_ET">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Include CSS files for styling -->

   
    <?php
    include 'head_login or.php';
    ?>
<style>
  body {
    background-color: rgba(0, 111, 170, 0.47);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow-y: scroll;
  }

  .container {
    max-width: 960px;
    margin: 40px auto;
    padding: 30px;
    background-color: rgba(0, 110, 185, 0.1); /* blue background */
    color: white; /* white text */
    border-radius: 10px;
  }

  h1 {
    font-size: 22px;
    margin-bottom: 10px;
    text-align: center;
    color: black;
  }

  p {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
    text-align: left;
    color: black;
  }

  a {
    color:rgb(0, 102, 255); /* yellow-ish for visibility */
    text-decoration: none;
  }

  .social-media ul {
    list-style: disc;
    padding-left: 40px;
    font-size: 16px;
    color: black;
    text-align: left;
    
  }

  .social-media ul li a {
    color:rgb(0, 102, 255);
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
  }

  footer {
    background-color: rgb(0, 110, 185);
    color: white;
    text-align: center;
    padding: 12px 0;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
  }

  footer h6 {
    font-size: 16px;
    margin: 0;
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
        <a href="contactus_am.php?lang=am_ET">አማ</a>
        <a href="contactus.php?lang=en_US">En</a>
        <a href="contactus_or.php?lang=or_ET">AO</a>
    </div>
    </div>
    <div class="container">
       
    <div class="contact-info">
    <h1> <?= __('Our Location')?></h1>
    <p>🏠︎&nbsp&nbsp&nbsp&nbsp&nbsp<?= __('Near AASTU')?></p>
</div>

        <div class="contact-info">
            <h1><?= __('Contact Details')?></h1>
            <p>✆&nbsp&nbsp&nbsp&nbsp&nbsp<strong><?= __('Phone')?>:</strong>+251923814569<br>
            <strong>✉&nbsp&nbsp&nbsp&nbsp&nbsp<?= __('Email')?>:</strong> <a href="mailto:kirkossubcityw02.com.et">kirkossubcityw02.com.et</a></p>
        </div>
        
        <div class="social-media">
        <h1><?= __('Our Social Media Platform')?></h1>
            <ul>
                <li><a href="https://www.facebook.com/yourorganization">Facebook</a></li>
                <li><a href="https://twitter.com/yourorganization">Twitter</a></li>
                <li><a href="https://www.instagram.com/yourorganization">Instagram</a></li>
                <!-- Add more social media links as necessary -->
            </ul>
        </div>
        
        <div class="social-media">
            <h1><?= __('Office Hours')?></h1>
            <p>🕖&nbsp&nbsp&nbsp&nbsp&nbsp<?= __('Monday')?><br>
            🕖&nbsp&nbsp&nbsp&nbsp&nbsp<?= __('Saturday')?> </p>
        </div>
        
        <div class="social-media">
            <h1><?= __('General Inquiries')?></h1>
            <p>🔎&nbsp&nbsp&nbsp&nbsp&nbsp<?= __('For general')?>.</p>
        </div>
        
      
    </div>
    
<footer class="text-light text-center py-2 mt-4">
  <h6>&copy;<?= __('2025 Kirkos Sub City wereda 02 Vital Event Registration System')?> </h6>
</footer>
</body>
</html>
