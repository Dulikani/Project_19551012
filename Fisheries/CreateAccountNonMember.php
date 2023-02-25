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



if (isset($_POST['createNonMemberAccount'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $NIC = $_POST['NIC'];
        $FirstName = $_POST['fname'];
        $LastName = $_POST['lname'];
        $AccountType = $_POST['AccountType'];
        $TransactionType = $_POST['TransactionType'];
        $transactionAmount = $_POST['transactionAmount'];
        $transactionDate = $_POST['transactionDate'];
        $createdBy = $_SESSION['use'];

        $transactionDateNew = date("Y-m-d", strtotime($transactionDate));



        $sql = "insert into non_member_account(NIC,FirstName,LastName,AccType,TransType,TransAmount,TransDate,CreatedBy) values('$NIC','$FirstName','$LastName','$AccountType','$TransactionType','$transactionAmount','$transactionDateNew','$createdBy')";
        $stmt = mysqli_prepare($conn, $sql);


        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if ($check == 1) {

            $description = "Non Mem Acc Creation Deposit";
            $Name = $FirstName;
            $tType = "Credit";


            $sql5 = "SELECT *  FROM non_member_account WHERE NIC='$NIC'";
            $resultset5 = mysqli_query($conn, $sql5) or die("database error:" . mysqli_error($conn));
            $record5 = mysqli_fetch_assoc($resultset5);

            $accNoNew = $record5['account_No'];

            $sql11 = "insert into non_member_transactions(NIC,AccNo,TransType,Amount,RunningBal,Description,FullName) values('$NIC','$accNoNew','$tType','$transactionAmount','$transactionAmount','$description','$Name')";
            $stmt11 = mysqli_prepare($conn, $sql11);
            mysqli_stmt_execute($stmt11);





            echo '<script>alert("Successfully Account Created")</script>';
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
                                    <h3 class="card-title">Manage Banking</h3>

                                    <hr>

                                    <form class="form-sample" action="" id="nonMemberAccount" target="_parent" method="POST">
                                        <h4 class="">Non Member Account Creation<br></h4><br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">NIC</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="NIC" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="fname" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Last Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="lname" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Account Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="AccountType">
                                                            <option>Personal Account</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Transaction Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="TransactionType" required>
                                                            <option>Deposit</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Transaction Amount</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="transactionAmount" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Transaction Date </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="transactionDate" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2" name="createNonMemberAccount">Create Account</button>


                                    </form>



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