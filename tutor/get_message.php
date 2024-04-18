<?php
include("./include/authentication.php");

// Check if student_id and tutor_id are provided via GET request
if(isset($_GET['student_id'])) {
    // Get student_id and tutor_id from GET request
    $student_id = $_GET['student_id'];
    $tutor_id = $_SESSION['auth_user']['user_id'];

    // Fetch the latest 5 messages from the database for the given student_id and tutor_id
    $query = "SELECT `message_text`, `timestamp` FROM `message` WHERE `student_id` = '$student_id' AND `tutor_id` = '$tutor_id' ORDER BY `timestamp` DESC";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Error fetching messages: ' . mysqli_error($con));
    }

    $messages = []; // Array to store messages

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Push each message to the messages array
            $messages[] = '<li class="list-group-item">' . $row['message_text'] . ' <span class="badge badge-secondary">' . $row['timestamp'] . '</span></li>';
        }
    } else {
        // If no messages, add a placeholder message
        $messages[] = '<li class="list-group-item">No messages yet</li>';
    }

    // Output the messages as JSON
    echo json_encode($messages);

    mysqli_close($con);
} else {
    // If student_id or tutor_id is not provided, handle the error or redirect to another page
    // For demonstration, let's echo an error message
    echo '<li class="list-group-item">Error: student_id or tutor_id not provided</li>';
}
?>
