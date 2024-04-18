<?php
session_start();
include('./config.php');


if (isset($_POST['adminlogin'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT
        admin.user_id,
        admin.firstname,
        admin.middlename,
        admin.lastname,
        admin.address,
        admin.email,
        admin.`password`,
        admin.phone_number,
        admin.profilepicture
    FROM
        admin
    WHERE
        admin.email = '$email' AND
        admin.`password` = '$password'
    LIMIT 1";

    $login_query_run = mysqli_query($con, $login_query);

    if ($login_query_run) {
        if (mysqli_num_rows($login_query_run) > 0) {
            $data = mysqli_fetch_assoc($login_query_run);

            $user_id = $data['user_id'];
            $full_name = $data['firstname'] . ' ' . $data['lastname'];
            $user_email = $data['email'];

            $_SESSION['auth'] = true;
            $_SESSION['user_type'] = "admin";
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $full_name,
                'user_email' => $user_email,
            ];

            $_SESSION['status'] = "Welcome $full_name!";
            $_SESSION['status_code'] = "success";
            header("Location: ../admin/index.php");
            exit();
        } else {
            $_SESSION['status'] = "Invalid Username and Password";
            $_SESSION['status_code'] = "error";
            header("Location: admin.php");
            exit();
        }
    } else {
        // Handle the query execution error
        $_SESSION['status'] = "Error executing the login query: " . mysqli_error($con);
        $_SESSION['status_code'] = "error";
        header("Location: admin.php");
        exit();
    }
} else {
    // Handle the case when 'adminlogin' is not set
    $_SESSION['status'] = "Invalid request";
    $_SESSION['status_code'] = "error";
    header("Location: admin.php");
    exit();
}

?>