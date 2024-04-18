<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPTCHA Validation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(../assets-landingpage/img/y.jpg);
            background-size: cover;
            position: relative;
            border-radius: 0;
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

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 600px;
            background-color: #fff;
        }

        #logo-container {
            text-align: center;
            margin-bottom: 20px;
            margin-top: -20px;
            /* Added margin-top */
        }

        #logo-image {
            width: 100px;
            height: auto;
        }

        #captcha-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        #captcha-text {
            font-size: 24px;
            font-weight: bold;
            line-height: 50px;
            /* Adjusted line height */
            border: 1px solid #007bff;
            /* Added border */
            border-radius: 8px;
            /* Added border-radius */
            padding: 10px;
            /* Added padding */
            width: 150px;
            /* Fixed width */
            text-align: center;
            /* Center text */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border: 1px solid #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card text-center">
            <div id="logo-container">
                <img id="logo-image" src="../assets-landingpage/img/logopic.png" alt="Logo"> <!-- Replace with your logo URL -->
            </div>
            <h2><i class="fas fa-shield-alt"></i> Human Verification</h2>
            <p class="mb-5">Please complete the CAPTCHA below to prove you're human.</p>
            <div id="captcha-container">
                <span id="captcha-text"></span>
                <button class="btn btn-secondary" onclick="generateCaptcha()"><i class="fas fa-sync-alt"></i> Refresh CAPTCHA</button>
            </div>
            <div class="form-group">
                <label for="captchaSolution">Enter CAPTCHA Solution:</label>
                <input type="text" class="form-control" id="captchaSolution" placeholder="Enter the characters above" required>
            </div>
            <button type="button" class="btn btn-primary btn-block" onclick="validateCaptcha()"><i class="fas fa-check"></i> Submit</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function generateCaptcha() {
            var captchaCode = generateRandomCode();
            document.getElementById('captcha-text').innerText = captchaCode;
            document.getElementById('captchaSolution').value = ''; // Clear previous solution
        }

        function generateRandomCode() {
            var length = 6;
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var result = '';
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        function validateCaptcha() {
            var userSolution = document.getElementById('captchaSolution').value;
            var captchaText = document.getElementById('captcha-text').innerText;

            if (userSolution.toUpperCase() === captchaText.toUpperCase()) {
                alert('CAPTCHA validation successful. Redirecting...');
                setTimeout(function() {
                    // Redirect to the success page
                    window.location.href = '../landingpage/regtutor.php';
                }, 2000); // 2000 milliseconds (2 seconds)
            } else {
                alert('CAPTCHA validation failed. Please try again.');
            }
        }

        // Initial CAPTCHA generation
        generateCaptcha();
    </script>
</body>

</html>