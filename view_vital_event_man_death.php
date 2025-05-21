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
$search_k_id_no = $search_f_name = "";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store search input values
    $search_k_id_no = mysqli_real_escape_string($conn, $_POST["search_k_id_no"]);
    $search_f_name = mysqli_real_escape_string($conn, $_POST["search_f_name"]);
}

// Construct the WHERE clause based on search inputs
$whereClause = "";
if (!empty($search_k_id_no)) {
    $whereClause .= " AND k_id_no LIKE '%$search_k_id_no%'";
}
if (!empty($search_f_name)) {
    $whereClause .= " AND f_name LIKE '%$search_f_name%'";
}

$sql = "SELECT * FROM death_table WHERE 1=1 $whereClause";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Display the data
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VITAL EVENT death application</title>
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
    background-color:rgba(255, 77, 77, 0.26);
    color: rgba(0, 111, 170, 0.26);
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}
.button-container {
    display: inline-block;
}
.btn-danger {
    background-color:rgb(251, 206, 177); /* example red */
    color: white;
    font-weight: bold;
}
    </style>
</head>

<body>
<div class="container-fluid">
        <div class="table-container">
    <h5><center>Death applications</center></h5>
    <?php
    // Check if the message parameter is set in the URL
    if (isset($_GET['message'])) {
        // Display the message
        echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
    } 
    ?>
            <!-- Search form -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="search_k_id_no" placeholder="Search by K_ID number" value="<?php echo $search_k_id_no; ?>">
                <input type="text" name="search_f_name" placeholder="Search by first name" value="<?php echo $search_f_name; ?>">
                <button type="submit"  class="btn btn-primary">Search</button>
            </form>
            <!-- End of search form -->

            <table border="1px">
                <tr>
                <th class="tt">No</th>
<th class="tt">Kebele ID</th>
<th class="tt">Name</th>
<th class="tt">Sex</th>
<th class="tt">Nationality</th>
<th class="tt">Death Date</th>
<th class="tt">Age</th>
<th class="tt">Marital Status</th>
<th class="tt">Children Number</th>
<th class="tt">Place of Death</th>
<th class="tt">Registrant's Name</th>
<th class="tt">Relationship</th>
<th class="tt">Status</th>
<th class="tt">Payment </th>
<th class="tt">Certificate </th>
<th class="tt">Action</th>
<?php 
$count = 1;
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate age from birth and death dates
        $birthDate = $row['Birth_date'] ?? null;
        $deathDate = $row['Death_date'] ?? null;
        $age = "-";
        if ($birthDate && $deathDate) {
            try {
                $birth = new DateTime($birthDate);
                $death = new DateTime($deathDate);
                $age = $birth->diff($death)->y; // Difference in years
            } catch (Exception $e) {
                $age = "Invalid date";
            }
        }
?>
<tr>
    <td class="td_tale"><?php echo $count++; ?></td>
    <td class="td_tale"><?php echo $row['k_id_no']; ?></td>
    <td class="td_tale"><?php echo htmlspecialchars($row['f_name'] . ' ' . $row['m_name'] . ' ' . $row['l_name']); ?></td>
    <td class="td_tale"><?php echo $row['Sex']; ?></td>
    <td class="td_tale"><?php echo $row['Nationality']; ?></td>
    <td class="td_tale"><?php echo $row['Death_date']; ?></td>
    <td class="td_tale"><?php echo $age; ?></td> <!-- ✅ calculated -->
    <td class="td_tale"><?php echo $row['Marriage_status']; ?></td>
    <td class="td_tale"><?php echo $row['child_number']; ?></td>
    <td class="td_tale"><?php echo $row['Death_place']; ?></td>
    <td class="td_tale"><?php echo $row['r_fname'] . ' ' . $row['r_mname']; ?></td>
    <td class="td_tale"><?php echo $row['Death_states']; ?></td>
    <td class="td_tale"><?php echo $row['Death_states']; ?></td>
    <td class="td_tale"><?php echo $row['Payemnt']; ?></td>
    <td class="td_tale"><a class="btn btn-success" href="view_certficate_death_manager.php?k_id_no=<?php echo $row['k_id_no']; ?>">view</a></td>
    <td class="td_taleee">
        <a class="btn btn-danger" href="update_death_manager.php?k_id_no=<?php echo $row['k_id_no']; ?>" onclick="return confirm('Are you sure you want to update this record?');" style="font-weight: bold;">Update</a>
        <a class="btn btn-secondary" href="delete_death_manager.php?k_id_no=<?php echo $row['k_id_no']; ?>" onclick="return confirm('⚠️ Are you sure you want to DELETE this record? This action cannot be undone.');">Delete</a>
    </td>
</tr>
<?php
    }
} else {
?>
<tr>
    <td colspan="16" class="not-registered">No death applications found.</td>
</tr>
<?php } ?>


                </tr>

                <?php 
                $count = 1;
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="td_tale"><?php echo $count++; ?></td>
                            <td class="td_tale"><?php echo $row['k_id_no']; ?></td>
                            <td class="td_tale">
                                
    <?php echo htmlspecialchars($row['f_name'] . ' ' . $row['m_name'] . ' ' . $row['l_name']); ?>
</td>

                            <td class="td_tale"><?php echo $row['Sex']; ?></td>
                            <td class="td_tale"><?php echo $row['Nationality']; ?></td>
                            <td class="td_tale"><?php echo $row['Death_date']; ?></td>
                            <td class="td_tale"><?php echo $row['Death_age']; ?></td>

                            <td class="td_tale"><?php echo $row['Marriage_status']; ?></td>
                            <td class="td_tale"><?php echo $row['child_number']; ?></td>
                            <td class="td_tale"><?php echo $row['Death_place']; ?></td>
                            <td class="td_tale"><?php echo $row['r_fname'] . ' ' . $row['r_mname']; ?></td>
                            <td class="td_tale"><?php echo $row['Death_states']; ?></td>
                            <td class="td_tale"><?php echo $row['Death_states']; ?></td>
                            <td class="td_tale"><?php echo $row['Payemnt']; ?></td>
                            <td class="td_tale"> <a  class="btn btn-success" href="view_certficate_death_manager.php?k_id_no=<?php echo $row['k_id_no']; ?>">view</a></td>
                            <td class="td_taleee">
<!-- Update Button with confirmation -->
<a class="btn btn-danger" 
   href="update_death_manager.php?k_id_no=<?php echo $row['k_id_no']; ?>" 
   onclick="return confirm('Are you sure you want to update this record?');" 
   style="font-weight: bold;">Update</a>

<!-- Delete Button with confirmation -->
<a class="btn btn-secondary" 
   href="delete_death_manager.php?k_id_no=<?php echo $row['k_id_no']; ?>" 
   onclick="return confirm('⚠️ Are you sure you want to DELETE this record? This action cannot be undone.');">Delete</a>
    
</td>

                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="16" class="not-registered">No divorce Application Found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
