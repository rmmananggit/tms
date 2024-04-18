`<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Enrolles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">My Enrolles</li>
        </ol>
      </nav>
    </div>



    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Enrolles's Information</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>


                <?php

                $user_id = $_SESSION['auth_user']['user_id'];
                $query = "SELECT
                s.firstname, 
                s.middlename, 
                s.lastname, 
                s.suffix, 
                s.user_id, 
                ts.title, 
                ta.application_id, 
                ta.applicationStatus, 
                ta.date_applied, 
                tm.module_title
            FROM
                tutorial_services ts
                INNER JOIN tutorial_application ta ON ts.job_id = ta.job_id
                INNER JOIN student s ON s.user_id = ta.student_id
                INNER JOIN tutorial_module tm ON ts.job_id = tm.job_id AND ta.module_id = tm.module_id
            WHERE
                ta.tutor_id = '$user_id' AND
                ta.applicationStatus IN ('Ongoing', 'Pending')
            ORDER BY
                ta.date_applied DESC;
            ";
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

                <a type="button" class="btn btn-primary" href="applicant_view.php?id=<?=$row['application_id'];?>">VIEW</a>
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
?>`