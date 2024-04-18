<?php
session_start();
include('./config.php');

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT
        tutor.user_id,
        tutor.email,
        tutor.`password`,
        tutor.firstname,
        tutor.middlename,
        tutor.lastname
    FROM
        tutor
    WHERE
        tutor.email = '$email' AND
        tutor.`password` = '$password'
    LIMIT 1";

    $login_query_run = mysqli_query($con, $login_query);

    if ($login_query_run) {
        if (mysqli_num_rows($login_query_run) > 0) {
            $data = mysqli_fetch_assoc($login_query_run);

            $user_id = $data['user_id'];
            $full_name = $data['firstname'] . ' ' . $data['lastname'];
            $user_email = $data['email'];
            $user_type = "tutor";

            $_SESSION['auth'] = true;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $full_name,
                'user_email' => $user_email,
            ];

            $_SESSION['status'] = "Welcome $full_name!";
            $_SESSION['status_code'] = "success";
            header("Location: ../tutor/subscription_check.php");
            exit();
        } else {
            $_SESSION['status'] = "Invalid Username and Password";
            $_SESSION['status_code'] = "error";
            header("Location: tutor_login.php");
            exit();
        }
    } else {
        // Handle the query execution error
        $_SESSION['status'] = "Error executing the login query: " . mysqli_error($con);
        $_SESSION['status_code'] = "error";
        header("Location: tutor_login.php");
        exit();
    }
} else {
    $_SESSION['status'] = "Invalid request";
    $_SESSION['status_code'] = "error";
    header("Location: tutor_login.php");
    exit();
}
?>
