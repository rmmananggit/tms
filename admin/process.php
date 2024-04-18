<?php
include('include/authentication.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';




if (isset($_POST['delete_subscription']))
 {
    $id = $_POST['delete_subscription'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `subscriptions` SET `status`='Rejected' WHERE `id` = $id";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

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

        $mail->Subject = "$firstname $lastname";
        $mail->Body = "You account subscription has been rejected.";
        $mail->send();


        $_SESSION['status'] = "Subscription has been rejected";
        $_SESSION['status_code'] = "success";
        header('Location: subscription.php');
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}


if (isset($_POST['approve_subscription'])) {
    $id = $_POST['approve_subscription'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `subscriptions` SET `status`='Active' WHERE `id` = $id";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

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

        $mail->Subject = "Welcome to TEACHMESENSIE Online Tutorial - Your Account Has Been Approved!";
        $mail->Body = "Dear <b>$firstname $lastname</b>, <br> <br>We are thrilled to welcome you aboard TEACHMESENSIE Online Tutorial! Your account has been successfully approved, and we're excited to have you join our community of learners. <br> With your account now active, you have unlocked a world of opportunities for learning and growth. Whether you're seeking to enhance your skills, explore new subjects, or prepare for exams, our platform is here to support you every step of the way. <br>";
        $mail->send();



        $_SESSION['status'] = "Subscription has been set to active";
        $_SESSION['status_code'] = "success";
        header('Location: subscription.php');
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}



if (isset($_POST['editprofile'])) {
    $user_id = $_POST['user_id'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $existingPicture = '';  // Variable to store the existing profile picture

    // Check if a new profile picture is selected
    if (!empty($_FILES['picture']['name'])) {
        // New picture is selected, get its contents
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
    } else {
        // No new picture selected, retain the existing one
        $existingPictureQuery = "SELECT profilepicture FROM admin WHERE user_id=?";
        $stmt = mysqli_prepare($con, $existingPictureQuery);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $existingPicture);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `admin` SET `address`=?, `phone_number`=?, `email`=?, `profilepicture`=? WHERE `user_id`=?";
    
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssi", $address, $phone, $email, $picture, $user_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION['status'] = "Profile has been updated";
            $_SESSION['status_code'] = "success";
            header('Location: 1.php');
            exit();
        } else {
            $_SESSION['status'] = "Error updating profile: " . mysqli_error($con);
            $_SESSION['status_code'] = "error";
            header('Location: 1.php');
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['status'] = "Error preparing statement: " . mysqli_error($con);
        $_SESSION['status_code'] = "error";
        header('Location: users-profile.php');
        exit();
    }
}

if (isset($_POST['profile_changepassword'])) {
    $user_id = $_POST['user_id'];
    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];

    // Validate that the new password matches the re-entered password
    if ($newpassword != $renewpassword) {
        $_SESSION['status'] = "New password and re-entered password do not match!";
        $_SESSION['status_code'] = "error";
        header('Location: users-profile.php');
        exit();
    }

    // Check the current password before updating
    $checkPasswordQuery = "SELECT `password` FROM `admin` WHERE `user_id` = ?";
    $stmt = mysqli_prepare($con, $checkPasswordQuery);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $storedPassword);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the current password
    if ($currentpassword == $storedPassword) {
        // Update the password in the database
        $updatePasswordQuery = "UPDATE `admin` SET `password` = ? WHERE `user_id` = ?";
        $stmt = mysqli_prepare($con, $updatePasswordQuery);
        mysqli_stmt_bind_param($stmt, "si", $newpassword, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $_SESSION['status'] = "Password changed successfully!";
        $_SESSION['status_code'] = "success";
        header('Location: users-profile.php');
        exit();
    } else {
        $_SESSION['status'] = "Incorrect current password!";
        $_SESSION['status_code'] = "error";
        header('Location: users-profile.php');
        exit();
    }

    mysqli_close($con);
}

if (isset($_POST['approvestudent'])) {
    $user_id = $_POST['approvestudent'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];


    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `student` SET `user_status`='Approved' WHERE `user_id` = $user_id";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

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

        $mail->Subject = "Welcome to TEACHMESENSIE Online Tutorial - Your Account Has Been Approved!";
        $mail->Body = "Dear <b>$firstname $lastname</b>, <br> <br>We are thrilled to welcome you aboard TEACHMESENSIE Online Tutorial! Your account has been successfully approved, and we're excited to have you join our community of learners. <br> With your account now active, you have unlocked a world of opportunities for learning and growth. Whether you're seeking to enhance your skills, explore new subjects, or prepare for exams, our platform is here to support you every step of the way. <br>";
        $mail->send();

        $_SESSION['status'] = "Student application approved";
        $_SESSION['status_code'] = "success";
        header('Location: student.php');
        exit(0);
    } else {
        $_SESSION['status'] = "Invalid Email Address";
        $_SESSION['status_code'] = "error";
        header('Location: student.php');
        exit(0);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

if (isset($_POST['rejectstudent'])) {
    $user_id = $_POST['rejectstudent'];
    $email = $_POST['email'];
    $subject = "Account Rejected";
    $message = "Your account verification has been rejected.";

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `student` SET `user_status`='Rejected' WHERE `user_id` = $user_id";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

         // nvih uxxr ogwz xrai

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
 
         $mail->Subject = "$subject";
         $mail->Body = "$message";
         $mail->send();
 
 
        $_SESSION['status'] = "Student application rejected";
        $_SESSION['status_code'] = "success";
        header('Location: student.php');
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}



?>

