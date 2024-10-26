<?php

 if(isset($_POST['amount']))
 {
    session_start();  

  if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];  
  } else {
      header("Location: login.php");
      exit();
  }
  require_once "config.php";
  
  $eId=$user['emp_id'];
    
    $amount=$_POST['amount'];
    $period=$_POST['period'];
    $emi=$amount/$period;
    $sql="INSERT INTO `loan` ( `emp_id`, `loan_ammount`, `loan_period`, `loan_status`, `emi`) VALUES ( '$eId', '$amount', '$period', 'Pending', '$emi');";
    $result=$conn->query($sql);

    echo "<script>alert('Applied For loan')</script>";
    if($user['role']=='User')
    {
        header("Location: welcome_employee.php");

    }
    else
    {
        header("Location: welcome_admin.php");

    }

 }


?>