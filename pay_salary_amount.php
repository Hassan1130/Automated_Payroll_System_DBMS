<?php
  require_once "config.php";
  if(isset($_POST['tSalary']))
      {
        $id=$_POST['Id'];
        $trx_salary=$_POST['tSalary'];
        $bonus=$_POST['Bonus'];
        $deduction=$_POST['deductions'];
        $loan=$_POST['loan'];
        $leaves=$_POST['Leaves'];
        $time=$_POST['time'];
        $sql= "INSERT INTO `financial_info` ( `emp_id`, `trx_salary`, `trx_time`, `leaves`, `overtime`, `bonus_given`,`deduction`) VALUES ( '$id', '$trx_salary', CURRENT_DATE(), '$leaves', '$time', '$bonus','$deduction');";
        $sql1="UPDATE salary_info SET salary_month=salary_month+1 WHERE emp_id='$id';";
        $sql2="UPDATE loan SET loan_ammount=loan_ammount-emi WHERE emp_id='$id' AND loan_status='Accepted' AND loan_ammount>0;";
        $result = $conn->query($sql);
      $result1 = $conn->query($sql1);
      $result2 = $conn->query($sql2);
  
     
      echo '<script>alert("Salary Paid")</script>';
      header('Location:pay_salary.php' . '?emp_id=' . $id);


        

      }?>