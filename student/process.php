                <?php
 include("./include/authentication.php");



 if(isset($_POST['apply'])) {

    $user_id = $_SESSION['auth_user']['user_id'];
    $job_id = $_POST['job_id'];
    $tutor_id = $_POST['tutor_id'];
    $tutoringmod = $_POST['tutoringmod'];
    $contact = $_POST['contact'];
    $learningdisabilities = $_POST['learningdisabilities'];
    $comment = $_POST['comment'];
    $notif = "New Student has been applied to your tutoring services";
    $modules = $_POST['modules'];

    foreach($modules as $module_id) {

        $insert_query = "INSERT INTO `tutorial_application`(`job_id`, `module_id`, `tutor_id`, `student_id`, `modoftutoring`, `parentcontact`, `learningdisabilities`, `additionalcomment`)  VALUES ('$job_id','$module_id','$tutor_id','$user_id','$tutoringmod','$contact','$learningdisabilities','$comment')";

        if(mysqli_query($con, $insert_query)) {
            continue;
        } else {
            echo "Error: " . mysqli_error($con);
            break;
        }
    }

    $query23 = "INSERT INTO `tutor_notification`(`user_id`, `message`) VALUES ('$tutor_id','$notif')";
    
    $query_run23 = mysqli_query($con, $query23);


    $_SESSION['status'] = "Congratulations! Your application has been successfully submitted. You will be notified once your application is reviewed by the tutor.";
    $_SESSION['status_code'] = "success";
    header("Location: search.php");
    exit();
}



 if(isset($_POST['submit_payment']))
 {
     $user_id = $_SESSION['auth_user']['user_id'];
    //  $reference = $_POST['reference'];
    //  $subs = $_POST['subscriptiontype'];
    //  $mop = $_POST['mop'];
    //  $receipt = $_FILES['receipt'];
     $gender = $_POST['gender'];
     $address = $_POST['address'];
     $barangay = $_POST['barangay'];
     $municipality = $_POST['municipality'];
     $zipcode = $_POST['zipcode'];
     $aboutme = $_POST['aboutme'];
 
    //  $query = "INSERT INTO `subscriptions`(`user_id`, `subscription_type`, `reference`, `modeofpayment`, `receipt`) VALUES ('$user_id','$subs','$reference','$mop','$receipt')";
    //  $query_run = mysqli_query($con, $query);
     
     $profile_picture = ''; // Set a default value
     if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
         $profile_picture = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
     }
 
     // Use prepared statements to prevent SQL injection
     $query1 = "INSERT INTO `tutee`(`user_id`, `gender`, `address`, `barangay`, `municipality`, `zipcode`, `aboutme`, `profile_picture`) VALUES ('$user_id','$gender','$address','$barangay','$municipality','$zipcode','$aboutme','$profile_picture')";
     
     $query_run1 = mysqli_query($con, $query1);
     if($query_run1)
     {
       header('Location: process_subscription.php');
         exit(0);
     }
     else
     {
        echo "Error: " . mysqli_error($con);
     }
 }


 if (isset($_POST['submit'])) {
    $user_id = $_SESSION['auth_user']['user_id'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $aboutme = $_POST['aboutme'];

    $profile_picture = ''; 
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
    }
    $identification = '';
    if (isset($_FILES['identification']) && $_FILES['identification']['error'] == 0) {
        $identification = addslashes(file_get_contents($_FILES['identification']['tmp_name']));
    }

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO `tutee`(`user_id`, `gender`, `address`, `barangay`, `municipality`, `zipcode`, `aboutme`, `profile_picture`, `identification`) VALUES ('$user_id','$gender','$address','$barangay','$municipality','$zipcode','$aboutme','$profile_picture','$identification')";
    
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Welcome";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit(0);
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

if (isset($_POST['editprofile'])) {
    $user_id = $_POST['user_id'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $school = $_POST['school'];
    $zipcode = $_POST['zipcode'];
    $existingPicture = '';  // Variable to store the existing profile picture

    // Check if a new profile picture is selected
    if (!empty($_FILES['picture']['name'])) {
        // New picture is selected, get its contents
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
    } else {
        // No new picture selected, retain the existing one
        $existingPictureQuery = "SELECT profilepicture FROM student WHERE user_id=?";
        $stmt = mysqli_prepare($con, $existingPictureQuery);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $existingPicture);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `student` SET `email`=?, `phone_number`=?, `barangay`=?, `municipality`=?, `zipcode`=?, `school`=?, `profilepicture`=? WHERE `user_id`=?";
    
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssssssi", $email, $phone, $barangay, $municipality, $zipcode, $school, $picture, $user_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Fetch the existing picture after executing the update statement
            $existingPictureQuery = "SELECT profilepicture FROM student WHERE user_id=?";
            $stmt = mysqli_prepare($con, $existingPictureQuery);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $existingPicture);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            $_SESSION['status'] = "Profile has been updated";
            $_SESSION['status_code'] = "success";
            header('Location: users-profile.php');
            exit();
        } else {
            $_SESSION['status'] = "Error updating profile: " . mysqli_error($con);
            $_SESSION['status_code'] = "error";
            header('Location: users-profile.php');
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
    $checkPasswordQuery = "SELECT `password` FROM `student` WHERE `user_id` = ?";
    $stmt = mysqli_prepare($con, $checkPasswordQuery);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $storedPassword);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the current password
    if ($currentpassword == $storedPassword) {
        // Update the password in the database
        $updatePasswordQuery = "UPDATE `student` SET `password` = ? WHERE `user_id` = ?";
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


if (isset($_POST['add_review'])) {
    $job_id = $_POST['job_id'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    $query = "INSERT INTO `tutorial_services_review`(`job_id`,`student_id`, `comment`, `stars`) VALUES ('$job_id','$user_id','$comment','$rating')";
    $query_run = mysqli_query($con, $query);

    
    if($query_run)
    {
        $_SESSION['status'] = "Rating Submitted";
        $_SESSION['status_code'] = "success";
      header('Location: review.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: review_add.php');
        exit(0);
    }
    mysqli_close($con);
} 


if (isset($_POST['submit_module_file'])) {
    // Retrieve form data
    $user_id = $_SESSION['auth_user']['user_id'];
    $module = $_POST['module'];
    $module_description = $_POST['module_description'];

    // Check if a file has been uploaded
    if ($_FILES['fileInput']['size'] > 0) {
        // File upload handling
        $uploadDir = '../uploads/'; // Directory to store uploaded files
        $fileName = $_FILES['fileInput']['name'];
        $fileTmpName = $_FILES['fileInput']['tmp_name'];
        $fileType = $_FILES['fileInput']['type'];

        // Move the uploaded file to the server
        $filePath = $uploadDir . $fileName;

        // Check if the directory exists, if not, create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($fileTmpName, $filePath)) {
            $query = "INSERT INTO `module_submit`(`description`, `file_name`, `file_type`, `file_path`, `module_id`, `user_id`) VALUES ('$module_description','$fileName','$fileType','$filePath','$module','$user_id')";
        } else {
            $_SESSION['status'] = "Error moving the file to the server";
            $_SESSION['status_code'] = "error";
            header('Location: module_submit.php');
            exit(0);
        }
    } else {
        // No file uploaded, set default values
        $fileName = "N/A";
        $fileType = "N/A";
        $filePath = "N/A";
        $query = "INSERT INTO `module_submit`(`description`, `file_name`, `file_type`, `file_path`, `module_id`, `user_id`) VALUES ('$module_description','$fileName','$fileType','$filePath','$module','$user_id')";
    }

    // Execute the query
    $query_run = mysqli_query($con, $query);

    // Check if the query executed successfully
    if ($query_run) {
        $_SESSION['status'] = "Your Activity has been submitted successfully";
        $_SESSION['status_code'] = "success";
        header('Location: module_submit.php');
        exit(0);
    } else {
        $_SESSION['status'] = "Error adding file to the database";
        $_SESSION['status_code'] = "error";
        header('Location: module_submit.php');
        exit(0);
    }
}


if(isset($_POST['delete_submit_file'])) {
    // Get the submit_id of the file to be deleted
    $submit_id = $_POST['delete_submit_file'];

    // Query to fetch the file details
    $query = "SELECT * FROM module_submit WHERE submit_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $submit_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // File path of the uploaded file
    $filePath = $row['file_path'];

    // Delete the file from the server
    if(file_exists($filePath)) {
        unlink($filePath); // Deletes the file
    }

    // Query to delete the record from the database
    $deleteQuery = "DELETE FROM module_submit WHERE submit_id = ?";
    $stmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $submit_id);
    $deleteResult = mysqli_stmt_execute($stmt);

    // Check if deletion was successful
    if($deleteResult) {
        // Redirect back to the page after successful deletion
        header("Location: ".$_SERVER['HTTP_REFERER']); // Redirect to the previous page

        $_SESSION['status'] = "File has been deleted";
        $_SESSION['status_code'] = "success";
        exit();
    } else {
        echo "Error deleting file.";
    }
}


if (isset($_POST['completemodule'])) {
    $user_id = $_SESSION['auth_user']['user_id'];
    $moduleid = $_POST['moduleid'];
    $jobid = $_POST['jobid'];
    $applicationStatus = "Archived";
    $tutor_services_status = "Available";

    $query = "UPDATE `tutorial_application` SET `applicationStatus`= '$applicationStatus' WHERE `job_id` = '$jobid'";
    $query_run = mysqli_query($con, $query);

    $query1 = "UPDATE `tutorial_services` SET `status`='$tutor_services_status' WHERE `job_id` = '$jobid'";
    $query_run1 = mysqli_query($con, $query1);

    
    if($query_run && $query_run1)
    {
        $_SESSION['status'] = "Congratulations! You have successfully completed this module.";
        $_SESSION['status_code'] = "success";
      header('Location: module.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: module.php');
        exit(0);
    }
    mysqli_close($con);
} 

?>