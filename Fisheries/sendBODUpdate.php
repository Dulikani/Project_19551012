<?php
include_once("db_connect.php");

$loanID = $_GET['id'];

$sql = "SELECT * FROM member_loan where LoanID='$loanID'";
$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$k = 0;
$record = mysqli_fetch_assoc($resultset);

$MemberID = $record['MemberID'];
$AccountNo = $record['AccountNo'];


$sql = "insert into loantobod(LoanID,MemberID,AccountNo) values('$loanID','$MemberID','$AccountNo')";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_execute($stmt);

$check = mysqli_stmt_affected_rows($stmt);
if ($check == 1) {

        $update = "UPDATE member_loan SET Approval='Sent BOD' where LoanID='$loanID'";
        $stmt1 = mysqli_prepare($conn, $update);


        mysqli_stmt_execute($stmt1);

        $check1 = mysqli_stmt_affected_rows($stmt1);
        if ($check1 == 1) {
                $msg1 = 'Data Successfullly UPloaded';
                header("Location:ViewLoan.php");
        } else {
                $msg1 = 'Error uploading Data';
        }
        $msg = 'Data Successfullly UPloaded';
} else {
        $msg = 'Error uploading Data';
}




?>
