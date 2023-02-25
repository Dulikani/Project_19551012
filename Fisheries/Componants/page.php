
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

session_start();

$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $NIC = $_POST['NIC'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];

    $NICLenght = strlen($NIC);
    $TelephoneLength = strlen($telephone);


    $sql1 = "SELECT COUNT(*) AS empCount FROM employee WHERE nic='$NIC'";
    $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
    $record1 = mysqli_fetch_assoc($resultset1);


    $empCount = $record1['empCount'];

    if ($empCount == 0) {
        if ($TelephoneLength == 10) {


            if ($NIC != "") {
                if ($NICLenght == 10 || $NICLenght == 12) {

                    $newDate = date("Y-m-d", strtotime($dob));

                    $dob = date("m/d/Y", strtotime($dob));

                    $dob = explode("/", $dob);
                    $age = (date("md", date("U", mktime(0, 0, 0, $dob[0], $dob[1], $dob[2]))) > date("md")
                        ? ((date("Y") - $dob[2]) - 1)
                        : (date("Y") - $dob[2]));


                    $sql = "insert into employee(nic,first_name,last_name,gender,birthdate,age,contact_no,addres,salary) values('$NIC','$fname','$lname','$gender','$newDate','$age','$telephone','$address','$salary')";
                    $stmt = mysqli_prepare($conn, $sql);


                    mysqli_stmt_execute($stmt);

                    $check = mysqli_stmt_affected_rows($stmt);
                    if ($check == 1) {
                        $msg = 'Data Successfullly UPloaded';
                        echo '<script>alert("Employee successfully added.")</script>';
                    } else {
                        $msg = 'Error uploading Data';
                    }
                } else {
                    echo '<script>alert("Enter Valid NIC Number.")</script>';
                }
            } else {
                echo '<script>alert("Enter NIC Number.")</script>';
            }
        } else {
            echo '<script>alert("Invalid phone number")</script>';
        }
    } else {
        echo '<script>alert("Employee already registered")</script>';
    }
}
?>


<?php
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


            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php
            include_once("Componants/NavBar.php");
            ?>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    


                <!--text add-->





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