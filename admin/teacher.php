<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Tutor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Tutor</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tutor's Information</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Skills</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                        $query = ".phone_number
                      FROM
                        tutor";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                                <tr>

                                    <td><?= $row['firstname']; ?> <?= $row['lastname']; ?></td>
                                    <td><?= $row['phone_number']; ?></td>         
                                    <td><?= $row['skills']; ?></td>                    
                                    <td class="text-center">

                                    <a type="button" class="btn btn-primary" href="teacher_view.php?id=<?=$row['user_id'];?>">VIEW</a>
                                    
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