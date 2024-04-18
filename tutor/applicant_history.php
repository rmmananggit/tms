<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Application</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Application History</li>
        </ol>
      </nav>
    </div>



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Application History</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>


                <?php

                $user_id = $_SESSION['auth_user']['user_id'];
                $query = "SELECT
                student.firstname, 
                student.middlename, 
                student.lastname, 
                student.suffix, 
                student.user_id, 
                tutorial_services.title, 
                tutorial_application.application_id, 
                tutorial_application.applicationStatus, 
                tutorial_application.date_applied, 
                tutorial_module.module_title
            FROM
                tutorial_services
                INNER JOIN
                tutorial_application
                ON 
                    tutorial_services.job_id = tutorial_application.job_id
                INNER JOIN
                student
                ON 
                    student.user_id = tutorial_application.student_id
                INNER JOIN
                tutorial_module
                ON 
                    tutorial_services.job_id = tutorial_module.job_id AND
                    tutorial_application.module_id = tutorial_module.module_id
            WHERE
                tutorial_application.tutor_id = '$user_id' AND
                tutorial_application.applicationStatus = 'Archived'
            ORDER BY
                tutorial_application.date_applied DESC";
                $query_run = mysqli_query($con, $query);
                if(mysqli_num_rows($query_run) > 0)
                {
                foreach($query_run as $row)
                {
                ?>
                    <tr>
                    <td><b><a href="enrollees_profile.php?id=<?= $row['user_id']; ?>"><?= $row['firstname']; ?> <?= $row['middlename']; ?> <?= $row['lastname']; ?></a></b></td>
                <td><?= $row['module_title']; ?></td>
                <td><?= date('Y-m-d', strtotime($row['date_applied'])); ?></td>



                <td class="text-center">

                <a type="button" class="btn btn-primary" href="applicant_history_view.php?id=<?=$row['application_id'];?>">VIEW</a>
              </td>
                    </tr>

                    <?php
                }
                } else
                {
                ?>
                <tr>
                <td colspan="6">No Record Found</td>
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