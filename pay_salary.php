

<?php
  session_start();  

  if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];  
  } else {
      header("Location: login.php");
      exit();
  }
  require_once "config.php";
  $eId1=$user['emp_id'];

  $sql3 = "SELECT * FROM `emp_info` WHERE emp_id='$eId1' ";
    $result3 = $conn->query($sql3);
    $row3 = $result3->fetch_assoc() ;

    $eId=$_GET['emp_id'];

    $sql = "SELECT * FROM `emp_info` WHERE emp_id='$eId' ";
    $sql1="SELECT * FROM `salary_info` WHERE emp_id='$eId' ";
    $sql2="SELECT SUM(emi) as emi FROM `loan` where emp_id='$eId' AND loan_status='Accepted' AND loan_ammount>0;";
      $result = $conn->query($sql);
      $result1 = $conn->query($sql1);
      $result2 = $conn->query($sql2);
  
      $row = $result->fetch_assoc() ;
      $row1 = $result1->fetch_assoc() ;
      $row2 = $result2->fetch_assoc() ;

      
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee - Automated Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/employeeP_styles.css">
    <link rel="stylesheet" href="./css/navbar_footer_style.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="welcome_admin.php">
    <img src="./logos/logo.jpg" alt="" width="35" height="35"
  class=" align-text-top ">  
    Automated Payroll System</a>
    <div class="d-flex">
      <?php

        echo '<p class="fw-bold fs-5 me-3 mt-2">' . $row3['name'] . '</p>';
      ?>
      
      <a href="logout.php" class="text-decoration-none" onclick="return confirm('Are you sure you want to log out?')"> <button class="btn btn-outline-danger" type="button">Log Out</button></a>
   </div>
  </div>
</nav>
    <main>
        <div class="grid-container">
        <section id="profile">
            <h2>Calculate Salary </h2>
            <form>
                <div class="form-group">
                    <label for="employee-id">Employee ID:</label>
                    <input type="text" id="employee-id" name="employee-id" value="<?php echo htmlspecialchars($row['emp_id']); ?>"  readonly ><br>
                </div>
                <div class="form-group">
                    <label for="employee-name">Name:</label>
                    <input type="text" id="employee-name" name="employee-name"
                    value="<?php echo htmlspecialchars($row['name']); ?>" readonly  ><br>
                </div>
                <div class="form-group">
                    <label for="Salary">Salary:</label>
                    <input type="text" id="Salary" name="Salary"
                    value="<?php echo htmlspecialchars($row1['base_salary']); ?>" readonly ><br>
                </div>
                <div class="form-group">
                    <label for="Month">Salary Month:</label>
                    <input type="text" id="Month" name="Month"
                    value="<?php echo htmlspecialchars($row1['salary_month']); ?>" readonly ><br>
                </div>
                <div class="form-group">
                    <label for="Percentage">Bonus Percentage:</label>
                    <input type="text" id="Percentage" name="Percentage"
                    value="<?php echo htmlspecialchars($row1['bonus_percentage']); ?>" readonly ><br>
                </div>
                <div class="form-group">
                    <label for="Emi">Loan Emi:</label>
                    <input type="text" id="Emi" name="Emi"
                    value="<?php echo htmlspecialchars($row2['emi']); ?>" readonly ><br>
                </div>
                <div class="form-group">
                    <label for="Leave">Leave:</label>
                    <input type="text" id="Leave" name="Leave" ><br>
                </div>
                <div class="form-group" style="margin-top: 10px;margin-bottom: 10px;">
                    <label for="bonus">Give Bonus:</label>
                    <select id="bonus" name="bonus" style="padding-left: 10px; padding-right: 10px;">
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Overtime">Overtime Hour:</label>
                    <input type="text" id="Overtime" name="Overtime" ><br>
                </div>
                <button type="submit">Calculate Salary</button>
            </form>
        </section>
        <section id="salary">
            <h2>Salary Information</h2>
            <form  action="pay_salary_amount.php" method="post">
                <label for="Id">Employee Id:</label>
                <input type="text" id="Id" name="Id" readonly><br>
                <label for="tSalary">Total Salary:</label>
                <input type="text" id="tSalary" name="tSalary" readonly ><br>
                <label for="Bonus">Bonus:</label>
                <input type="text" id="Bonus" name="Bonus" readonly ><br>
                <label for="deductions">Deductions:</label>
                <input type="text" id="deductions" name="deductions" readonly><br>
                <label for="loan">Loan Paid:</label>
                <input type="text" id="loan" name="loan" readonly><br>
                <label for="Leaves">Leaves:</label>
                <input type="text" id="Leaves" name="Leaves" readonly><br>
                <label for="time">Overtime:</label>
                <input type="text" id="time" name="time" readonly><br>
                <button type="submit" onclick="return confirm('Pay Salary?')">Give Salary</button>
            </form>
        </section>
        </div>
       
    
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
    <script src="./pay_salary.js"></script>
</body>
</html>
