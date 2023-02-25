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


if (isset($_POST['approve'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $DonationID = $_POST['LoanID'];
        $AccountNo = $_POST['AccountNo'];
        $LoanType = $_POST['LoanType'];
        $LoanAmount = $_POST['LoanAmount'];
        $CreatedDate = $_POST['CreatedDate'];
        $MemberID = $_POST['MemberID'];
        $ApprovedBy = $_SESSION['use'];
        $Status = "BOD Approved";


        $sql = "insert into approval_donations(DonationID,MemberID,AccNo,DonationType,Amount,CreatedDate,ApprovalBy,Status) values('$DonationID','$MemberID','$AccountNo','$LoanType','$LoanAmount','$CreatedDate','$ApprovedBy' ,'$Status')";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if ($check == 1) {
            $msg = 'Data Successfullly UPloaded';

            $update = "UPDATE member_donation SET Status='BOD Approved' where DonationID='$DonationID'";
            $stmt1 = mysqli_prepare($conn, $update);


            mysqli_stmt_execute($stmt1);

            $check1 = mysqli_stmt_affected_rows($stmt1);
            if ($check1 == 1) {
                $msg1 = 'Data Successfullly UPloaded';
                header("Location:PendingDonations.php");
            } else {
                $msg1 = 'Error uploading Data';
            }
        } else {
            $msg = 'Error uploading Data';
        }
    }
}


if (isset($_POST['reject'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $DonationID = $_POST['LoanID'];
        $AccountNo = $_POST['AccountNo'];
        $LoanType = $_POST['LoanType'];
        $LoanAmount = $_POST['LoanAmount'];
        $CreatedDate = $_POST['CreatedDate'];
        $MemberID = $_POST['MemberID'];
        $ApprovedBy = "1";
        $Status = "BOD Rejected";


        $sql = "insert into approval_donations(DonationID,MemberID,AccNo,DonationType,Amount,CreatedDate,ApprovalBy,Status) values('$DonationID','$MemberID','$AccountNo','$LoanType','$LoanAmount','$CreatedDate','$ApprovedBy' ,'$Status')";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if ($check == 1) {
            $msg = 'Data Successfullly UPloaded';

            $update = "UPDATE member_donation SET Status='BOD Rejected' where DonationID='$DonationID'";
            $stmt1 = mysqli_prepare($conn, $update);


            mysqli_stmt_execute($stmt1);

            $check1 = mysqli_stmt_affected_rows($stmt1);
            if ($check1 == 1) {
                $msg1 = 'Data Successfullly UPloaded';
                header("Location:PendingDonations.php");
            } else {
                $msg1 = 'Error uploading Data';
            }
        } else {
            $msg = 'Error uploading Data';
        }
    }
}
?>


<body>
    <div class="container-scroller">
        <?php
        include_once("Componants/TopNavBar.php");
        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">


            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
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

                    $sql3 = "SELECT * FROM approval_loans where MemberID='$memID'";
                    $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));


                    $sql4 = "SELECT * FROM member_transactions where MemberID='$memID'";
                    $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));

                    $sql5 = "SELECT * FROM approval_donations where MemberID='$memID'";
                    $resultset5 = mysqli_query($conn, $sql5) or die("database error:" . mysqli_error($conn));

                    ?>



                    <center>
                        <h3 style="font-weight: bold;">Donation Approval</h4>
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
                                                <p class="text-secondary mb-1">TP : <?php echo $record1['contact_no']; ?></p>
                                                <p class="text-muted font-size-sm">NIC : <?php echo $record1['nic']; ?></p>
                                                <hr>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0" style="color:red;">Available Bank Balance</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php

                                            $sql7 = "SELECT SUM(Amount) as SumCredit FROM bank_transactions where TransType='Credit'";
                                            $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
                                            $record7 = mysqli_fetch_assoc($resultset7);
                                            $SumCredit = $record7['SumCredit'];

                                            $sql8 = "SELECT SUM(Amount) as SumDebit FROM bank_transactions where TransType='Debit'";
                                            $resultset8 = mysqli_query($conn, $sql8) or die("database error:" . mysqli_error($conn));
                                            $record8 = mysqli_fetch_assoc($resultset8);
                                            $SumDebit = $record8['SumDebit'];

                                            $RunningBal = $SumCredit - $SumDebit;

                                            ?>
                                            <span class="text" style="color: red;"> <b>LKR <?php echo $RunningBal; ?></b></span>
                                            <hr>
                                        </div>
                                    </div>




                                    <h5 style="color:green ;">Accounts</h6>
                                        <table style="width: 100%;" border="1">
                                            <tr>
                                                <th>Acc No</th>
                                                <th>Acc Type</th>
                                                <th>Amount</th>
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
                                            <h5 style="color:green ;">Previous Loans</h6>
                                                <table style="width: 100%;" border="1">
                                                    <tr>
                                                        <th>Loan Date</th>
                                                        <th>Type</th>
                                                        <th> Amount</th>
                                                        <th>Due Date</th>

                                                    </tr>
                                                    <?php while ($record3 = mysqli_fetch_assoc($resultset3)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $record3['ApprovalDate']; ?></td>
                                                            <td><?php echo $record3['LoanType']; ?></td>
                                                            <td>LKR <?php echo $record3['Amount']; ?></td>
                                                            <td> <?php echo $record3['ApprovalDate']; ?></td>

                                                        </tr>
                                                    <?php }  ?>

                                                </table>
                                                <hr>
                                                <h5 style="color:green ;">Previous Donations</h6>
                                                    <table style="width: 100%;" border="1">
                                                        <tr>
                                                            <th>Donation Date</th>
                                                            <th>Dependant Name</th>
                                                            <th>Description</th>
                                                            <th> Status</th>


                                                        </tr>
                                                        <?php while ($record5 = mysqli_fetch_assoc($resultset5)) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $record5['ApprovalDate']; ?></td>
                                                                <td><?php echo $record5['DonationType']; ?></td>
                                                                <td>LKR <?php echo $record5['Amount']; ?></td>
                                                                <td> <?php echo $record5['Status']; ?></td>

                                                            </tr>
                                                        <?php }  ?>

                                                    </table>
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
                                                <input type="text" name="LoanType" value=" <?php echo $record['DonationType']; ?>" hidden>
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
                                                <input type="text" name="LoanAmount" value=" <?php echo $record['DonationAmount']; ?>" hidden>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Created Date</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['CreatedDate']; ?>
                                                <input type="text" name="CreatedDate" value=" <?php echo $record['CreatedDate']; ?>" hidden>
                                            </div>
                                        </div>


                                        <hr>
                                        <div class="row">
                                            <div class="col col-lg-4">
                                                <button type="submit" class="btn btn-success" name="approve">Approve Donation</button>
                                            </div>
                                            <div class="col col-lg-4">
                                                <button type="submit" class="btn btn-danger" name="reject">Reject Donation</button>
                                            </div>

                                        </div>

                                    </form>
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