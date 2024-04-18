<?php
include("authentication.php");
?>
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logopic.png" alt="">
        <span class="d-none d-lg-block">TMS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
     
      <?php
// Fetch notifications from the database
$query = "SELECT `id`, `message`, `created_at`, `read_status` FROM `admin_notification` ORDER BY `created_at` DESC LIMIT 5";
$result = mysqli_query($con, $query);
$num_notifications = mysqli_num_rows($result);
?>

<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-bell"></i>
    <?php if ($num_notifications > 0): ?>
        <?php $unread_count = 0; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <?php if ($row['read_status'] == 0) : ?>
                <?php $unread_count++; ?>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php if ($unread_count > 0): ?>
            <span class="badge bg-primary badge-number"><?php echo $unread_count; ?></span>
        <?php endif; ?>
    <?php endif; ?>
</a>

<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
    <?php mysqli_data_seek($result, 0); ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <?php if ($row['read_status'] == 0) : ?>
            <?php
            // Update read_status to 1 when the notification is clicked
            $update_query = "UPDATE `admin_notification` SET `read_status` = 1 WHERE `id` = " . $row['id'];
            mysqli_query($con, $update_query);
            ?>
        <?php endif; ?>
        <li class="notification-item">
            <div>
                <h6><?php echo $row['message']; ?></h6>
                <small><?php echo date('F j, Y g:i A', strtotime($row['created_at'])); ?></small>
            </div>
        </li>
    <?php endwhile; ?>
</ul>


   
      <?php if(isset($_SESSION['auth_user'])): ?>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['auth_user']['user_name']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          
            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


        

            <li>
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
    <?php endif; ?>


  </header><!-- End Header -->