<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>My Enrollment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">All Enrollment</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Enrollment</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Subject TItle</th>
                    <th scope="col">Subject Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        tutorial_application.applicationStatus, 
                        tutorial_application.date_applied, 
                        tutorial_application.module_id, 
                        tutorial_module.module_title, 
                        tutorial_module.module_description
                      FROM
                        tutorial_application
                        INNER JOIN
                        tutorial_module
                        ON 
                          tutorial_application.module_id = tutorial_module.module_id
                      WHERE
                        tutorial_application.student_id = '$user_id'
                      ORDER BY
                        tutorial_application.date_applied DESC";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                      <td width="100px"><?= $row['module_title']; ?></td>
                                    <td width="100px"><?= $row['module_description']; ?></td>
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
                                    <td class="text-center">

                                    <a type="button" class="btn btn-primary" href="application_view.php?id=<?=$row['module_id'];?>">VIEW</a>
                                    
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

            </div>
          </div>

        </div>
      </div>
    </section>



<?php
 include("./include/footer.php");
?>