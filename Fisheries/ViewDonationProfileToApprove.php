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


if (isset($_POST['pass'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $DonationDate = $_POST['LoanDate'];
        $ApprovedBy = $_SESSION['use'];
        $transerType = "Debit";


        $sql6 = "SELECT * FROM member_donation where DonationID='$loanID'";
        $resultset6 = mysqli_query($conn, $sql6) or die("database error:" . mysqli_error($conn));
        $record6 = mysqli_fetch_assoc($resultset6);
        $memID = $record6['MemberID'];
        $accNo = $record6['AccNo'];
        $description = $record6['DonationType'];
        $DonationAmount = $record6['DonationAmount'];



        $sql7 = "SELECT SUM(Amount) as SumCredit FROM bank_transactions where TransType='Credit'";
        $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
        $record7 = mysqli_fetch_assoc($resultset7);
        $SumCredit = $record7['SumCredit'];

        $sql8 = "SELECT SUM(Amount) as SumDebit FROM bank_transactions where TransType='Debit'";
        $resultset8 = mysqli_query($conn, $sql8) or die("database error:" . mysqli_error($conn));
        $record8 = mysqli_fetch_assoc($resultset8);
        $SumDebit = $record8['SumDebit'];

        $RunningBal = $SumCredit - $SumDebit;


        if ($RunningBal > $DonationAmount) {
            $sql = "insert into pass_donations(DonationID,MemberID,AccNo,Description,DonationAmount,DonationDate,CreatedBy) values('$loanID','$memID','$accNo','$description','$DonationAmount','$DonationDate','$ApprovedBy')";
            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_execute($stmt);

            $check = mysqli_stmt_affected_rows($stmt);

            $msg = 'Data Successfullly UPloaded';

            $update = "UPDATE member_donation SET Status='Passed' where DonationID='$loanID'";
            $stmt1 = mysqli_prepare($conn, $update);
            mysqli_stmt_execute($stmt1);

            $update1 = "UPDATE approval_donations SET Status='Passed' where DonationID='$loanID'";
            $stmt2 = mysqli_prepare($conn, $update1);
            mysqli_stmt_execute($stmt2);

            $AfterRunningBal = $RunningBal - $DonationAmount;

            $sql10 = "insert into bank_transactions(AccNo,TransType,Amount,RunningBal,Description) values('$accNo','$transerType','$DonationAmount','$AfterRunningBal','$description')";
            $stmt10 = mysqli_prepare($conn, $sql10);
            mysqli_stmt_execute($stmt10);


            $transerTypeCR = "Credit";


            $SubDebitMem = 0;
            $SumCreditMem = 0;

            $sql12 = "SELECT SUM(Amount) as SumCreditAcc FROM member_transactions where TransType='Credit' AND AccNo='$accNo'";
            $resultset12 = mysqli_query($conn, $sql12) or die("database error:" . mysqli_error($conn));
            $record12 = mysqli_fetch_assoc($resultset12);
            $SumCreditMem = $record12['SumCreditAcc'];

            $sql13 = "SELECT SUM(Amount) as SumDebitAcc FROM member_transactions where TransType='Debit' AND AccNo='$accNo'";
            $resultset13 = mysqli_query($conn, $sql13) or die("database error:" . mysqli_error($conn));
            $record13 = mysqli_fetch_assoc($resultset13);
            $SubDebitMem = $record13['SumDebitAcc'];


            $MemAccBal = $SumCreditMem - $SubDebitMem;
            $RunningBalMem = $MemAccBal + $DonationAmount;
            $NIC = " ";
            $Name = "Fisheries Donation";

            $sql11 = "insert into member_transactions(MemberID,AccNo,TransType,Amount,RunningBal,Description,NIC,FullName) values('$memID','$accNo','$transerTypeCR','$DonationAmount','$RunningBalMem','$description','$NIC','$Name')";
            $stmt11 = mysqli_prepare($conn, $sql11);
            mysqli_stmt_execute($stmt11);

            echo '<script>alert("Successfully Passed Donation")</script>';
            header("Location:ViewDonationBank.php");
        } else {
            echo '<script>alert("Cannot Proceed Donation.Insufficient Bank Balance")</script>';
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

                    $sql5 = "SELECT * FROM approval_donations where DonationID='$loanID'";
                    $resultset5 = mysqli_query($conn, $sql5) or die("database error:" . mysqli_error($conn));
                    $record5 = mysqli_fetch_assoc($resultset5);
                    ?>



                    <center>
                        <h3 style="font-weight: bold;">Pass Donation Request</h4>
                    </center>
                    <br>
                    <br>
                    <div class="row ">
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="images\faces\avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <?php while ($record1 = mysqli_fetch_assoc($resultset1)) {
                                            ?>
                                                <h4><?php echo $record1['first_name']; ?> <?php echo $record1['last_name']; ?></h4>
                                                <!--<p class="text-secondary mb-1">Full Stack Developer</p>-->
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
                                </div>

                            </div>



                        </div>

                    </div>
                    <div class="row ">
                        <div class="col-md-5">

                            <div class="card mb-3">

                                <div class="card-body">
                                    <h4 style="color:green ;">Donation Details</h4><br>
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
                                                <h6 class="mb-0">Loan Status</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php
                                                if ($record5['Status'] == "Pending") {
                                                ?>
                                                    <label class="badge badge-danger"> <?php echo $record5['Status']; ?> </label>
                                                <?php } else if ($record5['Status'] == "BOD Approved") {   ?>
                                                    <label class="badge badge-warning"> <?php echo $record5['Status']; ?> </label>
                                                <?php } else { ?>
                                                    <label class="badge badge-success"> <?php echo $record5['Status']; ?> </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <br>

                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>



                        <div class="col-md-7">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4 style="color:green ;">Additional Details</h4><br>

                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Donation Date</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" id="Amount" name="Amount" value=" <?php echo $record['LoanAmount']; ?>" hidden />
                                                <input type="date" class="form-control" id="LoanDate" name="LoanDate" required />



                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col col-lg-12">
                                                <button type="submit" class="btn btn-success" name="pass" id="pass" style="width: 20%;float: right;">Pass Loan</button>
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