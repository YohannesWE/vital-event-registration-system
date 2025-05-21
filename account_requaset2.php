<?php
    	include_once 'languge.php'; ?>
<?php
session_start();
error_reporting(0);

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant' || $_SESSION['usertype'] == 'admin') {
    header("Location: login.php");
    exit();
}
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM user WHERE states = 'pending'and usertype = 'applicant' ";
$result = mysqli_query($conn, $sql);
if($_GET['c_id']){
    $t_id=$_GET['c_id'];
    $sql2="DELETE FROM user WHERE id='$t_id'";
    $result2=mysqli_query($conn,$sql2);
    if($result2){
      header('location:Account_Requset.php');
    }
}
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $sql3 = "UPDATE user SET states = 'approved' WHERE id = '$approve_id'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
      $sql4 = "SELECT email FROM user WHERE id = '$approve_id'";
      $result4 = mysqli_query($conn, $sql4);
      if (!$result4) {
        die("Query failed: " . mysqli_error($conn));
  }
  $row = mysqli_fetch_assoc($result4);
    $email = $row['email'];

    
    
if (isset($email)) {

  $mail = require __DIR__ . "/mailer.php";
  
  $mail->setFrom("noreply@example.com");
  $mail->addAddress($email);
  $mail->Subject = "Account approval";
  $mail->Body = <<<END
  
  Congratulations, your account has been approved; you can now access our services.
  
  END;
  
  try {
  
      $mail->send();
  
  } catch (Exception $e) {
  
    echo '<script>';
    echo 'alert("Message could not be sent. Mailer error: ' . $mail->ErrorInfo . '");';
    echo '</script>';
    
  
  }
  
  }
  
  echo '<script>';
  echo 'alert("Message sent, please check your inbox.");';
  echo 'window.location.href = "Account_Request.php";';
  echo '</script>';
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civil registrar Page</title>
    <?php include 'admin_css.php'; ?>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color:rgba(0, 111, 170, 0.47);
            margin: 0;
            padding: 0;
        }

        .container {
            width:100%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color:rgb(0, 110, 185);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .td_talee img {
            width: 90px;
            height: 30px;
            display: block;
            margin: 0 auto;
        }

        .td_taleee {
            display: flex;
            align-items: center;
            height: 70px;
        }

        .td_taleee a {
            margin-right: 10px;
        }

        /* Scrollable container */
        .table-container {
            overflow: auto;
            max-height: 400px; /* Adjust height as needed */
        }

        /* To make the table scrollable horizontally */
        .table-container table {
            min-width: 100%; /* Ensure table takes full width even if content doesn't */
        }
    </style>
</head>
<body>


<div class="container-fluid">
    <h1>All Applicant Account Request</h1>
    <a href="Civil_registrar.php" class="btn btn-primary">Back</a>
    <div class="table-container">
        <table>
            <tr>
                <th>NO</th>
                <th>Kebele ID Number</th>
                <th>Full Name</th>
                <th>Father Name</th>
                <th>Grandfather Name</th>
                <th>Username</th>
                <th>Keble ID Photo</th>
                <th>More info</th>
                <th>Action</th>
            </tr>
            <?php
            $count = 0;
            while ($info = $result->fetch_assoc()) {
                $count++;
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $info['k_id_no']; ?></td>
                    <td><?php echo $info['full_name']; ?></td>
                    <td><?php echo $info['middle_name']; ?></td>
                    <td><?php echo $info['last_name']; ?></td>
                    <td><?php echo $info['username']; ?></td>
                    <td class="td_talee">
                        <a href="<?php echo $info['k_id']; ?>" target="_blank" >
                            <img src="s.png" alt="PDF Icon">
                        </a>
                    </td>
                    <td><a href="account_requaset2.php" class="btn btn-primary">More</a></td>
                    <td class="td_taleee">
                        <?php
                        echo "<a onClick=\"javascript:return confirm('Are You Sure To Delete Customer');\" href='Account_Requset.php?c_id={$info['id']}' class='btn btn-danger'>Delete User</a>";
                        echo "<a onClick=\"javascript:return confirm('Are You Sure To Approve Customer?');\" href='Account_Requset.php?approve_id={$info['id']}' class='btn btn-success'>Approve user</a>";
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
