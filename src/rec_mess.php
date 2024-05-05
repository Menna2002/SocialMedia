<?php
include('connect.php');
include('CheckLogin.php');

if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
    header("Location: log_in.php");
    die();
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
    <title>Messages</title>
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
    <h1 class="profile">Messages</h1>
<?php
$messages = DB::query('SELECT chat.*, users.Email FROM chat join users on  users.id = chat.sender_id  where  receiver_id=:receiver OR sender_id=:sender ', array(':receiver'=>$userid, ':sender'=>$userid));

foreach ($messages as $message) {
    echo '<div class="post">sender : '.$message['Email'].'<br><br>'.$message['message'].'</div>';
}
?>
</body>
</html>