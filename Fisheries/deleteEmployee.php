<?php
include_once("db_connect.php");
$sql = "DELETE FROM employee WHERE emp_ID='" . $_GET["emp_ID"] . "'";
if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Employee deleted successfully")</script>';

    header("Location: EditEmployee.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>