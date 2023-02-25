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
                                    <h3 class="card-title">Member Transaction Report</h3>
                                    <div class="form-group row">
                                        <?php
                                        $fromMIS = array_key_exists('from', $_GET) ? $_GET['from'] : '';
                                        $toMIS = array_key_exists('to', $_GET) ? $_GET['to'] : '';

                                        ?>



                                        <br>


                                        <label class="col-sm-3 col-form-label">From Date</label>
                                        <div class="col-sm-9">

                                            <input type="text" value="<?php echo $fromMIS; ?>" class="form-control" id="from" readonly>
                                        </div>
                                        <label class="col-sm-3 col-form-label">To Date</label>
                                        <div class="col-sm-9">

                                            <input type="text" value="<?php echo $toMIS; ?>" class="form-control" id="to" readonly>
                                        </div>
                                        <label class="col-sm-3 col-form-label">Account Number</label>
                                        <div class="col-sm-9">

                                            <input type="text" id="accNo" class="form-control">
                                        </div>

                                        <button type="submit" id="proceed" class="btn btn-warning mr-2" onclick="Openform1();">Proceed</button>

                                    </div>
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

            // const proceed = document.getElementById('proceed');



            var accNo1 = document.getElementById("accNo").value;

            var from1 = document.getElementById("from").value;

            var to1 = document.getElementById("to").value;

            window.location.href = 'Reports/TransactionReport.php?from=' + from1 + '&to=' + to1 + '&accNo=' + accNo1;


            // if (memberAccount.style.display === 'none') {
            //     form.style.display = 'block';
            // } else {
            //     form.style.display = 'none';
            // }



        }


        // if (memberAccount.style.display === 'none') {
        //     form.style.display = 'block';
        // } else {
        //     form.style.display = 'none';
        // }
    </script>





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