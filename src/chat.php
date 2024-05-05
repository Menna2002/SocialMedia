<?php

include('connect.php');
include('CheckLogin.php');

if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
        die('Not logged in');
}
if (isset($_POST['send'])) {
        $now = new DateTime();
        $timestampe=$now->format('Y-m-d H:i:s');
        
        if (DB::query('SELECT id FROM users WHERE id=:receiver_id', array(':receiver_id'=>$_GET['receiver']))) {

                DB::query("INSERT INTO chat VALUES ( :sender_id ,:receiver_id , :message ,:timestampe )", array(':sender_id'=>$userid, ':receiver_id'=>htmlspecialchars($_GET['receiver']),':message'=>$_POST['message'] , ':timestampe'=>$timestampe ));
                echo "<div style='margin-left:70px;margin-top:80px;'>Message Sent!</div>";
        } else {
                die('missing receiver id ');
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="css/social-media.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/main.css">
        <title>chat</title>
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
        
        <h1 class="profile">Send a Message</h1>
<form action="chat.php?receiver=<?php echo htmlspecialchars($_GET['receiver']); ?>" method="post">
        <textarea name="message" class="newpost" placeholder="write a message"></textarea>
        <input  type="submit" name="send" value="Send Message" class="create">
</form>    
</body>
</html>