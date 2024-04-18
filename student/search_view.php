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
                <h4 style="margin-left: 20px">Tutor's Information</h4>
            </div>
            <div class="card-body">

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $users = "SELECT
                            tutorial_schedule.`day`, 
                            tutorial_schedule.job_id, 
                            tutorial_schedule.`day`, 
                            tutorial_services.*, 
                            DATE_FORMAT(tutorial_schedule.starttime, '%h:%i %p') as starttime,
                            DATE_FORMAT(tutorial_schedule.endtime, '%h:%i %p') as endtime,
                            tutorial_module.module_id
                            FROM
                            tutorial_services
                            INNER JOIN
                            tutorial_schedule
                            ON 
                            tutorial_services.job_id = tutorial_schedule.job_id
                            INNER JOIN
                            tutorial_module
                            ON 
                            tutorial_services.job_id = tutorial_module.job_id
                            WHERE
                            tutorial_schedule.job_id = '$id' ";
                    $users_run = mysqli_query($con, $users);

                    if (mysqli_num_rows($users_run) > 0) {
                        $user = mysqli_fetch_assoc($users_run);
                        ?>

                          <!-- Check if the student has already applied -->
                          <?php 
                        $student_id = $_SESSION['auth_user']['user_id'];
                        $applied_query = "SELECT * FROM tutorial_application WHERE job_id = '$id' AND student_id = '$student_id'";
                        $applied_result = mysqli_query($con, $applied_query);
                        $already_applied = mysqli_num_rows($applied_result) > 0;
                        ?>
                        <form action="process.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="job_id" value="<?= $user['job_id']; ?>">
                            <input type="hidden" name="tutor_id" value="<?= $user['tutor_id']; ?>">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label for=""><strong>Job Title</strong></label>
                                    <p class="form-control-plaintext"><?= $user['title']; ?></p>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for=""><strong>Description</strong></label>
                                    <textarea class="form-control-plaintext" name="description" rows="4"  maxlength="200" disabled><?= $user['description']; ?></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for=""><strong>Rate Per Hour</strong></label>
                                    <p class="form-control-plaintext">₱<?= $user['rate1']; ?></p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for=""><strong>Rate Per Day</strong></label>
                                    <p class="form-control-plaintext">₱<?= $user['rate2']; ?></p>
                                </div>

                                <div class="row mt-4">
                                    <div class="col">
                                        <hr class="my-4">
                                    </div>
                                    <div class="col-auto mt-2 mb-4">
                                        <h4 class="text-primary">Payment</h4>
                                    </div>
                                    <div class="col">
                                        <hr class="my-4">
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for=""><strong>Payment Method</strong></label>
                                                <p class="form-control-plaintext"><?= $user['mop']; ?></p>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for=""><strong>Account Number</strong></label>
                                                <p class="form-control-plaintext"><?= $user['accountnumber']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col">
                                        <hr class="my-4">
                                    </div>
                                    <div class="col-auto mt-2 mb-4">
                                        <h4 class="text-primary">Class Schedule</h4>
                                    </div>
                                    <div class="col">
                                        <hr class="my-4">
                                    </div>
                                </div>

                                <!-- Display the schedule rows -->
                                <?php 
                                $schedule_query = "SELECT
                                    tutorial_schedule.`day`, 
                                    DATE_FORMAT(tutorial_schedule.starttime, '%h:%i %p') as starttime,
                                    DATE_FORMAT(tutorial_schedule.endtime, '%h:%i %p') as endtime
                                    FROM
                                    tutorial_schedule
                                    WHERE
                                    tutorial_schedule.job_id = '$id' ";
                                $schedule_result = mysqli_query($con, $schedule_query);

                                if (mysqli_num_rows($schedule_result) > 0) {
                                    while ($scheduleEntry = mysqli_fetch_assoc($schedule_result)) {
                                ?>
                                        <div class="row schedule-row">
                                            <div class="col-md-4 mb-3">
                                                <label for=""><strong>Day</strong></label>
                                                <input required type="text" value="<?= $scheduleEntry['day']; ?>" name="day[]" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for=""><strong>Start Time</strong></label>
                                                <input required type="text" value="<?= $scheduleEntry['starttime']; ?>" name="starttime[]" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for=""><strong>End Time</strong></label>
                                                <input required type="text" value="<?= $scheduleEntry['endtime']; ?>" name="endtime[]" class="form-control" readonly>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>


                                <div class="row mt-4">
                                    <div class="col">
                                        <hr class="my-4">
                                    </div>
                                    <div class="col-auto mt-2 mb-4">
                                        <h4 class="text-primary">MODULES</h4>
                                    </div>
                                    <div class="col">
                                        <hr class="my-4">
                                    </div>
                                </div>


                                <div class="container">
                                    <div class="col-md-12 mt-2">

                                        <?php
                                        $module_query = "SELECT
                                            tutorial_module.*
                                            FROM
                                            tutorial_module
                                            WHERE
                                            tutorial_module.job_id = '$id'";
                                        $module_result = mysqli_query($con, $module_query);

                                        if (mysqli_num_rows($module_result) > 0) {
                                            while ($module = mysqli_fetch_assoc($module_result)) {
                                        ?>
                                               <div class="card">
       <div class="card-body">
        <h5 class="card-title"><?= $module['module_title'] ?></h5>
        <p class="card-text"><?= $module['module_description']; ?></p>
    </div>
</div>

                                        <?php
                                            }
                                        } else {
                                            echo "No modules found";
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <!-- Check if already applied, if yes, disable button and change label to "Applied" -->
                                    <?php if ($already_applied): ?>
                                        <button class="btn btn-primary" style="float:right; margin-left: 8px;" disabled>Already Applied</button>
                                    <?php else: ?>
                                        <a href="enroll.php?job_id=<?= $id; ?>&tutor_id=<?= $user['tutor_id']; ?>" style="float:right; margin-left: 8px;" class="btn btn-primary">Enroll</a>
                                    <?php endif; ?>
                                    <a class="btn btn-danger" href="search.php" role="button" style="float:right;">Back</a>
                                </div>


                            </div>
                        </form>
                <?php
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
