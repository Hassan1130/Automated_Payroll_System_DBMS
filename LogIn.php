<?php 
  if(isset($_POST['email']))
  {
    session_start();
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $role=$_POST['optradio'];
   
    require_once "config.php";

    $sql = "SELECT * FROM `user` WHERE email='$email' AND role='$role'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      
     $row = $result->fetch_assoc() ;
     if($row['password'] != $pass)
     {
        echo '<script>alert("Wrong PassWord")</script>';
     }
     else
     {
      $_SESSION['user'] = $row;

        if($role=='Admin')
        {
          header("Location: welcome_admin.php");
        }
        else
        {
          header("Location: welcome_employee.php");
        }
     }
          
      
  } else {
    echo '<script>alert("You are not a ' . $role . '")</script>';
     
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
    <link rel="stylesheet" href="./css/login_loan-style.css">
    <title>LogIn</title>

    </head>
    <body>
        <div class="container">
            <!--Main div-->
            <div class="row main_div shadow">
                <!--welcome-->
                    <div class="Data card col-7 px-5 py-1 justify-content-center">
                        <div>
                       <h1 style="text-align: center;">Welcome to website</h1>
                       <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim, nobis ipsa ipsum reprehenderit obcaecati totam ab voluptates ea, atque maxime voluptatem quam voluptas sunt neque iste adipisci temporibus consequatur animi aut magnam soluta! Totam commodi obcaecati autem vitae sint unde deserunt. Quasi animi labore necessitatibus eius unde omnis cumque voluptatem!</p>
                        </div>
                    </div>
                    <!--LogIn-->
                    <div class="Login card col-5 p-3 justify-content-center ">
                        <div class="d-flex flex-column justify-content-evenly">
                          <h3 style="text-align: center;">LOGIN</h3>
                          <form class="d-flex flex-column justify-content-evenly" action="LogIn.php" method="post"> 
                          <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="email" id="email" placeholder="Enter your email">
                          <input class="w-75 m-auto my-2 px-3 py-1 rounded-pill" name="password" id="password" placeholder="Enter your Password">
                          <div class="w-75 mx-auto">
                            <!--Radio_button      -->
                            <div class="d-flex flex-row justify-content-evenly p-3">
                                   <div class="form-check">
                                    <input type = "radio" class = "form-check-input" id = "admin" name = "optradio" value = "Admin" checked>  
                                    <label class = "form-check-label" for = "btn1"> Admin </label>  
                                    </div>  
                                    <div class = "form-check">  
                                    <input type = "radio" class = "form-check-input" id = "user" name = "optradio" value = "User">  
                                    <label class = "form-check-label" for = "btn2">User</label>  
                                    </div>   

                                 </div>
                          
                          </div>
                          
                            <button class="mx-auto btn btn-outline-light shadow rounded-pill px-5 " onclick="">LOGIN</button>
                          
                          </form>
                          
                        </div>
                      </div>
                      </div>


            

        </div>
         <!--Footer-->
         <footer>
            <div>
              <div>
                <h3>Automated Payroll System</h3>
                <p> An automated payroll system is software that calculates salaries, deductions, and taxes, generates
                  paychecks, and maintains records, streamlining the process and ensuring accuracy in employee payments
                  and tax compliance.</p>
                <div>
                  <ul class=”socials”>
                    <li><img src="./logos/367582_facebook_social_icon.png" alt="" width="35" height="35"
                        class=""></li>
                    <li><img src="./logos/5305170_bird_social media_social network_tweet_twitter_icon.png" alt="" width="35"
                        height="35" class="d-inline-block align-text-top "></li>
                    <li><img src="./logos/5282542_linkedin_network_social network_linkedin logo_icon.png" alt="" width="35"
                        height="35" class="d-inline-block align-text-top "></li>
                    <li><img src="./logos/5279112_camera_instagram_social media_instagram logo_icon.png" alt="" width="35"
                        height="35" class="d-inline-block align-text-top "></li>
        
                  </ul>
                </div>
                <h3>Copyright @ 2024 by The Great Group Of Lazys</h3>
              </div>
            </div>
        
        
          </footer>
    </body>
</html>