<?php
session_start();

if (!isset($_SESSION['k_id_no'])) {
    header("Location: view_death_check.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$k_id_no = $_SESSION['k_id_no'];
$sql = "SELECT * FROM death_table WHERE k_id_no = '$k_id_no'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['d_id'];
    $fname = $row['f_name'];
    $mname = $row['m_name'];
    $lname = $row['l_name'];
    $gender = $row['Sex'];
    $nationality = $row['Nationality'];
    $death_status = $row['Death_states'];
    $payment_status = $row['Payemnt'];
} else {
    $message = "You have not registered any death event.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Death Application</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_death.php'; ?>
    <style>
        body {
            background-color: rgba(0, 111, 170, 0.47);
            overflow-y: scroll;
        }
        .not-registered {
            text-align: center;
            font-size: 18px;
            color: #333;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
        }
    </style>
</head>
<body>
<div class="language-dropdown">
    <button>🌐</button>
    <div class="language-options">
        <a href="view_death_application.php?lang=am_ET">አማ</a>
        <a href="view_death_application.php?lang=en_US">En</a>
        <a href="view_death_application.php?lang=or_ET">AO</a>
    </div>
</div>

<div class="container-fluid">
    <center>
        <h5><?= __('Death Application Status') ?> </h5>
        <?php if (isset($message)) : ?>
            <div class="not-registered"><?php echo $message; ?></div>
        <?php else : ?>
        <div class="table-container">
            <table border="1px">
                <tr>
                    <th class="tt">ID</th>
                    <th class="tt"><?= __('Kebele Id Number/fayeda') ?></th>
                    <th class="tt"><?= __('Deceased Name') ?> </th>
                    <th class="tt"><?= __('Gender') ?></th>
                    <th class="tt"><?= __('Nationality') ?></th>
                    <th class="tt"><?= __('Death Status') ?></th>
                    <th class="tt"><?= __('Payment Status') ?></th>
                    <th class="tt"><?= __('More Details') ?></th>
                </tr>
                <tr>
                    <td class="td_tale"><?php echo $id; ?></td>
                    <td class="td_tale"><?php echo $k_id_no; ?></td>
                    <td class="td_tale"><?php echo $fname . " " . $mname . " " . $lname; ?></td>
                    <td class="td_tale"><?php echo $gender; ?></td>
                    <td class="td_tale"><?php echo $nationality; ?></td>
                    <td class="td_tale"><?php echo $death_status; ?></td>
                    <td class="td_tale"><?php echo $payment_status; ?></td>
                    <td class="td_tale">
                        <a class="btn btn-success" href="view_death_application2.php"><?= __('More Details') ?></a>
                    </td>
                </tr>
            </table>
        </div>
        <?php endif; ?>
    </center>
</div>
</body>
</html>
