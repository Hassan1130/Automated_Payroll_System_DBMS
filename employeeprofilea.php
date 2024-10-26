<?php
  session_start();  

  if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];  
  } else {
      header("Location: login.php");
      exit();
  }
  require_once "config.php";
  $email=$user['email'];
  $eId=$user['emp_id'];
  $sql = "SELECT * FROM `emp_info` WHERE emp_id='$eId' ";
  $sql1="SELECT * FROM `salary_info` WHERE emp_id='$eId' ";
  $sql2="SELECT emp_id, SUM(loan_ammount) as total_loan_amount, SUM(loan_period) as total_loan_period 
FROM `loan` 
WHERE emp_id='$eId' AND loan_status='Accepted'";
  $sql3="SELECT * FROM `user` where emp_id='$eId'";
    $result = $conn->query($sql);
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);

    $row = $result->fetch_assoc() ;
    $row1 = $result1->fetch_assoc() ;
    $row2 = $result2->fetch_assoc() ;
    $row3 = $result3->fetch_assoc() ;

   if(isset($_POST['employee-name']))
   {
       $name=$_POST['employee-name'];
       $email=$_POST['email'];
       $mobile=$_POST['phone'];
       $address=$_POST['address'];
       $id=$_POST['employee-id'];
       $pass=$_POST['pass'];
       $sql = "UPDATE `emp_info` SET `mobile` = '$mobile',
       
                                     `name` = '$name',
                                     `address` = '$address',
                                     `email` = '$email'
        WHERE `emp_info`.`emp_id` = '$id'";
         $sql1 = "UPDATE `user` SET `email` = '$email',
       
         `password` = '$pass'
        WHERE `emp_id` = '$id'";
        $result = $conn->query($sql);
        $result = $conn->query($sql1);
        if($result)
        {
            echo '<script>alert("Profile Updated")</script>';
            Header('Location: '.$_SERVER['PHP_SELF']);

        }
        else
        {
            echo '<script>alert("Profile Not Updated")</script>';

        }
       
   }
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Account - Automated Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/employeeP_styles.css">
    <link rel="stylesheet" href="./css/navbar_footer_style.css">

</head>
<body style="background-color:#ffed;">
    
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <?php 
     if($user['role']=='Admin')
     {
        echo '<a class="navbar-brand" href="welcome_admin.php">';
     }
     else
     {
        echo '<a class="navbar-brand" href="welcome_employee.php">';
     }
  
  ?>
    
    <img src="./logos/logo.jpg" alt="" width="35" height="35"
  class=" align-text-top ">  
    Automated Payroll System</a>
    <div class="d-flex">
      <?php

        echo '<p class="fw-bold fs-5 me-3 mt-2">' . $row['name'] . '</p>';
      ?>
      
      <a href="logout.php" class="text-decoration-none" onclick="return confirm('Are you sure you want to log out?')"> <button class="btn btn-outline-danger" type="button">Log Out</button></a>
   </div>
  </div>
</nav>
   <!-- main part -->
    <main>
        <div class="grid-container">
         <section id="profile">
            <h2>Employee Profile</h2>
            <form action="employeeprofilea.php" method="post">

                
                <div class="form-group">
                    <label for="employee-id">Employee ID:</label>
                    <input type="number" id="employee-id" name="employee-id" readonly value="<?php echo htmlspecialchars($row['emp_id']); ?>" ><br>
                </div>
                <div class="form-group">
                    <label for="employee-name">Name(editable):</label>
                    <input type="text" id="employee-name" name="employee-name" value="<?php echo htmlspecialchars($row['name']); ?>" ><br>
                </div>
                <div class="form-group">
                    <label for="department">Designation:</label>
                    <input type="text" id="department" name="department" readonly value="<?php echo htmlspecialchars($row['designation']); ?>"><br>
                </div>
                <div class="form-group">
                    <label for="email">Email(editable):</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" ><br>
                </div>
                <div class="form-group">
                    <label for="pass">Password(editable):</label>
                    <input type="text" id="pass" name="pass" value="<?php echo htmlspecialchars($row3['password']); ?>" ><br>
                </div>
                <div class="form-group">
                    <label for="phone">Phone(editable):</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['mobile']); ?>" ><br>
                </div>
                <div class="form-group">
                    <label for="address">Adress(editable):</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" ><br>
                </div>
                <div class="form-group">
                    <label for="join">Joining Date:</label>
                    <input type="text" id="join" name="join" value="<?php echo htmlspecialchars($row['joining_date']); ?>" ><br>
                </div>
                <button type="submit" onclick="return confirm('Are you sure you want to Update?')">Update Profile</button>
            </form>
          </section>
          <section id="salary">
            <h2>Salary Information</h2>
            <form>
                <label for="basic-salary">Basic Salary:</label>
                <input type="text" id="basic-salary" name="basic-salary" readonly value="<?php echo htmlspecialchars($row1['base_salary']); ?>" ><br>
                <label for="allowances">Bank Acc:</label>
                <input type="text" id="bank" name="bank" readonly value="<?php echo htmlspecialchars($row1['bank_acc']); ?>"><br>
                <label for="deductions">Loan:</label>
                <input type="text" id="deductions" name="deductions" readonly value="<?php echo htmlspecialchars(isset($row2['total_loan_amount']) ? $row2['total_loan_amount'] : 0); ?>"><br>
                <label for="loan">Loan Period:</label>
                <input type="text" id="loan" name="loan" readonly value="<?php echo htmlspecialchars(isset($row2['total_loan_period']) ? $row2['total_loan_period'] : 0); ?>"><br>
                <label for="month">Salary Month:</label>
                <input type="text" id="month" name="month" readonly value="<?php echo htmlspecialchars($row1['salary_month']); ?>"><br>
                <label for="bonus">Bonus Percentage:</label>
                <input type="text" id="bonus" name="bonus" readonly value="<?php echo htmlspecialchars($row1['bonus_percentage']); ?>"><br>
                
            </form>
          </section>
        </div>
        <section id="leave" class="m-2">
            <h2>Finance Report</h2>
            <table class="square-table">
    <thead>
        <tr>
            <th>finance_id</th>
            <th>trx_salary</th>
            <th>trx_time</th>
            <th>leaves</th>
            <th>overtime</th>
            <th>bonus_given</th>
            <th>deduction</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql4= "SELECT * FROM `financial_info` where emp_id='$eId'";
        $result4=$conn->query($sql4);
        if($result4->num_rows > 0){

            while($row4 = $result4->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row4['finance_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row4['trx_salary']) . "</td>";
                echo "<td>" . htmlspecialchars($row4['trx_time']) . "</td>";
                echo "<td>" . htmlspecialchars($row4['leaves']) . "</td>";
                echo "<td>" . htmlspecialchars($row4['overtime']) . "</td>";
                echo "<td>" . htmlspecialchars($row4['bonus_given']) . "</td>";
                echo "<td>" . htmlspecialchars($row4['deduction']) . "</td>";
                echo "</tr>";
            }
        }
        
        ?>
    </tbody>
</table>
        </section>
    
    </main>
    <footer>
    <div>
        <div>
            <h3>Automated Payroll System</h3>
            <p> An automated payroll system is software that calculates salaries, deductions, and taxes, generates
                paychecks, and maintains records, streamlining the process and ensuring accuracy in employee
                payments and tax compliance.</p>
            <div>
                <ul class=”socials”>
                    <li><img src="./logos/367582_facebook_social_icon.png" alt="" width="35" height="35"
                            class="d-inline-block align-text-top "></li>
                    <li><img src="./logos/5305170_bird_social media_social network_tweet_twitter_icon.png" alt=""
                            width="35" height="35" class="d-inline-block align-text-top "></li>
                    <li><img src="./logos/5282542_linkedin_network_social network_linkedin logo_icon.png" alt=""
                            width="35" height="35" class="d-inline-block align-text-top "></li>
                    <li><img src="./logos/5279112_camera_instagram_social media_instagram logo_icon.png" alt=""
                            width="35" height="35" class="d-inline-block align-text-top "></li>

                </ul>
            </div>
            <h3>Copyright @ 2024 by The Great Group Of Lazys</h3>
        </div>
    </div>


</footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
