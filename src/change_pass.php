<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="css/social-media.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/main.css">        
        <title>change password</title>
</head>
<body>
	<header>
                <a href="log_out.php">log out</a>
                <a href="change_pass.php">change password</a>
                <a href="rec_mess.php">recieved messages</a>
                <a href="profile.php?userEmail=">search for profile</a>
                <a href="chat.php?receiver=">chat with someone</a>
                <a href="index.php">timeline</a>
        </header>
<div class="center">
<div class="item">
<h1>Change your Password</h1>
</div>
<form action="change_pass.php" method="post">
<?php
include('connect.php');
include('CheckLogin.php');

if (Login::isLoggedIn()) {

        if (isset($_POST['changepassword'])) {
        
                $oldpassword = $_POST['oldpassword'];
                $newpassword = $_POST['newpassword'];
                $newpasswordrepeat = $_POST['newpasswordrepeat'];
                $userid = Login::isLoggedIn();

                if (password_verify($oldpassword, DB::query('SELECT pass FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['pass'])) {
                        if ($newpassword == $newpasswordrepeat) {
                                if (strlen($newpassword) >= 6 && strlen($newpassword) <= 30) {
                                        DB::query('UPDATE users SET pass=:newpassword WHERE id=:userid', array(':newpassword'=>password_hash($newpassword, PASSWORD_BCRYPT), ':userid'=>$userid));
                                        echo 'Password changed successfully!';
                                }
                        } else {
                                echo 'Passwords don\'t match!';
                        }
                } else {
                        echo 'Incorrect old password!';
                }
        }
} else {
        header("Location: log_in.php");
        die();
}
?>
        <div class="item">
        <input type="password"  class="text_input"  name="oldpassword" value="" placeholder="Current Password">
        </div>
        <div class="item">
        <input type="password" class="text_input"  name="newpassword" value="" placeholder="New Password">
        </div>
        <div class="item">
        <input type="password" class="text_input"  name="newpasswordrepeat" value="" placeholder="Repeat Password">
        </div>
        <div class="item">
        <input type="submit" class="submit_input"  name="changepassword" value="Change Password">
        </div>
</form>
</div>
</body>
</html>