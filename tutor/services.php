<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
  <h1>My Tutorial Services</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">My Services</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tutorial Information</h5>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Schedule</th>
                <th scope="col">Date Posted</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $user_id = $_SESSION['auth_user']['user_id'];
              $query = "SELECT
                          tutorial_services.*, 
                          GROUP_CONCAT(CONCAT(tutorial_schedule.`day`, ' ', DATE_FORMAT(tutorial_schedule.starttime, '%l:%i %p'), ' - ', DATE_FORMAT(tutorial_schedule.endtime, '%l:%i %p')) SEPARATOR '<br>') as schedules
                        FROM
                          tutorial_services
                          INNER JOIN
                          tutorial_schedule
                          ON 
                            tutorial_services.job_id = tutorial_schedule.job_id
                        WHERE
                          tutorial_services.tutor_id = '$user_id'
                        GROUP BY
                          tutorial_services.job_id
                        ORDER BY
                          tutorial_services.date_posted DESC";
              $query_run = mysqli_query($con, $query);
              if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $row) {
              ?>
                      <tr>

                          <td><?= $row['title']; ?></td>  
                          <td><?= $row['schedules']; ?></td>
                          <td><?= date('F j, Y', strtotime($row['date_posted'])); ?></td>    
                          <?php
                          $status = $row['status'];
                          $badge_class = '';

                          switch ($status) {
                              case 'Available':
                                  $badge_class = 'bg-success';
                                  break;
                              case 'Inactive':
                                  $badge_class = 'bg-danger';
                                  break;
                              default:
                                  $badge_class = 'bg-secondary';
                                  break;
                          }
                          ?>

                          <td><span class="badge <?= $badge_class; ?>"><?= $status; ?></span></td>       
                          <td class="text-center">
                              <a type="button" class="btn btn-primary" href="services_view.php?id=<?=$row['job_id'];?>">VIEW</a>
                          </td>    

                      </tr>
              <?php
                  }
              } else {
              ?>
                  <tr>
                      <td colspan="4">No Record Found</td>
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
