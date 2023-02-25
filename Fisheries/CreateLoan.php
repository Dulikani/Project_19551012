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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



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

        $memberID = $_POST['memberID'];
        $AccountNo = $_POST['AccountNo'];
        $Guarantor1 = $_POST['Guarantor1'];
        $Guarantor2 = $_POST['Guarantor2'];
        $LoanType = $_POST['LoanType'];
        $loanAmount = $_POST['loanAmount'];
        $createdBy = $_SESSION['use'];
        $approval = "Pending";

        $sql3 = "SELECT COUNT(*) AS MemberID FROM member WHERE member_id= '$Guarantor1 '";
        $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
        $data3 = mysqli_fetch_assoc($resultset3);

        $sql4 = "SELECT COUNT(*) AS MemberID FROM member WHERE member_id= '$Guarantor2 '";
        $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));
        $data4 = mysqli_fetch_assoc($resultset4);


        $sql1 = "SELECT COUNT(*)  AS total FROM loan_memguarantor WHERE GuarantorID= '$Guarantor1 '";
        $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
        $data1 = mysqli_fetch_assoc($resultset1);


        $sql2 = "SELECT COUNT(*)  AS total FROM loan_memguarantor WHERE GuarantorID= '$Guarantor2 '";
        $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));
        $data2 = mysqli_fetch_assoc($resultset2);

        if ($memberID != $Guarantor1) {
            if ($memberID != $Guarantor2) {
            }
        }



        if ($data3['MemberID'] == 1) {
            if ($data4['MemberID'] == 1) {
                if ($data1['total'] < 3) {
                    if ($data2['total'] < 3) {
                        if ($Guarantor1 != $Guarantor2) {

                            if ($memberID != $Guarantor1) {
                                if ($memberID != $Guarantor2) {
                                    $sql = "insert into member_loan_temp(MemberID,AccountNo,Guarantor1,Guarantor2,LoanType,LoanAmount,Approval,CreatedBy) values('$memberID','$AccountNo','$Guarantor1','$Guarantor2','$LoanType','$loanAmount','$approval','$createdBy')";
                                    $stmt = mysqli_prepare($conn, $sql);

                                    mysqli_stmt_execute($stmt);

                                    $check = mysqli_stmt_affected_rows($stmt);
                                    if ($check == 1) {
                                        $msg = 'Data Successfullly UPloaded';
                                        header("Location:CreateLoanInsert.php");
                                    } else {
                                        echo '<script>alert("Data insert error.Try again.")</script>';
                                    }
                                } else {
                                    echo '<script>alert("Cannot Set member id to the Guarantors")</script>';
                                }
                            } else {
                                echo '<script>alert("Cannot Set member id to the Guarantors")</script>';
                            }
                        } else {
                            echo '<script>alert("Cannot Set Same Guarantors")</script>';
                        }
                    } else {
                        echo '<script>alert("Guarantor 2 already exceed guaranty limit")</script>';
                    }
                } else {
                    echo '<script>alert("Guarantor 1 already exceed guaranty limit")</script>';
                }
            } else {

                echo '<script>alert("Invalid Guarantor 2 Member ID")</script>';
            }
        } else {
            echo '<script>alert("Invalid Guarantor 1 Member ID")</script>';
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
                                    <h3 class="card-title">Create Loan</h3>

                                    <hr>
                                    <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">
                                        <h4 class="">Member Loan Creation<br></h4><br>
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

                                                    $sql = "SELECT * FROM member WHERE member_id= '$valueToSearch '";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                    $record = mysqli_fetch_assoc($resultset);
                                                    if (mysqli_num_rows($resultset) == 1) {





                                                        $sql = "SELECT * FROM member_account WHERE memberID= '$valueToSearch '";
                                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));


                                            ?>

                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Account No</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="AccountNo" required>
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
                                                    <label class="col-sm-3 col-form-label">Guarantor 1 Member ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="Guarantor1" id="Guarantor1" required onkeypress='validate(event)'/>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <script>
                                                        function validate(evt) {
                                                            var theEvent = evt || window.event;

                                                            // Handle paste
                                                            if (theEvent.type === 'paste') {
                                                                key = event.clipboardData.getData('text/plain');
                                                            } else {
                                                                // Handle key press
                                                                var key = theEvent.keyCode || theEvent.which;
                                                                key = String.fromCharCode(key);
                                                            }
                                                            var regex = /[0-9]|\./;
                                                            if (!regex.test(key)) {
                                                                theEvent.returnValue = false;
                                                                if (theEvent.preventDefault) theEvent.preventDefault();
                                                            }
                                                        }

                                                        $("#Guarantor1").keypress(function(e) {
                                                            var current_val = $(this).val();
                                                            var typing_char = String.fromCharCode(e.which);
                                                            if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                                return false;
                                                            }

                                                        })
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Guarantor 2 Member ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="Guarantor2" id="Guarantor2" onkeypress='validate(event)' required />
                                                            </div>

                                                        </div>
                                                        <script>
                                                        function validate(evt) {
                                                            var theEvent = evt || window.event;

                                                            // Handle paste
                                                            if (theEvent.type === 'paste') {
                                                                key = event.clipboardData.getData('text/plain');
                                                            } else {
                                                                // Handle key press
                                                                var key = theEvent.keyCode || theEvent.which;
                                                                key = String.fromCharCode(key);
                                                            }
                                                            var regex = /[0-9]|\./;
                                                            if (!regex.test(key)) {
                                                                theEvent.returnValue = false;
                                                                if (theEvent.preventDefault) theEvent.preventDefault();
                                                            }
                                                        }

                                                        $("#Guarantor2").keypress(function(e) {
                                                            var current_val = $(this).val();
                                                            var typing_char = String.fromCharCode(e.which);
                                                            if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                                return false;
                                                            }

                                                        })
                                                    </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Loan Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="LoanType" required>
                                                            <option>Personal Loan</option>
                                                            <option>Vehicle Loan</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Loan Amount</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="loanAmount" id="loanAmount" onkeypress='validate(event)' required />

                                                    </div>
                                                </div>
                                                <script>
                                                        function validate(evt) {
                                                            var theEvent = evt || window.event;

                                                            // Handle paste
                                                            if (theEvent.type === 'paste') {
                                                                key = event.clipboardData.getData('text/plain');
                                                            } else {
                                                                // Handle key press
                                                                var key = theEvent.keyCode || theEvent.which;
                                                                key = String.fromCharCode(key);
                                                            }
                                                            var regex = /[0-9]|\./;
                                                            if (!regex.test(key)) {
                                                                theEvent.returnValue = false;
                                                                if (theEvent.preventDefault) theEvent.preventDefault();
                                                            }
                                                        }

                                                        $("#loanAmount").keypress(function(e) {
                                                            var current_val = $(this).val();
                                                            var typing_char = String.fromCharCode(e.which);
                                                            if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                                return false;
                                                            }

                                                        })
                                                    </script>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2" name="createloan">Continue</button>
                            <?php } else {
                                                        echo '<script>alert("No Member Found")</script>';
                                                    }
                                                }
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