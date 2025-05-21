<?php
session_start();
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
                    $_SESSION['username']=$name;
                    $_SESSION['id']=$id;
                    $_SESSION['email']=$email;
                    header("Location: applicant.php");
                    break;
                case "manager":
                    $_SESSION['username']=$name;
                    $_SESSION['id']=$id;
                    header("Location: manager.php");
                    break;
                    case "child":
                        $_SESSION['username']=$name;
                        $_SESSION['id']=$id;
                        header("Location: children.php");
                        break;
                case "Civil_registrar":
                    $_SESSION['username']=$name;
                    $_SESSION['id']=$id;
                    header("Location:Civil_registrar.php");
                    break;
                case "admin":
                    $_SESSION['username']=$name;
                    $_SESSION['id']=$id;
                    header("Location: admin.php");
                    break;
                default:
                    echo "Invalid user type.";
            }
        } elseif ($states == "pending") {
            $_SESSION['username']=$name;
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still pending for approval.");';
            echo 'window.location.href="login.php";';
            echo '</script>';
        } 
        elseif ($states == "deactivated") {
            $_SESSION['username']=$name;
            echo '<script type="text/javascript">';
            echo 'alert("Your account is still deactivated please contact the adminstrator.");';
            echo 'window.location.href="login.php";';
            echo '</script>';
        }
        else {
            $_SESSION['username']=$name;
            echo '<script type="text/javascript">';
            echo 'alert("Incorrect username or password.");';
            echo 'window.location.href="login.php";';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Incorrect username or password.");';
        echo 'window.location.href="login.php";';
        echo '</script>';
    }
}
?>