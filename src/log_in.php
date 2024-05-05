<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="css/social-media.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/form.css">
    <title>social media</title>    
  </head>
  
  <body>
  
<div class="center">
  
  <div class="item">
  <h1>log in</h1>
  </div>
        <form action="log_in.php" method="post">
        <?php
          include('connect.php');
          
          if(isset($_POST['login'])){
          $email=$_POST['email'];
          $pass=$_POST['pass'];
          if (DB::query('SELECT email FROM users WHERE email=:Email', array(':Email'=>$email))) {
              if (password_verify($pass, DB::query('SELECT pass FROM users WHERE Email=:Email', array(':Email'=>$email))[0]['pass'])) {
                        $strong = TRUE;
                        $token = bin2hex(openssl_random_pseudo_bytes(64,$strong));
                        $user_id = DB::query('SELECT id FROM users WHERE Email=:Email', array(':Email'=>$email))[0]['id'];
                        DB::query('INSERT INTO login VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                        setcookie("FBID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                        setcookie("FBID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                        header("Location:index.php");
                      }else{
                        echo"<span style='color:red;padding:0'>wrong email or password!<span/>";
                      }
                  }else{
                  echo"<span style='color:red;padding:0'>wrong email or password!<span/>";
                  }
            }
        ?>
          <div class="item">
          <input type="text" class="text_input" name="email" placeholder="Email">
          </div>
          <div class="item">
          <input type="password" class="text_input"  name="pass" placeholder="Password">
          </div>
          <div class="item">
          <input type="submit" class="submit_input" value="Log In"  name="login">
          <div class="item">
          <div class="item">
          <a href="sign_up.php">Create New Account</a>
          <div class="item">        
        </form>
  </div>      
  </body>
</html>
