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

        $LoanID = $_POST['LoanID'];
        $AccountNo = $_POST['AccountNo'];
        $LoanType = $_POST['LoanType'];
        $LoanAmount = $_POST['LoanAmount'];
        $CreatedDate = $_POST['CreatedDate'];
        $MemberID = $_POST['MemberID'];
        $ApprovedBy = $_SESSION['use'];

        $sql = "insert into approval_loans(LoanID,MemberID,AccNo,LoanType,Amount,CreatedDate,ApprovalBy) values('$LoanID','$MemberID','$AccountNo','$LoanType','$LoanAmount','$CreatedDate','$ApprovedBy')";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if ($check == 1) {
            $msg = 'Data Successfullly UPloaded';

            $update = "UPDATE member_loan SET Approval='Approved' where LoanID='$LoanID'";
            $stmt1 = mysqli_prepare($conn, $update);


            mysqli_stmt_execute($stmt1);

            $check1 = mysqli_stmt_affected_rows($stmt1);
            if ($check1 == 1) {
                $msg1 = 'Data Successfullly UPloaded';
                header("Location:ViewLoan.php");
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

            <?php
            include_once("Componants/NavBar.php");
            ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">



                    <?php


                    $sql = "SELECT * FROM member_loan where LoanID='$loanID'";
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
                    ?>



                    <center>
                        <h3 style="font-weight: bold;">Passed Loan Profile</h4>
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
                                                <p class="text-secondary mb-1">Full Stack Developer</p>
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
                                </div>
                            </div>


                        </div>






                        <div class="col-md-5">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Loan ID</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['LoanID']; ?>
                                                <input type="text" name="LoanID" value=" <?php echo $record['LoanID']; ?>" hidden>
                                                <input type="text" name="MemberID" value=" <?php echo $record['MemberID']; ?>" hidden>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Account No</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['AccountNo']; ?>
                                                <input type="text" name="AccountNo" value=" <?php echo $record['AccountNo']; ?>" hidden>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guarantor 1 ID</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['Guarantor1']; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guarantor 1 Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php
                                                $G1memID = $record['Guarantor1'];
                                                $sql14 = "SELECT * FROM member where member_id='$G1memID'";
                                                $resultset14 = mysqli_query($conn, $sql14) or die("database error:" . mysqli_error($conn));
                                                $record14 = mysqli_fetch_assoc($resultset14);
                                                echo $record14['first_name'];
                                                echo " ";
                                                echo $record14['last_name'];

                                                ?>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guarantor 1 Loan Count</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            <?php
                                                $G1memID = $record['Guarantor1'];
                                                $sql18 = "SELECT count(ID) as numOfLoans FROM loan_memguarantor where GuarantorID='$G1memID'";
                                                $resultset18 = mysqli_query($conn, $sql18) or die("database error:" . mysqli_error($conn));
                                                $record18 = mysqli_fetch_assoc($resultset18);
                                                echo $record18['numOfLoans'];
                                             

                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guarantor 2 ID</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['Guarantor2']; ?>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guarantor 2 Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            <?php
                                                $G1memID = $record['Guarantor2'];
                                                $sql15 = "SELECT * FROM member where member_id='$G1memID'";
                                                $resultset15 = mysqli_query($conn, $sql15) or die("database error:" . mysqli_error($conn));
                                                $record15 = mysqli_fetch_assoc($resultset15);
                                                echo $record15['first_name'];
                                                echo " ";
                                                echo $record15['last_name'];

                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Guarantor 2 Loan Count</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                            <?php
                                                $G1memID = $record['Guarantor2'];
                                                $sql17 = "SELECT count(ID) as numOfLoans FROM loan_memguarantor where GuarantorID='$G1memID'";
                                                $resultset17 = mysqli_query($conn, $sql17) or die("database error:" . mysqli_error($conn));
                                                $record17 = mysqli_fetch_assoc($resultset17);
                                                echo $record17['numOfLoans'];
                                             

                                                ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Loan Type</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['LoanType']; ?>
                                                <input type="text" name="LoanType" value=" <?php echo $record['LoanType']; ?>" hidden>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Loan Amount</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['LoanAmount']; ?>
                                                <input type="text" name="LoanAmount" value=" <?php echo $record['LoanAmount']; ?>" hidden>

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
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Created By</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo $record['CreatedBy']; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Loan Status</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">




                                                <?php
                                                if ($record['Approval'] == "Pending") {
                                                ?>
                                                    <label class="badge badge-danger"> <?php echo $record['Approval']; ?> </label>
                                                <?php } else if ($record['Approval'] == "Sent BOD") {   ?>
                                                    <label class="badge badge-warning"> <?php echo $record['Approval']; ?> </label>
                                                <?php } else { ?>
                                                    <label class="badge badge-success"> <?php echo $record['Approval']; ?> </label>
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
                                <h4 class="card-title">View Passed Loans</h4>




                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Pass ID
                                                </th>
                                                <th>
                                                    Loan ID
                                                </th>
                                                <th>
                                                    Account No
                                                </th>
                                                <th>
                                                    Description
                                                </th>
                                                <th>
                                                    Loan Amount
                                                </th>
                                                <th>
                                                    Loan Date
                                                </th>
                                                <th>
                                                    No Of Months
                                                </th>
                                                <th>
                                                    Interest
                                                </th>
                                                <th>
                                                    Monthly Installment
                                                </th>
                                                <th>
                                                    Total Loan with Int
                                                </th>
                                                <th>
                                                    Created Date
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM pass_loans where MemberID='$memID'";
                                            $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                            $k = 0;
                                            while ($record = mysqli_fetch_assoc($resultset)) {
                                            ?>
                                                <tr>
                                                    <td class="py-1">
                                                        <?php echo $record['PassID']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $record['LoanID']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['AccNo']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['Description']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['LoanAmount']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['LoanDate']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['NoOfMonths']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['Interest'];
                                                        //echo " %"; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['MonthlyInstallment']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['TotalWithInterest']; ?>
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
                <p style="color:#f2f2f2;">Copyright ?? 2022. By <a href="" target="_blank" style="color:#f2f2f2;">Poornima Wijesundara</a> . All rights reserved.</p>
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