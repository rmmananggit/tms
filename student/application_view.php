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
                    <h4 style="margin-left: 20px">Tutor's Information
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                            $users = "SELECT
                            tutorial_module.module_title, 
                            tutorial_module.module_description, 
                            tutorial_services.*, 
                            tutorial_schedule.`day`, 
                            DATE_FORMAT(tutorial_schedule.starttime, '%h:%i %p') as starttime,
                            DATE_FORMAT(tutorial_schedule.endtime, '%h:%i %p') as endtime,
                            tutor.profile_picture, 
                            tutor.firstname, 
                            tutor.middlename, 
                            tutor.lastname, 
                            tutor.phone_number, 
                            tutor.email,
                            tutor.suffix
                          FROM
                            tutorial_module
                            INNER JOIN
                            tutorial_services
                            ON 
                              tutorial_module.job_id = tutorial_services.job_id
                            INNER JOIN
                            tutorial_schedule
                            ON 
                              tutorial_services.job_id = tutorial_schedule.job_id
                            INNER JOIN
                            tutor
                            ON 
                              tutorial_services.tutor_id = tutor.user_id
                          WHERE
                            tutorial_module.module_id = '$id'";
                            $users_run = mysqli_query($con, $users);

                            if(mysqli_num_rows($users_run) > 0)
                            {
                                foreach($users_run as $user)
                                {
                             ?>
                        <form action="process.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="job_id" value="<?=$user['job_id'];?>">
                        <input type="hidden" name="tutor" value="<?= $user['tutor_id']; ?>">

                     <div class="row">

                     <div class="col-md-6 mb-3">
                            <label for=""><strong>Full Name</strong></label>
                            <p class="form-control-plaintext"><?=$user['firstname'];?> <?=$user['middlename'];?> <?=$user['lastname'];?> <?=$user['suffix'];?></p>
                    </div>

                    <div class="col-md-6 mb-3">
                    <?php 
                      echo '<img class="img-fluid" 
                      data-image="'.base64_encode($user['profile_picture']).'" 
                      src="data:image;base64,'.base64_encode($user['profile_picture']).'" 
                      alt="image" style="object-fit: cover; width: 200px; height: 200px;">'; 
                    ?>
                  </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate Per Hour</strong></label>
                    <p class="form-control-plaintext">₱<?=$user['rate1'];?></p>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate Per Day</strong></label>
                    <p class="form-control-plaintext">₱<?=$user['rate2'];?></p>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Email Address</strong></label>
                    <p class="form-control-plaintext"><?=$user['email'];?></p>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Phone Number</strong></label>
                    <p class="form-control-plaintext"><?=$user['phone_number'];?></p>
                    </div>

                    <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">MODULES ENROLL</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>


              <div class="container">
                  <div class="col-md-12 mt-2">
                    
                  <?php
                  require '../admin/config/config.php';

                  $id = $_GET['id'];
                  $query = "SELECT
                  tutorial_module.*
                FROM
                  tutorial_module
                WHERE
                  tutorial_module.module_id = '$id'";
                  $query_run = mysqli_query($con, $query);
                  $check_module = mysqli_num_rows($query_run) > 0;

                  if($check_module)
                  {
                    while($row = mysqli_fetch_array($query_run))
                    {
                      ?>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['module_title'] ?></h5>
                      <?php echo $row['module_description'] ?>
                    </div> 
                  </div>
                      <?php
                    }
                  }
                  else
                  {
                    echo "No Module";
                  }

                  ?>
                  </div>
              </div>   


                <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">Class Schedule</h4c>
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
    
    <a class="btn btn-danger" href="application.php" role="button" style="float:right;">Back</a>

    </div>
                               </div>


                                </div>
                </form>
                <?php
                                }
                            }
                            else
                            {
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







