<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'teachmesensie';

// Create backup directory if it doesn't exist
$backupDirectory = 'backup';
if (!is_dir($backupDirectory)) {
    mkdir($backupDirectory);
}

// Create a temporary backup file
$backupFile = $backupDirectory . '/database_backup_' . date('YmdHis') . '.sql';

// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve table names from the database
$tables = array(
    'admin',
    'admin_notification',
    'message',
    'module_submit',
    'student',
    'student_notification',
    'student_payment',
    'subscriptions',
    'tutor',
    'tutorial_application',
    'tutorial_module',
    'tutorial_module_files',
    'tutorial_schedule',
    'tutorial_services',
    'tutorial_services_review',
    'tutor_notification',
);

// Open the backup file for writing
$file = fopen($backupFile, 'w');

// Export each table to the backup file
foreach ($tables as $table) {
    // Export table structure
    $createTableSql = "SHOW CREATE TABLE `$table`";
    $createTableResult = $connection->query($createTableSql);
    $createTableData = $createTableResult->fetch_assoc();

    fwrite($file, $createTableData['Create Table'] . ";\n");

    // Export table data
    $selectDataSql = "SELECT * FROM `$table`";
    $selectDataResult = $connection->query($selectDataSql);

    while ($row = $selectDataResult->fetch_assoc()) {
        $keys = array_map([$connection, 'real_escape_string'], array_keys($row));
        $values = array_map([$connection, 'real_escape_string'], array_values($row));
        $insertSql = "INSERT INTO `$table` (`" . implode('`,`', $keys) . "`) VALUES ('" . implode("','", $values) . "');\n";
        fwrite($file, $insertSql);
    }

    fwrite($file, "\n");
}

// Close the backup file
fclose($file);

// Force the backup file to download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
header('Content-Length: ' . filesize($backupFile));
readfile($backupFile);

// Close the database connection
$connection->close();
?>
