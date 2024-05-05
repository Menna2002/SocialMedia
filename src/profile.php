<?php
include('connect.php');
include('CheckLogin.php');
include('post.php');

if (Login::isLoggedIn()) {

$userEmail = "";
$name = "";
$isFollowing = False;

if (isset($_GET['userEmail'])) {
        if (DB::query('SELECT Email FROM users WHERE Email=:userEmail', array(':userEmail'=>$_GET['userEmail']))) {

                        $userEmail = DB::query('SELECT Email FROM users WHERE Email=:userEmail', array(':userEmail'=>$_GET['userEmail']))[0]['Email'];
                        $name = substr($userEmail, 0, strpos($userEmail, "@"));
                        $userid = DB::query('SELECT id FROM users WHERE Email=:userEmail', array(':userEmail'=>$_GET['userEmail']))[0]['id'];
                        $followerid = Login::isLoggedIn();
                        $now = new DateTime();
                        $timestampe=$now->format('Y-m-d H:i:s');        
                
                if (isset($_POST['follow'])) {
                        if ($userid != $followerid) {        
                                if (!DB::query('SELECT follower_id FROM friends WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                        DB::query('INSERT INTO friends VALUES (:userid, :followerid,:timestampe)', array(':userid'=>$userid, ':followerid'=>$followerid,':timestampe'=>$timestampe));
                                }$isFollowing = TRUE;        
                                        }
                                }
                if (isset($_POST['unfollow'])) {
                        if ($userid != $followerid) {
                                if (DB::query('SELECT follower_id FROM friends WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                        DB::query('DELETE FROM friends WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
                                } $isFollowing = FALSE;        
                                }
                        }        
                if (DB::query('SELECT follower_id FROM friends WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                        // 'Already following!';
                        $isFollowing = TRUE;
                }
                if (isset($_POST['post'])) {
                        Post::createPost($_POST['post_title'],Login::isLoggedIn(),$userid);
                }
                
                if (isset($_GET['postid'])) {
                        post::likePost($_GET['postid'],$followerid);
                }
                
                $posts = post::displayPosts($userid,$userEmail,$followerid);
                
        } else {
                die('User not found!');
        }
}

}else {
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>profile</title>
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

<h1 class="profile">profile : <?php echo $name;?></h1>
        <form action="profile.php?userEmail=<?php echo $userEmail;?>" method="post">
        <?php
        if ($userid != $followerid) {
                if ($isFollowing) {
                        echo '<input type="submit" name="unfollow" value="delete friend" class="create">';
                } else {
                        echo '<input type="submit" name="follow" value="add friend" class="create">';
                }
        }
        ?>
        </form>
        
        <form action="profile.php?userEmail=<?php echo $userEmail;?>" method="post">
                <textarea name="post_title" class ="newpost" placeholder="create post"></textarea>
                <input type="submit" name="post" value="create post" class="create">
        </form>
        
        <div class="title"><?php echo $name;?> posts</div>
        <div class="posts">
                <?php echo'<div class="post">'.$posts."</div>" ; ?>
        </div>
</body>
</html>