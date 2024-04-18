<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>My Module</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">My Module</li>
        </ol>
      </nav>
    </div>



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Module</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Job Title</th>
                    <th scope="col">Module</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        tutorial_module.*, 
                        tutorial_module.module_title, 
                        tutorial_module.module_description, 
                        tutorial_services.title, 
                        tutorial_application.paymentStatus, 
                        tutorial_application.applicationStatus, 
                        tutorial_services.job_id
                      FROM
                        tutorial_module
                        INNER JOIN
                        tutorial_application
                        ON 
                          tutorial_module.module_id = tutorial_application.module_id
                        INNER JOIN
                        tutorial_services
                        ON 
                          tutorial_application.job_id = tutorial_services.job_id AND
                          tutorial_module.job_id = tutorial_services.job_id
                      WHERE
                        tutorial_application.student_id = '$user_id' AND
                        tutorial_application.applicationStatus = 'Ongoing'";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>
                                <td><?= $row['title']; ?></td>
                                    <td><?= $row['module_title']; ?></td>
                                    <?php
                  $status = $row['applicationStatus'];
                  $badge_class = '';

                  switch ($status) {
                      case 'Ongoing':
                          $badge_class = 'bg-warning';
                          break;
                      case 'Rejected':
                          $badge_class = 'bg-danger';
                          break;
                      case 'Pending':
                          $badge_class = 'bg-secondary';
                          break;
                      case 'Done':
                        $badge_class = 'bg-success';
                        break;
                      default:
                          $badge_class = 'bg-secondary';
                          break;
                  }
                  ?>

                  <td><span class="badge <?= $badge_class; ?>"><?= $status; ?></span></td>      
                                    <td width="100px">
                                    <form action="process.php" method="POST">  
                                    <div class="btn-group" rolez="group" aria-label="Basic outlined example">
                                    <?php if($row['paymentStatus'] == 'Unpaid') { ?>
                                        MODULE LOCKED
                                    <?php } else { ?>
                                        <a type="button" class="btn btn-outline-primary" href="module_files.php?id=<?=$row['module_id'];?>&jobid=<?=$row['job_id'];?>">View</a>
                                    <?php } ?>
                                    </div>
                                    </form>
                                    </td>

                        
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="4">You have no current module!</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>



<?php
 include("./include/footer.php");
?>
