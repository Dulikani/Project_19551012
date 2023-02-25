<?php
session_start();
unset($_SESSION["use"]);
header("Location:index.php");
?>