<!DOCTYPE html>
<html lang="en">

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
</head>

<?php
include_once("db_connect.php");
?>

<?php

session_start();
if ($_SESSION['use']) {
} else {
    header("Location:index.php");
}

?>

<?php
error_reporting(0);


$loanID = $_GET['id'];


?>


<body>
    <div class="container-scroller">
        <?php
        include_once("Componants/TopNavBar.php");
        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <?php
            include_once("Componants/NavBar.php");
            ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">



                    <?php


                    $sql = "SELECT * FROM member_donation where DonationID='$loanID'";
                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                    $record = mysqli_fetch_assoc($resultset);
                    $memID = $record['MemberID'];


                    $sql1 = "SELECT * FROM member where member_id='$memID'";
                    $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));

                    $sql2 = "SELECT * FROM member_account where memberID='$memID'";
                    $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));

                    $sql3 = "SELECT * FROM pass_donations where MemberID='$memID'";
                    $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));


                    $sql4 = "SELECT * FROM member_transactions where MemberID='$memID'";
                    $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));
                    ?>



                    <center>
                        <h3 style="font-weight: bold;">View Donation Profile</h4>
                    </center>
                    <br>
                    <br>
                    <div class="row ">
                        <div class="col-md-7 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="images\faces\avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <?php while ($record1 = mysqli_fetch_assoc($resultset1)) {
                                            ?>
                                                <h4><?php echo $record1['first_name']; ?> <?php echo $record1['last_name']; ?></h4>
                                                <p class="text-muted font-size-sm"><?php echo $record1['nic']; ?></p>
                                                <hr>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                    <h5 style="color:green ;">Accounts</h6>
                                        <table style="width: 100%;" border="1">
                                            <tr>
                                                <th>Acc No</th>
                                                <th>Acc Type</th>
                                                <th>Opening Balance</th>
                                            </tr>
                                            <?php while ($record2 = mysqli_fetch_assoc($resultset2)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $record2['account_no']; ?></td>
                                                    <td><?php echo $record2['AccType']; ?></td>
                                                    <td>LKR <?php echo $record2['TransAmount']; ?></td>
                                                </tr>
                                            <?php }  ?>

                                        </table>
                                        <hr>
                                        <h5 style="color:green ;">Recent Transactions</h6>
                                            <table style="width: 100%;" border="1">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>CR/DE</th>
                                                    <th>Amount</th>
                                                </tr>
                                                <?php while ($record4 = mysqli_fetch_assoc($resultset4)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $record4['TransactionDate']; ?></td>
                                                        <td><?php echo $record4['TransType']; ?></td>
                                                        <td>LKR <?php echo $record4['Amount']; ?></td>
                                                    </tr>
                                                <?php }  ?>

                                            </table>
                                            <hr>

                                </div>
                            </div>


                        </div>






                        <div class="col-md-5">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Donation ID</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['DonationID']; ?>
                                                <input type="text" name="LoanID" value=" <?php echo $record['DonationID']; ?>" hidden>
                                                <input type="text" name="MemberID" value=" <?php echo $record['MemberID']; ?>" hidden>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Account No</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['AccNo']; ?>
                                                <input type="text" name="AccountNo" value=" <?php echo $record['AccNo']; ?>" hidden>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Donation Type</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['DonationType']; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Description</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['Description']; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Dependant Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['DepName']; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Donation Amount</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['DonationAmount']; ?>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Created Date</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['CreatedDate']; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Donation Status</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">




                                                <?php
                                                if ($record['Status'] == "Pending") {
                                                ?>
                                                    <label class="badge badge-danger"> <?php echo $record['Status']; ?> </label>
                                                <?php } else if ($record['Status'] == "Sent BOD") {   ?>
                                                    <label class="badge badge-warning"> <?php echo $record['Status']; ?> </label>
                                                <?php } else { ?>
                                                    <label class="badge badge-success"> <?php echo $record['Status']; ?> </label>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>



                    </div>

                    <hr>


                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">View Passed Donations</h4>




                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Pass ID
                                                </th>
                                                <th>
                                                    Donation ID
                                                </th>
                                                <th>
                                                    Account No
                                                </th>
                                                <th>
                                                    Description
                                                </th>
                                                <th>
                                                    Donation Amount
                                                </th>
                                                <th>
                                                    Donation Date
                                                </th>

                                                <th>
                                                    Created Date
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM pass_donations where MemberID='$memID'";
                                            $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                            $k = 0;
                                            while ($record = mysqli_fetch_assoc($resultset)) {
                                            ?>
                                                <tr>
                                                    <td class="py-1">
                                                        <?php echo $record['PassID']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $record['DonationID']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['AccNo']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['Description']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['DonationAmount']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['DonationDate']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['CreatedDate']; ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>


        </div>
    </div>
    </div>



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