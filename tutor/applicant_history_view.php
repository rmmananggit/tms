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
                    <h4 style="margin-left: 20px">Student Information
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                            $users = "SELECT
                            tutorial_application.application_id, 
                            student.user_id, 
                            student.firstname, 
                            student.middlename, 
                            student.suffix, 
                            student.lastname, 
                            student.phone_number, 
                            student.gender, 
                            student.barangay, 
                            student.municipality, 
                            student.email, 
                            student.profilepicture, 
                            tutorial_services.title, 
                            tutorial_services.description, 
                            tutorial_services.rate2, 
                            tutorial_services.rate1, 
                            tutorial_services.job_id, 
                            tutorial_module.module_title, 
                            tutorial_module.module_description, 
                            tutorial_application.additionalcomment, 
                            tutorial_application.learningdisabilities, 
                            tutorial_application.parentcontact, 
                            tutorial_application.modoftutoring, 
                            tutorial_application.applicationStatus,
                            tutorial_application.paymentStatus,
                            tutorial_application.application_id
                        FROM
                            tutorial_services
                            INNER JOIN
                            tutorial_module
                            ON 
                                tutorial_services.job_id = tutorial_module.job_id
                            INNER JOIN
                            tutorial_application
                            ON 
                                tutorial_services.job_id = tutorial_application.job_id AND
                                tutorial_module.module_id = tutorial_application.module_id
                            INNER JOIN
                            student
                            ON 
                                student.user_id = tutorial_application.student_id
                        WHERE
                            tutorial_application.application_id = '$id'
                        ORDER BY
                            tutorial_application.date_applied DESC";
                            $users_run = mysqli_query($con, $users);

                            if(mysqli_num_rows($users_run) > 0)
                            {
                                foreach($users_run as $user)
                                {
                             ?>
                        <form action="process.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="application_id" value="<?=$user['application_id'];?>">
                        <input type="hidden" name="student_user_id" value="<?=$user['user_id'];?>">
                        <input type="hidden" name="title" value="<?=$user['title'];?>">


                     <div class="row">

                           <div class="col-md-6 mb-3">
                            <label for=""><strong>Full Name</strong></label>
                                <input  type="text" name="title" value="<?=$user['firstname'];?> <?=$user['middlename'];?> <?=$user['lastname'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong></strong></label>
                            <?php 
                            echo '<img class="img-fluid" 
                            data-image="'.base64_encode($user['profilepicture']).'" 
                            src="data:image;base64,'.base64_encode($user['profilepicture']).'" 
                            alt="image" style="object-fit: cover; width: 200px; height: 200px">'; 
                            ?>
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Email Address</strong></label>
                                <input  type="text" name="title" value="<?=$user['email'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Phone Number</strong></label>
                                <input  type="text" name="title" value="<?=$user['phone_number'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Address</strong></label>
                                <input  type="text" name="title" value="<?=$user['barangay'];?> <?=$user['municipality'];?>" class="form-control-plaintext">
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Gender</strong></label>
                                <input  type="text" name="title" value="<?=$user['gender'];?>" class="form-control-plaintext">
                            </div>

                <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">Tutorial Services Information</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>


                     <div class="col-md-12 mb-3">
                            <label for=""><strong>Module Title</strong></label>
                                <input  type="text" name="title" value="<?=$user['module_title'];?>" class="form-control-plaintext" maxlength="80">
                            </div>

                    <div class="col-md-12 mb-3">
                    <label for=""><strong>Description</strong></label>
                        <textarea class="form-control-plaintext" name="description" rows="4"  maxlength="200"><?=$user['module_description'];?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate</strong></label>
                    <input  type="text" value="<?=$user['rate2'];?> / Per Day" name="rate" class="form-control-plaintext">
                    </div>

                    <div class="col-md-6 mb-3">
                    <label for=""><strong>Rate</strong></label>
                    <input  type="text" value="<?=$user['rate1'];?> / Per Hour" name="rate" class="form-control-plaintext">
                    </div>

                    <div class="row mt-4">
                <div class="col">
                  <hr class="my-4">
                </div>
                <div class="col-auto mt-2 mb-4">
                  <h4 class="text-primary">Application Information</h4c>
                </div>
                <div class="col">
                  <hr class="my-4">
                </div>
              </div>

              <div class="col-md-6 mb-3">
            <label for=""><strong>Preferred Mode of Tutoring</strong></label>
                <input  type="text" name="title" value="<?=$user['modoftutoring'];?>" class="form-control-plaintext" maxlength="80">
            </div>

            <div class="col-md-6 mb-3">
            <label for=""><strong>Parent/Guardian Name and Contact</strong></label>
                <input  type="text" name="title" value="<?=$user['parentcontact'];?>" class="form-control-plaintext" maxlength="80">
            </div>

            <div class="col-md-6 mb-3">
                                <label for=""><strong>Any Learning Disabilities or Special Needs</strong></label>
                                <textarea required name="learningdisabilities" class="form-control-plaintext" rows="5"  maxlength="500"><?=$user['learningdisabilities'];?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for=""><strong>Additional Comments/Notes</strong></label>
                                <textarea required name="learningdisabilities" class="form-control-plaintext" rows="5"  maxlength="500"><?=$user['additionalcomment'];?></textarea>
                            </div>



    <div class="col-md-12">
<a class="btn btn-danger" href="applicants.php" role="button" style="float:right;">Back</a>        
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







