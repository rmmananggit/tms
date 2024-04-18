<?php
session_start();

unset( $_SESSION['auth']);
unset( $_SESSION['user_type']);
unset( $_SESSION['auth_user']);

$_SESSION['status'] = "Login again to continue.";
$_SESSION['status_code'] = "info";
header("Location: ../login/index.php");
exit(0);
?>
