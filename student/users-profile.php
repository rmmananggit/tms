<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">

          <?php
                        $id = $_SESSION['auth_user']['user_id'];
                        $users = "SELECT
                        student.*
                      FROM
                        student
                      WHERE
                        student.user_id = '$id'";
                        $users_run = mysqli_query($con, $users);
                        ?>
                        <?php
                        if (mysqli_num_rows($users_run) > 0) {
                            foreach ($users_run as $user) {
                        ?>

            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
<?php 
   echo '<img class="rounded-circle" 
   data-image="'.base64_encode($user['profilepicture']).'" 
   src="data:image;base64,'.base64_encode($user['profilepicture']).'" 
   alt="image" style="object-fit: cover; width: 100%; height: auto;">'; 
?>

              <h2><?= $user['firstname']; ?> <?= $user['lastname']; ?> </h2>
              <h3>Student</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $user['firstname']; ?> <?= $user['middlename']; ?> <?= $user['lastname']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?= $user['gender']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email Address</div>
                    <div class="col-lg-9 col-md-8"><?= $user['email']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?= $user['barangay']; ?> <?= $user['municipality']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Zip Code</div>
                    <div class="col-lg-9 col-md-8"><?= $user['zipcode']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                    <div class="col-lg-9 col-md-8"><?= $user['phone_number']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">School</div>
                    <div class="col-lg-9 col-md-8"><?= $user['school']; ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user['user_id']; ?>">

                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                       <input type="file" class="form-control" name="picture" accept="image/*">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="barangay" class="col-md-4 col-lg-3 col-form-label">Barangay</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" id="barangay" name="barangay" value="<?= $user['barangay']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="municipality" class="col-md-4 col-lg-3 col-form-label">Municipality</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="municipality" type="text" class="form-control" id="municipality" value="<?= $user['municipality']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="zipcode" class="col-md-4 col-lg-3 col-form-label">Zip Code</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="zipcode" type="text" class="form-control" id="zipcode" value="<?= $user['zipcode']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="phone" value="<?= $user['phone_number']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="school" class="col-md-4 col-lg-3 col-form-label">School</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="school" type="text" class="form-control" id="school" value="<?= $user['school']; ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="editprofile" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                  <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user['user_id']; ?>">

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9 input-group">
                      <input name="currentpassword" type="password" class="form-control" id="currentPassword">
                      <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                        <i class="bi bi-eye-fill"></i>
                      </button>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9 input-group">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                      <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                        <i class="bi bi-eye-fill"></i>
                      </button>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9 input-group">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      <button class="btn btn-outline-secondary" type="button" id="toggleRenewPassword">
                        <i class="bi bi-eye-fill"></i>
                      </button>
                    </div>
                  </div>

                    <div class="text-center">
                      <button type="submit" name="profile_changepassword" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
      <?php
                            }
                        } else {
                        ?>
                            <h4>ERROR!</h4>
                        <?php
                        }
                       ?>
    </section>

<?php
 include("./include/footer.php");
?>