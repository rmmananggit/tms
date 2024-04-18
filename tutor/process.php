<?php
 include("./include/authentication.php");

 if (isset($_POST['create_tutoring_services'])) {
    $tutor_id = $_SESSION['auth_user']['user_id'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $rate_day = mysqli_real_escape_string($con, $_POST['rate_day']);
    $rate_hour = mysqli_real_escape_string($con, $_POST['rate_hour']);
    $selected_days = isset($_POST['days']) && is_array($_POST['days']) ? implode(',', $_POST['days']) : '';
    $subject = $_POST['subject'];
    $mop = $_POST['mop'];
    $accountnumber = $_POST['accountnumber'];

    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    // Initialize days, startTimes, and endTimes arrays
    $days = isset($_POST['day']) ? $_POST['day'] : array();
    $startTimes = isset($_POST['starttime']) ? $_POST['starttime'] : array();
    $endTimes = isset($_POST['endtime']) ? $_POST['endtime'] : array();

    // Check for conflicting schedules first
    for ($i = 0; $i < count($days); $i++) {
        $day = mysqli_real_escape_string($con, $days[$i]);
        $startTime = mysqli_real_escape_string($con, $startTimes[$i]);
        $endTime = mysqli_real_escape_string($con, $endTimes[$i]);

        // Check for conflicting schedules
        $queryCheckConflict = "SELECT 
                                    tutorial_schedule.*, 
                                    tutorial_services.tutor_id 
                                FROM 
                                    tutorial_schedule 
                                INNER JOIN 
                                    tutorial_services 
                                ON 
                                    tutorial_schedule.job_id = tutorial_services.job_id 
                                WHERE 
                                    `day` = '$day' AND 
                                    (
                                        (
                                            starttime <= '$startTime' AND 
                                            endtime >= '$startTime'
                                        ) OR 
                                        (
                                            starttime <= '$endTime' AND 
                                            endtime >= '$endTime'
                                        )
                                    ) AND 
                                    tutorial_services.tutor_id = '$tutor_id'";

        $resultConflict = mysqli_query($con, $queryCheckConflict);

        if (mysqli_num_rows($resultConflict) > 0) {
            // Handle schedule conflict
            $startTimeFormatted = date("h:i A", strtotime($startTime));
            $endTimeFormatted = date("h:i A", strtotime($endTime));
            $_SESSION['status'] = "There is a conflict with the schedule for $day at $startTimeFormatted - $endTimeFormatted. Check your posted tutorial services schedule.";
            $_SESSION['status_code'] = "error";
            header('Location: services.php');
            exit();
        }
    }

    // If no conflicts, proceed to insert tutorial services, modules, and schedules
    // Insert tutorial services
    $insert_query = "INSERT INTO `tutorial_services`(`category`,`subject`,`tutor_id`, `title`, `description`, `rate1`, `rate2`, `mop`, `accountnumber`) 
    VALUES ('$category','$subject','$tutor_id','$title','$description','$rate_day','$rate_hour','$mop','$accountnumber')";
    mysqli_query($con, $insert_query);
    $job_id = mysqli_insert_id($con); // Get the last inserted job_id

   // Insert tutorial modules
if (isset($_POST["module_title"]) && is_array($_POST["module_title"])) {
    foreach ($_POST["module_title"] as $key => $module_title) {
        $module_description = mysqli_real_escape_string($con, $_POST["module_description"][$key]);
        $queryModule = "INSERT INTO `tutorial_module` (`job_id`, `module_title`, `module_description`) 
                        VALUES ('$job_id', '$module_title', '$module_description')";
        $query_run_module = mysqli_query($con, $queryModule);
    }
}


    // Insert tutorial schedules
    for ($i = 0; $i < count($days); $i++) {
        $day = mysqli_real_escape_string($con, $days[$i]);
        $startTime = mysqli_real_escape_string($con, $startTimes[$i]);
        $endTime = mysqli_real_escape_string($con, $endTimes[$i]);
        $insert_schedule_query = "INSERT INTO tutorial_schedule (job_id, day, starttime, endtime) VALUES ('$job_id', '$day', '$startTime', '$endTime')";
        mysqli_query($con, $insert_schedule_query);
    }

    // Redirect to a success page
    $_SESSION['status'] = "Tutorial services created successfully";
    $_SESSION['status_code'] = "success";
    header('Location: services.php');
    exit();
}




if(isset($_POST['update_services']))
{
    $job_id= $_POST['job_id'];
    $title= $_POST['title'];
    $description= $_POST['description'];
    $hour_rate= $_POST['hour_rate'];
    $day_rate= $_POST['day_rate'];
    $status= $_POST['status'];

    $query = "UPDATE `tutorial_services` SET `title`='$title',`description`='$description',`rate1`='$hour_rate', `rate2`='$day_rate', `status`='$status' WHERE `job_id` = '$job_id'";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Tutorial Information Updated";
        $_SESSION['status_code'] = "success";
        header('Location: services.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something is wrong!";
        $_SESSION['status_code'] = "error";
        header('Location: services.php');
        exit(0);
    }
}

if(isset($_POST['delete_services']))
{
    $job_id= $_POST['job_id'];

    $query = "DELETE FROM `tutorial_services` WHERE `job_id` = '$job_id'";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Tutorial Service Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: services.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
        header('Location: services.php.php');
        exit(0);
    }
}

if (isset($_POST['add_file'])) {
    // Retrieve form data
    $module_id = $_POST['module_id'];
    $title = $_POST['title'];
    $description = isset($_POST['description']) ? $_POST['description'] : NULL;

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
            // File has been moved successfully
            $query = "INSERT INTO `tutorial_module_files`(`module_id`, `title`, `description`, `file_name`, `file_type`, `file_path`) VALUES ('$module_id','$title','$description','$fileName','$fileType','$filePath')";
        } else {
            $_SESSION['status'] = "Error moving uploaded file";
            $_SESSION['status_code'] = "error";
            header('Location: module.php');
            exit(0);
        }
    } else {
        // No file uploaded, set default values
        $fileName = "N/A";
        $fileType = "N/A";
        $filePath = "N/A";
        $query = "INSERT INTO `tutorial_module_files`(`module_id`, `title`, `description`, `file_name`, `file_type`, `file_path`) VALUES ('$module_id','$title','$description','$fileName','$fileType','$filePath')";
    }

    // Execute the query
    $query_run = mysqli_query($con, $query);

    // Check if the query executed successfully
    if ($query_run) {
        $_SESSION['status'] = "Congratulations!
        The activity has been successfully added to the module. Your changes have been saved. Thank you for your contribution!";
        $_SESSION['status_code'] = "success";
        header('Location: module.php');
        exit(0);
    } else {
        // Error adding file to the database
        $_SESSION['status'] = "Error adding file to the database: " . mysqli_error($con);
        $_SESSION['status_code'] = "error";
        header('Location: module.php');
        exit(0);
    }
}



if (isset($_POST['submit_payment'])) {
    $user_id = $_SESSION['auth_user']['user_id'];
    $reference = $_POST['reference'];
    $subs = $_POST['subscriptiontype'];
    $mop = $_POST['mop'];
    
    // Check if a file is selected
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
        // Get the file info
        $receipt = $_FILES['receipt'];
        
        // Check if the uploaded file is an image
        $imgInfo = getimagesize($receipt['tmp_name']);
        if ($imgInfo !== false) {
            // Image validation passed, proceed with insertion
            
            // Use prepared statement to handle file content safely
            $receiptContent = file_get_contents($receipt['tmp_name']);

            // Create a prepared statement
            $query = "INSERT INTO `subscriptions`(`user_id`, `subscription_type`, `reference`, `modeofpayment`, `receipt`) VALUES (?, ?, ?, ?, ?)";

            // Prepare the statement
            $stmt = mysqli_prepare($con, $query);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "issss", $user_id, $subs, $reference, $mop, $receiptContent);

            // Execute the statement
            $query_run = mysqli_stmt_execute($stmt);

            if ($query_run) {
                header('Location: process_subscription.php');
                exit(0);
            } else {
                // Error occurred while executing the statement
                $_SESSION['status'] = "Error occurred while processing the subscription";
                $_SESSION['status_code'] = "error";
                header('Location: subscription.php');
                exit(0);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Invalid file type (not an image)
            // Handle the error here, display an error message or redirect to the form with an error
            $_SESSION['status'] = "Receipt is not an image file";
            $_SESSION['status_code'] = "error";
            header('Location: subscription.php');
            exit(0);
        }
    } else {
        // No file selected or file upload error occurred
        // Handle the error here, display an error message or redirect to the form with an error
        $_SESSION['status'] = "No receipt file selected or file upload error occurred";
        $_SESSION['status_code'] = "error";
        header('Location: subscription.php');
        exit(0);
    }
}


if (isset($_POST['accept'])) {
    $student_user_id = $_POST['student_user_id'];
    $title = $_POST['title'];
    $applicationId = $_POST['id'];
    $job = $_POST['job_id'];
    $applicationStatus = "Ongoing";
    $status = "Ongoing";
    
    // Update the status of the accepted application
    $query = "UPDATE `tutorial_application` SET `applicationStatus`='$applicationStatus' WHERE `application_id`= $applicationId";
    $query_run = mysqli_query($con, $query);

    // Update the status of other applications for the same job to "Archived"
    $query_archive = "UPDATE `tutorial_application` SET `applicationStatus`='Archived' WHERE `job_id` = $job AND `application_id` != $applicationId";
    $query_run_archive = mysqli_query($con, $query_archive);

    // Update the status of the job in the tutorial_services table
    $query1 = "UPDATE `tutorial_services` SET `status`='$applicationStatus' WHERE `job_id` = $job";
    $query_run1 = mysqli_query($con, $query1);

    // Notify the accepted student
    $notif = "Your application to $title has been accepted";
    $query4 = "INSERT INTO `student_notification`(`user_id`, `message`) VALUES ('$student_user_id','$notif')";
    $query_run4 = mysqli_query($con, $query4);
    
    if($query_run && $query_run1 && $query_run_archive)
    {
        $_SESSION['status'] = "Application Accepted";
        $_SESSION['status_code'] = "success";
        header('Location: applicants.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
        header('Location: applicants.php');
        exit(0);
    }
} 



if (isset($_POST['reject'])) {
    $applicationId = $_POST['id'];
    $student_user_id = $_POST['student_user_id'];
    $title = $_POST['title'];
    $job = $_POST['job_id'];
    $status1 = "Rejected";
    $status = "Pending";
    
    $query1 = "UPDATE `tutorial_application` SET `applicationStatus`='$status1' WHERE `application_id`= $applicationId";
    $query_run = mysqli_query($con, $query1);
    
    $query1 = "UPDATE `tutorial_services` SET `status`='$status' WHERE `job_id` = $job";
    $query_run1 = mysqli_query($con, $query1);


    $notif = "Your application to $title has been rejected";
    $query4 = "INSERT INTO `student_notification`(`user_id`, `message`) VALUES ('$student_user_id','$notif')";
    $query_run4 = mysqli_query($con, $query4);

    if($query_run || $query_run1)
    {
        $_SESSION['status'] = "Application Rejected";
        $_SESSION['status_code'] = "error";
      header('Location: applicants.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: applicants.php');
        exit(0);
    }

}



if (isset($_POST['edit_profile'])) {
    $user_id = $_POST['user_id'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $existingPicture = '';  // Variable to store the existing profile picture

    // Check if a new profile picture is selected
    if (!empty($_FILES['picture']['name'])) {
        // New picture is selected, get its contents
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
    } else {
        // No new picture selected, retain the existing one
        $existingPictureQuery = "SELECT profile_picture FROM tutor WHERE user_id=?";
        $stmt = mysqli_prepare($con, $existingPictureQuery);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $existingPicture);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `tutor` SET `phone_number`=?, `barangay`=?, `municipality`=?, `zipcode`=?, `email`=?, `profile_picture`=? WHERE `user_id`=?";
    
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssssi",  $phone, $barangay, $municipality, $zipcode, $email, $picture, $user_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
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


if (isset($_POST['editprofile'])) {
    $user_id = $_POST['user_id'];
    $barangay = $_POST['barangay'];
    $municipality = $_POST['municipality'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $aboutme = $_POST['aboutme'];
    $existingPicture = '';  // Variable to store the existing profile picture

    // Check if a new profile picture is selected
    if (!empty($_FILES['picture']['name'])) {
        // New picture is selected, get its contents
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
    } else {
        // No new picture selected, retain the existing one
        $existingPictureQuery = "SELECT profile_picture FROM tutor WHERE user_id=?";
        $stmt = mysqli_prepare($con, $existingPictureQuery);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $existingPicture);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Use prepared statements to prevent SQL injection
    $query = "UPDATE `tutor` SET `email`=?, `phone_number`=?, `barangay`=?, `municipality`=?, `aboutme`=?, `profile_picture`=? WHERE `user_id`=?";
    
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssssi", $email, $phone, $barangay, $municipality, $aboutme, $picture, $user_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
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
    $checkPasswordQuery = "SELECT `password` FROM `tutor` WHERE `user_id` = ?";
    $stmt = mysqli_prepare($con, $checkPasswordQuery);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $storedPassword);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the current password
    if ($currentpassword == $storedPassword) {
        // Update the password in the database
        $updatePasswordQuery = "UPDATE `tutor` SET `password` = ? WHERE `user_id` = ?";
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

if(isset($_POST['delete_module_files'])) {
    // Get the submit_id of the file to be deleted
    $file_id = $_POST['delete_module_files'];

    // Query to fetch the file details
    $query = "SELECT * FROM tutorial_module_files WHERE file_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $file_id);
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
    $deleteQuery = "DELETE FROM tutorial_module_files WHERE file_id = ?";
    $stmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $file_id);
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


if (isset($_POST['unlockmodule'])) {
    $application_id = $_POST['application_id'];
    $student_user_id = $_POST['student_user_id'];
    $title = $_POST['title'];
    $statuspayment = "Paid";

    $query1 = "UPDATE `tutorial_application` SET `paymentStatus`='$statuspayment' WHERE `application_id`= $application_id";
    $query_run = mysqli_query($con, $query1);
 

    $notif = "Your <b>$title</b> module has been unlocked. You can now download the module files!";
    $query4 = "INSERT INTO `student_notification`(`user_id`, `message`) VALUES ('$student_user_id','$notif')";
    $query_run4 = mysqli_query($con, $query4);

    if($query_run || $query_run1)
    {
        $_SESSION['status'] = "Module Unlocked";
        $_SESSION['status_code'] = "success";
      header('Location: applicants.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
      header('Location: applicants.php');
        exit(0);
    }

}



if(isset($_POST['delete_submit_file'])) {
    // Retrieve the submit_id from the form submission
    $submit_id = $_POST['delete_submit_file'];
    
    // Retrieve the file_path associated with the submit_id
    $query = "SELECT file_path FROM module_submit WHERE submit_id = '$submit_id'";
    $result = mysqli_query($con, $query);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_path = $row['file_path'];
        
        // Delete the file from the ./uploads directory
        if(file_exists($file_path)) {
            unlink($file_path); // Delete the file
        } else {
            echo "File not found."; // File doesn't exist
        }
        
        // Delete the record from the module_submit table
        $delete_query = "DELETE FROM module_submit WHERE submit_id = '$submit_id'";
        $delete_result = mysqli_query($con, $delete_query);
        
        if($delete_result) {
            $_SESSION['status'] = "Module Unlocked";
            $_SESSION['status_code'] = "success";
          header('Location: module_student.php');
            exit(0);
        } else {
            echo "Error deleting file record.";
        }
    } else {
        // No record found with the given submit_id
        echo "Record not found.";
    }
}


if(isset($_POST['addgrade']))
{
    $submit_id= $_POST['submit_id'];
    $comment= $_POST['comment'];
    $grade= $_POST['grade'];

    $query = "UPDATE `module_submit` SET `grade`='$grade',`tutor_comment`='$comment' WHERE `submit_id` = '$submit_id'";
    $query_run = mysqli_query($con, $query);
    
    if($query_run)
    {
        $_SESSION['status'] = "Grade added successfully!";
        $_SESSION['status_code'] = "success";
        header('Location: module_student.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Something is wrong!";
        $_SESSION['status_code'] = "error";
        header('Location: module_student.php');
        exit(0);
    }
}
?>