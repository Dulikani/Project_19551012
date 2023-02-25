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




if (isset($_POST['addUser'])) {

    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $userID = $_POST['empID'];
        $password = $_POST['password'];
        $previladge = $_POST['userType'];


        $sql1 = "SELECT COUNT(*) AS empCount FROM user_log WHERE user_id='$userID'";
        $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
        $record1 = mysqli_fetch_assoc($resultset1);


        $empCount = $record1['empCount'];

        if ($empCount == 0) {




            $sql = "insert into user_log(user_id,password,previladge) values('$userID','$password','$previladge')";
            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_execute($stmt);

            $check = mysqli_stmt_affected_rows($stmt);
            if ($check == 1) {
                $msg = 'Data Successfullly UPloaded';
                echo '<script>alert("User Login successfully added.")</script>';
            } else {
                echo '<script>alert("Data insert error.Try again.")</script>';
            }
        } else {
            echo '<script>alert("User Login already added")</script>';
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
                                    <h3 class="card-title">Manage User Logins</h3>

                                    <hr>
                                    <form class="form-sample" action="" id="addUser" method="POST" target="_parent">
                                        <h4 class="">Activate User Logins<br></h4><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">


                                                    <label class="col-sm-3 col-form-label">Employee ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" name="empID" id="empID" value="<?php echo isset($_POST['empID']) ? $_POST['empID'] : '' ?>" />
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
                                                    $valueToSearch = $_POST['empID'];

                                                    $sql = "SELECT * FROM employee WHERE emp_ID= '$valueToSearch '";
                                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                    $record = mysqli_fetch_assoc($resultset);
                                                    if (mysqli_num_rows($resultset) == 1) {

                                                        $sql1 = "SELECT * FROM employee WHERE emp_ID= '$valueToSearch '";
                                                        $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));




                                            ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">


                                                                <label class="col-sm-3 col-form-label">Employee NIC</label>
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <?php while ($record1 = mysqli_fetch_assoc($resultset1)) {

                                                                        ?>
                                                                            <div class="col">
                                                                                <input type="text" class="form-control" name="nic" id="nic" value="<?php echo $record1['nic'];  ?>" readonly />
                                                                            </div>



                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">


                                                    <label class="col-sm-3 col-form-label">Employee Name</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">

                                                            <div class="col">
                                                                <input type="text" class="form-control" name="empname" id="empname" value="<?php echo $record1['first_name'];  ?> <?php echo $record1['last_name']; ?>" readonly />
                                                            </div>



                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">


                                                    <label class="col-sm-3 col-form-label">Contact No</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">

                                                            <div class="col">
                                                                <input type="text" class="form-control" name="contactNo" id="contactNo" value="<?php echo $record1['contact_no'];  ?> " readonly />
                                                            </div>


                                                        <?php } ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">User Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="userType" required>
                                                            <option value="Admin">Administrator</option>
                                                            <option value="BOD">Board of Director</option>
                                                            <option value="Banking">Bank Manager</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Password</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" name="password" id="password" minlength="10" onkeypress='validate(event)' />

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

                                                $("#password").keypress(function(e) {
                                                    var current_val = $(this).val();
                                                    var typing_char = String.fromCharCode(e.which);
                                                    if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                        return false;
                                                    }

                                                })
                                            </script>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2" name="addUser">Activate</button>
                            <?php } else {
                                                        echo '<script>alert("No Employee Found")</script>';
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