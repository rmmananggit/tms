<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");

 function forceDownload($file) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    readfile($file);
    exit;
}
?>

<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                    <h4 style="margin-left: 20px">Personal Information
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                            $users = "SELECT
                            tutor.*
                        FROM
                            tutor
                        WHERE
                            tutor.user_id = '$id'";
                            $users_run = mysqli_query($con, $users);

                            if(mysqli_num_rows($users_run) > 0)
                            {
                                foreach($users_run as $user)
                                {
                             ?>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?=$user['user_id'];?>">

                     <div class="row">

                     <div class="col-md-4 mb-3">
                     <label for=""><strong>Full Name</strong></label>
                      <p class="form-control-plaintext"><?=$user['firstname'];?> <?=$user['middlename'];?> <?=$user['lastname'];?> <?=$user['suffix'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Email</strong></label>
                    <p class="form-control-plaintext"><?=$user['email'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Phone Number</strong></label>
                    <p class="form-control-plaintext"><?=$user['phone_number'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Gender</strong></label>
                    <p class="form-control-plaintext"><?=$user['gender'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Address</strong></label>
                    <p class="form-control-plaintext"><?=$user['barangay'];?> <?=$user['municipality'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Zip Code</strong></label>
                    <p class="form-control-plaintext"><?=$user['zipcode'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Barangay</strong></label>
                    <p class="form-control-plaintext"><?=$user['barangay'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Municipality</strong></label>
                    <p class="form-control-plaintext"><?=$user['municipality'];?></p>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for=""><strong>Province</strong></label>
                    <p class="form-control-plaintext">Misamis Occidental</p>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Skills</strong></label>
                    <p class="form-control-plaintext"><?=$user['skills'];?></p>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>About Me</strong></label>
                    <textarea class="form-control-plaintext" disabled><?=$user['aboutme'];?></textarea>
                    </div>

                               <div class="col-md-6 text-center mb-3">
                               <p><b>Profile Picture</b></p>
                               <?php 
                                       echo '<img class="img-fluid img-bordered-sm" src = "data:image;base64,'.base64_encode($user['profile_picture']).'" 
                                       alt="image" style="max-height; max-width: 310px; object-fit: cover;">';
                                       ?>
                               </div>

                               <div class="col-md-6 text-center mb-3">
                                <p><b>Resume</b></p>
                                <div class="d-flex justify-content-center">
                                    <?php if ($user['resume_file_path']) { ?>
                                        <a href="<?= $user['resume_file_path']; ?>" class="btn btn-success" role="button">Download Resume</a>
                                    <?php } ?>
                                </div>
                            </div>


                       

                               <div class="col-md-12">

    <a class="btn btn-primary" href="teacher.php" role="button" style="float:right;">Back</a>
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







