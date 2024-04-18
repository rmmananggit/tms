<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> 


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright. All Rights Reserved
  </div>
  <div class="credits">
   <span><strong> Designed by Teach me sensie group</strong></span>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/sweetalert.min.js"></script>

<!-- address -->
<script src="assets/js/address.js"></script>

<!-- 5 start -->
<script src="assets/js/star-ratings.js"></script>


<script>
    // When the modal is about to be shown
    $('#exampleModal').on('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = $(event.relatedTarget);
        // Extract job ID from data attribute
        var jobId = button.data('job-id');
        // Set the job ID to the hidden input field in the modal form
        $('#job_id').val(jobId);
    });
</script>

<script>
  // Function to toggle password visibility
  function togglePassword(inputId, buttonId) {
    const passwordInput = document.getElementById(inputId);
    const toggleButton = document.getElementById(buttonId);

    toggleButton.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      toggleButton.innerHTML = type === 'password' ? '<i class="bi bi-eye-fill"></i>' : '<i class="bi bi-eye-slash-fill"></i>';
    });
  }

  // Toggle password visibility for each input
  togglePassword('currentPassword', 'toggleCurrentPassword');
  togglePassword('newPassword', 'toggleNewPassword');
  togglePassword('renewPassword', 'toggleRenewPassword');
</script>

<script>
    document.getElementById('resetBtn').addEventListener('click', function() {
        // Clear all form elements
        document.getElementById('municipalityDropdown').selectedIndex = 0;
        document.getElementById('barangayDropdown').selectedIndex = 0;
        document.getElementById('skillsDropdown').selectedIndex = 0;

        // Redirect to search.php
        window.location.href = 'search.php';
    });
</script>

<?php
      if(isset($_SESSION['status']) && $_SESSION['status_code'] !='' )
      {
          ?>
              <script>
              swal({
                title: "<?php echo $_SESSION['status']; ?>",
              icon: "<?php echo $_SESSION['status_code']; ?>",
              });
              </script>
              <?php
              unset($_SESSION['status']);
              unset($_SESSION['status_code']);
      }     
?>
</body>

</html>