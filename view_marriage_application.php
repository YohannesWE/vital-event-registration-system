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

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $mId = $row['m_id'];

    $husbandFirstName = $row['Hasband_fname'];
    $husbandMiddleName = $row['Hasband_mname'];
    $husbandLastName = $row['Hasband_lname'];
    $wifeFirstName = $row['Wife_fname'];
    $wifeMiddleName = $row['Wife_mname'];
    $wifeLastName = $row['Wife_lname'];
    $husbandAge = $row['hasband_birth_date'];
    $wifeAge = $row['wife_birth_date'];
    $kebele = $row['marriage_kebele'];
    $marriageDate = $row['Marrage_date'];
    $marriageCondition = $row['Marrage_condition'];
  
  
    $marriagePaper = $row['Marriage_paper'];
    $marriageStatus = $row['Marriage_status'];
    $payment = $row['Payemnt'];
} else {
    $message = "You have not registered any marriage event.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vital event birth application</title>
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
    <?php if (isset($message)) : ?>
        <center>
            <h5><center><?php echo $message; ?></center></h5>
        </center>
    <?php else : ?>
        <center>
            <h5><center><?= __('My Marriage application')?></center></h5>
            <div class="container-fluid">
   
   <div class="table-container">
            <table border="1px">
                <tr>
                    <th class="tt"><?= __('Username')?></th>
                    <th class="tt"><?= __("Husband's Name")?></th>
                    <th class="tt"><?= __("Wife's Name")?></th>
                    <th class="tt"><?= __('Husband Birth date')?></th>
                    <th class="tt"><?= __('Wife Birth date')?></th>
                    <th class="tt"><?= __('Marriage Status')?></th>
                    <th class="tt"><?= __('Payment Status')?></th>
                    <th class="tt"><?= __('More Details')?></th>
                </tr>
                <tr>
                    <td class="td_tale"><?php echo $username; ?></td>
                    <td class="td_tale"><?php echo "$husbandFirstName $husbandMiddleName $husbandLastName"; ?></td>
                    <td class="td_tale"><?php echo "$wifeFirstName $wifeMiddleName $wifeLastName"; ?></td>
                    <td class="td_tale"><?php echo $husbandAge; ?></td>
                    <td class="td_tale"><?php echo $wifeAge; ?></td>
                    <td class="td_tale"><?php echo  $marriageStatus; ?></td>
                    <td class="td_tale"><?php echo $payment; ?></td>
                    <td class="td_tale">
                        <a class="btn btn-primary" href="view_marriage_application2.php">More</a>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    <?php endif; ?>
    </div>
    </div>
    </div>
</body>

</html>
