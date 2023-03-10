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





if (isset($_POST['createloan'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $memberID = $_POST['memberID'];
        $AccountNo = $_POST['AccountNo'];
        $Guarantor1 = $_POST['Guarantor1'];
        $Guarantor2 = $_POST['Guarantor2'];
        $LoanType = $_POST['LoanType'];
        $loanAmount = $_POST['loanAmount'];
        $createdBy = $_SESSION['use'];
        $approval = "Pending";

        $sql = "insert into member_loan(MemberID,AccountNo,Guarantor1,Guarantor2,LoanType,LoanAmount,Approval,CreatedBy) values('$memberID','$AccountNo','$Guarantor1','$Guarantor2','$LoanType','$loanAmount','$approval','$createdBy')";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if ($check == 1) {
            $msg = 'Data Successfullly UPloaded';
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Loans</h4><Br>
                                    <h5>View BOD Approval Status</h5>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Loan ID
                                                    </th>
                                                    <th>
                                                        Member ID
                                                    </th>
                                                    <th>
                                                        Account No
                                                    </th>
                                                    <th>
                                                        Guarantor ID 1
                                                    </th>
                                                    <th>
                                                        Guarantor ID 2
                                                    </th>
                                                    <th>
                                                        Loan Type
                                                    </th>
                                                    <th>
                                                        Amount
                                                    </th>
                                                    <th>
                                                        Created Date
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Approval BOD
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM member_loan WHERE Approval = 'Pending' OR Approval = 'Sent BOD' OR Approval = 'BOD Approved'   ";
                                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                $k = 0;
                                                while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $record['LoanID']; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $record['MemberID']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['AccountNo']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Guarantor1']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Guarantor2']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['LoanType']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['LoanAmount']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['CreatedDate']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($record['Approval'] == "Pending") {
                                                            ?>
                                                                <label class="badge badge-danger"> <?php echo $record['Approval']; ?> </label>
                                                            <?php } else if ($record['Approval'] == "Sent BOD") {   ?>
                                                                <label class="badge badge-warning"> <?php echo $record['Approval']; ?> </label>
                                                            <?php } else { ?>
                                                                <label class="badge badge-success"> <?php echo $record['Approval']; ?> </label>
                                                            <?php } ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($record['Approval'] == "Pending") {
                                                            ?>
                                                                <Button class="badge badge-primary"><a style="color: white;" href='sendBODUpdate.php?id=<?php echo $record['LoanID'] ?>'>Send To BOD</a></Button>
                                                            <?php }  ?>
                                                        </td>
                                                        <td>

                                                            <Button class="badge badge-warning"><a style="color: black;" href='ViewLoanProfile.php?id=<?php echo $record['LoanID'] ?>'>View Loan</a></Button>
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


                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Pass / Reject Loans</h4><Br>
                                    <h5>View Pass / Reject Status</h5>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Loan ID
                                                    </th>
                                                    <th>
                                                        Member ID
                                                    </th>
                                                    <th>
                                                        Account No
                                                    </th>
                                                    <th>
                                                        Guarantor ID 1
                                                    </th>
                                                    <th>
                                                        Guarantor ID 2
                                                    </th>
                                                    <th>
                                                        Loan Type
                                                    </th>
                                                    <th>
                                                        Amount
                                                    </th>
                                                    <th>
                                                        Created Date
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM member_loan WHERE Approval='Passed' OR Approval='BOD Reject'";
                                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                $k = 0;
                                                while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $record['LoanID']; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $record['MemberID']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['AccountNo']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Guarantor1']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Guarantor2']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['LoanType']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['LoanAmount']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['CreatedDate']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($record['Approval'] == "BOD Reject") {
                                                            ?>
                                                                <label class="badge badge-danger"> <?php echo $record['Approval']; ?> </label>
                                                            <?php } else if ($record['Approval'] == "Sent BOD") {   ?>
                                                                <label class="badge badge-warning"> <?php echo $record['Approval']; ?> </label>
                                                            <?php } else { ?>
                                                                <label class="badge badge-success"> <?php echo $record['Approval']; ?> </label>
                                                            <?php } ?>

                                                        </td>

                                                        <td>

                                                            <Button class="badge badge-warning"><a style="color: black;" href='ViewPassedLoanProfile.php?id=<?php echo $record['LoanID'] ?>'>View Loan</a></Button>
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