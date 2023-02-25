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
error_reporting(0);

session_start();




if (isset($_POST['createloan'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $memberID = $_POST['memberID'];
        $AccountNo = $_POST['AccountNo'];
        $DonType = $_POST['DonType'];
        $DonAmount = $_POST['Amount'];
        $Description = $_POST['Description'];
        $DepName = $_POST['fname'];
        $createdBy = $_SESSION['use'];
        $approval = "Pending";



        $sql = "insert into member_donation(MemberID,AccNo,DonationType,DonationAmount,Description,DepName,CreatedBy,Status) values('$memberID','$AccountNo','$DonType','$DonAmount','$Description','$DepName','$createdBy','$approval')";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);

        $check = mysqli_stmt_affected_rows($stmt);
        if ($check == 1) {
            $msg = 'Data Successfullly UPloaded';
            echo '<script>alert("Donation request Successfully added")</script>';
        } else {
            echo '<script>alert("Data insert error.Try again.")</script>';
        }
    }
}
?>

<?php

session_start();
if ($_SESSION['use']) {
} else {
    header("Location:index.php");
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
                                    <h3 class="card-title">Create Donation</h3>

                                    <hr>
                                    <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">
                                        <h4 class="">Member Donation Request Form<br></h4><br>
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

                                                    $sql1 = "SELECT * FROM member WHERE member_id= '$valueToSearch '";
                                                    $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
                                                    $record1 = mysqli_fetch_assoc($resultset1);
                                                    if (mysqli_num_rows($resultset1) == 1) {






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
                                                                                                                            $AccountNo = $record["account_no"];
                                                                                                                            $sql3 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AccountNo' AND TransType='Credit'";
                                                                                                                            $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                                                                                                                            $data3 = mysqli_fetch_assoc($resultset3);
                                                                                                                            $TotalCreditAmount = $data3['TotalAmount'];

                                                                                                                            $sql4 = "SELECT SUM(Amount) as TotalAmount FROM member_transactions WHERE AccNo= '$AccountNo' AND TransType='Debit'";
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
                                                    <label class="col-sm-3 col-form-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" id="Description" name="Description" required />
                                                            </div>

                                                        </div>
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
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Donation Amount</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="Amount" id="Amount" onkeypress='validate(event)' required />
                                                            </div>

                                                        </div>
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

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Donation Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="DonType" required>
                                                            <option>Medical Donation</option>
                                                            <option>Property Donation</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Dependant Name</label>
                                                    <div class="col-sm-9">
                                                        <?php


                                                        // using concat mysql function
                                                        $sql3 = "SELECT * FROM member_dependant WHERE member_ID= '$valueToSearch '";
                                                        $resultset4 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                                                        ?>
                                                        <select class="form-control" name="fname" required>
                                                            <?php

                                                            while ($record4 = mysqli_fetch_assoc($resultset4)) {
                                                            ?>
                                                                <option value="<?php echo $record4["first_name"]; ?> <?php echo $record4["last_name"]; ?>">
                                                                    <?php echo $record4["first_name"]; ?> <?php echo $record4["last_name"]; ?> - <?php echo $record4["relationship"]; ?>
                                                                </option>
                                                            <?php
                                                            }

                                                            ?>
                                                        </select>



                                                    </div>
                                                </div>
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
                            <br>
                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Donation Requests</h4>

                                    <div class="table-responsive pt-3">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Donation ID
                                                    </th>
                                                    <th>
                                                        Member ID
                                                    </th>
                                                    <th>
                                                        Account No
                                                    </th>
                                                    <th>
                                                        Description
                                                    </th>
                                                    <th>
                                                        Donation Amount
                                                    </th>
                                                    <th>
                                                        Donation Type
                                                    </th>
                                                    <th>
                                                        Dependant Name
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
                                                $sql = "SELECT * FROM member_donation WHERE Status = 'Pending' OR Status = 'Sent BOD' OR Status = 'BOD Approved'";
                                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                $k = 0;
                                                while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $record['DonationID']; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $record['MemberID']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['AccNo']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Description']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['DonationAmount']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['DonationType']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['DepName']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['CreatedDate']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($record['Status'] == "Pending") {
                                                            ?>
                                                                <label class="badge badge-danger"> <?php echo $record['Status']; ?> </label>
                                                            <?php } else if ($record['Status'] == "Sent BOD") {   ?>
                                                                <label class="badge badge-warning"> <?php echo $record['Status']; ?> </label>
                                                            <?php } else { ?>
                                                                <label class="badge badge-success"> <?php echo $record['Status']; ?> </label>
                                                            <?php } ?>

                                                        </td>

                                                        
                                                        <td>
                                                            <?php
                                                            if ($record['Status'] == "Pending") {
                                                            ?>
                                                                <Button><a href='sendBODUpdateDonation.php?id=<?php echo $record['DonationID'] ?>'>Send To BOD</a></Button>
                                                            <?php }  ?>
                                                        </td>
                                                        <td>

                                                            <Button><a href='ViewDonationProfile.php?id=<?php echo $record['DonationID'] ?>'>View donation</a></Button>
                                                        </td>


                                                    </tr>
                                                <?php
                                                } ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Passed Donations</h4>

                                    <div class="table-responsive pt-3">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Donation ID
                                                    </th>
                                                    <th>
                                                        Member ID
                                                    </th>
                                                    <th>
                                                        Account No
                                                    </th>
                                                    <th>
                                                        Description
                                                    </th>
                                                    <th>
                                                        Donation Amount
                                                    </th>
                                                    <th>
                                                        Donation Type
                                                    </th>
                                                    <th>
                                                        Dependant Name
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
                                                $sql = "SELECT * FROM member_donation where Status='Passed' OR Status='BOD Rejected'";
                                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                $k = 0;
                                                while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $record['DonationID']; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $record['MemberID']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['AccNo']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Description']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['DonationAmount']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['DonationType']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['DepName']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['CreatedDate']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($record['Status'] == "Pending") {
                                                            ?>
                                                                <label class="badge badge-danger"> <?php echo $record['Status']; ?> </label>
                                                            <?php } else if ($record['Status'] == "Sent BOD") {   ?>
                                                                <label class="badge badge-warning"> <?php echo $record['Status']; ?> </label>
                                                            <?php } else if ($record['Status'] == "BOD Rejected") {   ?>
                                                                <label class="badge badge-danger"> <?php echo $record['Status']; ?> </label>
                                                            <?php } else { ?>
                                                                <label class="badge badge-success"> <?php echo $record['Status']; ?> </label>
                                                            <?php } ?>

                                                        </td>
                                                        <td>

                                                            <Button><a href='ViewPassedDonationProfile.php?id=<?php echo $record['DonationID'] ?>'>View Donation</a></Button>
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