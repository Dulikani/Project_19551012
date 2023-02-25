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







if (isset($_POST['createloan'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {



        $sql18 = "SELECT MAX(LoanID) AS LoanID FROM member_loan_temp";
        $result18 = mysqli_query($conn, $sql18) or die("database error:" . mysqli_error($conn));
        $row18 = mysqli_fetch_array($result18);
        $loanIDNew = $row18["LoanID"];


        $sql19 = "SELECT * FROM member_loan_temp WHERE LoanID= '$loanIDNew '";
        $resultset12 = mysqli_query($conn, $sql19) or die("database error:" . mysqli_error($conn));
        while ($record2 = mysqli_fetch_assoc($resultset12)) {

            $memberID = $record2["MemberID"];
            $AccountNo = $record2["AccountNo"];
            $Guarantor1 = $record2["Guarantor1"];
            $Guarantor2 = $record2["Guarantor2"];
            $LoanType = $record2["LoanType"];
            $loanAmount = $record2["LoanAmount"];
            $createdBy = $record2["CreatedBy"];
            $approval = $record2["Approval"];



            $insert = "insert into member_loan(MemberID,AccountNo,Guarantor1,Guarantor2,LoanType,LoanAmount,Approval,CreatedBy) values('$memberID','$AccountNo','$Guarantor1','$Guarantor2','$LoanType','$loanAmount','$approval','$createdBy')";
            $stmt1 = mysqli_prepare($conn, $insert);

            mysqli_stmt_execute($stmt1);

            $check = mysqli_stmt_affected_rows($stmt1);
            if ($check == 1) {
                $msg = 'Data Successfullly UPloaded';


                $sql5 = "insert into loan_memguarantor(LoanID,GuarantorID) values('$loanIDNew','$Guarantor1')";
                $stmt5 = mysqli_prepare($conn, $sql5);
                mysqli_stmt_execute($stmt5);
                $check1 = mysqli_stmt_affected_rows($stmt5);

                $sql6 = "insert into loan_memguarantor(LoanID,GuarantorID) values('$loanIDNew','$Guarantor2')";
                $stmt6 = mysqli_prepare($conn, $sql6);
                mysqli_stmt_execute($stmt6);
                $check2 = mysqli_stmt_affected_rows($stmt6);


                $del = "DELETE FROM member_loan_temp ";
                if ($conn->query($del) === TRUE) {
                    echo "Record deleted successfully";
                    header("Location:ViewLoan.php");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                $msg = 'Error uploading Data';
            }
        }
    }
}


if (isset($_POST['edit'])) {


    $del = "DELETE FROM member_loan_temp ";
    if ($conn->query($del) === TRUE) {
        echo "Record deleted successfully";
        header("Location:CreateLoan.php");
    } else {
        echo "Error deleting record: " . $conn->error;
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
                                    <h3 class="card-title">Create Loan Cont.</h3>

                                    <hr>
                                    <h4 class="">Member Loan Creation<br></h4><br>

                                    <?php

                                    $sql8 = "SELECT MAX(LoanID) AS LoanID FROM member_loan_temp";
                                    $result8 = mysqli_query($conn, $sql8) or die("database error:" . mysqli_error($conn));
                                    $row8 = mysqli_fetch_array($result8);
                                    $loanIDNew = $row8["LoanID"];


                                    $sql9 = "SELECT * FROM member_loan_temp WHERE LoanID= '$loanIDNew '";
                                    $resultset1 = mysqli_query($conn, $sql9) or die("database error:" . mysqli_error($conn));
                                    while ($record1 = mysqli_fetch_assoc($resultset1)) {

                                    ?>
                                        <table style="height: 80px;width:30%">
                                            <tr>
                                                <td>Member ID</td>
                                                <td><?php echo $record1["MemberID"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Account No</td>
                                                <td><?php echo $record1["AccountNo"]; ?></td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <hr>
                                                </td>
                                            </tr>

                                            <tr style="margin-top:100px;">
                                                <td style="color:green">Guarantor 1 Details</td>
                                            </tr>
                                            <?php

                                            $guarantor1 = $record1["Guarantor1"];
                                            $guarantor2 = $record1["Guarantor2"];


                                            $sql10 = "SELECT * FROM member WHERE member_id= '$guarantor1 '";
                                            $resultset2 = mysqli_query($conn, $sql10) or die("database error:" . mysqli_error($conn));
                                            while ($record2 = mysqli_fetch_assoc($resultset2)) {

                                            ?>
                                                <tr>
                                                    <td>Guarantor 1 ID</td>
                                                    <td><?php echo $record2["member_id"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Guarantor 1 Name</td>
                                                    <td><?php echo $record2["first_name"]; ?> <?php echo $record2["last_name"]; ?></td>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                            $sql1 = "SELECT COUNT(*)  AS total FROM loan_memguarantor WHERE GuarantorID= '$guarantor1 '";
                                            $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
                                            $data1 = mysqli_fetch_assoc($resultset1);

                                            ?>



                                            <tr>
                                                <td>Total Guarantor Count</td>
                                                <td><?php echo $data1['total'] ?></td>
                                            </tr>


                                            <hr>
                                            <tr>
                                                <td>
                                                    <hr>
                                                </td>
                                            </tr>

                                            <tr style="margin-top:100px;">
                                                <td style="color:green">Guarantor2 Details</td>
                                            </tr>
                                            <?php

                                            $guarantor1 = $record1["Guarantor1"];
                                            $guarantor2 = $record1["Guarantor2"];


                                            $sql10 = "SELECT * FROM member WHERE member_id= '$guarantor2 '";
                                            $resultset2 = mysqli_query($conn, $sql10) or die("database error:" . mysqli_error($conn));
                                            while ($record2 = mysqli_fetch_assoc($resultset2)) {

                                            ?>
                                                <tr>
                                                    <td>Guarantor 2 ID</td>
                                                    <td><?php echo $record2["member_id"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Guarantor 2 Name</td>
                                                    <td><?php echo $record2["first_name"]; ?> <?php echo $record2["last_name"]; ?></td>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                            $sql1 = "SELECT COUNT(*)  AS total FROM loan_memguarantor WHERE GuarantorID= '$guarantor2 '";
                                            $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
                                            $data1 = mysqli_fetch_assoc($resultset1);

                                            ?>



                                            <tr>
                                                <td>Total Guarantor Count</td>
                                                <td><?php echo $data1['total'] ?></td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <br>
                                        <table style="height:100px;width:62%">
                                            <tr>
                                                <td>Loan Type</td>
                                                <td><?php echo $record1["LoanType"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Loan Amount</td>
                                                <td><?php echo $record1["LoanAmount"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Created Date</td>
                                                <td><?php echo $record1["CreatedDate"]; ?></td>
                                            </tr>

                                        </table>
                                        <br> <br>






                                    <?php } ?>



                                    <form method="POST">
                                        <button type="submit" class="btn btn-warning mr-2" name="edit">Reset</button>

                                        <button type="submit" class="btn btn-success mr-2" name="createloan">Confirm and Submit</button>
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