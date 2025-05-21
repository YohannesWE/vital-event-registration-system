
<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    
}elseif($_SESSION['usertype']=='manger'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='customer'){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='kebele employee'){
    header("location:login.php");
}
$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM user WHERE usertype='customer' ";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view  customer</title>
    <?php
    include 'admin_css.php';
    ?>
    <style>
        table {
  border-collapse: collapse;
  width: 100%;
  margin-left: 20px;
  margin-right: 20px;
}

th, td {
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

.tt {
  font-weight: bold;
}

.td_tale {
  max-width: 200px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.td_talee {
  max-width: 100px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

table {
  border: 1px solid #ddd;
}

th, td {
  border: 1px solid #ddd;
}

table {
  border-spacing: 0;
}

table {
  table-layout: fixed;
  width: 100%;
}

table th {
  position: sticky;
  top: 0;
  background-color: #f2f2f2;
  z-index: 1;
}

table td {
  overflow: hidden;
  text-overflow: ellipsis;
}

table {
  overflow: auto;
  max-height: 400px;
}
    </style>
    
</head>
<body>
 
<header class="header">
    <a href=""> kebele employee Page </a>
    <div class="logout">
    <a href="manage_account.php" class="btn btn-primary">Back</a>
        <a href="logout.php" class="btn btn-primary">Logout</a>

    </div>
  </header>
 
  
    <center>
    <h1>
       All customer 
    </h1>
<table border="1px">
    <tr>
        <th class="tt">
            ID
        </th>
        <th class="tt">
          Full NAME
        </th>
        <th class="tt">
         USERNAME
        </th>
        <th class="tt">
        EMAIL
        </th>
        <th class="tt">
        PHONE
        </th>
        <th class="tt">
        status
        </th>
       
    </tr>

<?php 
while($info=$result -> fetch_assoc())
{


?>

    <tr>
    <td class="td_tale"  width="100px">
                <?php  echo"{$info['id']}" ?>
    </td>


    <td class="td_tale" >
    <?php  echo"{$info['full_name']}" ?> 
     </td>

    <td class="td_tale">
    <?php  echo"{$info['username']}" ?>   
     </td>

    <td class="td_tale">
    <?php  echo"{$info['email']}" ?>
    </td>

    <td class="td_tale">
    <?php  echo"{$info['phone']}" ?> 
     </td>
       
     <td class="td_tale">
    <?php  echo"{$info['states']}" ?> 
     </td>
     
 
    </tr>
    
  
    <?php
}

    ?>

</table>
    </center>
  
</body>
</html>