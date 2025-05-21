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
    $whereClause .= " AND Wife_fname LIKE '%$search_wife_fname%'";
}

$sql = "SELECT * FROM marriage_table WHERE 1=1 $whereClause";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Application</title>
    <?php include 'scroll_css.php'; ?>
    <?php include 'admin_css.php'; ?>
    <style>
        body{
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

        <h5><center>Marriage Application</center></h5>
        <!-- Search form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="search_username" placeholder="Search by Username" value="<?php echo $search_username; ?>">
            <input type="text" name="search_husband_fname" placeholder="Search by Husband's First Name" value="<?php echo $search_husband_fname; ?>">
            <input type="text" name="search_wife_fname" placeholder="Search by Wife's First Name" value="<?php echo $search_wife_fname; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <!-- End of search form -->
        <center>
        <div class="container-fluid">
            <div class="table-container">
                <?php if ($result && mysqli_num_rows($result) > 0) : ?>
                    <table border="1px">
                        <tr>
                            <th class="ttt">Username</th>
                            <th class="ttt">Husband Name</th>

                            <th class="ttt">Wife Name</th>
                
                            <th class="ttt">Husband's date of birth</th>
                            <th class="ttt">Wife's date of birth</th>
                            <th class="ttt">Husband's Nationality</th>
                            <th class="ttt">Wife's date of Nationality</th>
                            <th class="ttt">ate of Marriage </th>
                            <th class="ttt">Marital Status</th>
                            <th class="ttt">Status</th>
                            <th class="ttt">Payment</th>
                            <th class="ttt">certificate</th>
                            <th class="ttt">Action</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td class="tt"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['Hasband_fname'] . ' ' . $row['Hasband_mname'] . ' ' . $row['Hasband_lname']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['Wife_fname'] . ' ' . $row['Wife_mname'] . ' ' . $row['Wife_lname']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['hasband_birth_date']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['wife_birth_date']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['Hasband_natinality']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['wife_natinality']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['Marrage_date']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['Marrage_condition']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['Marriage_status']); ?></td>
                                <td class="tt"><?php echo htmlspecialchars($row['Payemnt']); ?></td>
                                <td class="tt">  <a  class="btn btn-success" href="view_certficate_marriage.php?username=<?php echo $row['username']; ?>">view</a></td>
                                <td class="td_taleee">
                      
         <a  class="button" href="update_event_marriage.php?username=<?php echo $row['username']; ?>">Update</a>
                        </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else : ?>
                    <p class="not-registered">No Marriage records found.</p>
                <?php endif; ?>
            </div>
        </div>
    </center>
</body>

</html>

<?php

?>
