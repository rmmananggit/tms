<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets-landingpage/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets-landingpage/css/style-landingpage.css">
    <link rel="stylesheet" href="./assets-landingpage/bootstrap/fontawesome/css/all.css">

    <link rel="stylesheet" href="./assets-landingpage/bootstrap/boxicons-master/boxicons.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Contact Us |</title>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding:15px;padding-bottom:6px;padding-top:6px;">
      <a class="navbar-brand" style="padding-left:30px;font-weight:700;letter-spacing:1px;" href="../Capstone_projects/landing.php"><img src="./assets-landingpage/img/logopic.png" style="width:50px;height:50px;" alt="Logo">Tutoring System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto" style="gap:30px;padding-right:100px;">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.php">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="team.php">Team</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>

      </div>
    </nav>
  </header>

    <div class="container-fluid contact-section">
        <div class="container">
            <h2 class="contact-heading">Contact Us <i class="fas fa-phone-square"></i></h2>

            <div class="contact-content mb-4">
                <p class="contact-description">Have a question or need assistance? Feel free to reach out to us.</p>
            </div>


            <div class="row mt-5">

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bx bx-location-plus"></i>
                            <h4>Location:</h4>
                            <p>Poblacion, Sinacaban Misamis Occidental 7203</p>
                        </div>

                        <div class="email">
                            <i class="bx bxs-envelope"></i>
                            <h4>Email:</h4>
                            <p>dominickoauman@gmail.com</p>
                        </div>

                        <div class="phone">
                            <i class="bx bx-phone"></i>
                            <h4>Call:</h4>
                            <p>09383926312</p>
                        </div>

                    </div>

                </div>

                <div class="col-lg-8 mt-lg-0">

                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>

                </div>

            </div>

        </div>
    </div>

    <footer>
        <!-- Your footer content goes here -->
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
</body>

</html>