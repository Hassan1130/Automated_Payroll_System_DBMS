<?php
   require_once 'config.php';
   $salary=$_POST['basic-salary'];
   $bank=$_POST['bank'];
   $bonus=$_POST['bonus'];
   $id=$_POST['id'];
  
   $sql = "UPDATE `salary_info` SET `base_salary` = '$salary',
   
                                 `bank_acc` = '$bank',
                                 `bonus_percentage` = '$bonus'
                                 
    WHERE `emp_id` = '$id'";
    $result = $conn->query($sql);
    if($result)
    {
        
        header('Location:update_employee.php' . '?emp_id=' . $id);

    }
    else
    {
        echo '<script>alert("Profile Not Updated")</script>';

    }
   

?>