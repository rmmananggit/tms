<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../assets-landingpage/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets-landingpage/css/style-landingpage.css">
    <link rel="stylesheet" href="../assets-landingpage/bootstrap/fontawesome/css/all.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <title>Login Page</title>

    <style>
        body {
            background-color: #f8f9fa;
            background-image: url(../assets-landingpage/img/y.jpg);
            background-size: cover;
            position: relative;
            border-radius: 0;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        html:before {
            content: "";
            background: rgba(0, 0, 0, 0.40);
            position: absolute;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #fff;
            color: #000;
        }

        .center-logo {
            text-align: center;
        }

        .logo {
            max-width: 100px;
            max-height: 100px;
        }

        .form-group {
            position: relative;
        }

        .forgot-password {
            text-align: right;
        }

        .title h2 {
            text-align: center;
            margin-top: 50px;
            font-weight: 900;
            font-size: 3rem;
        }

        .password-toggle-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            opacity: 0;
            /* Initially hide the icon */
            transition: opacity 0.3s ease;
            /* Add a transition for smooth effect */
        }

        .password-toggle-icon.visible {
            opacity: 1;
            /* Show the icon when it has the 'visible' class */
        }
    </style>
</head>
<?php session_start(); ?>
<body>

    <div class="title text-white">
        <h2 class="text-danger">TEACH ME SENSEI: <span class="text-light">Tutoring System</span></h2>
    </div>

    <div class="container">
        <div class="login-container">
            <div class="center-logo">
                <img src="../assets-landingpage/img/logopic.png" alt="Logo" class="logo">
            </div>

            <form action="login_tutor.php" method="POST" autocomplete="off" novalidate>
                <div class="form-group">
                    <label for="username">Email Address</label>
                    <input type="text" class="form-control" id="username" name="email" placeholder="Enter your username" required>
                    <div class="invalid-feedback">Email Address is required.</div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="fas fa-eye" id="show_eye"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="invalid-feedback">Password is required.</div>
                </div>

                <div class="form-group">
                    <div class="forgot-password">
                        <a href="tutor_forgot.php">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block" name="login" onclick="validateForm()">Sign In</button>

                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="tutor_register.php">Create an account</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

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

    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function validateForm() {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');

            if (usernameInput.value.trim() === '') {
                usernameInput.classList.add('is-invalid');
                usernameInput.classList.remove('is-valid');
            } else {
                usernameInput.classList.remove('is-invalid');
                usernameInput.classList.add('is-valid');
            }

            if (passwordInput.value.trim() === '') {
                passwordInput.classList.add('is-invalid');
                passwordInput.classList.remove('is-valid');
            } else {
                passwordInput.classList.remove('is-invalid');
                passwordInput.classList.add('is-valid');
            }
        }
    </script>
</body>

</html>
