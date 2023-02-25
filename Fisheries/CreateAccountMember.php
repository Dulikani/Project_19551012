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
error_reporting(0);

if (isset($_POST['createMemberAccount'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $memberID = $_POST['memberID'];
        $NIC = $_POST['NIC'];
        $AccountType = $_POST['AccountType'];
        $TransactionType = $_POST['TransactionType'];
        $transactionAmount = $_POST['transactionAmount'];
        $transactionDate = $_POST['transactionDate'];
        $createdBy = $_SESSION['use'];

        $transactionDateNew = date("Y-m-d", strtotime($transactionDate));

        $sql1 = "SELECT COUNT(*) AS TypeCount FROM member_account WHERE memberID='$memberID' and AccType='$AccountType'";
        $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
        $record1 = mysqli_fetch_assoc($resultset1);

        $sql2 = "SELECT *  FROM member WHERE member_id='$memberID'";
        $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));
        $record2 = mysqli_fetch_assoc($resultset2);

        $memName = $record2['first_name'];

        $type = $record1['TypeCount'];

        if ($type == 0) {
            $sql = "insert into member_account(memberID,NIC,AccType,TransType,OpeningBal,TransAmount,TransDate,CreatedBy) values('$memberID','$NIC','$AccountType','$TransactionType','$transactionAmount','$transactionAmount','$transactionDateNew','$createdBy')";
            $stmt = mysqli_prepare($conn, $sql);


            mysqli_stmt_execute($stmt);

            $check = mysqli_stmt_affected_rows($stmt);
            if ($check == 1) {
                $description = "Acc Creation Deposit";
                $Name = $memName;
                $tType = "Credit";


                $sql5 = "SELECT *  FROM member_account WHERE memberID='$memberID' AND AccType='$AccountType'";
                $resultset5 = mysqli_query($conn, $sql5) or die("database error:" . mysqli_error($conn));
                $record5 = mysqli_fetch_assoc($resultset5);

                $accNoNew = $record5['account_no'];

                $sql11 = "insert into member_transactions(MemberID,AccNo,TransType,Amount,RunningBal,Description,NIC,FullName) values('$memberID','$accNoNew','$tType','$transactionAmount','$transactionAmount','$description','$NIC','$Name')";
                $stmt11 = mysqli_prepare($conn, $sql11);
                mysqli_stmt_execute($stmt11);





                echo '<script>alert("Account Created Successfully.")</script>';
            } else {
                $msg = 'Error uploading Data';
            }
        } else {
            echo '<script>alert("You cannot create same type accounts")</script>';
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
                                    <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">
                                        <h4 class="">Member Account Creation<br></h4><br>
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

                                                    $sql = "SELECT * FROM member WHERE member_ID= '$valueToSearch '";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                    $record = mysqli_fetch_assoc($resultset);
                                                    if (mysqli_num_rows($resultset) == 1) {


                                            ?>

                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">NIC</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="NIC" value="<?php echo $record['nic']; ?>" readonly required />
                                                                </div>
                                                            </div>
                                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="fname" value="<?php echo $record['first_name']; ?>" readonly required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Last Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="lname" value="<?php echo $record['last_name']; ?>" readonly required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Account Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="AccountType" required>
                                                            <option>Savings Account</option>
                                                            <option>18+ Account</option>
                                                            <option>Woman Account</option>

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
                                                        <input type="text" class="form-control" id="transactionAmount" name="transactionAmount" onkeypress='validate(event)' required />
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

                                                    $("#transactionAmount").keypress(function(e) {
                                                        var current_val = $(this).val();
                                                        var typing_char = String.fromCharCode(e.which);
                                                        if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                            return false;
                                                        }

                                                    })
                                                </script>
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

                                        <button type="submit" class="btn btn-primary mr-2" name="createMemberAccount">Create Account</button>

                                    </form>




                                </div>
                                <hr>
                                <div class="table-responsive pt-3">
                                    <h4>&nbsp;My Accounts</h4>
                                    <br>
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Account No
                                                </th>
                                                <th>
                                                    Account Type
                                                </th>
                                                <th>
                                                    Transaction type
                                                </th>
                                                <th>
                                                    Transaction Amount
                                                </th>
                                                <th>
                                                    Created Date
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                        $sql = "SELECT * FROM member_account WHERE memberID='$valueToSearch'";
                                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                        $k = 0;
                                                        while ($record = mysqli_fetch_assoc($resultset)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $record['account_no']; ?>

                                                    </td>
                                                    <td>
                                                        <?php echo $record['AccType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['TransType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['TransAmount']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $record['CreatedDate']; ?>
                                                    </td>



                                                </tr>
                                <?php
                                                        }
                                                    } else {
                                                        echo '<script>alert("No Member Found")</script>';
                                                    }
                                                }
                                            }
                                ?>


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



    <script type="text/javascript">
        function Openform1() {
            var inputVal = document.getElementById("memberID").value;
            inputVal.value = inputVal;

        }

        function Openform() {
            const memberAccount = document.getElementById('memberAccount');
            const nonMemberAccount = document.getElementById('nonMemberAccount');
            const employeeAccount = document.getElementById('employeeAccount');
            const dependantAccount = document.getElementById('dependantAccount');


            const proceed = document.getElementById('proceed');


            var selectElement = document.querySelector('#accountType');
            var output = selectElement.value;


            if (output == "1") {
                memberAccount.style.display = 'block';
                nonMemberAccount.style.display = 'none';
                employeeAccount.style.display = 'none';
                dependantAccount.style.display = 'none';

            } else if (output == "2") {
                nonMemberAccount.style.display = 'block';
                memberAccount.style.display = 'none';
                employeeAccount.style.display = 'none';
                dependantAccount.style.display = 'none';

            } else if (output == "3") {
                employeeAccount.style.display = 'block';
                memberAccount.style.display = 'none';
                nonMemberAccount.style.display = 'none';
                dependantAccount.style.display = 'none';

            } else if (output == "4") {
                dependantAccount.style.display = 'block';
                memberAccount.style.display = 'none';
                nonMemberAccount.style.display = 'none';
                employeeAccount.style.display = 'none';

            }



            // if (memberAccount.style.display === 'none') {
            //     form.style.display = 'block';
            // } else {
            //     form.style.display = 'none';
            // }



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