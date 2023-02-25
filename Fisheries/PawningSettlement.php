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

session_start();
if ($_SESSION['use']) {
} else {
    header("Location:index.php");
}

?>

<?php
include_once("db_connect.php");
?>
<?php
error_reporting(0);


$Remain = "";
$PawningCreatedDate = "YYYY-MM-DD";
$LastPaymentDate = "1st Payment";
$pawningamount = "";
$TotalPay = "";




if (isset($_POST['searchamount'])) {

    $LastPaymentDate = "1st Payment";

    $memberID = $_POST['memberID'];
    $pawningID = $_POST['pawningID'];
    $AccountNo = $_POST['AccountNo'];


    $sql13 =  "SELECT COUNT(*) as CountPawning FROM mem_pass_pawnings WHERE pawningID= '$pawningID' AND AccountNo= '$AccountNo' AND memberID= '$memberID' ";
    $resultset13 = mysqli_query($conn, $sql13) or die("database error:" . mysqli_error($conn));
    $data13 = mysqli_fetch_assoc($resultset13);
    $CountPawning = $data13['CountPawning'];

    if ($CountPawning > 0) {
        $sql11 =  "SELECT SUM(PayAmount) as AmountPaid FROM pawning_settlement WHERE pawningID= '$pawningID '";
        $resultset11 = mysqli_query($conn, $sql11) or die("database error:" . mysqli_error($conn));
        $data11 = mysqli_fetch_assoc($resultset11);
        $AmountPaid = $data11['AmountPaid'];

        $sql16 =  "SELECT SUM(TotalPay) as TotalPay FROM pawning_settlement WHERE pawningID= '$pawningID '";
        $resultset16 = mysqli_query($conn, $sql16) or die("database error:" . mysqli_error($conn));
        $data16 = mysqli_fetch_assoc($resultset16);
        $TotalPay = $data16['TotalPay'];


        $sql28 =  "SELECT SUM(InterestAmount) as InterestAmount FROM pawning_settlement WHERE pawningID= '$pawningID'";
        $resultset28 = mysqli_query($conn, $sql28) or die("database error:" . mysqli_error($conn));
        $data28 = mysqli_fetch_assoc($resultset28);
        $InterestAmountOnly = $data28['InterestAmount'];


        $sql13 =  "SELECT COUNT(PayAmount) as SettleCount FROM pawning_settlement WHERE pawningID= '$pawningID '";
        $resultset13 = mysqli_query($conn, $sql13) or die("database error:" . mysqli_error($conn));
        $data13 = mysqli_fetch_assoc($resultset13);
        $SettleCount = $data13['SettleCount'];


        $sql12 = "SELECT * FROM mem_pass_pawnings WHERE pawningID= '$pawningID '";
        $resultset12 = mysqli_query($conn, $sql12) or die("database error:" . mysqli_error($conn));
        $data12 = mysqli_fetch_assoc($resultset12);
        $pawningamount = $data12['pawningamount'];
        $PawningCreatedDate = $data12['PawningCreatedDate'];

        $sql14 =  "SELECT MAX(Settle_ID) as GetSettle_ID FROM pawning_settlement WHERE pawningID= '$pawningID '";
        $resultset14 = mysqli_query($conn, $sql14) or die("database error:" . mysqli_error($conn));
        $data14 = mysqli_fetch_assoc($resultset14);
        $MaxSettle_ID = $data14['GetSettle_ID'];

        $sql15 =  "SELECT * FROM pawning_settlement WHERE Settle_ID= '$MaxSettle_ID '";
        $resultset15 = mysqli_query($conn, $sql15) or die("database error:" . mysqli_error($conn));
        $data15 = mysqli_fetch_assoc($resultset15);
        $LastPaymentDate = $data15['PayDate'];
        $RemainAmount = $data15['RemainAmount'];


        $PaidAll = $TotalPay - $InterestAmountOnly;


        $Remain = $pawningamount - $PaidAll;


        if ($Remain <= 0) {
            echo '<script>alert("No Remain Pawning Settlement.")</script>';
            $Remain = 0;
        }
    } else {
        echo '<script>alert("Entered data mismatched")</script>';
    }
}


if (isset($_POST['createPawningSettlement'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $memberID = $_POST['memberID'];
        $pawningID = $_POST['pawningID'];
        $AccountNo = $_POST['AccountNo'];
        $PayAmount = $_POST['PayAmount'];
        $TotWithIntAmount = $_POST['TotWithIntAmount'];
        $remainingAmount = $_POST['remainingAmount'];
        $InterestAmount = $_POST['InterestAmount'];
        $payDate = $_POST['payDate'];
        $LastPaymentDate = $_POST['LastPaymentDate'];
        $SettleAmount = $_POST['SettleAmount'];
        $remainAmount = $_POST['remainAmount'];


        $lastSettlementAmount = $remainAmount + $InterestAmount;


        $sql27 =  "SELECT SUM(TotalPay) as TotalPay FROM pawning_settlement WHERE pawningID= '$pawningID'";
        $resultset27 = mysqli_query($conn, $sql27) or die("database error:" . mysqli_error($conn));
        $data27 = mysqli_fetch_assoc($resultset27);
        $TotalPaidWithInt = $data27['TotalPay'];

        $sql26 =  "SELECT SUM(InterestAmount) as InterestAmount FROM pawning_settlement WHERE pawningID= '$pawningID'";
        $resultset26 = mysqli_query($conn, $sql26) or die("database error:" . mysqli_error($conn));
        $data26 = mysqli_fetch_assoc($resultset26);
        $InterestAmountOnly = $data26['InterestAmount'];

        $sql23 = "SELECT * FROM mem_pass_pawnings WHERE pawningID= '$pawningID '";
        $resultset23 = mysqli_query($conn, $sql23) or die("database error:" . mysqli_error($conn));
        $data23 = mysqli_fetch_assoc($resultset23);
        $pawningamount = $data23['pawningamount'];

        $TotalPaidAmount = $TotalPaidWithInt - $InterestAmountOnly;


        if (($TotalPaidAmount + $SettleAmount) >= $pawningamount) {
            $Status = "Settled";
            $remainingAmount = 0;



            $update1 = "UPDATE pawning_settlement SET Status='$Status' where pawningID='$pawningID'";
            $stmt2 = mysqli_prepare($conn, $update1);
            mysqli_stmt_execute($stmt2);

            $AddAmount = ($TotalPaidAmount + $SettleAmount) - $pawningamount;

            if ($AddAmount != 0) {

                $sql = "insert into pawning_settlement(memberID,AccountNo,pawningID,PayAmount,InterestAmount,TotalPay,RemainAmount,PayDate,LastPaymentDate,Status) values('$memberID','$AccountNo','$pawningID','$PayAmount','$InterestAmount','$lastSettlementAmount','$remainingAmount','$payDate','$LastPaymentDate','$Status')";


                $TransactionType = "Credit";

                $sql3 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AccountNo ' AND TransType='Credit'";
                $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                $data3 = mysqli_fetch_assoc($resultset3);
                $TotalCreditAmount = $data3['TotalAmount'];

                $sql4 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AccountNo ' AND TransType='Debit'";
                $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));
                $data4 = mysqli_fetch_assoc($resultset4);
                $TotalDebitAmount = $data4['TotalAmount'];

                $RunningBal = $TotalCreditAmount - $TotalDebitAmount;
                $NewBalance = $RunningBal + $AddAmount;

                $Description = "Pawning ID $pawningID Settle Amount";
                $NIC = "";
                $Name = "";

                $sql3 = "insert into member_transactions(MemberID,AccNo,TransType,Amount,RunningBal,Description,NIC,FullName) values('$memberID','$AccountNo','$TransactionType','$AddAmount','$NewBalance','$Description','$NIC','$Name')";
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
            $sql = "insert into pawning_settlement(memberID,AccountNo,pawningID,PayAmount,InterestAmount,TotalPay,RemainAmount,PayDate,LastPaymentDate,Status) values('$memberID','$AccountNo','$pawningID','$PayAmount','$InterestAmount','$TotWithIntAmount','$remainingAmount','$payDate','$LastPaymentDate','$Status')";
        //}

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if ($check == 1) {
            echo '<script>alert("Pawning Transaction Successfully completed")</script>';
        } else {
            echo '<script>alert("Data insert error.Try again.")</script>';
        }
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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Pawning Settlement</h3>

                                    <hr>
                                    <form class="form-sample" action="" id="LoanSettle" method="POST" target="_parent">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Member ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="memberID" value="<?php echo isset($_POST['memberID']) ? $_POST['memberID'] : '' ?>" required />
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
                                                    <label class="col-sm-3 col-form-label">Pawning ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="pawningID" value="<?php echo isset($_POST['pawningID']) ? $_POST['pawningID'] : '' ?>" required />

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
                                                                <button type="submit" class="btn btn-primary mr-2" name="searchamount">Search Pawning</button>

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
                                                                <input type="text" class="form-control" name="PayAmount" id="Amount" value="<?php echo $pawningamount; ?>" readonly required />

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Pawning Created Date</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="PawningCreatedDate" id="PawningCreatedDate" value="<?php echo $PawningCreatedDate; ?>" readonly required />

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
                                                    <label class="col-sm-3 col-form-label">Paid Amount with Interest</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="TotWithIntAmount" id="Amount" value="<?php echo $TotalPay; ?>" readonly required />

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Remain Amount</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="remainAmount" id="remainAmount" value="<?php echo $Remain; ?>" readonly required />

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
                                                    <label class="col-sm-3 col-form-label">Settle Amount</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="SettleAmount" id="SettleAmount" value="" />
                                                                <input type="text" class="form-control" name="SettleCount" id="SettleCount" value="<?php echo $SettleCount; ?>" hidden />
                                                                <input type="text" class="form-control" name="InterestAmount" id="InterestAmount" value="" hidden />
                                                                <input type="text" class="form-control" name="payDate" id="payDate" value="" hidden />
                                                                <input type="text" class="form-control" name="LastPaymentDate" id="LastPaymentDate" value="<?php echo $LastPaymentDate; ?>" hidden />
                                                                <input type="text" class="form-control" name="remainingAmount" id="remainingAmount" value="" hidden />

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
                                                                <button class="btn btn-warning" type="button" id="calculate" onclick="Calculate1();"> Generate Amount</button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Settle Amount With Interest</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="TotWithIntAmount" id="TotWithIntAmount" readonly />

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success mr-2" name="createPawningSettlement" onclick="return confirm('Do you confirm this transaction?')">Make Transaction</button>



                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <script type="text/javascript">
                    function Calculate1() {
                        var PawningCreatedDate = document.getElementById("PawningCreatedDate").value;
                        var SettleAmount = parseInt(document.getElementById("SettleAmount").value);
                        var Amount = parseInt(document.getElementById("Amount").value);
                        var SettleCount = parseInt(document.getElementById("SettleCount").value);
                        var remainAmount = parseInt(document.getElementById("remainAmount").value);
                        var LastPaymentDate = document.getElementById("LastPaymentDate").value;


                        var someDateYear = new Date(PawningCreatedDate);
                        someDateYear.setMonth(someDateYear.getMonth() + 1); //number  of days to add, e.x. 15 days
                        var monthForward = someDateYear.toISOString().substr(0, 10);



                        if (SettleCount == 0) {
                            var d1 = new Date(PawningCreatedDate);
                            var d2 = new Date();
                            var d2Date = d2.toISOString().substr(0, 10);
                            var diff = d2.getTime() - d1.getTime();
                            var daydiff = (diff * 1.1574e-8).toFixed(0);

                            var remainedAmount = Amount - SettleAmount;

                            if (daydiff <= 30) {
                                var InterestAmount = ((Amount * 19) / 100) / 12;
                                var totalwithInterest = SettleAmount + InterestAmount;
                            } else {
                                var InterestAmount = (((Amount * 19) / 100) / 365) * daydiff;
                                var totalwithInterest = SettleAmount + InterestAmount;

                            }
                        } else {
                            var remainedAmount = remainAmount - SettleAmount;

                            var d1 = new Date(LastPaymentDate);
                            var d2 = new Date();
                            var d2Date = d2.toISOString().substr(0, 10);
                            var diff = d2.getTime() - d1.getTime();
                            var daydiff = (diff * 1.1574e-8).toFixed(0);


                            var InterestAmount = (((remainAmount * 19) / 100) / 365) * daydiff;

                            var totalwithInterest = SettleAmount + InterestAmount;
                        }





                        document.getElementById("remainingAmount").value = Math.round(remainedAmount);
                        document.getElementById("payDate").value = d2Date;
                        document.getElementById("InterestAmount").value = Math.round(InterestAmount);
                        document.getElementById("TotWithIntAmount").value = Math.round(totalwithInterest);



                        //var weightAmount=totalWeight*8750;
                        // var repaymentInterest=(weightAmount*19)/100;
                        //  var repayment=repaymentInterest+weightAmount;
                        //  document.getElementById("amount").value = repayment;
                        // document.getElementById("pawningamount").value = weightAmount;


                        // var someDateYear = new Date();
                        // someDateYear.setMonth(someDateYear.getMonth() + 12); //number  of days to add, e.x. 15 days
                        // var monthForward = someDateYear.toISOString().substr(0, 10);
                        // document.getElementById("settlementDate").value = monthForward;

                        // var btn = document.getElementById('calculate');
                        // btn.disabled = true;


                    }
                </script>

                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Pawning Settlements</h4><Br>
                                    <div class="table-responsive pt-3">
                                        <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">


                                                        <label class="col-sm-3 col-form-label">Pawning No</label>
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
                                                        Member ID
                                                    </th>
                                                    <th>
                                                        Account No
                                                    </th>
                                                    <th>
                                                        Pawning Amount
                                                    </th>
                                                    <th>
                                                        Total Paid
                                                    </th>
                                                    <th>
                                                        Interest Amount
                                                    </th>
                                                    <th>
                                                        Remain Amount
                                                    </th>
                                                    <th>
                                                        Pay Date
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php


                                                if (isset($_POST['searchaccount'])) {

                                                    $accNo = $_POST['accNo'];
                                                    $sql = "SELECT * FROM pawning_settlement where pawningID='$accNo'";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                    $k = 0;
                                                    while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $record['Settle_ID']; ?>

                                                            </td>
                                                            <td>
                                                                <?php echo $record['memberID']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['AccountNo']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['PayAmount']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['TotalPay']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['InterestAmount']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['RemainAmount']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['PayDate']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['Status']; ?>
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