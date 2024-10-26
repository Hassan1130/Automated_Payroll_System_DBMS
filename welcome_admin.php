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
    $result = $conn->query($sql);
    $row = $result->fetch_assoc() ;


      
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/navbar_footer_style.css">
 
</head>

<body style="background-color:#ffed;">
  

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  
    <a class="navbar-brand">
    <img src="./logos/logo.jpg" alt="" width="35" height="35"
  class=" align-text-top ">  
    Automated Payroll System</a>
    <div class="d-flex">
      <?php

        echo '<p class="fw-bold fs-5 me-3">' . $row['name'] . '</p>';
      ?>
      
      <a href="logout.php" class="text-decoration-none" onclick="return confirm('Are you sure you want to log out?')"> <button class="btn btn-outline-danger" type="button">Log Out</button></a>
   </div>
  </div>
</nav>

  <!-- Main part -->
  <div class="container text-center pt-5">
    <h1 style="font-style: initial;">Welcome Admin</h1>
    <br>
    <!--dashboard-->
    <div class="row">
      <div class="col-6">
    <div class="container-fluid">
      <!--dash1side-->
    <div class="row">
      <div class="col-6">
              <div class="row-sm-4 shadow " style="background-color: #ffe8f5;padding: 10px;margin:1%; border-radius: 30%;">Total Cash
                <div>1095000 tk.</div>
             </div><br>

              <div class="row-sm-4 shadow" style="background-color:#f7e8ff;padding: 10px;margin: 1%; border-radius: 30%;">Total Cost
                <div>880440 tk.</div>
              </div><br>
              <div class="row-sm-4 shadow" style=" background-color:#e8f8ff;padding: 10px;margin: 1%;border-radius: 30%;">Total Salary
                <div>1000000 tk.</div>
              </div>
      </div>
           <!--dash2side-->  
            <div class="col-6">
                            <div class="row-sm-4 shadow" style=" background-color:#f0eec0;padding: 10px;margin: 1%;border-radius: 30%;">Salary Paid
                <div>0-80000 tk.</div>
              </div><br>
                <div class="row-sm-4 shadow" style=" background-color:#e4e1fa;padding: 10px;margin: 1%;border-radius: 30%;">Company Loan
                  <div>9500000 tk.</div>
                </div><br>
              <div class="row-sm-4 shadow" style="background-color: #d5ebe6;padding: 10px;margin: 1%;border-radius: 30%;">Total employee 
                <div>1000</div>
              </div>
                </div>
    </div>
    </div>
        <br>
      </div>
      <!--buttonside-->
   <div class="col-6">
      <div class="row">
      <div class="col">
       <a href="employeeprofilea.php"><button type="button" class="btn btn-outline-info btn-lg">My Profile </button></a> 
      </div>
    </div><br>

    <div class="row">
      <div class="col">
      <a href="allemployeea.php"><button type="button" class="btn btn-outline-info btn-lg">All Employee Information </button></a> 
      </div>
    </div>
    <br>

    <div class="row">
      <div class="col">
      <a href="add_employee.php">  <button type="button" class="btn btn-outline-info btn-lg"> Add Employee</button></a>
      </div>
    </div>
    <br>

    <div class="row">
      <div class="col">
      <a href="loan.php">
        <button type="button" class="btn btn-outline-info btn-lg"> Loan Review </button></a>
      </div>
      
    </div><br>
    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-outline-info btn-lg" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Apply Loan </button>
      </div>
      
    </div><br>
  </div><br></div>
  </div>

  <!-- Modal for loan application -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Loan Application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="applyloan.php" method="post">
      <div class="modal-body">
                <input type="hidden" id="emp_id" name="emp_id" value=<?php $eid ?> > 
                    <input class="mb-1 p-1 w-100" type="number" id="amount" name="amount" placeholder="Enter your desired Loan Amount"><br>  
                    <input class="mb-1 p-1 w-100" type="number" id="period" name="period" placeholder="Enter your desired Loan period"><br>
               
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Apply</button>
        </div>

      </form>
      
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</body>
</html>