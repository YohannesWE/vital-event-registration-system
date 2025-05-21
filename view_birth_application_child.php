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
$sql = "SELECT * FROM birth_table WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['b_id'];
    $fname = $row['f_name'];
    $mname = $row['m_name'];
    $lname = $row['l_name'];
    $motherfname = $row['Mother_fname'];
    $mothermname = $row['Mother_mname'];
   
    $motherlname = $row['Mother_lname'];
    $father_fname = $row['father_fname'];
    $father_mname = $row['father_mname'];
    $father_lname = $row['father_lname'];

    $mother_natinality = $row['mother_natinality'];
    $father_natinality = $row['father_natinality'];

  


    $Registration_date = $row['Registration_date'];
    $birthdate = $row['Birthdate'];
    $nationality = $row['Nationality'];
    $birthregion = $row['Birth_kebele'];
    $birthcity = $row['father_mname'];
    $birth_states = $row['Birth_status'];
    $paymnt_states = $row['Payment'];
} else {
    $message = "You have not registered any birth event.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>VITAL EVENT birth application</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'children_page.php'; ?>
 <style>
            body {
                background-color:rgba(73, 140, 184, 0.47);

            overflow-y: scroll; /* Always show vertical scrollbar */
            }
 </style>
</head>

<body>
<div class="container">

    <?php if (isset($message)) : ?>
        <center>
            <h2><?php echo $message; ?></h2>
        </center>
    <?php else : ?>
        <center>
        <h2><?= __('My Birth Application')?> </h2>
   
            <table border="1px">
                <tr>
                <th class="tt"><?= __('Birth ID')?></th>
                    <th class="tt"><?= __('Username')?></th>
                    <th class="tt"><?= __('Name')?></th>
                    <th class="tt"><?= __('Mother Name')?></th>
                    <th class="tt"><?= __('Birth Status')?></th>
                    <th class="tt"><?= __('Payment Status')?></th>
                    <th class="tt"><?= __('More Details')?></th>
                </tr>
                <tr>
                <td class="td_tale"><?php echo $id; ?></td>
                    <td class="td_tale"><?php echo $username; ?></td>
                    <td class="td_tale"><?php echo "$fname $mname $lname"; ?></td>
                    <td class="td_tale"><?php echo "{$motherfname} {$mothermname} {$motherlname}"; ?></td>
                    <td class="td_tale"><?php echo $birth_states; ?></td>
                    <td class="td_tale"><?php echo $paymnt_states; ?></td>
                    <td class="td_tale">
                    <a href="view_birth_application_child2.php?id=<?php echo $id; ?>" class="btn btn-primary"><?= __('More Details')?></a>
                    </td>
                </tr>
            </table>
        </center>
    <?php endif; ?>
    </div>
</body>

</html>
