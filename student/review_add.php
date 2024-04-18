<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");
?>

<style>
    body{
    margin-top:20px;
    background:#eee;    
}
a {
    color: #f96332;
}
.m-t-5{
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

#rating-value{	
	width: 110px;
	margin: 40px auto 0;
	padding: 10px 5px;
	text-align: center;
	box-shadow: inset 0 0 2px 1px rgba(46,204,113,.2);
}

/*styling star rating*/
.rating{
	border: none;
	float: left;
}

.rating > input{
	display: none;
}

.rating > label:before{
	content: '\f005';
	font-family: FontAwesome;
	margin: 5px;
	font-size: 1.5rem;
	display: inline-block;
	cursor: pointer;
}

.rating > .half:before{
	content: '\f089';
	position: absolute;
	cursor: pointer;
}


.rating > label{
	color: #ddd;
	float: right;
	cursor: pointer;
}

.rating > input:checked ~ label,
.rating:not(:checked) > label:hover, 
.rating:not(:checked) > label:hover ~ label{
	color: #2ce679;
}

.rating > input:checked + label:hover,
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label,
.rating > input:checked ~ label:hover ~ label{
	color: #2ddc76;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
        $user_id = $_SESSION['auth_user']['user_id'];
        $query = "SELECT
            tutorial_services.title, 
            tutorial_services.description, 
            tutorial_services.job_id, 
            tutor.`password`, 
            tutor.firstname, 
            tutor.middlename, 
            tutor.suffix, 
            tutor.lastname, 
            tutor.barangay, 
            tutor.municipality, 
            tutor.profile_picture
        FROM
            tutorial_services
            INNER JOIN
            tutorial_application
            ON 
                tutorial_services.job_id = tutorial_application.job_id
            INNER JOIN
            tutor
            ON 
                tutorial_application.tutor_id = tutor.user_id AND
                tutorial_services.tutor_id = tutor.user_id
        WHERE
            tutorial_application.student_id = '$user_id'";
        $query_run = mysqli_query($con, $query);
        $check = mysqli_num_rows($query_run) > 0;

        if ($check) {
            while ($row = mysqli_fetch_array($query_run)) {
                $job_id = $row['job_id'];
                // Check if the user has already reviewed this tutor
                $review_query = "SELECT * FROM tutorial_services_review WHERE job_id = '$job_id' AND student_id = '$user_id'";
                $review_result = mysqli_query($con, $review_query);
                $review_exists = mysqli_num_rows($review_result) > 0;
        ?>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card profile-header">
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <?php
                                    echo '<img class="profile-image float-md-right" 
                                            data-image="' . base64_encode($row['profile_picture']) . '" 
                                            src="data:image;base64,' . base64_encode($row['profile_picture']) . '" 
                                            alt="image" style="object-fit: cover; width: 100%; height: auto;">';
                                    ?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12">
                                    <h4 class="m-t-0 m-b-0"><strong><?php echo $row['firstname']; ?></strong> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?> <?php echo $row['suffix']; ?></h4>
                                    <span class="job_post"><?php echo $row['title']; ?></span>
                                    <p><?php echo $row['barangay']; ?>, <?php echo $row['municipality']; ?>, Misamis Occidental</p>
                                    <div>
                                        <?php
                                        // Check if the user has already reviewed this tutor
                                        if (!$review_exists) {
                                            // Button to trigger modal with job ID as data attribute
                                            echo '<button type="button" class="btn btn-primary review-button" data-toggle="modal" data-target="#exampleModal" data-job-id="' . $job_id . '">Review</button>';
                                        } else {
                                            // Button disabled if review already exists
                                            echo '<button type="button" class="btn btn-primary" disabled>Reviewed</button>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No record found";
        }
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review Tutor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="job_id" id="job_id">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12">
                                <textarea class="form-control" id="comment" name="comment" rows="6" placeholder="Enter your review"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-lg-12">
                                <div class="rating-wrap">
                                    <label for=""><strong>Stars</strong></label>
                                    <div class="center">
                                        <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5"/><label for="star5" class="full" title="Awesome"></label>
					<input type="radio" id="star4.5" name="rating" value="4.5"/><label for="star4.5" class="half"></label>
					<input type="radio" id="star4" name="rating" value="4"/><label for="star4" class="full"></label>
					<input type="radio" id="star3.5" name="rating" value="3.5"/><label for="star3.5" class="half"></label>
					<input type="radio" id="star3" name="rating" value="3"/><label for="star3" class="full"></label>
					<input type="radio" id="star2.5" name="rating" value="2.5"/><label for="star2.5" class="half"></label>
					<input type="radio" id="star2" name="rating" value="2"/><label for="star2" class="full"></label>
					<input type="radio" id="star1.5" name="rating" value="1.5"/><label for="star1.5" class="half"></label>
					<input type="radio" id="star1" name="rating" value="1"/><label for="star1" class="full"></label>
					<input type="radio" id="star0.5" name="rating" value="0.5"/><label for="star0.5" class="half"></label>
                                        </fieldset>
                                    </div>
                                    <h6 id="rating-value"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="add_review" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
include("./include/footer.php");
?>