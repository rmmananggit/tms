<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="./assets/js/address.js"></script>


  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<style>
   .captcha
{
  width: 50%;
  background: yellow;
  text-align: center;
  font-size: 24px;
  font-weight: 700;
} 
</style>
<?php 
session_start(); 
$rand = rand(9999,1000);
?>
<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Student Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form action="student_register_code.php" method="POST" enctype="multipart/form-data" autocomplete="off"  class="row g-3 needs-validation" novalidate>
                    
                  <div class="row">
                    <div class="col-md-6">
                    <label for="fname" class="form-label">First Name <small style="color: red;">*</small></label>
                      <input type="text" name="fname" class="form-control" id="fname" placeholder="Juan" required>
                    </div>

                    <div class="col-md-6">
                    <label for="mname" class="form-label">Middle Name <small>(Optional)</small></label>
                      <input type="text" name="mname" class="form-control" id="mname" placeholder="Angus">
                    </div>

                    <div class="col-md-6 mt-2">
                    <label for="lname" class="form-label">Last Name <small style="color: red;">*</small></label>
                      <input type="text" name="lname" class="form-control" id="lname" placeholder="Dela Cruz" required>
                    </div>

                    <div class="col-md-6 mt-2">
                    <label for="lname" class="form-label">Suffix  <small>(Optional)</small></label>
                    <select class="form-select" id="suffix" name="suffix">
                        <option disabled selected value="">Select Suffix</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="JR">JR</option>
                        <option value="SR">SR</option>
                    </select>
                    </div>

                    <div class="col-md-12 mt-2">
                    <label for="email" class="form-label">Email Address <small style="color: red;">*</small></label>
                      <input type="text" name="email" class="form-control" id="email" placeholder="juandelacruz@gmail.com" required>
                    </div>
                    
                    <div class="col-md-6 mt-2">
                    <label for="password" class="form-label">Password <small style="color: red;">*</small></label>
                    <div class="input-group">
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Enter Password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="showPasswordToggle" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="confirmPassword" class="form-label">Confirm Password <small style="color: red;">*</small></label>
                    <div class="input-group">
                        <input type="password" id="inputPasswordConfirm" name="confirmpassword" class="form-control" placeholder="Enter Password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="showConfirmPasswordToggle" style="cursor: pointer;">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>
                    <p id="passwordMatchError" style="color: red; display: none;">Passwords do not match.</p>
                </div>
        
                    <div class="col-md-6 mt-2">
                    <label for="phone" class="form-label">Phone Number <small style="color: red;">*</small></label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="09X-XXX-XXXXX" required>
                    </div>

                    <div class="col-md-6 mt-2">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option disabled selected value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="municipality" class="form-label">Municipality <small style="color: red;">*</small></label>
                        <select name="municipality" class="form-control" id="municipality" required>
                            <option value="">Select Municipality</option>
                            <!-- Options will be populated dynamically -->
                        </select>
                    </div>

                    <div class="col-md-6 mt-2">
                        <label label for="barangay" class="form-label">Barangay <small style="color: red;">*</small></label>
                        <select name="barangay" class="form-control" id="barangay" required></select>
                    </div>
                    


                    <div class="col-md-6 mt-2">
                    <label for="zipcode" class="form-label">Zip Code <small style="color: red;">*</small></label>
                      <input type="number" name="zipcode" class="form-control" id="zipcode" placeholder="1234" required>
                    </div>

                    <div class="col-md-6 mt-2">
                    <label for="gender" class="form-label">Grade Level <small style="color: red;">*</small></label>
                    <select name="gradelevel" class="form-select" required>
                    <option value="" disabled selected>Select Grade Level</option>
                    <option value="Pre-school">Preschool</option>
                    <option value="Elementary School">Elementary School</option>
                    <option value="High School">High School</option>
                    <option value="Senior High">Senior High</option>
                    <option value="College">College</option>
                    </select>
                    </div>

                    <div class="col-md-12 mt-2">
                    <label for="school" class="form-label">Current School <small style="color: red;">*</small></label>
                      <input type="text" name="school" class="form-control" id="school" placeholder="Jimenez Bethel Institute" required>
                    </div>

                  <div class="col-md-12 mt-2">
                    <label for="idpicture" class="form-label">Student Id <small style="color: red;">*</small></label>
                      <input type="file" name="idpicture" class="form-control" id="idpicture" required>
                    </div>

                  <div class="col-md-12 mt-2">
                    <label for="profilepicture" class="form-label">Profile Picture <small style="color: red;">*</small></label>
                      <input type="file" name="profilepicture" class="form-control" id="profilepicture" required>
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

                    <div class="col-md-6 form-group">
       <label for="captcha">Captcha</label>
       <input type="text" name="captcha" id="captcha" placeholder="Enter Captcha" required class="form-control"/>
       <input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>">
     </div>
     <div class="col-md-6 form-group">
       <label for="captcha-code">Captcha Code</label>
       <div class="captcha"><?php echo $rand; ?></div>
     </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="submitButton" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="../login/index.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>


    <!-- Bootstrap Modal -->
<div class="modal" tabindex="-1" role="dialog" id="termsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Conditions</h5>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<p>1. Acceptance of Terms
By registering on our website, you agree to comply with and be bound by these terms and conditions. If you do not agree to these terms, please do not register or use our services.</p>

<p>2. Registration and Account Security

a. You must provide accurate and complete information during the registration process.

b. You are responsible for maintaining the security of your account credentials. Do not share your password and notify us immediately if you suspect any unauthorized access.</p>

<p>3. User Conduct

a. You agree not to engage in any activity that may disrupt or interfere with the proper functioning of the website.

b. Do not use the website for any unlawful or prohibited purpose.</p>

<p>4. Content Submission

a. You retain ownership of the content you submit, but you grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, adapt, publish, and display the content.

b. You are responsible for the content you submit, ensuring it does not violate any applicable laws or infringe on the rights of third parties.</p>

<p>5. Privacy

a. Our privacy policy governs the collection, use, and disclosure of personal information. By using our website, you agree to our privacy policy.</p>

<p>6. Termination

We reserve the right to terminate or suspend your account without notice for any violation of these terms and conditions.</p>

<p>7. Disclaimer of Warranties

a. The website is provided on an "as-is" and "as-available" basis. We make no warranties, expressed or implied, regarding the website's accuracy, completeness, reliability, or suitability for a particular purpose.

b. We do not guarantee uninterrupted, timely, secure, or error-free access to the website.</p>

<p>8. Limitation of Liability

To the fullest extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or in connection with your use of the website.</p>

<p>9. Changes to Terms

We reserve the right to modify or revise these terms and conditions at any time. Your continued use of the website after any changes constitutes acceptance of those changes.</p>

<p>10. Governing Law

These terms and conditions are governed by and construed in accordance with the laws of Misamis Occidental. Any disputes arising under or in connection with these terms shall be subject to the exclusive jurisdiction of the courts in Misamis Occidental.</p>
            </div>
        </div>
    </div>
</div>

  </main><!-- End #main -->

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

  <!-- Template Main JS File -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>

  <script>
    $(document).ready(function () {
        // Toggle password visibility for Password field
        $("#showPasswordToggle").click(function () {
            var passwordField = $("#inputPassword");
            var type = passwordField.attr("type") === "password" ? "text" : "password";
            passwordField.attr("type", type);
            $(this).find("i").toggleClass("bi-eye bi-eye-slash");
        });

        // Toggle password visibility for Confirm Password field
        $("#showConfirmPasswordToggle").click(function () {
            var confirmPasswordField = $("#inputPasswordConfirm");
            var type = confirmPasswordField.attr("type") === "password" ? "text" : "password";
            confirmPasswordField.attr("type", type);
            $(this).find("i").toggleClass("bi-eye bi-eye-slash");
        });
    });
</script>

  <script>
    function showTermsModal() {
        $('#termsModal').modal('show');
    }
</script>
  <!-- Custome JS -->
  <script>
    $(document).ready(function () {
        function validatePassword() {
            var password = $("#inputPassword").val();
            var confirmPassword = $("#inputPasswordConfirm").val();

            if (password !== confirmPassword) {
                $("#passwordMatchError").show();
            } else {
                $("#passwordMatchError").hide();
            }
        }

        function checkPasswordMatch() {
            validatePassword();

            // Use AJAX to send the password and confirm password to the server for validation
            $.ajax({
                type: "POST",
                url: "check_password.php", // Replace with the actual path to your server-side script
                data: {
                    password: $("#inputPassword").val(),
                    confirmPassword: $("#inputPasswordConfirm").val()
                },
                success: function (response) {
                    if (response === "false") {
                        $("#passwordMatchError").show();
                    } else {
                        $("#passwordMatchError").hide();
                    }
                  
                }
            });
        }
        // Attach the input event handler to both password fields
        $("#inputPassword, #inputPasswordConfirm").on("input", checkPasswordMatch);

        // Attach the change event handler to the terms and conditions checkbox
        $("#termsCheckbox").change(enableSubmitButton);

        // Initial validation on document load
        validatePassword();
    });
</script>


  <script>
    // Add event listener to the input field
    document.getElementById('phone').addEventListener('input', function (event) {
        // Remove non-numeric characters
        let phoneNumber = event.target.value.replace(/\D/g, '');

        // Check if the length is greater than 11, then trim to 11 digits
        if (phoneNumber.length > 11) {
            phoneNumber = phoneNumber.slice(0, 11);
        }

        // Format the phone number using regex
        phoneNumber = phoneNumber.replace(/^(\d{2})(\d{3})(\d{5})$/, '$1-$2-$3');

        // Set the formatted phone number back to the input field
        event.target.value = phoneNumber;
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