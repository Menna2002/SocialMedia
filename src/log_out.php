<?php
include('connect.php');
include('CheckLogin.php');

if (!Login::isLoggedIn()) {
        header("Location: log_in.php");
}
if (isset($_POST['confirm'])) {

        if (isset($_POST['alldevices'])) {

                DB::query('DELETE FROM login WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));

        } else {
                if (isset($_COOKIE['FBID'])) {
                        DB::query('DELETE FROM login WHERE token=:token', array(':token'=>sha1($_COOKIE['FBID'])));
                }
                setcookie('FBID', '1', time()-3600);
                setcookie('FBID_', '1', time()-3600);
        }header("Location: log_in.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="css/social-media.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/main.css">
        <title>log out</title>
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
        <h1>Logout of your Account?</h1>
        </div>
        <div class="item">
        <p>Are you sure you'd like to logout?</p>
        <div class="item">
        <form action="log_out.php" method="post">
                <div class="item">
                <input type="checkbox" class="text_input btn" name="alldevices" value="alldevices"> Logout of all devices?
                </div>
                <div class="item">
                <input type="submit" class="submit_input" name="confirm" value="Confirm">
                </div>
        </form>
</div>        
</body>
</html>
