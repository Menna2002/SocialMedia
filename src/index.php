<?php

include('connect.php');
include('CheckLogin.php');
include('post.php');

$showTimeline = False;

if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
        $showTimeline = True;
        $followingposts = DB::query('SELECT  post.post_id , post.title, post.likes, users.FName 
                                        FROM users JOIN post
                                        ON users.id = post.created_by
                                        JOIN friends
                                        ON friends.user_id = post.created_by
                                        WHERE follower_id = :userid
                                        ORDER BY post.likes DESC;',array(':userid'=>$userid));
                                        
        $username =  DB::query('SELECT FName FROM users WHERE id = :userid',array(':userid'=>$userid))[0]['FName']; 
        $Email =  DB::query('SELECT Email FROM users WHERE id = :userid',array(':userid'=>$userid))[0]['Email'];        
        
        
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
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <title>home page</title>
	</head>
	<body>
	<header>
                <span class="name" style="color: red;"><?php echo $username ?></span>
                <a href="log_out.php">log out</a>
                <a href="change_pass.php">change password</a>
                <a href="rec_mess.php">recieved messages</a>
                <a href="profile.php?userEmail=<?php echo $Email ?>" >search for profile</a>
                <a href="chat.php?receiver=">chat with someone</a>
                <a href="index.php">timeline</a>
        </header>
        <div class="posts">
        <?php 
        
        if (isset($_GET['postid'])) {
        post::likePost($_GET['postid'],$userid);}
        echo'<div class = title>friends timeline</div>';
        foreach ($followingposts as $posts) {
        echo '<div class = post>';
        
        echo'<h3 class ="user">posted by :' .$posts['FName'].'</h3>';
        
        echo '<p class="content">'.$posts['title'].'</p>';
        
        echo "<form action='index.php?postid=".$posts['post_id']."' method='post'>";
        
        if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$posts['post_id'], ':userid'=>$userid))) {
                        echo" <input type='submit' name='like' value='&#x2661;' class ='like'>";
                        
                }else{
                        echo"<input type='submit' name='unlike' value='&#x2764;' class='like'>";
                }
                echo "<span>".$posts['likes']." likes</span>
                        </form>";
        echo '</div>';     
        }
        
        ?>
        
        </div>
        
	</body>
</html>