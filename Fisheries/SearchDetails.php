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


//$loanID = $_GET['id'];

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


                    /*$sql = "SELECT * FROM member_loan where LoanID='$loanID'";
                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                    $record = mysqli_fetch_assoc($resultset);
                    $memID = $record['MemberID'];*/



                    ?>



                    <center>
                        <h3 style="font-weight: bold;">Member Profile</h4>
                    </center>
                    <br>
                    <br>
                    <form class="form-sample" action="" id="addUser" method="POST" target="_parent">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">

                                    <label class="col-sm-3 col-form-label">Member ID</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" name="memberID" id="memberID" onkeypress='validate(event)' value="<?php echo isset($_POST['memberID']) ? $_POST['memberID'] : '' ?>" />
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

                                                $("#memberID").keypress(function(e) {
                                                    var current_val = $(this).val();
                                                    var typing_char = String.fromCharCode(e.which);
                                                    if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                        return false;
                                                    }

                                                })
                                            </script>
                                            <div class="col-md-auto">
                                                <button type="" name="searchmember" class="btn btn-success mr-2">Search</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['searchmember'])) {
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $valueToSearch = $_POST['memberID'];

                            $sql = "SELECT * FROM member WHERE member_id= '$valueToSearch '";
                            $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                            $record = mysqli_fetch_assoc($resultset);
                            if (mysqli_num_rows($resultset) == 1) {

                                $sql1 = "SELECT * FROM member where member_id='$valueToSearch'";
                                $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));

                                $sql2 = "SELECT * FROM member_account where memberID='$valueToSearch'";
                                $resultset2 = mysqli_query($conn, $sql2) or die("database error:" . mysqli_error($conn));

                                $sql3 = "SELECT * FROM pass_loans where MemberID='$valueToSearch'";
                                $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));


                                $sql4 = "SELECT * FROM member_transactions where MemberID='$valueToSearch'";
                                $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));


                                $sql5 = "SELECT * FROM pass_donations where MemberID='$valueToSearch'";
                                $resultset5 = mysqli_query($conn, $sql5) or die("database error:" . mysqli_error($conn));

                                $sql6 = "SELECT * FROM mem_pass_pawnings where memberID='$valueToSearch'";
                                $resultset6 = mysqli_query($conn, $sql6) or die("database error:" . mysqli_error($conn));
                    ?>


                                <div class="row ">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <img src="images\faces\avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                                    <div class="mt-3">
                                                        <?php while ($record1 = mysqli_fetch_assoc($resultset1)) {
                                                        ?>
                                                            <h4><?php echo $record1['first_name']; ?> <?php echo $record1['last_name']; ?></h4>
                                                            <p class="text-secondary mb-1">TP : <?php echo $record1['contact_no']; ?></p>
                                                            <p class="text-muted font-size-sm">NIC : <?php echo $record1['nic']; ?></p>
                                                            <hr>
                                                        <?php }  ?>
                                                    </div>
                                                </div>
                                                <h5 style="color:green ;">My Accounts</h6>
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
                                                    <h5 style="color:green ;">My Loans</h6>
                                                        <table style="width: 100%;" border="1">
                                                            <tr>
                                                                <th>Loan ID</th>
                                                                <th>Acc No</th>

                                                                <th>Loan Date</th>
                                                                <th>Type</th>
                                                                <th> Amount</th>
                                                                <th>Paid Status</th>

                                                            </tr>
                                                            <?php while ($record3 = mysqli_fetch_assoc($resultset3)) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $record3['LoanID']; ?></td>
                                                                    <td><?php echo $record3['AccNo']; ?></td>

                                                                    <td><?php echo $record3['LoanDate']; ?></td>
                                                                    <td><?php echo $record3['Description']; ?></td>
                                                                    <td>LKR <?php echo $record3['LoanAmount']; ?></td>
                                                                    <td> <?php echo $record3['PaidStatus']; ?></td>

                                                                </tr>
                                                            <?php }  ?>

                                                        </table>
                                                        <hr>
                                                        <h5 style="color:green ;">My Donations</h6>
                                                            <table style="width: 100%;" border="1">
                                                                <tr>
                                                                    <th>Donation ID</th>
                                                                    <th>Acc No</th>

                                                                    <th>Description</th>
                                                                    <th>Donation Amount</th>
                                                                    <th> Donation Date</th>
                                                                    <th>Created Date</th>

                                                                </tr>
                                                                <?php while ($record5 = mysqli_fetch_assoc($resultset5)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $record5['DonationID']; ?></td>
                                                                        <td><?php echo $record5['AccNo']; ?></td>

                                                                        <td><?php echo $record5['Description']; ?></td>
                                                                        <td>LKR <?php echo $record5['DonationAmount']; ?></td>
                                                                        <td> <?php echo $record5['DonationDate']; ?></td>
                                                                        <td> <?php echo $record5['CreatedDate']; ?></td>

                                                                    </tr>
                                                                <?php }  ?>

                                                            </table>
                                                            <hr>
                                                            <h5 style="color:green ;">My Pawnings</h6>
                                                                <table style="width: 100%;" border="1">
                                                                    <tr>
                                                                        <th>Pawning ID</th>
                                                                        <th>Account No</th>

                                                                        <th>Interest</th>
                                                                        <th>Pawning CreatedDate</th>
                                                                        <th> Settlement Date</th>
                                                                        <th>Total Weight</th>
                                                                        <th>Pawning amount</th>
                                                                        <th>Total amount</th>

                                                                    </tr>
                                                                    <?php while ($record6 = mysqli_fetch_assoc($resultset6)) {
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $record6['pawningID']; ?></td>
                                                                            <td><?php echo $record6['AccountNo']; ?></td>

                                                                            <td><?php echo $record6['Interest']; ?></td>
                                                                            <td><?php echo $record6['PawningCreatedDate']; ?></td>
                                                                            <td>LKR <?php echo $record6['settlementDate']; ?></td>
                                                                            <td> <?php echo $record6['totalWeight']; ?></td>
                                                                            <td> <?php echo $record6['pawningamount']; ?></td>
                                                                            <td> <?php echo $record6['amount']; ?></td>

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

                                            </div>
                                        </div>


                                    </div>










                                </div>

                    <?php
                            }
                            else{
                                echo '<script>alert("No member found")</script>'; 
                            }
                        }
                    }

                    ?>

                    <hr>
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