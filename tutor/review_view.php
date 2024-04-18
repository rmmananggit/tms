<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");
?>

<style>
    body {
        margin-top: 20px;
        background: #eee;
    }

    a {
        color: #f96332;
    }

    .m-t-5 {
        margin-top: 5px;
    }

    .card {
        background: #fff;
        margin-bottom: 30px;
        transition: .5s;
        border: 0;
        border-radius: .1875rem;
        display: inline-block;
        position: relative;
        width: 100%;
        box-shadow: none;
        height: 300px;
    }

    .card .body {
        font-size: 14px;
        color: #424242;
        padding: 20px;
        font-weight: 400;
    }

    .profile-page .profile-header {
        position: relative
    }

    .profile-page .profile-header .profile-image img {
        border-radius: 50%;
        width: 140px;
        border: 3px solid #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23)
    }

    .profile-page .profile-header .social-icon a {
        margin: 0 5px
    }

    .profile-page .profile-sub-header {
        min-height: 60px;
        width: 100%
    }

    .profile-page .profile-sub-header ul.box-list {
        display: inline-table;
        table-layout: fixed;
        width: 100%;
        background: #eee
    }

    .profile-page .profile-sub-header ul.box-list li {
        border-right: 1px solid #e0e0e0;
        display: table-cell;
        list-style: none
    }

    .profile-page .profile-sub-header ul.box-list li:last-child {
        border-right: none
    }

    .profile-page .profile-sub-header ul.box-list li a {
        display: block;
        padding: 15px 0;
        color: #424242
    }

    #rating-value {
        width: 110px;
        margin: 40px auto 0;
        padding: 10px 5px;
        text-align: center;
        box-shadow: inset 0 0 2px 1px rgba(46, 204, 113, .2);
    }

    /*styling star rating*/
    .rating {
        border: none;
        float: left;
    }

    .rating>input {
        display: none;
    }

    .rating>label:before {
        content: '\f005';
        font-family: FontAwesome;
        margin: 5px;
        font-size: 1.5rem;
        display: inline-block;
        cursor: pointer;
    }

    .rating>.half:before {
        content: '\f089';
        position: absolute;
        cursor: pointer;
    }

    .rating>label {
        color: #ddd;
        float: right;
        cursor: pointer;
    }

    .rating>input:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #2ce679;
    }

    .rating>input:checked+label:hover,
    .rating>input:checked~label:hover,
    .rating>label:hover~input:checked~label,
    .rating>input:checked~label:hover~label {
        color: #2ddc76;
    }
</style>

<div class="pagetitle">
    <h1>My Tutorial Services</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Review</li>
        </ol>
    </nav>
</div>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container profile-page">
    <div class="row">
        <?php
        require '../admin/config/config.php';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        $query = "SELECT
        tutorial_services.title, 
        tutorial_services.description, 
        tutorial_services_review.`comment`, 
        tutorial_services_review.stars, 
        tutorial_services_review.date, 
        student.firstname, 
        student.middlename, 
        student.lastname, 
        student.suffix, 
        student.profilepicture, 
        student.barangay, 
        student.municipality
    FROM
        tutorial_services
        INNER JOIN
        tutorial_services_review
        ON 
            tutorial_services.job_id = tutorial_services_review.job_id
        INNER JOIN
        student
        ON 
            tutorial_services_review.student_id = student.user_id
    WHERE
        tutorial_services_review.job_id = '$id'";
        $query_run = mysqli_query($con, $query);
        $check = mysqli_num_rows($query_run) > 0;

        if ($check) {
            while ($row = mysqli_fetch_array($query_run)) {
        ?>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card profile-header">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <?php
                                    echo '<img class="profile-image float-md-right" 
                                            data-image="' . base64_encode($row['profilepicture']) . '" 
                                            src="data:image;base64,' . base64_encode($row['profilepicture']) . '" 
                                            alt="image" style="object-fit: cover; width: 100%; height: auto;">';
                                    ?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12">
                                    <h4 class="m-t-0 m-b-0"><strong><?php echo $row['firstname']; ?></strong> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?> <?php echo $row['suffix']; ?></h4>
                                    <p><?php echo $row['barangay']; ?>, <?php echo $row['municipality']; ?>, Misamis Occidental</p>

                                    <h5><i>Review Message:</i></h5>
                                    <h5><?php echo $row['comment']; ?></h5>
                                    <hr>
                                    <h4><?php echo $row['stars']; ?> <i class="bi bi-star-fill"></i> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
            }
        } else {
            echo "No record found";
        }
        ?>
    </div>
</div>

<?php
include("./include/footer.php");
?>
