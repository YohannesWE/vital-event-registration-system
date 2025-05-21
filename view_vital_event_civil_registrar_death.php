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

    <h5><center>Death applications</center></h5>
    <div class="container-fluid">
        <div class="table-container">
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
<th class="tt">Gender</th>
<th class="tt">Nationality</th>
<th class="tt">Date of Death</th>
<th class="tt">Date of birth</th>
<th class="tt">Marital Status</th>
<th class="tt">Children Number</th>
<th class="tt">Place of Death</th>
<th class="tt">Registrant's Name</th>
<th class="tt">Relationship</th>
<th class="tt">Status</th>
<th class="tt">Payment </th>
<th class="tt">Certificate </th>
<th class="tt">Action</th>


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
                            <td class="td_tale"><?php echo $row['Birth_date']; ?></td>

                            <td class="td_tale"><?php echo $row['Marriage_status']; ?></td>
                            <td class="td_tale"><?php echo $row['child_number']; ?></td>
                            <td class="td_tale"><?php echo $row['Death_place']; ?></td>
                            <td class="td_tale"><?php echo $row['r_fname'] . ' ' . $row['r_mname']; ?></td>
                            <td class="td_tale"><?php echo $row['Relationship_type']; ?></td>
                            <td class="td_tale"><?php echo $row['Death_states']; ?></td>
                            <td class="td_tale"><?php echo $row['Payemnt']; ?></td>
                            <td class="td_tale"> <a  class="btn btn-success" href="view_certficate_death.php?k_id_no=<?php echo $row['k_id_no']; ?>">view</a></td>
                            <td class="td_taleee">
    <a  class="btn btn-primary" href="update_death.php?k_id_no=<?php echo $row['k_id_no']; ?>" >Update</a>  </td> 
  
    
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
