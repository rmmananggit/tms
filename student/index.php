<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>
<style>
.evt-tab-inner {
  margin-bottom: 80px;
}
.evt-tab-inner ul {
  margin: 0;
  padding: 0;
  border: 0 !important;
}
.evt-tab-inner ul li {
  text-align: center;
  display: contents;
}
.evt-tab-inner ul li a {
  border: 1px solid var(--main-color) !important;
  height: 100px;
  line-height: 100px;
  padding: 0;
  width: 33.33%;
  border-radius: 0 !important;
  font-size: 24px;
  position: relative;
}
.evt-tab-inner ul li a span {
  font-weight: 700;
  margin-right: 25px;
  color: #20202c;
}
.evt-tab-inner ul li a:after {
  content: "";
  position: absolute;
  height: 30px;
  width: 30px;
  background: var(--main-color);
  transform: rotate(45deg);
  left: 50%;
  margin-left: -15px;
  bottom: -16px;
  opacity: 0;
  visibility: hidden;
  transition: all 0.4s ease-in;
}
.evt-tab-inner ul li a:hover, .evt-tab-inner ul li a:active, .evt-tab-inner ul li a:focus, .evt-tab-inner ul li a.active {
  background: var(--main-color) !important;
  color: #fff !important;
}
.evt-tab-inner ul li a:hover span, .evt-tab-inner ul li a:active span, .evt-tab-inner ul li a:focus span, .evt-tab-inner ul li a.active span {
  color: #fff;
}
.evt-tab-inner ul li a:hover:after, .evt-tab-inner ul li a:active:after, .evt-tab-inner ul li a:focus:after, .evt-tab-inner ul li a.active:after {
  opacity: 1;
  visibility: visible;
}
.evt-tab-inner.style-two ul li a {
  width: 50%;
}

.single-schedules-inner {
    background-color:#fff;
  box-shadow: 0px 3px 15px 0px rgba(184, 40, 88, 0.08);
  padding: 30px 30px 35px 30px;
  margin-bottom: 30px;
  transition: 0.4s;
  border-radius: 20px;
}
.single-schedules-inner .date {
  color: var(--main-color);
  font-size: 14px;
  margin-bottom: 15px;
}
.single-schedules-inner .date i {
  color: #646e85;
  margin-right: 3px;
}
.single-schedules-inner h5 {
  line-height: 36px;
  margin-bottom: 18px;
}
.single-schedules-inner .icons {
  margin-bottom: 20px;
}
.single-schedules-inner p {
  margin-bottom: 0;
}
.single-schedules-inner .media {
  margin-top: 43px;
}
.single-schedules-inner .media .media-left {
  margin-right: 15px;
}
.single-schedules-inner .media .media-left img {
  height: 60px;
  width: 60px;
  border-radius: 10px;
}
.single-schedules-inner .media .media-body h6 {
  font-weight: 500;
  margin-bottom: 0;
}
.single-schedules-inner .media .media-body p {
  margin-bottom: 0;
  font-size: 12px;
  font-weight: 500;
}
.single-schedules-inner:hover {
  box-shadow: 0px 6px 30px 0px rgba(184, 40, 88, 0.2);
}
.single-schedules-inner.lunch-schedules {
  height: 93.1%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/*------------- single-schedules-inner 02--------------*/
.single-schedules-inner-two {
  border-bottom: 1px solid #E5E5E5;
  margin-bottom: 30px;
  padding-bottom: 30px;
}
.single-schedules-inner-two .schedules-date {
  display: inline-block;
  background: var(--main-color);
  height: 150px;
  width: 150px;
  padding-top: 35px;
  position: absolute;
}
.single-schedules-inner-two .schedules-date .number {
  font-size: 45px;
  font-weight: 700;
  display: block;
  color: #fff;
  margin-bottom: 0;
  line-height: 1;
}
.single-schedules-inner-two .schedules-date .text {
  font-size: 24px;
  font-weight: 400;
  display: block;
  color: #fff;
}
.single-schedules-inner-two .media {
  padding-left: 170px;
}
.single-schedules-inner-two .media .media-left {
  margin-right: 20px;
}
.single-schedules-inner-two .media .media-body h4 {
  font-size: 28px;
  font-family: var(--heading-font);
  font-weight: 500;
}
.single-schedules-inner-two .schedules-location h4 {
  font-size: 28px;
  font-family: var(--heading-font);
  font-weight: 500;
}

/*------------- single-schedules-inner 03--------------*/
.schedules-date {
  display: inline-block;
  background: var(--main-color);
  height: 150px;
  width: 150px;
  padding-top: 35px;
  position: absolute;
}
.schedules-date .number {
  font-size: 45px;
  font-weight: 700;
  display: block;
  color: #fff;
  margin-bottom: 0;
  line-height: 1;
}
.schedules-date .text {
  font-size: 24px;
  font-weight: 400;
  display: block;
  color: #fff;
}

.event-schedule-3 {
  margin: 0;
  padding: 0;
}
.event-schedule-3 li {
  padding-left: 176px;
  position: relative;
  list-style: none;
}
.event-schedule-3 li:after {
  content: "";
  position: absolute;
  left: 70px;
  top: 140px;
  bottom: 0;
  background: rgba(255, 255, 255, 0.5);
  z-index: -1;
  height: 100%;
  width: 1px;
  z-index: -2;
}
.event-schedule-3 li:last-child:after {
  display: none;
}
.event-schedule-3 .schedules-date {
  left: 0;
  width: 147px;
  height: 140px;
  background: #FD0156;
}
.event-schedule-3 .schedules-date:after {
  content: "";
  position: absolute;
  left: 10px;
  right: 10px;
  top: 10px;
  bottom: -10px;
  background: #5E39E8;
  z-index: -1;
}

.single-event-schedule-3 {
  background: #fff;
  padding: 50px;
  margin-bottom: 50px;
  position: relative;
}
.single-event-schedule-3:after {
  content: "";
  position: absolute;
  left: 20px;
  right: 20px;
  top: 20px;
  bottom: -20px;
  background: #5E39E8;
  z-index: -1;
}
.single-event-schedule-3 .media-left {
  margin-right: 50px;
}
.single-event-schedule-3 .media-left img {
  border-radius: 20px;
  margin-bottom: 10px;
}
.single-event-schedule-3 .media-left h6 {
  margin-bottom: 0;
  color: #eee;
}
.single-event-schedule-3 .media-left p {
  font-size: 12px;
  margin-bottom: 0;
  color: #eee;
}
.single-event-schedule-3 .media-body h4 {
  margin-bottom: 5px;
  color: #eee;
}
.single-event-schedule-3 .media-body p {
  color: #eee;
}
.single-event-schedule-3 .media-body .time {
  margin-bottom: 0;
  color: #eee;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #495057;
    background-color: #20B2AA !important;
    border-color: #dee2e6 #dee2e6 #fff;
}
.evt-tab-inner ul li a:hover, .evt-tab-inner ul li a:active, .evt-tab-inner ul li a:focus, .evt-tab-inner ul li a.active {
    background: #eee !important;
    color: #fff !important;
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
.evt-tab-inner ul li a {
    border: 1px solid var(--main-color) !important;
    height: 100px;
    line-height: 100px;
    padding: 0;
    width: 33.33%;
    border-radius: 0 !important;
    font-size: 24px;
    position: relative;
}
.nav-link {
    display: block;
    padding: .5rem 1rem;
}
</style>

<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

         
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">On-going Tutor</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-mailbox"></i>
                    </div>
                    <div class="ps-3">

                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $ongoing_query = "SELECT
                                    tutorial_application.*
                                  FROM
                                    tutorial_application
                                  WHERE
                                    tutorial_application.`applicationStatus` = 'Ongoing' AND
                                    tutorial_application.student_id = '$user_id'";
                                    $ongoing_query_run = mysqli_query($con, $ongoing_query);


                                    if($ongoing_total = mysqli_num_rows($ongoing_query_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$ongoing_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div>

       

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Pending Enrollment</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-person"></i>
                    </div>
                    <div class="ps-3">

                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $pending = "SELECT
                                    tutorial_application.*
                                  FROM
                                    tutorial_application
                                  WHERE
                                    tutorial_application.student_id = '$user_id' AND
                                    tutorial_application.`applicationStatus` = 'Pending'";
                                    $pending_run = mysqli_query($con, $pending);


                                    if($pending_total = mysqli_num_rows($pending_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$pending_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Active Modules</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">

                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $pending = "SELECT
                                    tutorial_module.*
                                  FROM
                                    tutorial_module
                                    INNER JOIN
                                    tutorial_application
                                    ON 
                                      tutorial_module.module_id = tutorial_application.module_id
                                  WHERE
                                    tutorial_application.student_id = '$user_id' AND
                                    tutorial_application.`applicationStatus` = 'Ongoing'";
                                    $pending_run = mysqli_query($con, $pending);


                                    if($pending_total = mysqli_num_rows($pending_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$pending_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Module Passed</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-journal-arrow-up"></i>
                    </div>
                    <div class="ps-3">

                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $pending = "SELECT
                                    module_submit.*
                                  FROM
                                    module_submit
                                  WHERE
                                    module_submit.user_id = '$user_id'";
                                    $pending_run = mysqli_query($con, $pending);


                                    if($pending_total = mysqli_num_rows($pending_run))
                                    {
                                        echo '<h6 class="mb-0"> '.$pending_total.' </h6>';
                                    }else
                                    {
                                        echo '<h6 class="mb-0">0</h6>';
                                    }
                                    ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>



          </div>
        </div>
      </div>



      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />






    </section>



<?php
 include("./include/footer.php");
?>