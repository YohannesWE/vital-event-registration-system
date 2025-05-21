<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION["username"];
$sql = "SELECT * FROM marriage_table WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $mId = $row['m_id'];

$husbandFirstName = $row['Hasband_fname'];
$husbandMiddleName = $row['Hasband_mname'];
$husbandLastName = $row['Hasband_lname'];
$wifeFirstName = $row['Wife_fname'];
$wifeMiddleName = $row['Wife_mname'];
$wifeLastName = $row['Wife_lname'];

$kebele = $row['marriage_kebele'];
$marriageDate = $row['Marrage_date'];
$marriageCondition = $row['Marrage_condition'];


$marriagePaper = $row['Marriage_paper'];
$Hasband_natinality = $row['Hasband_natinality'];
$wife_natinality = $row['wife_natinality'];
$marriage_Region = $row['marriage_Region'];
$marriage_Zone = $row['marriage_Zone'];
} else {
    echo '<script class="not-registered">alert("you are not register merrage event."); window.location.href = "applicant.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view  Marriage application</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css1_applicant.php'; ?>
<style>
       body {
                background-color:rgba(73, 140, 184, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
</style>
</head>

<body>
<div class="container-fluid">
    
  
        <center>
            <h5>
             My Marriage Application
            </h5>
            <div class="container-fluid">
   
   <div class="table-container">
            <table border="1px">
                <tr>
<th class="tt">
  wife Natinality
</th>
<th class="tt">
   hasband Natinality
</th>
<th class="tt">
Marriage region
</th>
<th class="tt">
Marriage zone
</th>
<th class="tt">
Marriage Kebele
</th>
<th class="tt">
    Marriage Date
</th>
<th class="tt">
    Marriage Condition
</th>




                </tr>

                <tr>
                <td class="td_tale">
                        <?php echo $Hasband_natinality; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $wife_natinality; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $marriage_Region; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $marriage_Zone; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $kebele; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $marriageDate; ?>
                    </td>
                    <td class="td_tale">
                        <?php echo $marriageCondition; ?>
                    </td>
           
                    
             

                </tr>
            </table>
        </center>
</div>
</div>


  
</body>
</html>