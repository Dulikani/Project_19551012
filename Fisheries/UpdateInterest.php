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





if (isset($_POST['updateInterest'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $RateID = $_POST['rateID'];
        $rate = $_POST['Interest_Rate'];
        date_default_timezone_set("Asia/Calcutta");
        $updateDate = date("Y-m-d h:i:sa");

        $update = "UPDATE interest_rates SET Interest_Rate='$rate',UpdatedDate='$updateDate' where ID='$RateID'";
        $stmt1 = mysqli_prepare($conn, $update);


        mysqli_stmt_execute($stmt1);

        $check1 = mysqli_stmt_affected_rows($stmt1);
        if ($check1 == 1) {
            $msg1 = 'Data Successfullly UPloaded';
            header("Location:UpdateInterest.php");
        } else {
            $msg1 = 'Error uploading Data';
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
                                    <h4 class="card-title">Interest Rates</h4>

                                    <div class="table-responsive pt-3">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Interest ID
                                                    </th>
                                                    <th>
                                                        Loan Type
                                                    </th>
                                                    <th>
                                                        Months
                                                    </th>
                                                    <th>
                                                        Interest Rate
                                                    </th>
                                                    <th>
                                                        Last Updated Date
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM interest_rates ";
                                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                $k = 0;
                                                while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $record['ID']; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $record['Loan_Type']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Months']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['Interest_Rate']; ?>%

                                                        </td>

                                                        <td>
                                                            <?php echo $record['UpdatedDate']; ?>
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










                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">

                                    <form class="form-sample" action="" id="memberAccount" method="POST" target="_parent">
                                        <h4 class="">Update Loan Interest Rate<br></h4><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">


                                                    <label class="col-sm-3 col-form-label">Interest ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="rateID" id="rateID" onkeypress='validate(event)' value="<?php echo isset($_POST['rateID']) ? $_POST['rateID'] : '' ?>" />
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

                                                                $("#rateID").keypress(function(e) {
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
                                            <?php
                                            if (isset($_POST['searchmember'])) {
                                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                                    $valueToSearch = $_POST['rateID'];
                                                    // search in all table columns
                                                    // using concat mysql function
                                                    $sql = "SELECT * FROM interest_rates WHERE ID= '$valueToSearch '";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                    $record = mysqli_fetch_assoc($resultset);

                                            ?>


                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Loan Type</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="Loan_Type" value="<?php echo $record["Loan_Type"]; ?>" readonly />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Months</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="Months" value="<?php echo $record["Months"]; ?>" readonly />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Interest Rate %</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="Interest_Rate" value="<?php echo $record["Interest_Rate"]; ?> " />

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2" name="updateInterest">Update</button>
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