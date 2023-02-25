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
//error_reporting(0);


$Remain = 0;

if (isset($_POST['searchamount'])) {


    $MemberID = $_POST['MemberID'];
    $LoanID = $_POST['LoanID'];
    $AccNo = $_POST['AccountNo'];


    $sql13 =  "SELECT COUNT(*) as CountLoan FROM pass_loans WHERE LoanID= '$LoanID' AND AccNo= '$AccNo' AND MemberID= '$MemberID' ";
    $resultset13 = mysqli_query($conn, $sql13) or die("database error:" . mysqli_error($conn));
    $data13 = mysqli_fetch_assoc($resultset13);
    $CountLoan = $data13['CountLoan'];

    if ($CountLoan > 0) {
        $sql11 =  "SELECT SUM(Amount) as AmountPaid FROM loan_settlement WHERE LoanID= '$LoanID '";
        $resultset11 = mysqli_query($conn, $sql11) or die("database error:" . mysqli_error($conn));
        $data11 = mysqli_fetch_assoc($resultset11);
        $Payable = $data11['AmountPaid'];

        $sql12 = "SELECT * FROM pass_loans WHERE LoanID= '$LoanID '";
        $resultset12 = mysqli_query($conn, $sql12) or die("database error:" . mysqli_error($conn));
        $data12 = mysqli_fetch_assoc($resultset12);
        $TotalWithInterestamount = $data12['TotalWithInterest'];

        $Remain = $TotalWithInterestamount - $Payable;

        if ($Remain <= 0) {
            echo '<script>alert("No Remain Loan Settlement.")</script>';
            $Remain = 0;
        }
    } else {
        echo '<script>alert("Entered data mismatched")</script>';
    }
}


if (isset($_POST['createLoanSettlement'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $MemberID = $_POST['MemberID'];
        $LoanID = $_POST['LoanID'];
        $Amount = $_POST['Amount'];
        $AccNo = $_POST['AccountNo'];


        if ($Amount > 0) {
            $sql1 = "SELECT * FROM pass_loans WHERE LoanID= '$LoanID '";
            $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
            $data1 = mysqli_fetch_assoc($resultset1);

            $TotalWithInterest = $data1['TotalWithInterest'];
            $Interest = $data1['Interest'];
            $LoanDate = $data1['LoanDate'];
            $NoOfMonths = $data1['NoOfMonths'];


            $sql2 = "SELECT SUM(Amount) as AmountPaid FROM loan_settlement WHERE LoanID= '$LoanID '";
            $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));
            $data2 = mysqli_fetch_assoc($resultset2);
            $AmountPaid = $data2['AmountPaid'];

            $remainMonths = $NoOfMonths;
            $sql20 = "SELECT MAX(Settle_ID) as SettleID FROM loan_settlement WHERE LoanID= '$LoanID' AND AccNo= '$AccNo' AND member_ID= '$MemberID'";
            $resultset20 = mysqli_query($conn, $sql20) or die("database error:" . mysqli_error($conn));
            $data20 = mysqli_fetch_assoc($resultset20);
            $SettleID = $data20['SettleID'];

            $sql21 = "SELECT *  FROM loan_settlement WHERE Settle_ID= '$SettleID '";
            $resultset21 = mysqli_query($conn, $sql21) or die("database error:" . mysqli_error($conn));
            $data21 = mysqli_fetch_assoc($resultset21);
            $PaymentDueDate= $data21['CreatedDate'];

            //$PaymentDueDate = '1';

            $RemainAmount = $TotalWithInterest - $AmountPaid - $Amount;




            if (($Amount + $AmountPaid) >= $TotalWithInterest) {
                $Status = "Settled";
                $RemainAmount = 0;
                $sql = "insert into loan_settlement(member_ID,AccNo,LoanID,Amount,RemainAmount,RemainMonths,LastPaymentDate,Status) values('$MemberID','$AccNo','$LoanID','$Amount','$RemainAmount','$remainMonths','$PaymentDueDate','$Status')";


                $update = "UPDATE pass_loans SET PaidStatus='$Status' where LoanID='$LoanID'";
                $stmt1 = mysqli_prepare($conn, $update);
                mysqli_stmt_execute($stmt1);

                $update1 = "UPDATE loan_settlement SET Status='$Status' where LoanID='$LoanID'";
                $stmt2 = mysqli_prepare($conn, $update1);
                mysqli_stmt_execute($stmt2);

                $AddAmount = ($Amount + $AmountPaid) - $TotalWithInterest;

                if ($AddAmount != 0) {

                    $TransactionType = "Credit";

                    $sql3 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AccNo ' AND TransType='Credit'";
                    $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                    $data3 = mysqli_fetch_assoc($resultset3);
                    $TotalCreditAmount = $data3['TotalAmount'];

                    $sql4 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AccNo ' AND TransType='Debit'";
                    $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));
                    $data4 = mysqli_fetch_assoc($resultset4);
                    $TotalDebitAmount = $data4['TotalAmount'];

                    $RunningBal = $TotalCreditAmount - $TotalDebitAmount;
                    $NewBalance = $RunningBal + $AddAmount;

                    $Description = "Loan ID $LoanID Settle Amount";
                    $NIC = "";
                    $Name = "";

                    $sql3 = "insert into member_transactions(MemberID,AccNo,TransType,Amount,RunningBal,Description,NIC,FullName) values('$MemberID','$AccNo','$TransactionType','$AddAmount','$NewBalance','$Description','$NIC','$Name')";
                    $stmt3 = mysqli_prepare($conn, $sql3);
                    mysqli_stmt_execute($stmt3);

                    $check1 = mysqli_stmt_affected_rows($stmt3);
                    if ($check1 == 1) {
                        echo '<script>alert("Additional Transaction Successfully completed")</script>';
                    } else {
                        echo '<script>alert("Data insert error.Try again.")</script>';
                    }
                }
            } else {
                $Status = "Pending";
                $sql = "insert into loan_settlement(member_ID,AccNo,LoanID,Amount,RemainAmount,RemainMonths,LastPaymentDate,Status) values('$MemberID','$AccNo','$LoanID','$Amount','$RemainAmount','$remainMonths','$PaymentDueDate','$Status')";
            }

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_execute($stmt);

            $check = mysqli_stmt_affected_rows($stmt);
            if ($check == 1) {
                echo '<script>alert("Loan Transaction Successfully completed")</script>';
            } else {
                echo '<script>alert("Data insert error.Try again.")</script>';
            }
        }else{
            echo '<script>alert("Invalid amount.")</script>';

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
            <?php
            include_once("Componants/NavBar.php");
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Loan Settlement</h3>

                                    <hr>
                                    <form class="form-sample" action="" id="LoanSettle" method="POST" target="_parent">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Member ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="MemberID" value="<?php echo isset($_POST['MemberID']) ? $_POST['MemberID'] : '' ?>" required />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Account No</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="AccountNo" value="<?php echo isset($_POST['AccountNo']) ? $_POST['AccountNo'] : '' ?>" required />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Loan ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="LoanID" value="<?php echo isset($_POST['LoanID']) ? $_POST['LoanID'] : '' ?>" required />

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <button type="submit" class="btn btn-primary mr-2" name="searchamount">Search Loan Payable Amount</button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Amount</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="Amount" value="<?php echo $Remain; ?>" />

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success mr-2" name="createLoanSettlement" onclick="return confirm('Do you confirm this transaction?')">Make Transaction</button>



                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Loan Settlements</h4><Br>
                                    <div class="table-responsive pt-3">
                                        <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">


                                                        <label class="col-sm-3 col-form-label">Loan No</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input type="text" class="form-control" name="accNo" id="accNo" value="<?php echo isset($_POST['accNo']) ? $_POST['accNo'] : '' ?>" />
                                                                </div>
                                                                <div class="col-md-auto">
                                                                    <button type="" name="searchaccount" class="btn btn-primary mr-2">Proceed</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Settlement ID
                                                    </th>
                                                    <th>
                                                        Date
                                                    </th>
                                                    <th>
                                                        Member ID
                                                    </th>
                                                    <th>
                                                        Account No
                                                    </th>
                                                    <th>
                                                        Loan Transaction Amount
                                                    </th>
                                                    <th>
                                                        Remain Balance
                                                    </th>
                                                    <th>
                                                        Remain Months
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php


                                                if (isset($_POST['searchaccount'])) {

                                                    $accNo = $_POST['accNo'];
                                                    $sql = "SELECT * FROM loan_settlement where LoanID='$accNo'";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                    $k = 0;
                                                    while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $record['Settle_ID']; ?>

                                                            </td>
                                                            <td>
                                                                <?php echo $record['CreatedDate']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['member_ID']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['AccNo']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['Amount']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['RemainAmount']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['RemainMonths']; ?>
                                                            </td>


                                                        </tr>
                                                <?php
                                                    }
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