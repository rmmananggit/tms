<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");

// Assuming you have already established a database connection

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $tutor_id = $_GET['tutor_id']; 

    // Fetch module titles and IDs from the database
    $query = "SELECT module_id, module_title FROM tutorial_module WHERE job_id = '$job_id'";
    $result = mysqli_query($con, $query);
?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    <h4 style="margin-left: 20px">Enrollment</h4>
                </div>
                <div class="card-body">

                    <form action="process.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="job_id" value="<?= $job_id; ?>">
                        <input type="hidden" name="tutor_id" value="<?= $tutor_id; ?>">
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="payby"><strong>Module:</strong></label>
                                <div class="form-check">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <input class="form-check-input" type="checkbox" name="modules[]" value="<?= $row['module_id']; ?>" id="module<?= $row['module_id']; ?>">
                                        <label class="form-check-label" for="module<?= $row['module_id']; ?>">
                                            <?= $row['module_title']; ?>
                                        </label>
                                        <br>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Preferred Mode of Tutoring</strong></label>
                            <input required type="text" name="tutoringmod" placeholder="Eg. In-person, online or combination of both" class="form-control" maxlength="80" >
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for=""><strong>Parent/Guardian Name and Contact</strong><small>(if applicable)</small></label>
                            <input required type="text" name="contact" class="form-control" placeholder="Eg. 09*******" maxlength="80" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for=""><strong>Any Learning Disabilities or Special Needs</strong></label>
                                <textarea required name="learningdisabilities" class="form-control" rows="3" placeholder="Eg. Dyslexia, Attention Deficit Hyperactivity Disorder" maxlength="500"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for=""><strong>Additional Comments/Notes</strong></label>
                                <textarea required name="comment" placeholder="Eg. I wanted to let you know that my child, Sarah, has been struggling with reading comprehension lately." class="form-control" rows="3" maxlength="500"></textarea>
                            </div>

                        </div>


                        <div class="col-12">
    <div class="form-check">
        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
        <label class="form-check-label" for="acceptTerms">
            I agree and accept the <a href="#" onclick="showTermsModal()">terms and conditions</a>
        </label>
        <div class="invalid-feedback">You must agree before submitting.</div>
    </div>
</div>



                        <div class="col-md-12">
                            <button type="submit" name="apply" class="btn btn-primary" style="float:right; margin-left: 10px;">Submit</button>
                            <a class="btn btn-danger" href="search.php" role="button" style="float:right;">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

<?php
} else {
?>
    <h4>No Record Found!</h4>
<?php
}
?>


<!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions for Tutors: Refund Policy for Unexpected Student Circumstances</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>1. Refund Eligibility:</strong></p>
        <ul>
          <li>Tutors agree to provide refunds to students under the following circumstances:</li>
          <ul>
            <li>A student is unable to attend a scheduled class due to unexpected circumstances beyond their control, such as illness, family emergency, or unavoidable commitments.</li>
            <li>The student notifies the tutor of their inability to attend at least 24 hours before the scheduled class.</li>
          </ul>
        </ul>

        <p><strong>2. Refund Amount:</strong></p>
        <ul>
          <li>Tutors will refund the full amount of the missed class to the student in the event of an eligible refund request.</li>
        </ul>

        <p><strong>3. Refund Process:</strong></p>
        <ul>
          <li>Students must provide valid documentation or evidence of the unexpected circumstances that prevented them from attending the scheduled class.</li>
          <li>Upon receipt of the documentation, tutors will review the request and process the refund within seven (7) business days.</li>
        </ul>

        <!-- Add other sections following the same format -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
    function showTermsModal() {
        $('#termsModal').modal('show');
    }
</script>

<?php
include("./include/footer.php");
?>