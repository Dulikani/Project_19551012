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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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

$msg = '';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $NIC = $_POST['NIC'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];

    $NICLenght = strlen($NIC);

    $sql1 = "SELECT COUNT(*) AS memCount FROM member WHERE nic='$NIC'";
    $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
    $record1 = mysqli_fetch_assoc($resultset1);


    $memCount = $record1['memCount'];

    if ($memCount == 0) {




        if ($NIC != "") {
            if ($NICLenght == 10 || $NICLenght == 12) {
                if ($fname != "") {
                    if ($lname != "") {
                        if ($gender != "") {
                            if ($dob != "") {
                                if ($telephone != "") {
                                    if ($address != "") {

                                        $newDate = date("Y-m-d", strtotime($dob));

                                        $dob = date("m/d/Y", strtotime($dob));

                                        $dob = explode("/", $dob);
                                        $age = (date("md", date("U", mktime(0, 0, 0, $dob[0], $dob[1], $dob[2]))) > date("md")
                                            ? ((date("Y") - $dob[2]) - 1)
                                            : (date("Y") - $dob[2]));


                                        $sql = "insert into member(nic,first_name,last_name,gender,birthdate,age,contact_no,addres) values('$NIC','$fname','$lname','$gender','$newDate','$age','$telephone','$address')";
                                        $stmt = mysqli_prepare($conn, $sql);


                                        mysqli_stmt_execute($stmt);

                                        $check = mysqli_stmt_affected_rows($stmt);
                                        if ($check == 1) {
                                            $msg = 'Data Successfullly UPloaded';
                                            echo '<script>alert("Member succesfully registered.")</script>';
                                        } else {
                                            $msg = 'Error uploading Data';
                                        }
                                    } else {
                                        echo '<script>alert("Enter Your Address")</script>';
                                    }
                                } else {
                                    echo '<script>alert("Enter your Mobile Number")</script>';
                                }
                            } else {
                                echo '<script>alert("Enter your Birthdate")</script>';
                            }
                        } else {
                            echo '<script>alert("Select Gender")</script>';
                        }
                    } else {
                        echo '<script>alert("Enter last name")</script>';
                    }
                } else {
                    echo '<script>alert("Enter Your First Name.")</script>';
                }
            } else {
                echo '<script>alert("Enter Valid NIC Number.")</script>';
            }
        } else {
            echo '<script>alert("Enter NIC Number.")</script>';
        }
    } else {
        echo '<script>alert("Member already registered.")</script>';
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
                                    <h4 class="card-title">Member Registration</h4>
                                    <form class="form-sample" action="" name="form1" method="POST">
                                        <p class="card-description">
                                            Personal info
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Member ID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">NIC</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="NIC" id="NIC" placeholder="Enter NIC" maxlength="12" minlength="10" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">First Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="fname" id="firstname" placeholder="Enter First Name" />
                                                    </div>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#firstname').keydown(function(e) {
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
                                                        <input type="text" class="form-control" name="lname" id="lastname" placeholder="Enter Last Name" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#lastname').keydown(function(e) {
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
                                                        <select class="form-control" name="gender">
                                                            <option>Male</option>
                                                            <option>Female</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Date of Birth</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control datepicker" placeholder="dd/mm/yyyy" id="datepicker" name="dob" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Telephone No</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Enter Mobile No" minlength="10" onkeypress='validate(event)' />
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
                                                        <input type="text" class="form-control" name="address" placeholder="Enter Adddress" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Register</button>
                                        <button class="btn btn-light"><a href="Dashboard.php" style="color:black;">Cancel</a></button>


                                    </form>
                                </div>
                            </div>
                        </div>












                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Registered Members</h4>




                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Member ID
                                                    </th>
                                                    <th>
                                                        NIC
                                                    </th>
                                                    <th>
                                                        First name
                                                    </th>
                                                    <th>
                                                        Last name
                                                    </th>
                                                    <th>
                                                        Gender
                                                    </th>
                                                    <th>
                                                        Birth Date
                                                    </th>
                                                    <th>
                                                        Age
                                                    </th>
                                                    <th>
                                                        Contact No
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM member";

                                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                    <tr>
                                                        <td class="py-1">
                                                            <?php echo $record['member_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['nic']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['first_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['last_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['gender']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['birthdate']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['age']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['contact_no']; ?>
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