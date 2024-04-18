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
                    <h4 style="margin-left: 20px">Tutorial Information</h4>
                </div>
                <div class="card-body">

                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $users = "SELECT
                                        tutorial_services.*, 
                                        tutorial_schedule.`day`, 
                                        DATE_FORMAT(tutorial_schedule.starttime, '%h:%i %p') as starttime,
                                        DATE_FORMAT(tutorial_schedule.endtime, '%h:%i %p') as endtime
                                    FROM
                                        tutorial_services
                                        INNER JOIN
                                        tutorial_schedule
                                        ON 
                                            tutorial_services.job_id = tutorial_schedule.job_id
                                    WHERE
                                        tutorial_services.job_id = '$id'";
                        $users_run = mysqli_query($con, $users);

                        if (mysqli_num_rows($users_run) > 0) {
                            foreach ($users_run as $user) {
                    ?>
                                <form action="process.php" method="POST" enctype="multipart/form-data">

                                    <!-- Hidden field for job_id -->
                                    <input type="hidden" name="job_id" value="<?= $user['job_id']; ?>">

                        <div class="row">

                        <div class="col-md-12 mb-3">
                        <label for=""><strong>Subject</strong></label>
                        <input required type="text" value="<?=$user['subject'];?>" class="form-control" readonly>
                        </div>

                        <div class="col-md-12 mb-3">
                                <label for=""><strong>Subject Title</strong></label>
                                <input required type="text" name="title" value="<?= $user['title']; ?>" class="form-control" maxlength="80" readonly>
                        </div>
                                    
                        <div class="col-md-12 mb-3">
                        <label for=""><strong>Description</strong></label>
                            <textarea class="form-control" name="description" rows="10"  maxlength="200"><?=$user['description'];?></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for=""><strong>Rate</strong></label>
                        <input required type="number" value="<?=$user['rate1'];?>" name="hour_rate" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for=""><strong>Rate Description</strong></label>
                        <input required type="text" value="Per Hour" name="rate" class="form-control-plaintext" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for=""><strong>Rate</strong></label>
                        <input required type="number" value="<?=$user['rate2'];?>" name="day_rate" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for=""><strong>Rate Description</strong></label>
                        <input required type="text" value="Per Day" name="rate" class="form-control-plaintext" readonly>
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
                                        <?php foreach ($users_run as $scheduleEntry) : ?>
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
                                        <?php endforeach; ?>

                                        <div class="col-md-12">
                                            <!-- <button type="submit" name="update_services" class="btn btn-secondary" style="float:right; margin-left: 10px;">Save Changes</button> -->
                                            <button type="submit" name="delete_services" class="btn btn-danger" style="float:right; margin-left: 10px;">Delete</button>
                                            <a class="btn btn-primary" href="services.php" role="button" style="float:right;">Back</a>
                                        </div>
                                    </div>
                                </form>
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
