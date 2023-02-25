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
//error_reporting(0);

session_start();


$memberID = $_GET['memid'];

$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $relationship = $_POST['relationship'];
    $Disease = $_POST['Disease'];

    $newDate = date("Y-m-d", strtotime($dob));

    $dob = date("m/d/Y", strtotime($dob));

    $dob = explode("/", $dob);
    $age = (date("md", date("U", mktime(0, 0, 0, $dob[0], $dob[1], $dob[2]))) > date("md")
        ? ((date("Y") - $dob[2]) - 1)
        : (date("Y") - $dob[2]));


    $sql = "insert into member_dependant(member_ID,first_name,last_name,gender,birthdate,age,relationship,disease) values('$memberID','$fname','$lname','$gender','$newDate','$age','$relationship','$Disease')";
    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_execute($stmt);

    $check = mysqli_stmt_affected_rows($stmt);
    if ($check == 1) {
        $msg = 'Data Successfullly UPloaded';
        echo '<script>alert("Member Dependant successfully added.")</script>';
    } else {
        $msg = 'Error uploading Data';
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
                                    <h4 class="card-title">Add Member Dependent </h4>
                                    <form class="form-sample" action="" method="POST">
                                        <p class="card-description">
                                            Personal info
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Member ID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="memID" readonly value="<?php echo $memberID; ?>" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Dependent First Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="fname" id="fname" required />
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
                                                    <label class="col-sm-3 col-form-label">Dependent Last Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="lname" id="lname" required />
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
                                                        <select class="form-control" name="gender" required>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Date of Birth</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="dob" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Relationship</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="relationship" required>
                                                            <option value="Mother">Mother</option>
                                                            <option value="Father">Father</option>
                                                            <option value="Son">Son</option>
                                                            <option value="Daughter">Daughter</option>
                                                            <option value="Spouse">Spouse</option>
                                                            <option value="Mother-In-Low">Mother-In-Low</option>
                                                            <option value="Father-In-Low">Father-In-Low</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Disease Name </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="Disease" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Add Dependant</button>


                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Dependants</h4>




                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Dep ID
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
                                                        Relationship
                                                    </th>
                                                    <th>
                                                        Disease Name
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM member_dependant where member_ID='$memberID'";
                                                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                                $k = 0;
                                                while ($record = mysqli_fetch_assoc($resultset)) {
                                                ?>
                                                    <tr>
                                                        <td class="py-1">
                                                            <?php echo $record['dep_ID']; ?>
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
                                                            <?php echo $record['relationship']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $record['disease']; ?>
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