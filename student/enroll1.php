<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-title">
                <h4 style="margin-left: 20px">Submit Payment</h4>
            </div>
            <div class="card-body">

                <?php
                if (isset($_GET['module_id'])) {
                    $module_id = $_GET['module_id'];
                    $rate1 = $_GET['rate1']; 
                    $rate2 = $_GET['rate2']; 
                    $tutor_id = $_GET['tutor_id']; 
                    $job_id = $_GET['job_id']; 
                    ?>
                    <form action="process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="module_id" value="<?= $module_id; ?>">
                        <input type="hidden" name="hour_rate" value="<?= $rate1; ?>">
                        <input type="hidden" name="day_rate" value="<?= $rate2; ?>">
                        <input type="hidden" name="tutor_id" value="<?= $tutor_id; ?>">
                        <input type="hidden" name="job_id" value="<?= $job_id; ?>">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="payby"><strong>Pay by:</strong></label>
                                <select name="payby" id="payby" class="form-select" required>
                                    <option value="" disabled selected>-- Select --</option>
                                    <option value="Day">Day</option>
                                    <option value="Hour">Hour</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="amountLabel"><strong id="amountLabel">Enter Amount</strong></label>
                                <input required type="number" Placeholder="Eg. 1" name="number" id="number" class="form-control" maxlength="80">
                            </div>
                        </div>

                        <!-- Add the reference input field -->
                        <input type="hidden" name="reference" id="reference" value="">

                        <div class="col-md-12 mb-3">
                            <label for=""><strong>Total Amount</strong></label>
                            <input required type="text" name="totalamount" id="totalamount" value="" class="form-control" maxlength="80" >
                        </div>

                        <div class="col-md-12 mb-3">
                                <label for="reference"><strong>Reference</strong></label>
                                <input required type="text" Placeholder="XXXX-XXXX-XXXX" name="reference" id="reference" class="form-control" maxlength="80">
                            </div>

                        <div class="col-md-12 mb-3">
                            <label for=""><strong>Receipt <small>(Maximum file size: 5MB)</small></strong></label>
                            <input required type="file" name="receipt" accept="image/*" class="form-control">
                        </div>

                        <div class="col-md-12">
                        <button type="submit" name="apply" class="btn btn-primary" style="float:right; margin-left: 10px;">Submit</button>


                            <a class="btn btn-danger" href="search.php" role="button" style="float:right;">Back</a>
                        </div>
                    </form>

                    <script>
                        document.getElementById('payby').addEventListener('change', function () {
                            var selectedValue = this.value;
                            var amountLabel = document.getElementById('amountLabel');
                            var referenceField = document.getElementById('reference');

                            if (selectedValue === 'Day') {
                                amountLabel.innerText = 'Enter Days';
                                referenceField.value = <?= $rate2; ?>;
                            } else if (selectedValue === 'Hour') {
                                amountLabel.innerText = 'Enter Hours';
                                referenceField.value = <?= $rate1; ?>;
                            } else {
                                amountLabel.innerText = 'Enter Amount';
                                referenceField.value = '';
                            }

                            updateTotalAmount();
                        });

                        document.getElementById('number').addEventListener('input', function () {
                            updateTotalAmount();
                        });

                        function updateTotalAmount() {
                            var enteredNumber = parseFloat(document.getElementById('number').value) || 0;
                            var referenceValue = parseFloat(document.getElementById('reference').value) || 0;
                            var totalAmount = enteredNumber * referenceValue;
                            document.getElementById('totalamount').value = totalAmount.toFixed(2);
                        }

                        updateTotalAmount();
                    </script>
                <?php
                } else {
                ?>
                    <h4>No Record Found!</h4>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php
include("./include/footer.php");
?>


<!-- ENROLL BACKEND -->

if (isset($_POST['apply'])) {
    require '../admin/config/config.php';

    $username = $_SESSION['auth_user']['user_name'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $module_id = $_POST['module_id'];
    $tutor_id = $_POST['tutor_id'];
    $job_id = $_POST['job_id'];
    $totalamount = $_POST['totalamount'];
    $reference = $_POST['reference'];

    // File upload handling
    $receipt = $_FILES['receipt'];

    // Validate file size
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    if ($receipt['size'] > $maxFileSize) {
        $_SESSION['status'] = "Receipt file size should be less than 5MB.";
        $_SESSION['status_code'] = "error";
        header("Location: search.php");
        exit(0);
    }

    // Validate file type (image)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($receipt['type'], $allowedTypes)) {
        $_SESSION['status'] = "Receipt must be an image file (JPEG, PNG, GIF).";
        $_SESSION['status_code'] = "error";
        header("Location: search.php");
        exit(0);
    }

    $notif = "$username enrolled to your tutorial services";
    $query4 = "INSERT INTO `tutor_notification`(`user_id`, `message`) VALUES ('$tutor_id','$notif')";
    $query_run4 = mysqli_query($con, $query4);


    $status = "Pending";

    $query = "INSERT INTO `tutorial_application`(`job_id`,`module_id`, `tutor_id`, `student_id`, `status`) VALUES ('$job_id','$module_id','$tutor_id','$user_id','$status')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $application_id = mysqli_insert_id($con); // Get the last inserted ID

        // Read file content
        $receipt_data = file_get_contents($receipt['tmp_name']);

        // Insert payment information with the receipt content as LONGBLOB
        $payment_query = "INSERT INTO `student_payment`(`application_id`, `module_id`, `amount`, `reference`, `receipt`) VALUES ('$application_id','$module_id','$totalamount','$reference', ?)";
        $stmt = mysqli_prepare($con, $payment_query);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, 's', $receipt_data);
        $payment_query_run = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        if ($payment_query_run) {
            $_SESSION['status'] = "Applied!";
            $_SESSION['status_code'] = "success";
            header("Location: index.php");
            exit(0);
        } else {
            // Rollback application if payment insertion fails
            $rollback_query = "DELETE FROM `tutorial_application` WHERE `application_id`='$application_id'";
            mysqli_query($con, $rollback_query);

            $_SESSION['status'] = "Error in payment!";
            $_SESSION['status_code'] = "danger";
            header("Location: index.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "Error in tutorial application!";
        $_SESSION['status_code'] = "danger";
        header("Location: index.php");
        exit(0);
    }
}
