<!-- INSERT INTO `emp_info` (`emp_id`, `email`, `password`, `name`, `designation`, `joining_date`, `address`, `mobile`) VALUES (NULL, 'abc@abc.com', '123456', 'abc def', 'gp', CURRENT_DATE(), 'chattorgram', '01714311157'); -->
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
  $sql = "SELECT * FROM `emp_info` WHERE email='$email' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc() ;


    if(isset($_POST['name']))
    {
      $name=$_POST['name'];
      $email1=$_POST['email'];
      $address=$_POST['address'];
      $mobile=$_POST['mobile'];
      $designation=$_POST['designation'];
      $salary=$_POST['salary'];
      $bonus=$_POST['bonus'];
      $bank=$_POST['bank'];
      $sql1="INSERT INTO `emp_info` ( `email`, `password`, `name`, `designation`, `joining_date`, `address`, `mobile`) VALUES ( '$email1', '123456', '$name', '$designation', CURRENT_DATE(), '$address', '$mobile');";
      $result1=$conn->query($sql1);
      if($result1)
    {
      $sql2 = "SELECT * FROM `emp_info` WHERE email='$email1' ORDER BY `emp_id` DESC LIMIT 1";
      $result2 = $conn->query($sql2);
      $row2 = $result2->fetch_assoc() ;
      $id=$row2['emp_id'];
  
      $sql3="INSERT INTO `user` (`emp_id`, `email`, `password`, `role`) VALUES ('$id', '$email1', '123456', 'User')";
      $result3 = $conn->query($sql3);

      $sql4="INSERT INTO `salary_info` (`emp_id`, `base_salary`, `bank_acc`, `salary_month`, `bonus_percentage`) VALUES ('$id', '$salary', '$bank', '0', '$bonus');";
      $result4=$conn->query($sql4);
       echo "<script>alert('Employee Added')</script>";
    }



    }


      
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
  <!--font awsome-->
  <script src="https://kit.fontawesome.com/5448101bd9.js" crossorigin="anonymous"></script>
  <!--css link-->
  <link rel="stylesheet" href="./css/addemployee.css">
  <link rel="stylesheet" href="./css/navbar_footer_style.css">
  <title>addemployee</title>

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

        echo '<p class="fw-bold fs-5 me-3 ">' . $row['name'] . '</p>';
      ?>
      
      <a href="logout.php" class="text-decoration-none" onclick="return confirm('Are you sure you want to log out?')"> <button class="btn btn-outline-danger" type="button">Log Out</button></a>
   </div>
  </div>
</nav>
  <div class="container">
    <!--Main div-->
    <div class=" main_div shadow w-50 mx-auto py-5">
      <h2 style="text-align: center;">ADD NEW EMPLOYEE</h2>
      <!--personal-->
      <div class="Data card  px-5 py-1 justify-content-center">
        <div>
            <form action="add_employee.php" method="post">
              <label for="username"> Name:</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="name" id="name" placeholder="Enter Name"><br>
              <label for="username"> Email:</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="email" id="email"
                placeholder="Enter Email"><br>
              <label for="username"> Address:</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="address" id="address"
                placeholder="Enter Address"><br>
              <label for="username"> Number:</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="mobile" id="mobile"
                placeholder="Enter Phone Number"><br>
              <label for="username"> Designation:</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="designation" id="designation"
                placeholder="Enter Designation"><br>
              <label for="username"> Salary:</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="salary" id="salary"
                placeholder="Enter Salary"><br>
              <label for="username"> Bonus :</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="bonus" id="bonus"
                placeholder="Enter Bonus percentage"><br>
              <label for="username"> Bank :</label>
              <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="bank" id="bank"
                placeholder="Enter Bank Account"><br>
              <button class="mx-auto btn btn-outline-light shadow rounded-pill px-5 " onclick=""
                style="background-color: rgb(168, 147, 120);">SUBMIT</button>

            </form>
        </div>
      </div>

    </div>
  </div>

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
</body>

</html>