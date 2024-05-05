<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="css/social-media.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/form.css">
    <title>sign up</title>
</head>
<body>
<div class="center">
<div class="item">
<h1>sign up</h1>
</div>
    <form action="sign_up.php" name="regform" method="post" >
    
    <?php
        include('connect.php');
          if(isset($_POST['createaccount'])){
              $fname =$_POST['fname'];
              $Lname =$_POST['lname'];
              $email =$_POST['email'];
              $phone =$_POST['phone'];
              $pass = $_POST['pass'];
              $DOB =  $_POST['DOB'];
              if(isset($_POST['gender'])){
                $gender = $_POST['gender'];
              }        
            if(!DB::query('SELECT Email FROM users WHERE Email = :Email',array(':Email'=>$email))){
                if(!empty($fname)||!empty($Lname)||!empty($email)||!empty($phone)||!empty($pass)||!empty($DOB)||!empty($gender)){
                    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                      if(strlen($pass)>=6 && strlen($pass)<=30){  
                            DB::query('INSERT INTO users Values(\'\',:FName,:LName,:Email,:phone,:pass,:DOB,:gender)',array(':FName'=>$fname,':LName'=>$Lname,':Email'=>$email,':phone'=>$phone,':pass'=>password_hash($pass,PASSWORD_BCRYPT),':DOB'=>$DOB,':gender'=>$gender));
                              header("Location: log_in.php");
                              }else{
                            echo'<span style="color:red;padding:0">password lenght must be in range (6-15) <span/>';
                                }
                        }else{
                              echo'<span style="color:red;padding:0"> invalid email<span/>';
                            }
                      }else{
                          echo'<span style="color:red;padding:0">All data is required<span/>';
                        }
                  }else{
                          echo'<span style="color:red;padding:0">user already exists<span/>';
                    }
          }
?>
              <div class="item">
              <input type="text" class="text_input"  placeholder="First name" name="fname">
              </div>
              <div class="item">
              <input type="text" class="text_input"  placeholder="Last name" name="lname">
              </div>
              <div class="item">
              <input type="text"  class="text_input"  placeholder="Email" name="email">
              </div>
              <div class="item">
              <input type="text" class="text_input"  placeholder="mobile number" name="phone" maxlength="11">
              </div>
              <div class="item">
              <input type="password" class="text_input" placeholder="New password" name="pass">
              </div>
              <div class="item">
              <input type="date" class="text_input" name="DOB">
              </div>
              <div class="item">
              <input type="radio" class="btn" name="gender" id='female' value="F"><label for="female">Female</label>
              </div>
              <div class="item">
              <input type="radio" class="btn" name="gender" id='male' value="M"><label for="male">Male</label>
              </div>
              <div class="item">
              <input type="submit" class="submit_input" value="sign up" name="createaccount" >
              </div>
              <div class="item">
              <a href="log_in.php">have an account?</a>
              </div>
    </form>
</div>    
</body>
</html>