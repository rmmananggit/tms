<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");

// Function to map file extensions to icons
function getFileIcon($extension) {
    $iconMap = [
        'pdf' => 'far fa-file-pdf',
        'doc' => 'far fa-file-word',
        'docx' => 'far fa-file-word',
        'xls' => 'far fa-file-excel',
        'xlsx' => 'far fa-file-excel',
        'ppt' => 'far fa-file-powerpoint',
        'pptx' => 'far fa-file-powerpoint',
        'jpg' => 'far fa-file-image',   // Additional: JPG image
        'jpeg' => 'far fa-file-image',  // Additional: JPEG image
        'png' => 'far fa-file-image',   // Additional: PNG image
        'gif' => 'far fa-file-image',   // Additional: GIF image
        'mp4' => 'far fa-file-video',   // Additional: MP4 video
        'avi' => 'far fa-file-video',   // Additional: AVI video
        // Add more file format mappings as needed
    ];

    return $iconMap[strtolower($extension)] ?? 'far fa-file'; // Default to a generic file icon
}

?>
<div class="pagetitle">
    <h1>Module Files</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">My Module</li>
            <li class="breadcrumb-item active">Module Files</li>
        </ol>
    </nav>
</div>


<div class="container-fluid mt-5">
    <div class="row">
        <?php
        require '../admin/config/config.php';

        if (isset($_GET['id'])) {
            $moduleid = $_GET['id'];
            $jobid = $_GET['jobid'];
            $query = "SELECT
            tutorial_module_files.*, 
            tutorial_application.applicationStatus
        FROM
            tutorial_module_files
            INNER JOIN
            tutorial_module
            ON 
                tutorial_module_files.module_id = tutorial_module.module_id
            INNER JOIN
            tutorial_application
            ON 
                tutorial_module.module_id = tutorial_application.module_id
        WHERE
            tutorial_module_files.module_id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 's', $moduleid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $allModulesCompleted = true; // Assume all modules are completed initially
            $applicationStatus = null; // Initialize application status variable

            if (mysqli_num_rows($result) > 0) {
                $totalFiles = mysqli_num_rows($result);
                $completedFiles = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $fileExtension = pathinfo($row['file_type'], PATHINFO_EXTENSION);
                    $fileIcon = getFileIcon($fileExtension);

                    if ($row['status'] === 'Completed') {
                        $completedFiles++;
                    } else {
                        $allModulesCompleted = false; // If any module is not completed, set to false
                    }

                    // Set application status
                    $applicationStatus = $row['applicationStatus'];
                }

                $progressPercentage = ($completedFiles / $totalFiles) * 100;
                ?>
                <div class="progress mb-5">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= floor($progressPercentage) ?>%;" aria-valuenow="<?= floor($progressPercentage) ?>" aria-valuemin="0" aria-valuemax="100"><?= floor($progressPercentage) ?>%</div>

                </div>
                <?php

                // Reset result pointer for reuse
                mysqli_data_seek($result, 0);

                while ($row = mysqli_fetch_array($result)) {
                    $fileExtension = pathinfo($row['file_type'], PATHINFO_EXTENSION);
                    $fileIcon = getFileIcon($fileExtension);
                    ?>
                    <div class="col-md-6 mb-3">
                        <div class="card ml-3">
                            <i class="<?= $fileIcon ?> fa-3x mt-2"></i>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $row['title'] ?></h5><small></small>
                                <p class="card-text text-left"><?= $row['description'] ?></p>
                                <br>
                                <p class="card-text" style="color: <?= $row['status'] === 'Pending' ? 'red' : 'green' ?>">
                                    <?= $row['status'] ?>
                                </p>


                                <div class="btn-group d-flex justify-content-center" role="group" aria-label="Button group with nested dropdown">
                                    <a href="<?= $row['file_path'] ?>" download class="btn btn-secondary">Download</a>

                                    <?php
                                    // Hide the "Mark as done" button if the status is "Completed"
                                    if ($row['status'] !== 'Completed') {
                                        ?>
                                        <a class="btn btn-success" href="markasdone.php?id=<?= $row['file_id']; ?>">Mark as done</a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                // Check if all modules are completed to enable/disable the "Complete Module" button
                $completeButtonDisabled = $allModulesCompleted;
            } else {
                echo "No module files found";
                // If no module files found, disable the "Complete Module" button
                $completeButtonDisabled = true;
            }
            

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle the case where 'id' is not set (e.g., redirect or display a message)
            echo "Module ID not provided in the URL.";
            // If module ID is not provided, disable the "Complete Module" button
            $completeButtonDisabled = true;
        }
        ?>
    </div>
</div>

<?php
// If application status is "Done", display the message; otherwise, display the button
if ($applicationStatus === 'Done') {
    echo "<div class='col-md-12 text-center'><p style='color: green;'>You have already completed this module</p></div>";
} else {
?>
<div class="col-md-12">
    <form action="process.php" method="POST">
        <input type="hidden" name="moduleid" value="<?= $moduleid ?>">
        <input type="hidden" name="jobid" value="<?= $jobid ?>">
        <div class="row justify-content-end mb-3">
            <div class="col-auto">
                <button type="submit" name="completemodule" class="btn btn-primary">Complete Module</button>
            </div>
        </div>
    </form>
</div>
<?php
}
?>

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

<script>
    function viewFile(filePath, fileExtension) {
        // Display the file content in the modal
        if (fileExtension === 'pdf') {
            // PDF file
            $('#fileContent').html(`<object data="${filePath}" type="application/pdf" width="100%" height="600px"></object>`);
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
            // Image file
            $('#fileContent').html(`<img src="${filePath}" class="img-fluid" style="object-fit: cover; max-height: 600px;" alt="Image" />`);
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
include('./include/footer.php');
?>
