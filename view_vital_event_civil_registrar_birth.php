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

// Define variables for search and initialize to empty strings
$search_username = $search_firstname = "";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store search input values
    $search_username = mysqli_real_escape_string($conn, $_POST["search_username"]);
    $search_firstname = mysqli_real_escape_string($conn, $_POST["search_firstname"]);
}

// Construct the WHERE clause based on search inputs
$whereClause = "";
if (!empty($search_username)) {
    $whereClause .= " AND username LIKE '%$search_username%'";
}
if (!empty($search_firstname)) {
    $whereClause .= " AND f_name LIKE '%$search_firstname%'";
}

$sql = "SELECT * FROM birth_table WHERE 1=1 $whereClause";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL EVENT birth application</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>
        body {
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        .button {
    display: inline-block;
    padding: 8px 16px;
    margin-right: 10px;
    background-color:rgba(0, 111, 170, 0.47);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}
.button-container {
    display: inline-block;
}


    </style>
</head>

<body>

<div class="container-fluid">
    <div class="table-container">
    
        <h5><center>Birth Application</center></h5>

        <!-- Search form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="search_username" placeholder="Search by username" value="<?php echo $search_username; ?>">
            <input type="text" name="search_firstname" placeholder="Search by first name" value="<?php echo $search_firstname; ?>">
            <button type="submit"  class="btn btn-primary">Search</button>
        </form>
        <!-- End of search form -->

        <table border="1px">
            <tr>
                <th class="tt">No</th>
                <th class="tt">Username</th>
                <th class="tt">Name</th>
               
                <th class="tt">Mother's Name</th>
                <th class="tt">Father's Name</th>
                <th class="tt">Mother's nationality</th>
                <th class="tt">Father's nationality</th>
                <th class="tt">Gender</th>
                <th class="tt">Date of Birth</th>
                <th class="tt">Nationality</th>
                <th class="tt">Status</th>
                <th class="tt">Payment</th>
                <th class="tt">Certificate</th>
                <th class="tt">Action</th>
            </tr>

            <?php 
            $count = 1;
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td class="td_tale"><?php echo $count++; ?></td>
                        <td class="td_tale"><?php echo $row['username']; ?></td>
                        <td class="td_tale"><?php echo $row['f_name'] . ' ' . $row['father_fname'] . ' ' . $row['father_mname']; ?></td>
                        <td class="td_tale"><?php echo "{$row['Mother_fname']} {$row['Mother_mname']} {$row['Mother_lname']}"; ?></td>
                        <td class="td_tale"><?php echo $row['father_fname'] . ' ' . $row['father_mname'] . ' ' . $row['father_lname']; ?></td>
                        <td class="td_tale"><?php echo $row['mother_natinality']; ?></td>
                        <td class="td_tale"><?php echo $row['father_natinality']; ?></td>
                        <td class="td_tale"><?php echo $row['sex']; ?></td>
                        <td class="td_tale"><?php echo $row['Birthdate']; ?></td>
                        <td class="td_tale"><?php echo $row['Nationality']; ?></td>
                        <td class="td_tale"><?php echo $row['Birth_status']; ?></td>
                        <td class="td_tale"><?php echo $row['Payment']; ?></td>
                        <td class="td_tale">  <a class="btn btn-success" href="view_certficate_birth.php?username=<?php echo $row['username']; ?>">View</a></td>
                        <td class="td_taleee">
   

       <a href="update_event_birth.php?username=<?php echo $row['username']; ?>" class="button">Update</a>
    
</td>

                    </tr> 
                    <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="13" class="not-registered">No Birth Application found.</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
