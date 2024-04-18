<?php
session_start();
require_once 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_data = $_SESSION['user_data'];
    $otp_entered = 123456;

    if ($otp_entered === $user_data['otp']) {
        // Update user as verified in the database
        $stmt = $con->prepare("UPDATE user_accounts SET is_verified = 1 WHERE phone_number = ?");
        $stmt->bind_param("s", $user_data['phonenumber']);
        $stmt->execute();
        $stmt->close();

        // Registration successful, redirect to login page
        $_SESSION['status'] = "Registration Complete!";
        $_SESSION['status_code'] = "success";
        header('Location: ../login/index.php');
        exit();
    } else {
        $_SESSION['status'] = "Please try again.";
        $_SESSION['status_code'] = "error";
    }
}

// If the OTP is invalid or the request method is not POST, stay on the same page
header('Location: otp.php');
exit();
?>
