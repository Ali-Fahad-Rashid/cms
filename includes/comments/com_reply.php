    <?php   
if (isset($_POST["do_reply"])){
    $name =  $_POST["name"];
    $email =  $_POST["email"];
    $comment =  $_POST["comment"];
    $post_id =  $_POST["post_id"];
    $reply_of =  $_POST["reply_of"];
     /*     $result = mysqli_query($connection, "SELECT * FROM comments WHERE comment_id  = " . $reply_of);
    if (mysqli_num_rows($result) > 0)    {
        $row = mysqli_fetch_object($result);
        // sending email
        $headers = 'From: YourWebsite <no-reply@yourwebsite.com>' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $subject = "Reply on your comment";
        $body = "<h1>Reply from:</h1>";
        $body .= "<p>Name: " . $name . "</p>";
        $body .= "<p>Email: " . $email . "</p>";
        $body .= "<p>Reply: " . $comment . "</p>";
        mail($row->comment_email, $subject, $body, $headers);    } */
        if(isset($_SESSION['user_id'])){
            $comment_user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE user_id = '{$comment_user_id}' ";
            $result = $conn->prepare($query);    
            $result->execute();    
            $row = $result->fetch();
            $image = $row['user_image'];
        }
            else {
                $comment_user_id=0;
                $image="123.jpg";
            }
    $query="INSERT INTO comments(comment_user, comment_email, comment_content, comment_post_id,
     comment_date, reply_of, comment_status, comment_image, comment_user_id) 
    VALUES (?,?,?,?,NOW(),?,?,?,?)";
     $result = $conn->prepare($query);    
     $result->execute([$name,$email,$comment,$post_id,$reply_of,'Approve',$image,$comment_user_id]);   

     $query="SELECT * FROM comments WHERE comment_id = $reply_of";
 $result = $conn->prepare($query);    
 $result->execute();    
 while($row = $result->fetch()){
    $comment_user= $row['comment_user'];
    $xxx= $row['comment_user_id'];}
  if($comment_user_id != $xxx){
    $query ="INSERT INTO `notifications` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`) VALUES
    ($post_id, '$name', 'reply', '$comment', 'unread', CURRENT_TIMESTAMP, '$comment_user', '$xxx')";
$result = $conn->prepare($query);    
$result->execute();    
    $query ="UPDATE `notifications` SET `notification_count` = notification_count + 1 WHERE `notification_post_id` = $post_id AND `notification_user_id` = '$xxx' ";
    $result = $conn->prepare($query);    
    $result->execute();    
  }
 header("Location: /cms/post.php?p_id=$post_id"); }
 if(isset($_SESSION['user_role'])){
 $x=$_SESSION['user_id'];
 $query ="UPDATE `notifications` SET `status` = 'read' WHERE `notification_post_id` = $post_id AND `notification_user_id` = '$x' ";
 $result = $conn->prepare($query);    
 $result->execute();    
 }  ?>