<?php
class Post{
    public static function createPost($post_title,$loggedInUserId,$profileUserId){
        $now = new DateTime();
        $timestampe=$now->format('Y-m-d H:i:s');        
        if (strlen($post_title) > 160 || strlen($post_title) < 1) {
            echo 'Incorrect length!' ;
        }
        if ($loggedInUserId == $profileUserId) {
            DB::query('INSERT INTO post VALUES (\'\', :post_title, :userid , :timestampe ,0)', array(':post_title'=>$post_title,":timestampe"=>$timestampe,':userid'=>$profileUserId));
        } else {
            echo '<div class="comm">Incorrect user!</div>';
        }
        
    }
    public static function likePost($postId, $likerId) {
        if (!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))) {
            DB::query('UPDATE post SET likes=likes+1 WHERE post_id=:postid', array(':postid'=>$postId));
            DB::query('INSERT INTO post_likes VALUES (:postid, :userid)', array(':postid'=>$postId,':userid'=>$likerId));
            } else {
            DB::query('UPDATE post SET likes=likes-1 WHERE post_id=:postid', array(':postid'=>$postId));
            DB::query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
        }
    }
    
    public static function displayPosts($userid, $userEmail, $loggedInUserId) {    
        $dbposts = DB::query('SELECT * FROM post WHERE created_by=:userid ORDER BY post_id DESC', array(':userid'=>$userid));
        $posts = "";
        foreach($dbposts as $p) {                
            if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$p['post_id'], ':userid'=>$loggedInUserId))) {
                $posts .= htmlspecialchars($p['title']).
                "
                <form action='profile.php?userEmail=$userEmail&postid=".$p['post_id']."' method='post'>
                    <input type='submit' name='like'  value='&#x2661;' class ='like'>
                            <span>".$p['likes']." likes</span>
                </form>";
                } else {
                    $posts .= htmlspecialchars($p['title']).
                    "
                    <form action='profile.php?userEmail=$userEmail&postid=".$p['post_id']."' method='post'>
                        <input type='submit' name='unlike' value='&#x2764;' class='like'>
                        <span>".$p['likes']." likes</span>
                    </form>";
            }
        } return $posts;
    }
}
?>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />