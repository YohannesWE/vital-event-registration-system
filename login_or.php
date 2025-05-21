
<?php
session_start();

 	include_once 'languge.php'; 

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM user WHERE username='" . $name . "' AND password='" . $pass . "' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $states = $row['states'];

        $_SESSION["states"] = $states;
        $_SESSION["username"] = $row['username'];
        $_SESSION["pass"] = $row['password'];
        $_SESSION["usertype"] = $row['usertype'];
        $_SESSION["k_id_no"] = $row['k_id_no'];
      

        if ($states == "approved") {
            switch ($row["usertype"]) {
                case "applicant":
                    $_SESSION['username'] = $name;
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $email;
                    $_SESSION['k_id_no'] = $k_id_no;
                    $_SESSION['k_id'] = $k_id;
                    header("Location: applicant.php");
                    break;
                case "manager":
                    $_SESSION['username'] = $name;
                    $_SESSION['id'] = $id;
                    header("Location: manager.php");
                    break;
                case "child":
                    $_SESSION['username'] = $name;
                    $_SESSION['id'] = $id;
                    header("Location: children.php");
                    break;
                case "Civil_registrar":
                    $_SESSION['username'] = $name;
                    $_SESSION['id'] = $id;
                 
                    header("Location:Civil_registrar.php");
                    break;
                case "admin":
                    $_SESSION['username'] = $name;
                    $_SESSION['id'] = $id;
                    header("Location: admin.php");
                    break;
                default:
                    echo "Invalid user type.";
            }
        } elseif ($states == "pending") {
            $_SESSION['username'] = $name;
            $_SESSION['message'] = '<div class="message message-pending">Your account is still pending for approval.</div>';
        } elseif ($states == "deactivated") {
            $_SESSION['username'] = $name;
            $_SESSION['message'] = '<div class="message message-deactivated">Your account is still deactivated please contact the administrator.</div>';
        } else {
            $_SESSION['username'] = $name;
            $_SESSION['message'] = '<div class="message message-error">Incorrect username or password.</div>';
        }
    } else {
        $_SESSION['message'] = '<div class="message message-error">Incorrect username or password.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'head_login or.php'; ?>
    <style>
        /* Your CSS styles for messages */
         
   
        body {
            background-color:rgba(9, 75, 111, 0.78);
   
        }
   body {
    background-color:rgb(0, 111, 170, 0.47);
       overflow-y: scroll; /* Always show vertical scrollbar */
   }
   .login-form {
    background-color:rgb(0, 111, 170, 0.19);
    padding: 40px;

       border-radius: 25px;
       box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   }

   .login-form .form-title {
       margin-bottom: 30px;
       font-size: 24px;
       font-weight: bold;
   }

   .login-form .form-group {
       margin-bottom: 20px;
   }

   .login-form .form-group label {
       font-weight: bold;
   }

   .login-form .form-group input {
       width: 100%;
       padding: 10px;
       border: 1px solid #ccc;
       border-radius: 10px;
   }

   .login-form .form-group input[type="submit"],
   .login-form .form-group input[type="reset"],
   .login-form .form-group input[type="button"] {
       width: auto;
       margin-top: 10px;
   }

   .login-form .signup-link {
       margin-top: 20px;
   }

   .login-form .signup-link a {
       color: black;
       text-decoration: none;
    
   }

   .login-form .signup-link a:hover {
       text-decoration: none;

   }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .message-error {
            background-color: #ffcccc;
            color: #cc0000;
        }

        .message-pending {
            background-color: #ffff99;
            color: #666600;
        }

        .message-deactivated {
            background-color: #cccccc;
            color: #333333;
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
        <a href="login_am.php?lang=am_ET">አማ</a>
        <a href="login.php?lang=en_US">En</a>
        <a href="login_or.php?lang=or_ET">AO</a>
    </div>
    </div>
<div class="container" style="padding-top: 59px;">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="" method="POST" class="login-form">
                <div class="form-title text-center"><?= __('Login Pageee')?></div>
                <!-- Display messages here -->
                <?php
              
                if (isset($_SESSION['message'])) {
                    echo '<div id="message"  role="alert">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <div class="form-group">
                    <label for="username"><?= __('Username')?></label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="password"><?= __('Password')?></label>
                    <input type="password" name="pass" id="password">
                </div>
                <center>
                    <div class="form-group">
                        <input type="submit" name="submit" value="<?= __('Login')?>" class="btn btn-primary">
                        <input type="button" value="<?= __('Back')?>" class="btn btn-secondary"
                               onclick="window.location.href='index_or.php'">
                    </div>
                </center>
                <div class="signup-link text-center"
                     style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; font-size: 16px; line-height: 1.6;"><?= __('If you do not have an account')?>, <a
                                href="customer-signup.php"
                                style="color:rgb(0, 110, 185); text-decoration: none; font-weight: bold;"><?= __('sign up')?></a> .</p>
                        <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; font-size: 16px; line-height: 1.6;">
                        <?= __('If you forget your password')?>, <a href="forgot-password.php" style="color:rgb(0, 110, 185); text-decoration: none; font-weight: bold;"><?= __('click here')?></a>.
</p>

            </form>
        </div>
    </div>
</div>

<script>
    setTimeout(function(){
        var messageElement = document.getElementById('message');
        if (messageElement !== null) {
            messageElement.remove();
        }
    }, 3000); // 3000 milliseconds = 3 seconds
</script>
</body>
</html>





