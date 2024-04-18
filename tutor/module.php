<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Module</h1>
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
              <h5 class="card-title">Module Information</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Module</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT
                        tutorial_services.title, 
                        tutorial_services.tutor_id, 
                        tutorial_services.description, 
                        tutorial_module.module_title, 
                        tutorial_module.module_description, 
                        tutorial_module.module_id
                      FROM
                        tutorial_services
                        INNER JOIN
                        tutorial_module
                        ON 
                          tutorial_services.job_id = tutorial_module.job_id
                      WHERE
                        tutorial_services.tutor_id = '$user_id'";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td><b><?= $row['title']; ?></b></td>
                                    <td><?= $row['module_title']; ?></td>
                                    <td><?= $row['module_description']; ?></td>
                                    <td class="text-center">

                                    <a type="button" class="btn btn-primary" href="module_files.php?id=<?=$row['module_id'];?>">VIEW</i></a>
                                    
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