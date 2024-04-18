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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script src="assets/js/sweetalert.min.js"></script>

<script>
    // JavaScript to hide the notification badge when the bell icon is clicked
    document.getElementById('notification-bell').addEventListener('click', function() {
        document.getElementById('notification-badge').style.display = 'none';
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
      toggleButton.innerHTML = type === 'password' ? '<i class="bi bi-eye-fill"></i>' : '<i class="bi bi-eye-fill"></i>';
    });
  }

  // Toggle password visibility for each input
  togglePassword('currentPassword', 'toggleCurrentPassword');
  togglePassword('newPassword', 'toggleNewPassword');
  togglePassword('renewPassword', 'toggleRenewPassword');
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