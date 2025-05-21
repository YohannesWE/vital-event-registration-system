<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
} elseif ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'applicant') {
    header("Location: login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "vital_event");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user_id is provided in the URL
if (isset($_GET['user_id'])) {
    $username = $_GET['user_id'];

    // Query the birth table
    $sql_birth = "SELECT * FROM birth_table WHERE username = '$username'";
    $result_birth = mysqli_query($conn, $sql_birth);
    $row_birth = mysqli_fetch_assoc($result_birth);

    // Query the marriage table
    $sql_marriage = "SELECT * FROM marriage_table WHERE username = '$username'";
    $result_marriage = mysqli_query($conn, $sql_marriage);
    $row_marriage = mysqli_fetch_assoc($result_marriage);

    // Query the divorce table
    $sql_divorce = "SELECT * FROM divorce_table WHERE username = '$username'";
    $result_divorce = mysqli_query($conn, $sql_divorce);
    $row_divorce = mysqli_fetch_assoc($result_divorce);

    // Close the database connection
    mysqli_close($conn);
} else {
    // If user_id is not provided, handle this case accordingly
    // For example, redirect to an error page
    header("Location: error.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Vital Event Info</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>
       body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
 
        /* Container styles */
        .containert {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color:rgb(0, 110, 185);
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Button styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color:rgb(41, 129, 187);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color:rgba(39, 145, 62, 0.47);
        }
        .serach{
            align:right;
        }
    </style>
</head>
<body>

<div class="containert">
    <div class="container-fluid">
        <div class="table-container">
            <h5><center>Vital Event Info List</center></h>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Birth</th>
                        <th>Marriage</th>
                        <th>Divorce</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th>Event Status</th>
<td>
    <?php
    if (isset($row_birth['Birth_status'])) {
        echo $row_birth['Birth_status'] === 'approved' ? 'Approved' : ($row_birth['Birth_status'] === 'pending' ? 'Pending' : 'N/A');
    } else {
        echo 'Not Registred';
    }
    ?>
</td>
<td>
    <?php
    if (isset($row_marriage['Marriage_status'])) {
        echo $row_marriage['Marriage_status'] === 'approved' ? 'Approved' : ($row_marriage['Marriage_status'] === 'pending' ? 'Pending' : 'N/A');
    } else {
        echo 'Not Registered';
    }
    ?>
</td>
<td>
    <?php
    if (isset($row_divorce['Divorce_states'])) {
        echo $row_divorce['Divorce_states'] === 'approved' ? 'Approved' : ($row_divorce['Divorce_states'] === 'pending' ? 'Pending' : 'N/A');
    } else {
        echo 'Not Registered';
    }
    ?>
</td>
</tr>

<tr>
    <th>Payment Status</th>
    <td>
        <?php
        if (isset($row_birth['Payment'])) {
            echo $row_birth['Payment'] === 'paid' ? 'Approved' : ($row_birth['Payment'] === 'unpaid' ? 'unpaid' : 'N/A');
        } else {
            echo 'Not Registered';
        }
        ?>
    </td>
    <td>
        <?php
        if (isset($row_marriage['Payemnt'])) {
            echo $row_marriage['Payemnt'] === 'paid' ? 'Approved' : ($row_marriage['Payemnt'] === 'unpaid' ? 'unpaid' : 'N/A');
        } else {
            echo 'Not Registered';
        }
        ?>
    </td>
    <td>
        <?php
        if (isset($row_divorce['Payment'])) {
            echo $row_divorce['Payment'] === 'paid' ? 'Approved' : ($row_divorce['Payment'] === 'unpaid' ? 'unpaid' : 'N/A');
        } else {
            echo 'Not Registered';
        }
        ?>
    </td>
</tr>

<tr>
    <th>Certificate</th>
    <td>
        <?php
        if (isset($row_birth['Birth_status']) && isset($row_birth['Payment'])) {
            if ($row_birth['Birth_status'] === 'approved' && $row_birth['Payment'] === 'paid') {
                echo 'Certified';
            } else {
                echo 'Not Certified';
            }
        } else {
            echo 'Not Registered';
        }
        ?>
    </td>
    <td>
        <?php
        if (isset($row_marriage['Marriage_status']) && isset($row_marriage['Payemnt'])) {
            if ($row_marriage['Marriage_status'] === 'approved' && $row_marriage['Payemnt'] === 'paid') {
                echo 'certified';
            } else {
                echo 'Not Certified';
            }
        } else {
            echo 'Not Registered';
        }
        ?>
    </td>
    <td>
        <?php
        if (isset($row_divorce['Divorce_states']) && isset($row_divorce['Payment'])) {
            if ($row_divorce['Divorce_states'] === 'approved' && $row_divorce['Payment'] === 'paid') {
                echo 'Certified';
            } else {
                echo 'Not Certified';
            }
        } else {
            echo 'Not Registered';
        }
        ?>
    </td>
</tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
