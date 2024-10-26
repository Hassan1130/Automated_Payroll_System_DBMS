<?php
$emp_id = $_GET['emp_id'];
require_once "config.php";


$sql1 = "DELETE FROM user WHERE emp_id = $emp_id";
$sql2 = "DELETE FROM salary_info WHERE emp_id = $emp_id";
mysqli_query($conn, $sql1);
mysqli_query($conn, $sql2);
$sql = "DELETE FROM emp_info WHERE emp_id = $emp_id";
mysqli_query($conn, $sql);
header('Location: allemployeea.php');
exit();
?>