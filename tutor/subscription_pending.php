<?php
session_start();

unset( $_SESSION['auth']);
unset( $_SESSION['user_type']);
unset( $_SESSION['auth_user']);

$_SESSION['status'] = "Your subscription form has been submitted. Please await confirmation from the administrator.";
$_SESSION['status_code'] = "warning";
header("Location: ../login/tutor_login.php");
exit(0);
?>
