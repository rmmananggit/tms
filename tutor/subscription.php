<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../websitepage/landingpage/assets-landingpage/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../websitepage/landingpage/assets-landingpage/css/style-landingpage.css">
    <link rel="stylesheet" href="../../websitepage/landingpage/assets-landingpage/bootstrap/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Add Payment</title>
    <style>
        body {

            background-image: url(../assets-landingpage/img/y.jpg);
            background-size: cover;
            position: relative;
            border-radius: 0;
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


        .container {
            margin-top: 50px;
        }

        .card-2 {
            border: none;
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: row;
            flex-direction: row;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
            height: 390px;
            padding-right: 9px;
        }

        .form-control {
            border-bottom: 2px solid #eee !important;
            border: none;
            font-weight: 600;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #8bbafe;
            outline: 0;
            box-shadow: none;
            border-radius: 0px;
            border-bottom: 2px solid blue !important;
        }

        .inputbox {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .inputbox span {
            position: absolute;
            top: 7px;
            left: 11px;
            transition: 0.5s;
        }

        .inputbox i {
            position: absolute;
            top: 13px;
            right: 8px;
            transition: 0.5s;
            color: #3F51B5;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .inputbox input:focus~span,
        .inputbox input:valid~span {
            transform: translateX(-0px) translateY(-15px);
            font-size: 12px;
        }

        .card-blue {
            background-color: #492bc4;
        }

        .hightlight {
            background-color: #5737d9;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 14px;
        }

        .yellow {
            color: #fdcc49;
        }

        .decoration,
        .btn-success,
        .btn-success:hover {
            color: #fff;
            background-color: #492bc4;
            border-color: #492bc4;
        }

        .decoration:hover {
            text-decoration: none;
            color: #fdcc49;
        }
    </style>
</head>
<?php session_start(); ?>
<body>
    <div class="container px-5">
        <div class="mb-2">
            <h2 style="font-weight:700;" class="text-light">Add <span class="text-danger">Payment</span></h2>
            <span class="text-light"><b>Please make the payment and wait for the administrator to approve the payment to use this system.</b></span>
        </div>

        <div class="row">
            <div class="col-md-8">
                <form action="process.php" method="POST" enctype="multipart/form-data" autocomplete="off" autocapitalize="on">
                    <div class="card p-4">
                        <h6 class="text-uppercase">Payment details</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="inputbox mt-3 mr-2">
                                    <input type="text" name="reference" class="form-control" required="required">
                                    <span>Reference Number</span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="border rounded">
                                    <select name="mop" required class="form-control">
                                        <option value="" disabled selected>Mode of Payment</option>
                                        <option value="Gcash">Gcash</option>
                                        <option value="Palawan Express">Palawan Express</option>
                                        <option value="PNB">PNB</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <span class="mb-2"><b>Select Subscription</b></span>
                            <div class="row mt-3">
                                <div class="col-md-8 d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="subscriptiontype" value="Monthly" id="monthlySubscription">
                                        <label class="form-check-label" for="monthlySubscription">Monthly
                                            (₱100/month)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="subscriptiontype" value="Yearly" id="yearlySubscription">
                                        <label class="form-check-label" for="yearlySubscription">Yearly
                                            (₱1,000/year)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <div class="col-xl-12">
                            <span for="formFile" class="form-label"><b>Receipt <small>(Select image file)</small></b></span>
                            <input class="form-control mt-3" type="file" name="receipt" id="formFile" accept="image/*">
                        </div>

                        <div class="mt-5 d-flex justify-content-end">
                            <button type="submit" name="submit_payment" class="btn btn-primary ml-3" style="width:150px;">Submit</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-2 text-center">
                <div class="col-md-12">
                    <div class="">
                        <h5 class="mb-5 mt-3">Where to send payment?</h5>
                        <div class="d-flex mb-5">
                            <span> <img src="./assets/img/gcash.png" width="60"></span>
                            <div class="ml-2">
                                <h6><b>Edrick Windell Carmelo</b></h6>
                                <h6><b>09123456789</b></h6>
                            </div>
                        </div>
                        <div class="d-flex mb-5">
                            <span> <img src="./assets/img/palawan1.png" width="60"></span>
                            <div class="ml-2">
                                <h6><b>Edrick Windell Carmelo</b></h6>
                                <h6><b>09123456789</b></h6>
                            </div>
                        </div>
                        <div class="d-flex mb-0">
                            <span> <img src="./assets/img/banktransfer.png" width="60"></span>
                            <div class="ml-2">
                                <h6><b>Edrick Windell Carmelo</b></h6>
                                <h6><b>413310115291</b></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
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
</html>