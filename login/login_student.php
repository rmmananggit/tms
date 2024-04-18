<?php
session_start();
include('./config.php');




if (isset($_POST['studentlogin'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT
        student.user_id,
        student.email,
        student.`password`,
        student.firstname,
        student.middlename,
        student.lastname,
        student.user_status
    FROM
        student
    WHERE
        student.email = '$email' AND
        student.`password` = '$password'
    LIMIT 1";

    $login_query_run = mysqli_query($con, $login_query);

    if ($login_query_run) {
        if (mysqli_num_rows($login_query_run) > 0) {
            $data = mysqli_fetch_assoc($login_query_run);

            $user_id = $data['user_id'];
            $full_name = $data['firstname'] . ' ' . $data['lastname'];
            $user_status = $data['user_status'];
            $user_email = $data['email'];
            $user_type = "student";


            $_SESSION['auth'] = true;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['u_status'] = $user_status;
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $full_name,
                'user_email' => $user_email,
            ];

            if ($user_status == 'Deactivated') {
                $_SESSION['status'] = "Your account has been deactivated";
                $_SESSION['status_code'] = "error";
                header("Location: ../login/student_login.php");
                exit();
            } elseif ($user_status == 'Pending') {
                $_SESSION['status'] = "Your account is still pending";
                $_SESSION['status_code'] = "warning";
                header("Location: ../login/student_login.php");
                exit();
            } elseif ($user_status == 'Approved') {
                $_SESSION['status'] = "Welcome $full_name!";
                $_SESSION['status_code'] = "success";
                header("Location: ../student/index.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid Username and Password";
            $_SESSION['status_code'] = "error";
            header("Location: student_login.php");
            exit();
        }
    } else {
        // Handle the query execution error
        $_SESSION['status'] = "Error executing the login query: " . mysqli_error($con);
        $_SESSION['status_code'] = "error";
        header("Location: student_login.php");
        exit();
    }
} else {
    $_SESSION['status'] = "Invalid request";
    $_SESSION['status_code'] = "error";
    header("Location: student_login.php");
    exit();
}

?>