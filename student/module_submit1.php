    <?php
    include("./include/authentication.php");
    include("./include/header.php");
    include("./include/topbar.php");
    include("./include/sidebar.php");
    ?>


    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item">Module</li>
            <li class="breadcrumb-item active">Submit Module</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <form action="process.php" method="post" autocomplete="off" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="mb-1 mt-2">Select Module File</label>
                                <select name="module" class="form-control">
                                    <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $m_query = "SELECT
                                    tutorial_module.module_id, 
                                    tutorial_module.module_title
                                FROM
                                    tutorial_module
                                    INNER JOIN
                                    tutorial_application
                                    ON 
                                        tutorial_module.module_id = tutorial_application.module_id
                                WHERE
                                    tutorial_application.student_id = '$user_id'";
                                    $module = mysqli_query($con, $m_query);
                                    while ($c = mysqli_fetch_array($module)) {
                                    ?>
                                        <option value="<?php echo $c['module_id'] ?>"><?php echo $c['module_title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                                <div class="col-md-12 mb-3">
                                    <textarea class="form-control" name="module_description" rows="7" placeholder="Description *" maxlength="200" required></textarea>
                                </div>

                            <div class="col-md-12 mb-3">
                            <label for="formFile" class="form-label">File <small>(Optional)</small></label>
                            <input class="form-control" type="file" id="formFile" name="fileInput" accept="image/*,video/*,.ppt,.pptx,.doc,.docx,.pdf">
                            </div>

                            </div>

                            <div class="text-right">
                            
                                <button type="submit" name="submit_module_file" style="float:right; margin-left: 6px;" class="btn btn-primary">Submit</button>

                                <a href="module_submit.php" class="btn btn-danger" style="float:right; ">Back</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include("./include/footer.php");
    ?>