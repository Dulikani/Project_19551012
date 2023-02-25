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
error_reporting(0);


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
                                    <h3 class="card-title">Generate Reports</h3>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">select the report type</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="accountType" id="accountType">
                                                <option value="1">Reports on loan given</option>
                                                <option value="2">Reports of accounts created</option>
                                                <option value="3">Reports of monthly donations given</option>
                                                <option value="4">Personal Transaction Report</option>
                                                <option value="5">Bank Transaction Report</option>

                                            </select><br>

                                        </div>
                                        <label class="col-sm-3 col-form-label">From Date</label>
                                        <div class="col-sm-9">

                                            <input type="date" id="from" class="form-control" required>
                                        </div>
                                        <label class="col-sm-3 col-form-label">To Date</label>
                                        <div class="col-sm-9">

                                            <input type="date" id="to" class="form-control" required>
                                        </div>


                                        <button type="submit" id="proceed" class="btn btn-warning mr-2" onclick="Openform();">Proceed</button>

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
        function Openform() {

            const proceed = document.getElementById('proceed');


            var selectElement = document.querySelector('#accountType');
            var output = selectElement.value;

            var from = document.getElementById("from").value;
            var to = document.getElementById("to").value;

            var someDateYear = new Date();
            var todate = someDateYear.toISOString().substr(0, 10);
           

            if (from != "" && to != "") {
                if (from < todate && to <= todate) {
                    if(from < to){

                if (output == "1") {

                    var from = document.getElementById("from").value;
                    var to = document.getElementById("to").value;
                    localStorage.setItem("from", from);
                    localStorage.setItem("to", to);
                    window.location.href = 'Reports/loansGiven.php?from=' + from + '&to=' + to;

                } else if (output == "2") {
                    var from = document.getElementById("from").value;
                    var to = document.getElementById("to").value;
                    localStorage.setItem("from", from);
                    localStorage.setItem("to", to);
                    window.location.href = 'Reports/accountCreation.php?from=' + from + '&to=' + to;

                } else if (output == "3") {
                    var from = document.getElementById("from").value;
                    var to = document.getElementById("to").value;
                    localStorage.setItem("from", from);
                    localStorage.setItem("to", to);
                    window.location.href = 'Reports/donationReport.php?from=' + from + '&to=' + to;


                } else if (output == "4") {
                    var accountType = document.getElementById("accountType").value;
                    var from = document.getElementById("from").value;
                    var to = document.getElementById("to").value;
                    localStorage.setItem("from", from);
                    localStorage.setItem("to", to);
                    localStorage.setItem("accountType", accountType);

                    window.location.href = 'PersonalTransactionReport.php?from=' + from + '&to=' + to + '&accType=' + accountType;

                } else if (output == "5") {
                    var from = document.getElementById("from").value;
                    var to = document.getElementById("to").value;
                    localStorage.setItem("from", from);
                    localStorage.setItem("to", to);
                    window.location.href = 'Reports/BankTransactionReport.php?from=' + from + '&to=' + to;



                }
            }
            else{
                alert("From date should be lesser than to date");
            }
            }
            else{
                alert("Invalid period");
            }
            } else {
                alert("Enter Period");
            }





            // if (memberAccount.style.display === 'none') {
            //     form.style.display = 'block';
            // } else {
            //     form.style.display = 'none';
            // }



        }
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