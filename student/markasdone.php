<?php
include("./include/authentication.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $status = "Completed";

    $query = "UPDATE `tutorial_module_files` SET `status`='$status' WHERE `file_id` = '$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Mark as done";
        $_SESSION['status_code'] = "success";
        header("Location: module.php"); // Include id in the redirect URL
        exit(0);
    } else {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status_code'] = "error";
        header("Location: module.php"); // Include id in the redirect URL
        exit(0);
    }
    mysqli_close($con);
}
?>
