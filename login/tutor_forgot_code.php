<?php
session_start();
include('./config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Function to generate a random OTP
function generateOTP($length = 5) {
    $characters = '0123456789';
    $otp = '';

    // Get the total number of characters in the string
    $charactersLength = strlen($characters);

    // Generate an OTP of specified length
    for ($i = 0; $i < $length; $i++) {
        // Choose a random character from the character set
        $otp .= $characters[rand(0, $charactersLength - 1)];
    }

    return $otp;
}

if (isset($_POST['forgot'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validate email format

    if (!$email) {
        $_SESSION['status'] = "Invalid email address format.";
        $_SESSION['status_code'] = "error";
        header("Location: tutor_forgot.php");
        exit;
    }

    $_SESSION['forgot_email'] = $email;

    // Check if email exists in the database
    $sql = "SELECT * FROM tutor WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique OTP
        $otp = generateOTP();

        // Store the OTP in the database
        $sql = "UPDATE tutor SET otp = ? WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $otp, $email);
        $stmt->execute();

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tms.onlinesystem@gmail.com';
        $mail->Password = 'nvihuxxrogwzxrai';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('tms.onlinesystem@gmail.com');

        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = "Tutor Forgot Password OTP";
        $mail->Body = "Your One-Time Password (OTP) for resetting your password is: <b>$otp</b>. <br> <br>Please use this OTP to proceed with resetting your password.<br> <br>If you didn't request this change, please ignore this email or contact support immediately.<br> <br>Best regards,<br>TEACH ME SENSIE DEVELOPMENT TEAM";


        $mail->send();

        // Redirect to otp.php with OTP as query parameter
        header("Location: tutor_forgot_otp.php");
        exit;
    } else {
        header("Location: tutor_forgot_otp.php");
        exit;
    }
}


if (isset($_POST['forgot_otp'])) {
    // Retrieve email from session
    $email = $_POST['sessionemail'];
    $entered_otp = $_POST['otp'];

    // Check if the entered OTP matches the one stored in the database
    $sql = "SELECT * FROM tutor WHERE email = ? AND otp = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $entered_otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a new random password
        $new_password = generateRandomPassword();

        // Update the password in the database for the user with the provided email
        $sql = "UPDATE tutor SET password = ? WHERE email = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $new_password, $email);
        $stmt->execute();

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tms.onlinesystem@gmail.com';
        $mail->Password = 'nvihuxxrogwzxrai';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('tms.onlinesystem@gmail.com');

        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = "Tutor New Password";
        $mail->Body = "<br>Your password has been successfully reset. Your new password is: <b>$new_password</b>.<br><br>If you did not request this change or have any concerns, please contact support immediately.<br><br>Best regards,<br>TEACH ME SENSIE DEVELOPMENT TEAM";


        $mail->send();

    
        $_SESSION['status'] = "Password reset successful. Check your email for the new password.";
        $_SESSION['status_code'] = "success";
        header("Location: tutor_login.php");
        exit; // Stop further execution
    } else {
        // Redirect the user back to the OTP page with an error message
        $_SESSION['status'] = "Incorrect OTP. Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: tutor_forgot_otp.php");
        exit; // Stop further execution
    }
} else {
    // Redirect the user to the forgot password page if they accessed this script directly without submitting the form
    header("Location: tutor_forgot.php");
    exit; // Stop further execution
}

// Function to generate a random password
function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    // Get the total number of characters in the string
    $charactersLength = strlen($characters);

    // Generate a random password of specified length
    for ($i = 0; $i < $length; $i++) {
        // Choose a random character from the character set
        $password .= $characters[rand(0, $charactersLength - 1)];
    }

    return $password;
}

?>
