<?php
include("./include/authentication.php");    

// Debugging: Check session data
var_dump($_SESSION['auth_user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user_id from session
    $user_id = $_SESSION['auth_user']['user_id'];

    // Debugging: Check POST data
    var_dump($_POST);

    // Get student_id from POST request
    $student_id = $_POST['student_id'];

    // Get message from POST request
    $message = $_POST['message'];

    // Prepare the SQL statement
    $query = "INSERT INTO `message` (`tutor_id`, `student_id`, `message_text`, `timestamp`) 
              VALUES (?, ?, ?, NOW())";

    // Prepare and bind parameters
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'iis', $user_id, $student_id, $message);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo 'Message sent successfully';
    } else {
        echo 'Error: ' . mysqli_error($con);
    }

    // Close statement and conection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
