<?php
session_start();
require_once 'dbcon.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '../PHPMailer/src/Exception.php';
// require '../PHPMailer/src/PHPMailer.php';
// require '../PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    
    // Check if middle name is set
    $middlename = isset($_POST['mname']) ? $_POST['mname'] : '';

    // Check if suffix is set
    $suffix = isset($_POST['suffix']) ? $_POST['suffix'] : '';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['confirmpassword'];
    $phonenumber = $_POST['phone'];
    $gender = $_POST['gender'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $educational_attainment = $_POST['educational_attainment'];
    $aboutme = $_POST['aboutme'];
    $skills_string = implode(', ', $_POST['skills']);
    $is_verified = "0";

    //longblob
    $profilepicture = $_POST['profilepicture'];

    //resume_file_path
    $resume = $_POST['resume'];

    if ($password !== $re_password) {
        $_SESSION['status'] = "Passwords do not match. Please re-enter your passwords.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); 
        exit();
    }

    // Example: Minimum password length of 8 characters
    if (strlen($password) < 3) {
        $_SESSION['status'] = "Password should be greater than 3 characters.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); 
        exit();
    }

    // Hash the password
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email is unique
    $email_check_stmt = $con->prepare("SELECT * FROM user_accounts WHERE email = ?");
    $email_check_stmt->bind_param("s", $email);
    $email_check_stmt->execute();
    $email_result = $email_check_stmt->get_result();
    $email_check_stmt->close();

    if ($email_result->num_rows > 0) {
        // Email is not unique, handle the error 
        $_SESSION['status'] = "Email is already in use. Please use a different email.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the index page
        exit();
    }

    // Check if the phone number is unique
    $phone_check_stmt = $con->prepare("SELECT * FROM user_accounts WHERE phone_number = ?");
    $phone_check_stmt->bind_param("s", $phonenumber);
    $phone_check_stmt->execute();
    $phone_result = $phone_check_stmt->get_result();
    $phone_check_stmt->close();

    if ($phone_result->num_rows > 0) {
        // Phone number is not unique, handle the error
        $_SESSION['status'] = "Phone number is already in use. Please use a different phone number.";
        $_SESSION['status_code'] = "error";
        header('Location: index.php'); // Redirect back to the index page
        exit();
    }

    // If both email and phone number are unique, proceed with insertion
    $otp = 123456;

        $stmt = $con->prepare("INSERT INTO `tutor`(`user_id`, `email`, `password`, `firstname`, `middlename`, `lastname`, `suffix`, `phone_number`, `gender`, `barangay`, `municipality`, `zipcode`, `aboutme`, `skills`, `educational`, `resume_file_path`, `profile_picture`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

    //     $firstname = htmlentities($_POST['firstname']);
    //     $lastname = htmlentities($_POST['lastname']);
    //     $email = htmlentities($_POST['email']);
    //     $otp = htmlentities($otp);

    //     $subject = 'Your One-Time Password (OTP) for Account Verification';
    //     $message = "
    //     Dear $firstname $lastname,<br>
    //     Thank you for registering with our platform. To verify your account, please use the following One-Time Password (OTP):<br>
    //     $otp<br>
    //     This OTP is valid for a single use and will expire in 5 minutes. Please enter this code on the verification page to complete the registration process.<br>
    //     If you did not attempt to register, please ignore this email.<br>
    //     ";

    //     $mail = new PHPMailer(true);
    //     $mail->isSMTP();
    //     $mail->Host = 'smtp.gmail.com';
    //     $mail->SMTPAuth = true;
    //     $mail->Username = 'teachmesenseitutorngsystem@gmail.com';
    //     $mail->Password= 'oxlhbwvzqhqcgwok';
    //     $mail->Port = 465;
    //     $mail->SMTPSecure = 'ssl';
    //     $mail->isHTML(true);
    //     $mail->setFrom($email, $firstname);
    //     $mail->addAddress("$email");
    //     $mail->Subject = ("$subject");
    //     $mail->Body = $message;
    //     $mail->send();

    // if (!$stmt) {
    //     die('Error during prepare: ' . $con->error);
    // }

    // Corrected binding parameters
    $stmt->bind_param("ssssssssss", $firstname,$middlename, $lastname, $suffix, $email, $password, $phonenumber, $is_verified, $user_type, $otp);

    if (!$stmt->execute()) {
        die('Error during execute: ' . $stmt->error);
    }

    // Store user data in session for verification
    $_SESSION['user_data'] = [
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'suffix' => $suffix,
        'phonenumber' => $phonenumber,
        'password' => $password,
        'otp' => $otp,
    ];

    // Redirect to OTP verification page
    header('Location: captcha.php');
    exit();
}

// function generateOTP() {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $otp = '';

//     for ($i = 0; $i < 8; $i++) {
//         $otp .= $characters[mt_rand(0, strlen($characters) - 1)];
//     }

//     return $otp;
// }
?>
