    <?php
    include("./include/authentication.php");
    include("./include/header.php");
    include("./include/topbar.php");
    include("./include/sidebar.php");
    ?>

    <div class="pagetitle">
        <h1>My Files</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Submit Module</li>
            </ol>
        </nav>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Activities</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Activities</th>
                                    <th scope="col">My Description</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_id = $_SESSION['auth_user']['user_id'];
                                $query = "SELECT
                                            module_submit.submit_id, 
                                            module_submit.description, 
                                            module_submit.file_name, 
                                            module_submit.file_type, 
                                            module_submit.file_path, 
                                            tutorial_module.module_title, 
                                            tutorial_services.tutor_id,
                                            module_submit.grade
                                        FROM
                                            module_submit
                                            INNER JOIN
                                            tutorial_module
                                            ON 
                                                module_submit.module_id = tutorial_module.module_id
                                            INNER JOIN
                                            tutorial_services
                                            ON 
                                                tutorial_module.job_id = tutorial_services.job_id
                                        WHERE
                                            tutorial_services.tutor_id = '$user_id'";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        $fileExtension = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                                ?>
<tr>
    <td width="100px"><?= $row['module_title']; ?></td>
    <td width="100px"><?= $row['description']; ?></td>
    <td width="100px">
    <?php if($row['grade'] == 0): ?>
        <?php echo "Not Yet Graded!"; ?>
    <?php else: ?>
        <?php echo $row['grade']; ?>
    <?php endif; ?>
</td>
    <td width="100px">
        <form action="process.php" method="POST">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-outline-primary" onclick="openGradeModal(<?= $row['submit_id']; ?>)">Grade</button>
                <a href="<?= $row['file_path'] ?>" class="btn btn-outline-success" download>Download</a> <!-- Download button -->
                <button type="submit" name="delete_submit_file" class="btn btn-outline-danger" value="<?= $row['submit_id']; ?>">Delete</button>
            </div>
        </form>
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

    <!-- Modal -->
    <div class="modal fade" id="viewFileModal" tabindex="-1" role="dialog" aria-labelledby="viewFileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFileModalLabel">View File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Content placeholder for the file -->
                    <div id="fileContent"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- Modal -->
    <div class="modal fade" id="gradeModal<?= $row['submit_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="gradeModalLabel<?= $row['submit_id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gradeModalLabel<?= $row['submit_id']; ?>">Score</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form inside modal -->
                <form id="gradeModalForm<?= $row['submit_id']; ?>" action="process.php" method="POST">
                    <!-- Hidden input to pass submit_id -->
                    <input type="hidden" name="submit_id" value="<?= $row['submit_id']; ?>">
                    
                    <!-- Your grading criteria and input fields can go here -->
                    <div class="form-group">

                        <label for="">Comment: <small>(Optional)</small></label>
                        <textarea class="form-control" name="comment" id="comment" cols="30" rows="5"></textarea>

                        <label for="grade" class="mt-2">Grade:</label>
                        <input type="text" class="form-control" id="grade" name="grade">
                       
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button type="submit" form="gradeModalForm<?= $row['submit_id']; ?>" name="addgrade" class="btn btn-primary">Submit Grade</button>
                </div>
            </div>
        </div>
    </div>
</div>


    <script>
            function openGradeModal(submitId) {
        $('#gradeModal' + submitId).modal('show');
    }

        function viewFile(filePath, fileExtension) {
            // Display the file content in the modal
            if (fileExtension === 'pdf') {
                // PDF file
                $('#fileContent').html(`<object data="${filePath}" type="application/pdf" width="100%" height="600px"></object>`);
            } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                // Image file
                $('#fileContent').html(`<img src="${filePath}" class="img-fluid" alt="Image" />`);
            } else if (fileExtension === 'mp4' || fileExtension === 'avi') {
                // Video file (you can customize this based on your video types)
                $('#fileContent').html(`<video controls width="100%" height="400px"><source src="${filePath}" type="video/${fileExtension}"></video>`);
            } else {
                // Default case: embed in an iframe (you might need additional handling for other file types)
                $('#fileContent').html(`<iframe src="${filePath}" frameborder="0" width="100%" height="600px"></iframe>`);
            }

            // Show the modal
            $('#viewFileModal').modal('show');
        }
    </script>
    <?php
    include("./include/footer.php");
    ?>
