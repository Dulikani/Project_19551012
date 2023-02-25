<?php
include_once("db_connect.php");

$donationID = $_GET['id'];

$sql = "SELECT * FROM member_donation where DonationID='$donationID'";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$k = 0;
$record = mysqli_fetch_assoc($resultset);

$MemberID = $record['MemberID'];
$AccountNo = $record['AccNo'];


$sql = "insert into donationtobod(DonationID,MemberID,AccountNo) values('$donationID','$MemberID','$AccountNo')";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_execute($stmt);

$check = mysqli_stmt_affected_rows($stmt);
if ($check == 1) {

        $update = "UPDATE member_donation SET Status='Sent BOD' where DonationID='$donationID'";
        $stmt1 = mysqli_prepare($conn, $update);


        mysqli_stmt_execute($stmt1);

        $check1 = mysqli_stmt_affected_rows($stmt1);
        if ($check1 == 1) {
                $msg1 = 'Data Successfullly UPloaded';
                header("Location:CreateDonationRequest.php");
        } else {
                $msg1 = 'Error uploading Data';
        }
        $msg = 'Data Successfullly UPloaded';
} else {
        $msg = 'Error uploading Data';
}




?>
