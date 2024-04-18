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
    $gradelevel = $_POST['gradelevel'];
    $school = $_POST['school'];
    $captcha = $_REQUEST['captcha'];
    $captcharandom = $_REQUEST['captcha-rand'];

    if($captcha!=$captcharandom)
    {
        $_SESSION['status'] = 'Error! Invalid Captcha';
        $_SESSION['status_code'] = 'error';
        header('Location: student_register.php');
        exit();
    }

    // Validate file uploads
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    // Validate ID Picture
    if ($_FILES['idpicture']['error'] === UPLOAD_ERR_OK) {
        $idPictureType = $_FILES['idpicture']['type'];
        $idPictureSize = $_FILES['idpicture']['size'];

        if (!in_array($idPictureType, $allowedTypes) || $idPictureSize > $maxFileSize) {
            $_SESSION['status'] = 'ID Picture must be a JPEG, PNG, or GIF image file less than 5MB.';
            $_SESSION['status_code'] = 'error';
            header('Location: student_register.php');
            exit();
        }

        $idpicturecontent = file_get_contents($_FILES['idpicture']['tmp_name']);
    } else {
        $_SESSION['status'] = 'Failed to upload ID Picture.';
        $_SESSION['status_code'] = 'error';
        header('Location: student_register.php');
        exit();
    }

    // Validate Profile Picture
    if ($_FILES['profilepicture']['error'] === UPLOAD_ERR_OK) {
        $profilePictureType = $_FILES['profilepicture']['type'];
        $profilePictureSize = $_FILES['profilepicture']['size'];

        if (!in_array($profilePictureType, $allowedTypes) || $profilePictureSize > $maxFileSize) {
            $_SESSION['status'] = 'Profile Picture must be a JPEG, PNG, or GIF image file less than 10KB.';
            $_SESSION['status_code'] = 'error';
            header('Location: student_register.php');
            exit();
        }

        $profilePictureContent = file_get_contents($_FILES['profilepicture']['tmp_name']);
    } else {
        $_SESSION['status'] = 'Failed to upload Profile Picture.';
        $_SESSION['status_code'] = 'error';
        header('Location: student_register.php');
        exit();
    }

    // Use prepared statement to avoid SQL injection
    $stmt = $con->prepare("INSERT INTO `student`(`email`, `password`, `firstname`, `middlename`, `lastname`, `suffix`, `phone_number`, `gender`, `barangay`, `municipality`, `zipcode`, `gradelevel`, `school`, `id_picture`, `profilepicture`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die('Error in preparing the statement: ' . $con->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssssssssss", $email, $password, $fname, $mname, $lname, $suffix, $phone, $gender, $barangay, $municipality, $zipcode, $gradelevel, $school, $idpicturecontent, $profilePictureContent);

    // Execute the query
    $result = $stmt->execute();

    // add new notification in admin

    $notif = "Student user $fname $lname has been registered";
    $query3 = "INSERT INTO `admin_notification`(`message`) VALUES ('$notif')";
    $query_run3 = mysqli_query($con, $query3);


    if ($result) {
        // Registration successful
        $_SESSION['status'] = 'Congratulations! Your registration has been successfully submitted. Please await confirmation from our administrative team. Thank you for choosing our service. We look forward to welcoming you soon!';
        $_SESSION['status_code'] = 'success';
    } else {
        // Registration failed
        $_SESSION['status'] = 'Registration failed: ' . $stmt->error;
        $_SESSION['status_code'] = 'error';
    }

    // Close the statement
    $stmt->close();

    // Redirect to the registration page
    header('Location: student_login.php');
    exit();
} else {
    // If the form is not submitted, redirect to the registration page
    header('Location: student_register.php');
    exit();
}
?>
