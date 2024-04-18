<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>
<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">My Tutorial Services</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <div class="ps-3">
                                   <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $pending = "SELECT
                                    tutorial_services.*
                                  FROM
                                    tutorial_services
                                  WHERE
                                    tutorial_services.tutor_id = '$user_id'";
                                    $pending_run = mysqli_query($con, $pending);


                                    if($pending_total = mysqli_num_rows($pending_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$pending_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Active Tutorial Services</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $pending = "SELECT
                                    tutorial_services.*
                                  FROM
                                    tutorial_services
                                  WHERE
                                    tutorial_services.tutor_id = '$user_id' AND
                                    tutorial_services.`status` = 'Ongoing'";
                                    $pending_run = mysqli_query($con, $pending);


                                    if($pending_total = mysqli_num_rows($pending_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$pending_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>



            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Enrolles</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $pending = "SELECT
                                    tutorial_application.*
                                  FROM
                                    tutorial_application
                                  WHERE
                                    tutorial_application.tutor_id = '$user_id' AND
                                    tutorial_application.applicationStatus = 'Approved'";
                                    $pending_run = mysqli_query($con, $pending);


                                    if($pending_total = mysqli_num_rows($pending_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$pending_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->



            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Module</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $pending = "SELECT
                                    tutorial_services.*, 
                                    tutorial_module.*
                                  FROM
                                    tutorial_services
                                    INNER JOIN
                                    tutorial_module
                                    ON 
                                      tutorial_services.job_id = tutorial_module.job_id
                                  WHERE
                                    tutorial_services.tutor_id = '$user_id'";
                                    $pending_run = mysqli_query($con, $pending);


                                    if($pending_total = mysqli_num_rows($pending_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$pending_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>



          </div>
        </div><!-- End Left side columns -->


      </div>
    </section>



<?php
 include("./include/footer.php");
?>