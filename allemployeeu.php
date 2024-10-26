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
    <title>Employee Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!--font awsome-->
    <script src="https://kit.fontawesome.com/5448101bd9.js" crossorigin="anonymous"></script>
    <!--css link-->
    <link rel="stylesheet" href="./css/navbar_footer_style.css">
</head>

<body >
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
        
          <a class="navbar-brand" href="welcome_employee.php">
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


    
           <!-- search Box -->
            
    
           <div >
                <div  style="margin-left: 15px; align-items: center;">
                    <div class="col-md-8 d-flex">
                        <div class="search" style="width: 500px;">
                            <i class="fa fa-search"></i>
                           
                            <form action="allemployeeu.php" method="post">
                                <input type="text" id="search" name="search" class="form-control" placeholder="Write your employe ID Or Name">
                            <button class=" button rounded" >Search</button>
                            </form>

                        </div>

                    </div>

                </div>
                <div style="margin-left: 15px;" class="w-100 row ">
                <?php
                               if(isset($_POST['search']))
                               {

                                $search=$_POST['search'];
                                if (is_numeric($search)) {
                                    
                                    $sql2 = "SELECT * FROM `emp_info` WHERE emp_id='$search'";
                                    $result = $conn->query($sql2);
                                if ($result->num_rows > 0) {
                                    // Loop through each result and display the card for each employee
                                    while ($row = $result->fetch_assoc()) {
                                        echo '
                                        <div class="card bg-light bg-gradient border rounded-3 col-4 mx-auto" style="width: 33%; padding: 0; margin-top: 10px;">
                                            <div class="d-flex">
                                                <div class="my-2 p-1">
                                                    <h6 class=""><b>Id: ' . $row["emp_id"] . '</b></h6>
                                                    <h6 style="font-size: small;">Name: ' . $row["name"] . '</h6>
                                                    <h6 style="font-size: small;">Designation: ' . $row["mobile"] . '</h6>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                } else {
                                    echo "<p>No employee found with the provided ID or name.</p>";
                                }
                                } elseif(strlen($search)>0) {
                                   
                                   $sql2 = "SELECT * FROM `emp_info` WHERE name LIKE '%$search%'";
                                   $result = $conn->query($sql2);
                                if ($result->num_rows > 0) {
                                    // Loop through each result and display the card for each employee
                                    while ($row = $result->fetch_assoc()) {
                                        echo '
                                        <div class="card bg-light bg-gradient border rounded-3 col-4 mx-auto" style="width: 33%; padding: 0; margin-top: 10px;">
                                            <div class="d-flex">
                                                <div class="my-2 p-1">
                                                    <h6 class=""><b>Id: ' . $row["emp_id"] . '</b></h6>
                                                    <h6 style="font-size: small;">Name: ' . $row["name"] . '</h6>
                                                    <h6 style="font-size: small;">Designation: ' . $row["mobile"] . '</h6>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                } else {
                                    echo "<p>No employee found with the provided ID or name.</p>";
                                }
                                }
                                
                              

                               }
                          
                
             
                            ?>

                </div>
            </div>
    
       <!-- search box end -->
    
       <div class="row mt-5">
       <?php
// Execute the query to fetch all rows from emp_info
$sql1 = "SELECT * FROM `emp_info`";
$result1 = $conn->query($sql1);

// Check if there are results
if ($result1->num_rows > 0) {
    // Loop through each row from the result set
    while ($row = $result1->fetch_assoc()) {
?>
        <div class="col-4 mx-auto mb-5" style="width: 33%;">
            <div class="card border p-3 shadow mx-auto" style="width: 18rem; padding: 0; border-radius: 20px; background-color:rgb(228, 237, 245)">
                <div class="d-flex">
                    <img class="rounded-circle float-left m-2 p-1 border border-1 border-secondary" style="width: 100px; height: 100px;" src="./logos/person.jpg" alt="Employee Image">
                    <div class="my-2">
                        <!-- Dynamically display employee details -->
                        <h6><b>ID: <?php echo $row['emp_id']; ?></b></h6>
                        <h6 style="font-size: small;"><?php echo $row['name']; ?></h6>
                        <h6 style="font-size: smaller;" class="text-muted"><?php echo $row['designation']; ?></h6>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Dynamically display salary and loan -->
                    <h5 class="card-title">Mobile: <span class="salary"><?php echo $row['mobile']; ?></span></h5>
                    <h5 class="card-title">Join: <?php echo $row['joining_date']; ?></h5>

                   
                </div>
            </div>
        </div>
<?php
    }
} else {
    // If no rows are returned, show a message
    echo "<p>No employees found.</p>";
}
?>


        
     
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
    <script src="./Javascript/employee.js"></script>
</body>

</html>



<!-- <div class="col-3 mx-auto" id="01">
            <div class="card bg-light bg-gradient border rounded-3 mx-auto" style="width: 18rem; padding: 0;">
                <div class="d-flex">
                 <img class="rounded-circle float-left m-2 p-1 border border-1 border-secondary " style="width: 100px; height: 100px;" src="" alt="">
                  <div class="my-2 ">
                     <h6><b>ID: 01</b></h6>
                    <h6 style="font-size: small;">Name Name</h6>
                    <h6 style="font-size: smaller;" class="text-muted">Software Developer</h6>
                
                  </div>
                </div>
                 <div class="card-body">
                     <h5 class="card-title">Salary: <span class="salary">45000</span> </h5>
                     <h5 class="card-title">Loan: <span class="loan">67500</span> </h5>
                     
                    <h5 class="card-title">Payable Salary: <span class="payableSalary">00</span></h5>
                    <h5 class="card-title">Salary Month: <span class="salaryMonth">00</span></h5>
                    <div class="text-center m-1 pt-2">
                     <a href="#" class="btn btn-outline-primary">Pay Salary</a>
                    </div>
                 </div>
             </div>
         </div> -->