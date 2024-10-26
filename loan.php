<!-- INSERT INTO `loan` (`loan_id`, `emp_id`, `loan_ammount`, `loan_period`, `loan_status`, `emi`) VALUES (NULL, '2', '10000', '2', 'Pending', '5000'); -->

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

    $sql1 = "SELECT * FROM `loan`  ";
    $result1 = $conn->query($sql1);


      
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
    <link rel="stylesheet" href="../css/login_loan-style.css">
    <link rel="stylesheet" href="./css/navbar_footer_style.css">

    <title>Loan Details</title>
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

        echo '<p class="fw-bold fs-5 me-3 mt-2">' . $row['name'] . '</p>';
      ?>
      
      <a href="logout.php" class="text-decoration-none" onclick="return confirm('Are you sure you want to log out?')"> <button class="btn btn-outline-danger" type="button">Log Out</button></a>
   </div>
  </div>
</nav>


    <div class="container">
        <table class="table table-hover mt-5">
            <thead class="tab_head">
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Loan Amount</th>
                    <th scope="col">Loan Length</th>
                    <th scope="col">Loan Status</th>
                    <th scope="col">Action-1</th>
                    <th scope="col">Action-2</th>
                </tr>
            </thead>
            <tbody id="loanDetails">
          <?php  if ($result1->num_rows > 0) {
    
    while ($row1 = $result1->fetch_assoc()) {
        echo "<tr class='tab_body'>";
        echo "<th scope='row'>" . $row1['emp_id'] . "</th>";  // Employee ID
        echo "<td>" . $row1['loan_ammount'] . "</td>";        // Loan Amount
        echo "<td>" . $row1['loan_period'] . "</td>";         // Loan Period
        echo "<td>" . $row1['loan_status'] . "</td>";         // Loan Status
        if($row1['loan_status']=='Rejected')
        {
            echo "<td>
        <form method='POST' action='update_loan_status.php'>
            <input type='hidden' name='loan_id' value='" . $row1['loan_id'] . "'>
            <input type='hidden' name='status' value='Accepted'>
            <button type='submit' class='btn btn-success' disabled>Accept</button>
        </form>
      </td>";
        }
        else
        {

            echo "<td>
            <form method='POST' action='update_loan_status.php'>
                <input type='hidden' name='loan_id' value='" . $row1['loan_id'] . "'>
                <input type='hidden' name='status' value='Accepted'>
                <button type='submit' class='btn btn-success'>Accept</button>
            </form>
          </td>";
        }


        if($row1['loan_status']=='Accepted')
        {
            echo "<td>
            <form method='POST' action='update_loan_status.php'>
                <input type='hidden' name='loan_id' value='" . $row1['loan_id'] . "'>
                <input type='hidden' name='status' value='Rejected'>
                <button type='submit' class='btn btn-danger' disabled>Reject</button>
            </form>
          </td>";
    
        }
        else
        {
            echo "<td>
        <form method='POST' action='update_loan_status.php'>
            <input type='hidden' name='loan_id' value='" . $row1['loan_id'] . "'>
            <input type='hidden' name='status' value='Rejected'>
            <button type='submit' class='btn btn-danger'>Reject</button>
        </form>
      </td>";

        }
       

echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No loan records found</td></tr>";
}
?>
               
                
                </tbody>
        </table>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>