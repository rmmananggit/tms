<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");
?>

<style>
    body {
        padding-top: 40px;
        background: #E6E6FA
    }

    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .avatar-md {
        height: 5rem;
        width: 5rem;
    }

    .fs-19 {
        font-size: 19px;
    }

    .primary-link {
        color: #314047;
        -webkit-transition: all .5s ease;
        transition: all .5s ease;
    }

    a {
        color: #02af74;
        text-decoration: none;
    }

    .bookmark-post .favorite-icon a,
    .job-box.bookmark-post .favorite-icon a {
        background-color: #da3746;
        color: #fff;
        border-color: danger;
    }

    .favorite-icon a {
        display: inline-block;
        width: 30px;
        height: 30px;
        font-size: 18px;
        line-height: 30px;
        text-align: center;
        border: 1px solid #eff0f2;
        border-radius: 6px;
        color: rgba(173, 181, 189, .55);
        -webkit-transition: all .5s ease;
        transition: all .5s ease;
    }

    .candidate-list-box .favorite-icon {
        position: absolute;
        right: 22px;
        top: 22px;
    }

    .fs-14 {
        font-size: 14px;
    }

    .bg-soft-secondary {
        background-color: rgba(116, 120, 141, .15) !important;
        color: #74788d!important;
    }

    .mt-1 {
        margin-top: 0.25rem!important;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<section class="section">
    <div class="container">
        <div class="justify-content-center row">
            <div class="col-lg-12">
                <div class="candidate-list-widgets mb-4">
                    <form action="#" method="GET" class="">
                        <div class="row">
                            <!-- municipality dropdown -->
                            <div class="col-lg-3">
                                <div class="filler-job-form">
                                    <i class="uil uil-location-point"></i>
                                    <select class="form-select selectForm__inner" data-trigger="true" name="municipality" id="municipalityDropdown" aria-label="Default select example">
                                        <!-- Options for municipalities -->
                                    </select>
                                </div>
                            </div>

                            <!-- barangay dropdown -->
                            <div class="col-lg-3">
                                <div class="filler-job-form">
                                    <i class="uil uil-location-point"></i>
                                    <select class="form-select selectForm__inner" data-trigger="true" name="barangay" id="barangayDropdown" aria-label="Default select example">
                                        <!-- Options for barangays -->
                                    </select>
                                </div>
                            </div>

                            <!-- skills dropdown -->
                            <div class="col-lg-3">
                                <div class="filler-job-form">
                                    <i class="uil uil-clipboard-notes"></i>
                                    <select class="form-select selectForm__inner" data-trigger="true" name="skills" id="skillsDropdown" aria-label="Default select example">
                                        <!-- Options for skills -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="filler-job-form">
                                    <i class="uil uil-clipboard-notes"></i>
                                    <button type="submit" class="btn btn-primary"><i class="uil uil-filter"></i> Search</button>
                                    <button type="button" class="btn btn-secondary" id="resetBtn"><i class="uil uil-undo"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        require '../admin/config/config.php';

        // Initialize the WHERE clause of the SQL query
        $whereClause = " WHERE 1=1";

        // Check if municipality is selected
        if (isset($_GET['municipality'])) {
            $municipality = mysqli_real_escape_string($con, $_GET['municipality']);
            $whereClause .= " AND tutor.municipality = '$municipality'";
        }

        // Check if barangay is selected
        if (isset($_GET['barangay'])) {
            $barangay = mysqli_real_escape_string($con, $_GET['barangay']);
            $whereClause .= " AND tutor.barangay = '$barangay'";
        }

        // Check if skills is selected
        if (isset($_GET['skills'])) {
            $skills = mysqli_real_escape_string($con, $_GET['skills']);
            $skillsArray = explode(',', $skills);
            $skillConditions = [];
            foreach ($skillsArray as $skill) {
                $skillConditions[] = "FIND_IN_SET('$skill', tutor.skills)";
            }
            $skillsCondition = implode(' OR ', $skillConditions);
            $whereClause .= " AND ($skillsCondition)";
        }

        // Modify your SQL query to include the WHERE clause
        $query = "SELECT
                        tutorial_services.job_id, 
                        tutorial_services.title, 
                        tutorial_services.description, 
                        tutorial_services.rate1, 
                        tutorial_services.rate2, 
                        tutorial_services.`status`, 
                        tutorial_services.date_posted, 
                        tutor.skills, 
                        tutor.firstname, 
                        tutor.middlename, 
                        tutor.lastname, 
                        tutor.profile_picture, 
                        tutor.barangay, 
                        tutor.municipality,
                        tutor.suffix,
                        tutor.user_id
                FROM
                        tutorial_services
                        INNER JOIN
                        tutor
                        ON 
                                tutorial_services.tutor_id = tutor.user_id
                $whereClause";

        $query_run = mysqli_query($con, $query);
        $check_job = mysqli_num_rows($query_run) > 0;

        if ($check_job) {
            while ($row = mysqli_fetch_array($query_run)) {
        ?>

                    <div class="col-lg-12">
                        <div class="candidate-list">
                            <div class="candidate-list-box card mt-4">
                                <div class="p-4 card-body">
                                    <div class="align-items-center row">
                                        <div class="col-auto">
                                            <div class="candidate-list-images">
                                                <?php
                                                echo '<img class="avatar-md rounded-circle" 
                                                                    data-image="' . base64_encode($row['profile_picture']) . '" 
                                                                    src="data:image;base64,' . base64_encode($row['profile_picture']) . '" 
                                                                    alt="image" style="object-fit: cover;">';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="candidate-list-content mt-3 mt-lg-0">
                                            <h5 class="fs-19 mb-0">
    <a class="primary-link" onclick="location.href='view_tutor_profile.php?id=<?= $row['user_id']; ?>'" style="cursor: pointer;">
       <u> <?php echo strtoupper($row['firstname']); ?> <?php echo strtoupper($row['middlename']); ?> <?php echo strtoupper($row['lastname']); ?> <?php echo strtoupper($row['suffix']); ?></u>
    </a>
</h5>

                                                <p class="text-muted"><?php echo $row['title'] ?></p>
                                                <ul class="list-unstyled text-muted">
                                                    <li><i class="mdi mdi-map-marker"></i> <?php echo $row['barangay'] ?> <?php echo $row['municipality'] ?></li>
                                                    <li><i class="mdi mdi-camera-timer"></i> <?php echo $row['rate1'] ?> / Per Hour</li>
                                                    <li><i class="mdi mdi-camera-timer"></i> <?php echo $row['rate2'] ?> / Per Day</li>
                                                    <li>
                                                        Status: <span style="color: <?php echo $row['status'] == 'Available' ? 'green' : ($row['status'] == 'Ongoing' ? 'red' : 'black'); ?>">
                                                            <?php echo $row['status']; ?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <?php
                                            $skillsArray = explode(',', $row['skills']);
                                            foreach ($skillsArray as $skill) {
                                                echo '<span class="badge bg-soft-secondary fs-14 mt-1">' . trim($skill) . '</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="favorite-icon mt-5">
                                        <button type="button" class="btn btn-primary" onclick="location.href='search_view.php?id=<?= $row['job_id']; ?>'">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        <?php
            }
        } else {
            echo "<div class='col-lg-12'>No Job Posted</div>";
        }
        ?>

    </div>
</section>

<?php
include("./include/footer.php");
?>
