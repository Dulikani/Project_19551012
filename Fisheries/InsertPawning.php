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
//error_reporting(0);




if (isset($_POST['pass'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $memberID = $_POST['memberID'];
        $AccountNo = $_POST['AccountNo'];
        $Interest = $_POST['Interest'];
        $settlementDate = $_POST['settlementDate'];
        $totalWeight = $_POST['totalWeight'];
        $pawningamount = $_POST['pawningamount'];
        $amount = $_POST['amount'];
        $ApprovedBy = $_SESSION['use'];
        $todate = $_POST['todate'];
        $transerType = "Debit";




        $description = "Member Pawning";


        $sql7 = "SELECT SUM(Amount) as SumCredit FROM bank_transactions where TransType='Credit'";
        $resultset7 = mysqli_query($conn, $sql7) or die("database error:" . mysqli_error($conn));
        $record7 = mysqli_fetch_assoc($resultset7);
        $SumCredit = $record7['SumCredit'];

        $sql8 = "SELECT SUM(Amount) as SumDebit FROM bank_transactions where TransType='Debit'";
        $resultset8 = mysqli_query($conn, $sql8) or die("database error:" . mysqli_error($conn));
        $record8 = mysqli_fetch_assoc($resultset8);
        $SumDebit = $record8['SumDebit'];

        $RunningBal = $SumCredit - $SumDebit;
        $AfterRunningBal = $RunningBal - $pawningamount;

        if ($RunningBal > $pawningamount) {
            $sql = "insert into mem_pass_pawnings(memberID,AccountNo,Interest,PawningCreatedDate,settlementDate,totalWeight,pawningamount,amount,ApprovedBy) values('$memberID','$AccountNo','$Interest','$todate','$settlementDate','$totalWeight','$pawningamount','$amount','$ApprovedBy')";
            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_execute($stmt);

            $check = mysqli_stmt_affected_rows($stmt);
            if ($check == 1) {
                $msg = 'Data Successfullly UPloaded';


                $sql10 = "insert into bank_transactions(AccNo,TransType,Amount,RunningBal,Description) values('$AccountNo','$transerType','$pawningamount','$AfterRunningBal','$description')";
                $stmt10 = mysqli_prepare($conn, $sql10);
                mysqli_stmt_execute($stmt10);

                $transerTypeCR = "Credit";


                $SubDebitMem = 0;
                $SumCreditMem = 0;

                $sql12 = "SELECT SUM(Amount) as SumCreditAcc FROM member_transactions where TransType='Credit' AND AccNo='$AccountNo'";
                $resultset12 = mysqli_query($conn, $sql12) or die("database error:" . mysqli_error($conn));
                $record12 = mysqli_fetch_assoc($resultset12);
                $SumCreditMem = $record12['SumCreditAcc'];

                $sql13 = "SELECT SUM(Amount) as SumDebitAcc FROM member_transactions where TransType='Debit' AND AccNo='$AccountNo'";
                $resultset13 = mysqli_query($conn, $sql13) or die("database error:" . mysqli_error($conn));
                $record13 = mysqli_fetch_assoc($resultset13);
                $SubDebitMem = $record13['SumDebitAcc'];


                $MemAccBal = $SumCreditMem - $SubDebitMem;
                $RunningBalMem = $MemAccBal + $pawningamount;
                $NIC = " ";
                $Name = "Fisheries Pawning";

                $sql11 = "insert into member_transactions(MemberID,AccNo,TransType,Amount,RunningBal,Description,NIC,FullName) values('$memberID','$AccountNo','$transerTypeCR','$pawningamount','$RunningBalMem','$description','$NIC','$Name')";
                $stmt11 = mysqli_prepare($conn, $sql11);
                mysqli_stmt_execute($stmt11);
            } else {
                $msg = 'Error uploading Data';
                echo '<script>alert("Pawning successfully issued.")</script>';

            }
        } else {
            echo '<script>alert("Cannot Proceed Pawning.Insufficient Bank Balance")</script>';
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
                                    <h3 class="card-title">Create Pawning</h3>

                                    <hr>
                                    <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">
                                        <h4 class="">Member Pawning Creation<br></h4><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">


                                                    <label class="col-sm-3 col-form-label">Member ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="memberID" id="memberID" value="<?php echo isset($_POST['memberID']) ? $_POST['memberID'] : '' ?>" />
                                                            </div>
                                                            <div class="col-md-auto">
                                                                <button type="" name="searchmember" class="btn btn-success mr-2">Search</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                            if (isset($_POST['searchmember'])) {
                                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                                    $valueToSearch = $_POST['memberID'];
                                                    // search in all table columns
                                                    // using concat mysql function






                                                    $sql = "SELECT * FROM member_account WHERE memberID= '$valueToSearch '";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));


                                            ?>

                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Account No</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="AccountNo">
                                                                    <?php
                                                                    // use a while loop to fetch data
                                                                    // from the $all_categories variable
                                                                    // and individually display as an option
                                                                    while ($record = mysqli_fetch_assoc($resultset)) {
                                                                    ?>
                                                                        <option value="<?php echo $record["account_no"]; ?>">
                                                                            <?php echo $record["account_no"]; ?> - LKR <?php


                                                                                                                        $AcNo = $record["account_no"];
                                                                                                                        $sql3 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AcNo ' AND TransType='Credit'";
                                                                                                                        $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                                                                                                                        $data3 = mysqli_fetch_assoc($resultset3);
                                                                                                                        $TotalCreditAmount = $data3['TotalAmount'];

                                                                                                                        $sql4 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AcNo ' AND TransType='Debit'";
                                                                                                                        $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));
                                                                                                                        $data4 = mysqli_fetch_assoc($resultset4);
                                                                                                                        $TotalDebitAmount = $data4['TotalAmount'];

                                                                                                                        $RunningBal = $TotalCreditAmount - $TotalDebitAmount;





                                                                                                                        echo $RunningBal; ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    // While loop must be terminated
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Interest</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="Interest" value="19%" readonly />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Settlement Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="settlementDate" name="settlementDate" readonly />
                                                        <input type="text" class="form-control" id="todate" name="todate" readonly hidden />

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Total weight of gold gram</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="totalWeight" name="totalWeight" required />

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Pawning Amount</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="pawningamount" name="pawningamount" readonly />

                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Repayment Amount</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="amount" name="amount" readonly />

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-warning" type="button" id="calculate" onclick="Calculate();"> Generate Amount</button>

                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2" name="pass">Pass Pawning</button>
                                <?php }
                                            } ?>
                                    </form>




                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <script type="text/javascript">
        function Calculate() {

            var totalWeight = parseInt(document.getElementById("totalWeight").value);

            var weightAmount = totalWeight * 8750;
            var repaymentInterest = (weightAmount * 19) / 100;
            var repayment = repaymentInterest + weightAmount;
            document.getElementById("amount").value = repayment;
            document.getElementById("pawningamount").value = weightAmount;


            var someDateYear = new Date();
            var todate = someDateYear.toISOString().substr(0, 10);
            document.getElementById("todate").value = todate;


            someDateYear.setMonth(someDateYear.getMonth() + 12); //number  of days to add, e.x. 15 days
            var monthForward = someDateYear.toISOString().substr(0, 10);
            document.getElementById("settlementDate").value = monthForward;

            var btn = document.getElementById('calculate');
            btn.disabled = true;

        }
    </script>





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