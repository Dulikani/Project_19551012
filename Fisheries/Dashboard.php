<!DOCTYPE html>
<html lang="en">
<?php
include_once("db_connect.php");
session_start();
error_reporting(0);
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Fisheries Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

  <style>
    .mySlides {
      display: none;
    }

    img {
      vertical-align: middle;
    }

    /* Slideshow container */
    .slideshow-container {
      max-width: 1000px;
      position: relative;
      margin: auto;
    }

    /* Caption text */
    .text {
      color: #f2f2f2;
      font-size: 15px;
      padding: 8px 12px;
      position: absolute;
      bottom: 8px;
      width: 100%;
      text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.6s ease;
    }

    .active {
      background-color: #717171;
    }

    /* Fading animation */
    .fade {
      animation-name: fade;
      animation-duration: 5s;
    }

    @keyframes fade {
      from {
        opacity: .2
      }

      to {
        opacity: 1
      }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
      .text {
        font-size: 11px
      }
    }
  </style>



  <?php
  if ($_SESSION['use']) {
  } else {
    header("Location:index.php");
  }

  ?>
</head>

<body>

  <div class="container-scroller">

    <?php
    include_once("Componants/TopNavBar.php");
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->


      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->

      <?php
      include_once("Componants/NavBar.php");
      ?>




      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">


                  <?php
                  $userType = $_SESSION['prev'];

                  if ($userType == "Admin") {
                  ?>

                    <h3 class="font-weight-bold">Hi Admin..Welcome Fisheries Co-Operative Society.</h3>
                  <?php

                  } elseif ($userType == "BOD") {
                  ?> <h3 class="font-weight-bold">Hi Board Of Director..Welcome Fisheries Co-Operative Society.</h3>
                  <?php
                  } elseif ($userType == "Banking") {
                  ?> <h3 class="font-weight-bold">Hi Bank Manager..Welcome Fisheries Co-Operative Society.</h3>
                  <?php
                  }


                  ?>

                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! </h6>
                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">

                      <h5 id="TDate"></h5>
                      <script>
                        const d = new Date();
                        document.getElementById("TDate").innerHTML = "Today :  " + d;
                      </script>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="slideshow-container">

                <div class="mySlides fade">
                  <div class="numbertext">1 / 3</div>
                  <img src="images/dashboard/slide1.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                  <div class="numbertext">2 / 3</div>
                  <img src="images/dashboard/slide2.jpg" style="width:100%">
                </div>

                <div class="mySlides fade">
                  <div class="numbertext">3 / 3</div>
                  <img src="images/dashboard/slide3.jpg" style="width:100%">
                </div>

              </div>
              <br>



              <script>
                let slideIndex = 0;
                showSlides();

                function showSlides() {
                  let i;
                  let slides = document.getElementsByClassName("mySlides");
                  for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                  }
                  slideIndex++;
                  if (slideIndex > slides.length) {
                    slideIndex = 1;
                  }

                  slides[slideIndex - 1].style.display = "block";
                  setTimeout(showSlides, 5000); // Change image every 4 seconds
                }
              </script>

            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale" style="background-color: #165168;">
                    <div class="card-body">
                      <p class="mb-4">Member Count</p>
                      <?php
                      $sql7 = "SELECT COUNT(member_id) as memCount FROM member ";
                      $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                      $record7 = mysqli_fetch_assoc($resultset7);
                      $memCount = $record7['memCount'];

                      ?>

                      <p class="fs-30 mb-2"><?php echo $memCount; ?></p>

                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue" style="background-color: #165168;">
                    <div class="card-body">
                      <p class="mb-4">Total Member Transactions</p>
                      <?php
                      $sql7 = "SELECT COUNT(TransactionID) as TranCount FROM member_transactions ";
                      $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                      $record7 = mysqli_fetch_assoc($resultset7);
                      $TranCount = $record7['TranCount'];

                      ?>

                      <p class="fs-30 mb-2"><?php echo $TranCount; ?></p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue" style="background-color: #165168;">
                    <div class="card-body">
                      <p class="mb-4">Total Pending Loans for Bank Manager Approval</p>

                      <?php
                      $sql7 = "SELECT COUNT(ApprovalID) as PendingLoanCount FROM approval_loans where Status='BOD Approved'";
                      $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                      $record7 = mysqli_fetch_assoc($resultset7);
                      $PendingLoanCount = $record7['PendingLoanCount'];
                      if ($PendingLoanCount > 0) { ?>
                        <p class="fs-30 mb-2" style="color: red;"><?php echo $PendingLoanCount; ?></p>
                      <?php
                      } else { ?>
                        <p class="fs-30 mb-2"><?php echo $PendingLoanCount; ?></p>
                      <?php } ?>





                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger" style="background-color: #165168;">
                    <div class="card-body">
                      <p class="mb-4">Total Pending Donations for Bank Manager Approval</p>
                      <?php
                      $sql7 = "SELECT COUNT(ApprovalID) as PendingDonationsCount FROM approval_donations where Status='BOD Approved'";
                      $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                      $record7 = mysqli_fetch_assoc($resultset7);
                      $PendingDonationsCount = $record7['PendingDonationsCount'];

                      if ($PendingDonationsCount > 0) { ?>
                        <p class="fs-30 mb-2" style="color: red;"><?php echo $PendingDonationsCount; ?></p>
                      <?php
                      } else { ?>
                        <p class="fs-30 mb-2"><?php echo $PendingDonationsCount; ?></p>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Loan Details</p>
                  <?php
                  $sql7 = "SELECT COUNT(PassID) as PassIDCount FROM pass_loans ";
                  $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                  $record7 = mysqli_fetch_assoc($resultset7);
                  $PassIDCount = $record7['PassIDCount'];

                  $sql7 = "SELECT SUM(LoanAmount) as LoanAmount FROM pass_loans ";
                  $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                  $record7 = mysqli_fetch_assoc($resultset7);
                  $LoanAmount = $record7['LoanAmount'];

                  $sql7 = "SELECT COUNT(PassID) as MemCount FROM pass_loans GROUP BY MemberID";
                  $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                  $record7 = mysqli_fetch_assoc($resultset7);
                  $MemCount = $record7['MemCount'];
                  ?>
                  <p class="font-weight-500">Loan applications are approved by the BOD of the society and passed by Bank Manager</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Total Loans Passed</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $PassIDCount; ?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Pending Loans</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $PendingLoanCount; ?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Provided Loan Amount</p>
                      <h3 class="text-primary fs-30 font-weight-medium">LKR <?php echo $LoanAmount; ?></h3>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Donation Details</p>
                  <?php
                  $sql7 = "SELECT COUNT(PassID) as PassIDCount FROM pass_donations ";
                  $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                  $record7 = mysqli_fetch_assoc($resultset7);
                  $PassIDCount = $record7['PassIDCount'];

                  $sql7 = "SELECT SUM(DonationAmount) as DonationAmount FROM pass_donations ";
                  $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                  $record7 = mysqli_fetch_assoc($resultset7);
                  $DonationAmount = $record7['DonationAmount'];

                  $sql7 = "SELECT COUNT(PassID) as MemCount FROM pass_donations GROUP BY MemberID";
                  $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                  $record7 = mysqli_fetch_assoc($resultset7);
                  $MemCount = $record7['MemCount'];
                  ?>

                  <p class="font-weight-500">Donation applications are approved by the BOD and passed by Bank Manager</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Total Donations Passed</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $PassIDCount; ?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Pending Donation</p>
                      <h3 class="text-primary fs-30 font-weight-medium"><?php echo $PendingDonationsCount; ?></h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Provided Donation Amount</p>
                      <h3 class="text-primary fs-30 font-weight-medium">LKR <?php echo $DonationAmount; ?></h3>
                    </div>

                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer" style="background-color: #165168 ;color:azure">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              <p style="color:#f2f2f2;">Copyright © 2022. By <a href="" target="_blank" style="color:#f2f2f2;">Poornima Wijesundara</a> . All rights reserved.</p>
            </span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>