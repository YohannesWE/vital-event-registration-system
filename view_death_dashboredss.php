
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view death appliction</title>
    <?php
    include 'admin_css.php';
    ?>
     <style>

*{
    margin: 0px;
    padding: 0px;
}

a,a:hover{
    text-decoration: none! important;
    text-shadow: 0cap;
}
.logout{
    float: right;
    padding-right: 30px;
}

ul{
    background-color: #424a5b;
    width:16%;
    height: 100%;
    position: fixed;
    padding-top: 10%;
    text-align: center;
}
ul li{
    list-style: none;
    padding-bottom: 30px;
    font-size: 15px;
}
ul li a{
    color: white;
    font-weight: bold;
    font-size: large;
   
    
}

ul li a:hover{
    color: skyblue;
    text-decoration: none;
}
.content{
    margin-left: 20%;
    margin-top: 5%;
    
}


    </style>
    <style>
    .header {
    background-color: skyblue;
    line-height: 70px;
    padding-left: 30px;
    position: sticky;
    top: 0;
}
    


        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            text-align: left;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<header class="header">
    <a href=""> User Page </a>
    <div class="logout">
        <a href="exit.php" class="btn btn-primary">Exit</a>
    </div>
  </header>
  <aside>
    <ul class="ui">
        <li>
            <a href="view_death_application.php">view death appliction</a>
           
        </li>
        <li>
            <a href="print_vital_event_death.php">death certficate</a>
           
        </li>
       
      
        <li>
            <a href="send_payemnt_death.php">send payemnt  </a>
        </li>



    </ul>
  </aside>
    <div class="content">
        
    </div>
</body>
</html>