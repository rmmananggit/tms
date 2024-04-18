<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>
<style>
    body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>



<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Enrollee's</a></li>
              <li class="breadcrumb-item active" aria-current="page">Enrollee's Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">


                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $users = "SELECT
                    student.*
                FROM
                    student
                WHERE
                    student.user_id = '$id'";
                    $users_run = mysqli_query($con, $users);

                    if (mysqli_num_rows($users_run) > 0) {
                        foreach ($users_run as $user) {
                ?>

                  <div class="d-flex flex-column align-items-center text-center">
                  <?php 
                    echo '<img class="rounded-circle" 
                    data-image="'.base64_encode($user['profilepicture']).'" 
                    src="data:image;base64,'.base64_encode($user['profilepicture']).'" 
                    alt="image" style="object-fit: cover; width: 150px; height: auto;">'; 
                    ?>
                    <div class="mt-3">
                      <h4><?= $user['firstname']; ?> <?= $user['middlename']; ?> <?= $user['lastname']; ?> <?= $user['suffix']; ?></h4>
                      <p class="text-secondary mb-1">Student</p>
                      <p class="text-muted font-size-sm"><?= $user['barangay']; ?>, <?= $user['municipality']; ?>, Misamis Occidental</p>
                      <a type="button" class="btn btn-primary" href="message.php?id=<?= $id; ?>">Message</a>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $user['firstname']; ?> <?= $user['middlename']; ?> <?= $user['lastname']; ?> <?= $user['suffix']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $user['email']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $user['phone_number']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $user['gender']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $user['barangay']; ?>, <?= $user['municipality']; ?>, Misamis Occidental
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Grade Level</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $user['gradelevel']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">School</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $user['school']; ?>
                    </div>
                  </div>
                </div>
              </div>

             

                      <?php
                        }
                    } else {
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
          </div>

        </div>
    </div>







<?php
 include("./include/footer.php");
?>