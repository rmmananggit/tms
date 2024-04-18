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
                <h4 style="margin-left: 20px">Subscription Information</h4>
            </div>
            <div class="card-body">

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $users = "SELECT
                            tutor.firstname, 
                            tutor.middlename, 
                            tutor.lastname, 
                            tutor.email,
                            subscriptions.user_id, 
                            subscriptions.subscription_type, 
                            subscriptions.`status`, 
                            subscriptions.approved_date, 
                            subscriptions.expiration_date, 
                            subscriptions.reference, 
                            subscriptions.modeofpayment, 
                            subscriptions.receipt, 
                            subscriptions.stamp, 
                            subscriptions.id
                        FROM
                            subscriptions
                            INNER JOIN
                            tutor
                            ON 
                                subscriptions.user_id = tutor.user_id
                        WHERE
                            tutor.user_id = '$id'";
                    $users_run = mysqli_query($con, $users);

                    if (mysqli_num_rows($users_run) > 0) {
                        foreach ($users_run as $user) {
                ?>
                            <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">

                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label for=""><strong>Full Name</strong></label>
                                    <p class="form-control-plaintext"><?= $user['firstname']; ?> <?= $user['middlename']; ?> <?= $user['lastname']; ?></p>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for=""><strong>Email Address</strong></label>
                                    <p class="form-control-plaintext"><?= $user['email']; ?></p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for=""><strong>Status</strong></label>
                                    <p class="form-control-plaintext"><?= $user['status']; ?></p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for=""><strong>Subscription</strong></label>
                                    <p class="form-control-plaintext"><?= $user['subscription_type']; ?></p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for=""><strong>Approved Date</strong></label>
                                    <p class="form-control-plaintext"><?= $user['approved_date']; ?></p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for=""><strong>Expiration Date</strong></label>
                                    <p class="form-control-plaintext"><?= $user['expiration_date']; ?></p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for=""><strong>Reference</strong></label>
                                    <p class="form-control-plaintext"><?= $user['reference']; ?></p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for=""><strong>Mode of Payment</strong></label>
                                    <p class="form-control-plaintext"><?= $user['modeofpayment']; ?></p>
                                </div>

                                <label for=""><strong>Receipt</strong></label>
                                <div class="col-md-4 mb-3 text-center">
                                    <?php 
                        echo '<img class="img-fluid img-bordered-sm" src = "data:image;base64,'.base64_encode($user['receipt']).'" 
                        alt="image" style="max-height; max-width: 310px; object-fit: cover;">'; 
                                    ?>
                                </div>

                                <div class="col-md-12">
                                    <form action="process.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                        <input type="hidden" name="email" value="<?= $user['email']; ?>">
                                        <input type="hidden" name="firstname" value="<?= $user['firstname']; ?>">
                                        <input type="hidden" name="lastname" value="<?= $user['lastname']; ?>">
                                        <?php
                                        // Check if the status is neither "Active" nor "Rejected"
                                        if ($user['status'] !== 'Active' && $user['status'] !== 'Rejected') {
                                        ?>
                                            <button class="btn btn-danger" type="submit" name="delete_subscription" value="<?= $user['id']; ?>" style="float:right; margin-left: 10px;">Reject</button>

                                            <button class="btn btn-success" type="submit" name="approve_subscription" value="<?= $user['id']; ?>" style="float:right; margin-left: 10px;">Approve</button>
                                        <?php
                                        }
                                        ?>

                                        <a class="btn btn-primary" href="subscription.php" role="button" style="float:right;">Back</a>
                                    </form>
                                </div>
                            </div>

                <?php
                        }
                    } else {
                ?>
                        <h4>No Record Found!</h4>
                <?php
                    }
                }
                ?>


            </div>
        </div>
    </div>
</div>

<?php
include("./include/footer.php");
?>
