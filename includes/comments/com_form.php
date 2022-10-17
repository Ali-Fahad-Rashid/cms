<?php $post_id = $_GET['p_id'];
    $uuu = $_SESSION['user_id'];
 if(isset($_POST['post_comment'])) {
    $comment =$_POST['comment'];
    $error = ['comment'=> ''];
    if($comment == ''){
    $error['comment'] = 'Please Write your letter';    }
    foreach ($error as $key => $value) {
    if(empty($value)){
    unset($error[$key]); } } 
    if(empty($error)){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
    $comment=make_clickable($comment);
    $post_id = $_POST["post_id"];
    $reply_of = 0;
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
$query = "INSERT INTO comments(comment_user, comment_email, 
comment_content, comment_post_id, comment_date, reply_of, comment_status, comment_image, comment_user_id)
 VALUES (?,?,?,?,NOW(),?,?,?,?)";
$result = $conn->prepare($query);    
$result->execute([$name,$email,$comment,$post_id,$reply_of,'Approve',$image,$comment_user_id]);   
$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";    
$query .= "WHERE post_id = $post_id ";
$result = $conn->prepare($query);    
$result->execute();    
$query = "SELECT * FROM posts WHERE post_id = $post_id";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
    $post_user = $row['post_user'];
        $post_user_id = $row['post_user_id'];}
        if($uuu != $post_user_id){
            #notification_post_id  رقم البوست    id
            #post_name   اسم صاحب البوست 
            #notification_user_id   رقم  صاحب البوست   id
$query ="INSERT INTO `notifications` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`) VALUES
($post_id, '$name', 'comment', '$comment', 'unread', CURRENT_TIMESTAMP, '$post_user', '$post_user_id')";
$result = $conn->prepare($query);    
$result->execute();    
$query ="UPDATE notifications SET notification_count = notification_count + 1 WHERE notification_user_id = $post_user_id";
$result = $conn->prepare($query);    
$result->execute();    

}}} ?> <br></br>
<div class="card shadow-lg <?php echo _align ?>" style="width: 46rem;">
<div class="card-header">
<h4 class=" text-success"> <?php echo Comment ?> </h4></div>
<div class="card-body">
<form method="post" enctype="multipart/form-data" class=" text-dark">
<input type="hidden" name="post_id" value="<?php echo $post_id; ?>" required>
<div class="form-group">
<label class=" text-success"> <?php echo Username ?></label>
<input type="text" class="form-control" name="name" autocomplete="true" value=" <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "" ?>"
 required></div>
<div class="form-group">
<label class=" text-success"> <?php echo Email ?></label>
<input type="email" class="form-control" name="email" value="<?php  echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "" ?>" 
required></div>
<div class="form-group">
<label class=" text-success"> <?php echo YourComment ?></label> 
<textarea style="white-space: pre-wrap;" class="form-control" type="text" id="editor" name="comment" class="ddd" ></textarea>
<p class="text-danger"><?php echo isset($error['comment']) ?  $error['comment'] : '' ?></p>
<button type="submit" name="post_comment" class="btn btn-success"><?php echo Send ?> <i class="fas fa-location-arrow"></i></button></div>
</form>
</div></div>
