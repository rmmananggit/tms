<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");

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

<div class="col-md-12 mt-2 mb-2">
    <a type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#addFileModal"
        style="float: right;">Add Module</a>
</div>

<div class="container-fluid mt-5">
    <?php
    require '../admin/config/config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT `file_id`, `module_id`, `title`, `description`, `status`, `file_name`, `file_type`, `file_path` FROM `tutorial_module_files` WHERE `module_id` = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            ?>
    <div class="row">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $fileExtension = pathinfo($row['file_type'], PATHINFO_EXTENSION);
                $fileIcon = getFileIcon($fileExtension);
                ?>
<div class="col-md-12 mb-3">
    <div class="card h-100">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['title'] ?></h5>
                    <p class="card-text"><?= $row['description'] ?></p>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div class="card-body text-center">
                    <i class="<?= $fileIcon ?> fa-3x mt-2"></i>
                    <div class="btn-group" role="group">
                        <a href="<?= $row['file_path'] ?>" download class="btn btn-warning">Download</a>
                        <button type="button" class="btn btn-danger" onclick="deleteFile(<?= $row['file_id'] ?>)">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


            <?php
            }
            ?>
    </div> <!-- End of row -->
            <?php
        } else {
            echo "No module files found";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where 'id' is not set (e.g., redirect or display a message)
        echo "Module ID not provided in the URL.";
    }
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="addFileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFileModalLabel">Add Module</h5>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form for adding files can go here -->
                <!-- For simplicity, let's add a placeholder form -->
                <?php
                // Check if 'id' is set in the URL
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                ?>
                <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <!-- Add a hidden input field to store module_id -->
                    <input type="hidden" name="module_id" id="module_id" value="<?= $id ?>">
                    <div class="form-group mb-3">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description: <small>(Required)</small></label>
                        <textarea class="form-control" name="description" rows="7" maxlength="2000"
                            id="description" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fileInput">File Input: <small>(Optional)</small></label>
                        <input type="file" class="form-control" id="fileInput" name="fileInput"
                            accept="image/*,video/*,.ppt,.pptx,.doc,.docx">
                    </div>
                    <button type="submit" name="add_file" class="btn btn-primary"
                        style="float: right;">Upload</button>
                </form>
                <?php } else {
                    echo "Module ID not provided in the URL.";
                } ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="viewFileModal" tabindex="-1" role="dialog" aria-labelledby="viewFileModalLabel"
    aria-hidden="true">
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

<script>
    function deleteFile(fileId) {
        // Send an AJAX request to delete the file
        $.post('process.php', {
            delete_module_files: fileId
        }, function (response) {
            location.reload(); // Refresh the page after deletion
        });
    }

    function viewFile(filePath, fileExtension) {
        // Display the file content in the modal
        if (fileExtension === 'pdf') {
            // PDF file
            $('#fileContent').html(`<object data="${filePath}" type="application/pdf" width="100%"
                height="600px"></object>`);
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
            // Image file
            $('#fileContent').html(`<img src="${filePath}" class="img-fluid" alt="Image" />`);
        } else if (fileExtension === 'mp4' || fileExtension === 'avi') {
            // Video file (you can customize this based on your video types)
            $('#fileContent').html(`<video controls width="100%" height="400px"><source src="${filePath}"
                    type="video/${fileExtension}"></video>`);
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
