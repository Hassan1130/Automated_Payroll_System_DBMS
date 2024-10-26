<?php
 require_once "config.php";
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loan_id = $_POST['loan_id'];
    $new_status = $_POST['status'];

    $sql = "UPDATE `loan` SET `loan_status` = '$new_status' WHERE `loan_id` = '$loan_id'";

    $result = $conn->query($sql);

    

    header('Location: loan.php');
    exit;
}

?>