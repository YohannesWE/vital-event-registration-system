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
$sql = "SELECT * FROM divorce_table WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $diId = $row['di_id'];
    $husbandFirstName = $row['Hasband_fname'];
    $husbandMiddleName = $row['Hasband_mname'];
    $husbandLastName = $row['Hasband_lname'];
    $wifeFirstName = $row['wife_fname'];
    $wifeMiddleName = $row['wife_mname'];
    $wifeLastName = $row['wife_lname'];
    $divorceKebele = $row['Divorce_kebele'];
    $numberOfChildren = $row['Number_of_child'];

    $divorcePaper = $row['Divorce_paper'];
    $divorceStates = $row['Divorce_states'];
    $payment = $row['Payment'];
} else {
    $noDataMessage = "No divorce application registered.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL EVENT divorce application</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css1_applicant.php'; ?>
  
 <style>
        body {
                background-color:rgba(0, 111, 170, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
 </style>
</head>
<body>
        
<div class="container-fluid">

 
    
<div class="container-fluid">
   
   <div class="table-container">
 
        <?php if (isset($noDataMessage)): ?>
            <center>     <p class="not-registered "><?php echo $noDataMessage; ?></p>  <center>
        <?php else: ?>
            </center>
  <h5><center><?= __('My Divorce Application')?></center></h5>
            <table border="1px">
                <tr>
                    <th class="tt"><?= __('Username')?></th>
                    <th class="tt"><?= __("Husband's Name")?></th>
                    <th class="tt"><?= __("Wife's Name")?></th>
                    <th class="tt"><?= __('Divorce States')?></th>
                    <th class="tt"><?= __('Payment Status')?></th>
                    <th class="tt"><?= __('More Details')?></th>
                </tr>
                <tr>
                    <td class="td_tale"><?php echo $username; ?></td>
                    <td class="td_tale"><?php echo $husbandFirstName . ' ' . $husbandMiddleName . ' ' . $husbandLastName; ?></td>
                    <td class="td_tale"><?php echo "$wifeFirstName $wifeMiddleName $wifeLastName"; ?></td>
                    <td class="td_tale"><?php echo $divorceStates; ?></td>
                    <td class="td_tale"><?php echo $payment; ?></td>
                    <td class="td_tale">
                        <a class="btn btn-primary" href="view_divorce_application2.php?di_id=<?php echo $diId; ?>"><strong>More</strong></a>
                    </td>
                </tr>
            </table>
        <?php endif; ?>
    </center>
        </div>
        </div>
        </div>

</body>

</html>
