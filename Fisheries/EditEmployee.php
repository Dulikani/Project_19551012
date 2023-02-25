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


            <?php

            if (isset($_POST['savechanges'])) {
                $msg = '';
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $emp_id = $_POST['emp_ID'];

                    $NIC = $_POST['NIC'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $gender = $_POST['gender'];
                    $dob = $_POST['dob'];
                    $telephone = $_POST['telephone'];
                    $address = $_POST['address'];
                    $salary = $_POST['salary'];


                    $newDate = date("Y-m-d", strtotime($dob));

                    $dob = date("m/d/Y", strtotime($dob));

                    $dob = explode("/", $dob);
                    $age = (date("md", date("U", mktime(0, 0, 0, $dob[0], $dob[1], $dob[2]))) > date("md")
                        ? ((date("Y") - $dob[2]) - 1)
                        : (date("Y") - $dob[2]));


                    $update = "UPDATE employee SET nic='$NIC',first_name='$fname',last_name='$lname',gender='$gender',birthdate='$newDate',age='$age',contact_no='$telephone',addres='$address',salary='$salary' where emp_ID='$emp_id'";
                    $stmt = mysqli_prepare($conn, $update);


                    mysqli_stmt_execute($stmt);

                    $check = mysqli_stmt_affected_rows($stmt);
                    if ($check == 1) {
                        $msg = 'Data Successfullly UPloaded';
                        echo '<script>alert("Employee successfully updated.")</script>';
                    } else {
                        $msg = 'Error uploading Data';
                    }
                }
            }
            ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Employee Details</h4>

                                    <p class="card-description">

                                    </p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="form-sample" action="" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Enter Employee ID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="valueToSearch" class="form-control" value="<?php echo isset($_POST['valueToSearch']) ? $_POST['valueToSearch'] : '' ?>" /><br>
                                                        <button type="submit" name="search" class="btn btn-warning mr-2">Search Employee</button>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_POST['search'])) {
                                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            $valueToSearch = $_POST['valueToSearch'];
                                            // search in all table columns
                                            // using concat mysql function
                                            $sql = "SELECT * FROM employee WHERE emp_ID= '$valueToSearch '";
                                            $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                            $record = mysqli_fetch_assoc($resultset);
                                            if (mysqli_num_rows($resultset) == 1) {

                                                $dobNew = $record['birthdate'];

                                    ?>





                                                <form class="form-sample" action="" method="POST">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">NIC</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="NIC" id="NIC" value="<?php echo $record['nic']; ?>" readonly required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">First Name</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $record['first_name']; ?>" readonly required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <script type="text/javascript">
                                                            $(document).ready(function() {
                                                                $('#fname').keydown(function(e) {
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
                                                                <label class="col-sm-3 col-form-label">Last Name</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $record['last_name']; ?>" readonly required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script type="text/javascript">
                                                            $(document).ready(function() {
                                                                $('#lname').keydown(function(e) {
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


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Gender</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" name="gender" id="gender" value="<?php echo $record['gender']; ?>" disabled="true" required>
                                                                        <?php if ($record['gender'] == "Male") {
                                                                        ?>
                                                                            <option selected value="Male">Male</option>
                                                                            <option value="Female">Female</option>
                                                                        <?php } else {
                                                                        ?>
                                                                            <option selected value="Female">Female</option>
                                                                            <option value="Male">Male</option>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" class="form-control" data-date-format="DD-MM-YYYY" name="dob" id="dob" value="<?php echo $dobNew; ?>" required readonly />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Telephone No</label>
                                                                <div class="col-sm-9">
                                                                    <input type="number" class="form-control" name="telephone" id="telephone" minlength="10" onkeypress='validate(event)' value="<?php echo $record['contact_no']; ?>" readonly required />
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

                                                            $("#telephone").keypress(function(e) {
                                                                var current_val = $(this).val();
                                                                var typing_char = String.fromCharCode(e.which);
                                                                if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                                    return false;
                                                                }

                                                            })
                                                        </script>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Address </label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $record['addres']; ?>" readonly required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Salary </label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="salary" id="salary" onkeypress='validate(event)' value="<?php echo $record['salary']; ?>" readonly required />
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

                                                            $("#salary").keypress(function(e) {
                                                                var current_val = $(this).val();
                                                                var typing_char = String.fromCharCode(e.which);
                                                                if (parseFloat(current_val + "" + typing_char) > 1800000000) {
                                                                    return false;
                                                                }

                                                            })
                                                        </script>
                                                    </div>
                                                    <input type="text" name="emp_ID" id="emp_ID" value="<?php echo $record['emp_ID']; ?>" hidden />
                                                    <button type="" class="btn btn-success mr-2" hidden id="savechange" name="savechanges">Save Changes</button>



                                                </form>
                                                <br><br>
                                                <button type="" class="btn btn-primary mr-2" id="myButton">Edit</button>
                                                <button type="" class="btn btn-danger mr-2" id="myButton" onclick="return confirm('Do you confirm this delete?')"> <a href="deleteEmployee.php?emp_ID=<?php echo $record["emp_ID"]; ?>" style="color:white">Delete Employee</a></button>

                                    <?php } else {
                                                echo '<script>alert("No Employee Found")</script>';
                                            }
                                        }
                                    } ?>




                                    <script>
                                        document.getElementById('myButton').onclick = function() {
                                            document.getElementById('NIC').removeAttribute('readonly');
                                            document.getElementById('salary').removeAttribute('readonly');
                                            document.getElementById('address').removeAttribute('readonly');
                                            document.getElementById('telephone').removeAttribute('readonly');
                                            document.getElementById('gender').removeAttribute('disabled');
                                            document.getElementById('lname').removeAttribute('readonly');
                                            document.getElementById('fname').removeAttribute('readonly');
                                            document.getElementById('dob').removeAttribute('readonly');

                                            document.getElementById('savechange').removeAttribute('hidden');


                                            var btn = document.getElementById('myButton');
                                            btn.disabled = true;
                                            var btn1 = document.getElementById('Delete');
                                            btn1.disabled = true;
                                            var btn2 = document.getElementById('ViewDependant');
                                            btn2.disabled = true;
                                            var btn3 = document.getElementById('AddDependant');
                                            btn3.disabled = true;
                                        };
                                    </script>

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