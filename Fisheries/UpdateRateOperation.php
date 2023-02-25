<?php
include_once("db_connect.php");

$RateID = $_GET['id'];

if (isset($_GET['submit'])){

        $rate = $_POST['IntRate'];
       
        

        $update = "UPDATE interest_rates SET Interest_Rate='$rate' where ID='$RateID'";
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
?>
