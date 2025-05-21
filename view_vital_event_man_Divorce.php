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

// Initialize variables for search
$search_username = "";
$search_husband_fname = "";
$search_wife_fname = "";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store search input values
    $search_username = mysqli_real_escape_string($conn, $_POST["search_username"]);
    $search_husband_fname = mysqli_real_escape_string($conn, $_POST["search_husband_fname"]);
    $search_wife_fname = mysqli_real_escape_string($conn, $_POST["search_wife_fname"]);
}

// Construct the WHERE clause based on search inputs
$whereClause = "";
if (!empty($search_username)) {
    $whereClause .= " AND username LIKE '%$search_username%'";
}
if (!empty($search_husband_fname)) {
    $whereClause .= " AND Hasband_fname LIKE '%$search_husband_fname%'";
}
if (!empty($search_wife_fname)) {
    $whereClause .= " AND wife_fname LIKE '%$search_wife_fname%'";
}

$sql = "SELECT * FROM divorce_table WHERE 1=1 $whereClause";
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divorce Applications</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css_manager.php'; ?>
    <style>
        body{
            background-color:rgba(0, 111, 170, 0.47);
            overflow-y: scroll; /* Always show vertical scrollbar */
        }
        .button {
    display: inline-block;
    padding: 8px 16px;
    margin-right: 10px;
    background-color:rgb(0, 110, 185);
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}
.button1 {
    display: inline-block;
    padding: 8px 16px;
    margin-right: 10px;
    background-color: red;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}
.button2 {
    display: inline-block;
    padding: 8px 12px;
    margin-right: 10px;
    background-color: green;
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
    <h5><center>Divorce Applications</center></h5>
 
    <?php
    // Check if the message parameter is set in the URL
    if (isset($_GET['message'])) {
        // Display the message
        echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
    } 
    ?>
            <!-- Search form -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="search_username" placeholder="Search by Username" value="<?php echo $search_username; ?>">
                <input type="text" name="search_husband_fname" placeholder="Search by Husband's First Name" value="<?php echo $search_husband_fname; ?>">
                <input type="text" name="search_wife_fname" placeholder="Search by Wife's First Name" value="<?php echo $search_wife_fname; ?>">
                <button type="submit"  class="btn btn-primary">Search</button>
            </form>
            <!-- End of search form -->

            <table border="1px">
                <tr>
                    <th class="tt">NO</th>
                    <th class="tt">Username</th>
                    <th class="tt">Husband Name</th>
           
                    <th class="tt">Wife Name</th>
    
                    <th class="tt">Divorce Kebele</th>
                    <th class="tt">Number of Children</th>
                    <th class="tt"> States</th>
                    <th class="tt">Payment</th>
                    <th class="tt">certficate</th>
                    <th class="tt">Action</th>
                </tr>

                <?php 
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="td_tale"><?php echo $count++; ?></td>
                            <td class="td_tale"><?php echo $row['username']; ?></td>
                            <td class="td_tale">
    <?php echo htmlspecialchars($row['Hasband_fname'] . ' ' . $row['Hasband_mname'] . ' ' . $row['Hasband_lname']); ?>
</td>

<td class="td_tale">
    <?php echo htmlspecialchars($row['wife_fname'] . ' ' . $row['wife_mname'] . ' ' . $row['wife_lname']); ?>
</td>

                            <td class="td_tale"><?php echo $row['Divorce_kebele']; ?></td>
                            <td class="td_tale"><?php echo $row['Number_of_child']; ?></td>
                            <td class="td_tale"><?php echo $row['Divorce_states']; ?></td>
                            <td class="td_tale"><?php echo $row['Payment']; ?></td>
                            <td class="tt">  <a  class="button2" href="view_certficate_divorce_manager.php?username=<?php echo $row['username']; ?>">view</a></td>
                            <td class="td_taleee">
                            <a  class="button1" href="delete_event_divorce_manager.php?username=<?php echo $row['username']; ?>">Delete</a> </td>
                            <td class="td_taleee">   <a  class="button" href="update_event_divorce_manager.php?username=<?php echo $row['username']; ?>">Update</a>
                        </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="12" class="not-registered">No Divorce Application found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
