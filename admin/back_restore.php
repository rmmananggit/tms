<?php
 include("./include/authentication.php");
 include("./include/header.php");
 include("./include/topbar.php");
 include("./include/sidebar.php");
?>

<div class="pagetitle">
      <h1>Backup and Restore</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Backup and Restore</li>
        </ol>
      </nav>
    </div>

    <section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card h-100 text-start">
            <div class="card-body">
              <h1 class="card-title">BACKUP</h1>
             <div class="alert alert-warning" role="alert">
    <strong>Please note:</strong> <br> Downloading a backup of the database will create a snapshot of your data at the current moment. <br><br>
    Ensure that you understand the implications of restoring this backup, as it may overwrite existing data. It's recommended to proceed with caution and consult with your system administrator or database manager before initiating the download. <br><br> If you are unsure about any aspect of the backup process, seek assistance from a qualified professional.
</div>

              <p class="card-text"><a class="btn btn-primary" href="export.php">Click here to backup the database</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card h-100 text-start">
    <div class="card-body">
        <h4 class="card-title">RESTORE</h4>
        <div class="alert alert-warning" role="alert">
    <strong>WARNING: Irreversible Action Ahead!</strong>
    <br><br>
    Attention: By proceeding with this action, you are about to perform a database restore, which is irreversible. This means that any existing data will be overwritten and cannot be recovered.
    <br><br>
    Please ensure that you have thoroughly reviewed and confirmed your decision before proceeding. Data loss resulting from this action is permanent and cannot be undone. <br>
</div>

        <form method="POST" action="import.php" enctype="multipart/form-data">
            <input type="file" name="backupFile" class="form-control mb-3" required>
            <div class="text-end">
                <input type="submit" name="import" value="Import Data" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

</div>

      </div>
    </div>
  </div>
</section>




<?php
 include("./include/footer.php");
?>