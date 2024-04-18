<?php
// Start or resume the session
session_start();

// Include database configuration
include_once 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fname = $_POST['fname'];
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
    $lname = $_POST['lname'];
    $suffix = isset($_POST['suffix']) ? $_POST['suffix'] : '';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $educationalAttainment = $_POST['educational_attainment'];
    $skills = implode(", ", $_POST['skills']); // Convert skills array to a comma-separated string
    $aboutme = $_POST['aboutme'];
    $captcha = $_REQUEST['captcha'];
    $captcharandom = $_REQUEST['captcha-rand'];

    if($captcha!=$captcharandom)
    {
        $_SESSION['status'] = 'Error! Invalid Captcha';
        $_SESSION['status_code'] = 'error';
        header('Location: tutor.php');
        exit();
    }

    // File upload handling for resume
    $resumeFilePath = '../uploads/' . basename($_FILES['resume']['name']);

    // Check file type
    $resumeFileType = strtolower(pathinfo($resumeFilePath, PATHINFO_EXTENSION));
    if ($resumeFileType != 'pdf') {
        $_SESSION['status'] = 'Resume must be in PDF format.';
        $_SESSION['status_code'] = 'error';
        header('Location: tutor_register.php');
        exit();
    }

    move_uploaded_file($_FILES['resume']['tmp_name'], $resumeFilePath);

    // Validate profile picture upload
    if ($_FILES['profilepicture']['error'] === UPLOAD_ERR_OK) {
        $profilePictureSize = $_FILES['profilepicture']['size'];
        $profilePictureType = $_FILES['profilepicture']['type'];
        $profilePictureContent = file_get_contents($_FILES['profilepicture']['tmp_name']);

        // Check file size
        if ($profilePictureSize > 5 * 1024 * 1024) { // 5MB
            $_SESSION['status'] = 'Profile picture size should be less than 5MB.';
            $_SESSION['status_code'] = 'error';
            header('Location: tutor_register.php');
            exit();
        }

        // Check file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($profilePictureType, $allowedTypes)) {
            $_SESSION['status'] = 'Profile picture must be in JPEG, PNG, or GIF format.';
            $_SESSION['status_code'] = 'error';
            header('Location: tutor_register.php');
            exit();
        }
    } else {
        // Handle profile picture upload errors
        $_SESSION['status'] = 'Failed to upload profile picture.';
        $_SESSION['status_code'] = 'error';
        header('Location: tutor_register.php');
        exit();
    }

    // Use prepared statement to avoid SQL injection
    $stmt = $con->prepare("INSERT INTO `tutor`(`email`, `password`, `firstname`, `middlename`, `lastname`, `suffix`, `phone_number`, `gender`, `barangay`, `municipality`, `zipcode`, `aboutme`, `skills`, `educational`, `resume_file_path`, `profile_picture`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die('Error in preparing the statement: ' . $con->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssssssssss", $email, $password, $fname, $mname, $lname, $suffix, $phone, $gender, $barangay, $municipality, $zipcode, $aboutme, $skills, $educationalAttainment, $resumeFilePath, $profilePictureContent);

    // Execute the query
    $result = $stmt->execute();

    $notif = "Tutor user $fname $lname has been registered";
    $query3 = "INSERT INTO `admin_notification`(`message`) VALUES ('$notif')";
    $query_run3 = mysqli_query($con, $query3);

    if ($result) {
        // Registration successful
        $_SESSION['status'] = 'Registration successful';
        $_SESSION['status_code'] = 'success';
    } else {
        // Registration failed
        $_SESSION['status'] = 'Registration failed: ' . $stmt->error;
        $_SESSION['status_code'] = 'error';
    }

    // Close the statement
    $stmt->close();

    // Redirect to the registration page
    header('Location: tutor_login.php');
    exit();
} else {
    // If the form is not submitted, redirect to the registration page
    header('Location: tutor_register.php');
    exit();
}
?>
