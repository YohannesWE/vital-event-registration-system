<?php
// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vital_event';

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get all tables from the database
$tables = array();
$result = mysqli_query($connection, 'SHOW TABLES');
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Create a file name for the exported database
$filename = 'vital_event_backup_' . date('Y-m-d') . '.sql';

// Start the file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Export each table's data
foreach ($tables as $table) {
    $result = mysqli_query($connection, 'SELECT * FROM ' . $table);
    $numFields = mysqli_num_fields($result);

    // Generate SQL statements for table creation
    $tableCreate = mysqli_query($connection, 'SHOW CREATE TABLE ' . $table);
    $tableCreateRow = mysqli_fetch_row($tableCreate);
    echo $tableCreateRow[1] . ";\n\n";

    // Generate SQL statements for table data insertion
    while ($row = mysqli_fetch_row($result)) {
        echo 'INSERT INTO ' . $table . ' VALUES(';
        for ($i = 0; $i < $numFields; $i++) {
            $row[$i] = addslashes($row[$i]);
            if (isset($row[$i])) {
                echo '"' . $row[$i] . '"';
            } else {
                echo 'NULL';
            }
            if ($i < $numFields - 1) {
                echo ',';
            }
        }
        echo ");\n";
    }
    echo "\n";
}

// Close the database connection
mysqli_close($connection);
?>