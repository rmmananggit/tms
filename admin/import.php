<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'teachmesensie';
session_start();


// Check if the form is submitted
if (isset($_POST['import'])) {
    // Temporary backup file to import
    $backupFile = $_FILES['backupFile']['tmp_name'];

    // Create a database connection
    $connection = new mysqli($host, $username, $password, $database);

    // Check for connection errors
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Disable foreign key checks temporarily
    $connection->query('SET FOREIGN_KEY_CHECKS=0');

    // Clear existing database tables
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
    foreach ($tables as $table) {
        $dropTableSql = "DROP TABLE IF EXISTS `$table`";
        $connection->query($dropTableSql);
    }

    // Read the backup file
    $sqlStatements = file_get_contents($backupFile);

    // Execute the SQL statements
    if ($connection->multi_query($sqlStatements)) {
        do {
            // Discard results
            if ($result = $connection->store_result()) {
                $result->free();
            }
        } while ($connection->next_result());
    } else {
        echo "Error importing database: " . $connection->error;
    }

    // Re-enable foreign key checks
    $connection->query('SET FOREIGN_KEY_CHECKS=1');

    // Close the database connection
    $connection->close();

    $_SESSION['status'] = "Database imported successfully";
      $_SESSION['status_code'] = "success";
      header('Location: back_restore.php');
      exit(0);
}
?>
