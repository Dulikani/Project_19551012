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





if (isset($_POST['createTransaction'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $AccountNo = $_POST['AccountNo'];
        $TransactionType = $_POST['TransactionType'];
        $Amount = $_POST['Amount'];
        $Description = $_POST['Description'];


        if ($Amount > 0) {

            $sql3 = "SELECT SUM(Amount) as TotalAmount FROM bank_transactions WHERE  TransType='Credit'";
            $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
            $data3 = mysqli_fetch_assoc($resultset3);
            $TotalCreditAmount = $data3['TotalAmount'];

            $sql4 = "SELECT SUM(Amount) as TotalAmount FROM bank_transactions WHERE  TransType='Debit'";
            $resultset4 = mysqli_query($conn, $sql4) or die("database error:" . mysqli_error($conn));
            $data4 = mysqli_fetch_assoc($resultset4);
            $TotalDebitAmount = $data4['TotalAmount'];


            $RunningBal = $TotalCreditAmount - $TotalDebitAmount;




            if ($TransactionType == "Credit") {
                $NewBalance = $RunningBal + $Amount;


                $sql = "insert into bank_transactions(AccNo,TransType,Amount,RunningBal,Description) values('$AccountNo','$TransactionType','$Amount','$NewBalance','$Description')";
                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_execute($stmt);

                $check = mysqli_stmt_affected_rows($stmt);
                if ($check == 1) {
                    echo '<script>alert("Bank Transaction Successfully completed")</script>';
                } else {
                    echo '<script>alert("Data insert error.Try again.")</script>';
                }
            } else {
                $NewBalance = $RunningBal - $Amount;

                if ($RunningBal > $Amount) {
                    $sql = "insert into bank_transactions(AccNo,TransType,Amount,RunningBal,Description) values('$AccountNo','$TransactionType','$Amount','$NewBalance','$Description')";
                    $stmt = mysqli_prepare($conn, $sql);

                    mysqli_stmt_execute($stmt);

                    $check = mysqli_stmt_affected_rows($stmt);
                    if ($check == 1) {
                        echo '<script>alert("Transaction Successfully completed")</script>';
                    } else {
                        echo '<script>alert("Data insert error.Try again.")</script>';
                    }
                } else {
                    echo '<script>alert("Account Balance Insufficient")</script>';
                }
            }
        } else {
            echo '<script>alert("Invalid Amount")</script>';
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
                                    <h3 class="card-title">Make Bank Transaction</h3>

                                    <hr>
                                    <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Transaction Type</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <select class="form-control" name="TransactionType" required>
                                                                    <option>Credit</option>
                                                                    <option>Debit</option>

                                                                </select>
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
                                                            
                                                                <input type="text" class="form-control" name="AccountNo" value="00-Bank" required readonly />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" id="Description" name="Description" required />

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('#Description').keydown(function(e) {
                                                                if (e.ctrlKey || e.altKey) {
                                                                    e.preventDefault();
                                                                } else {
                                                                    if (!((e.keyCode == 8) || (e.keyCode == 32) || (e.keyCode == 46) || (e.keyCode >= 35 && e.keyCode <= 40) || (e.keyCode >= 65 && e.keyCode <= 90))) {
                                                                        $('#text-message').addClass('d-block').removeClass('d-none');
                                                                        return false;
                                                                    } else {
                                                                        $('#text-message').addClass('d-none').removeClass('d-block');
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Amount</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" id="Amount" name="Amount" onkeypress='validate(event)' required />
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

                                                $("#Amount").keypress(function(e) {
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
                                        <button type="submit" class="btn btn-success mr-2" name="createTransaction" onclick="return confirm('Do you confirm this transaction?')">Make Transaction</button>
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
                                    <h4 class="card-title">View Transactions</h4><Br>
                                    <div class="table-responsive pt-3">
                                        <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">


                                                        <label class="col-sm-3 col-form-label">Transaction Type</label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <select class="form-control" name="type" id="type" value="<?php echo isset($_POST['type']) ? $_POST['type'] : '' ?>">
                                                                        <option>Credit</option>
                                                                        <option>Debit</option>
                                                                    </select>
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
                                                        Transaction ID
                                                    </th>
                                                    <th>
                                                        Transaction Date
                                                    </th>
                                                    <th>
                                                        Description
                                                    </th>
                                                    <th>
                                                        Transaction Type
                                                    </th>
                                                    <th>
                                                        Transaction Amount
                                                    </th>
                                                    <th>
                                                        Running Balance
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php


                                                if (isset($_POST['searchaccount'])) {

                                                    $type = $_POST['type'];
                                                    $sql = "SELECT * FROM bank_transactions where TransType='$type'";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                    while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $record['TransactionID']; ?>

                                                            </td>
                                                            <td>
                                                                <?php echo $record['TransactionDate']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['Description']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['TransType']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['Amount']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $record['RunningBal']; ?>
                                                            </td>


                                                        </tr>
                                                <?php
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