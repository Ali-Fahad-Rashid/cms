<?php include "admin/functions.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>

<br></br><br></br>
<!-- user information -->
<?PHP
$me=$_GET['u_id'];
$user_id_r = $_GET['u_id'];
$query = "SELECT * FROM users WHERE user_id = $me";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$user_id             = $row['user_id'];
$username            = $row['username'];
$user_password       = $row['user_password'];
$user_email          = $row['user_email'];
$user_role           = $row['user_role'];  
$user_image          = $row['user_image'];  
$sex                 = $row['sex'];  
$user_cv             = $row['user_cv'];  
$user_birthday       = $row['user_birthday'];  
$country             = $row['country']; 


$user_time             = $row['user_time']; 
$user_session          = $row['user_session']; 
$user_status           = $row['user_status']; 

}?>  
<div class="container">
<div class="row"> 
<div class="col-4">
<div class="flip-card">
<h1 class="text-center" id="shsh"> <?PHP echo $username;?></h1> 
  <div class="flip-card-inner">
    <div class="flip-card-front">

    <?php if(substr( $user_image, 0, 4 ) === "http"){ ?>
      <img src="<?PHP echo $user_image;?>" class="cv" alt="Avatar" style="width:300px;height:300px;">

<?php } else { ?>

      <img src="/cms/images/<?PHP echo $user_image;?>" class="cv" alt="Avatar" style="width:300px;height:300px;">

      <?php } ?>
      </div>
    <div class="flip-card-back"></br>
      <p  id="shsh"><?PHP echo $user_cv;?></p> 
      <p id="shsh"><?PHP echo $country;?></p>

    <?php if($sex=='Male'){?>
      <p  id="shsh" class="card-text"><?PHP echo Male ?></p>
      <?php } if($sex=='Female') {?>
        <p  id="shsh" class="card-text"><?PHP echo Female ?></p>
        <?php } ?>

    <p  id="shsh" class="card-text"><?PHP echo $user_birthday;?></p>
    <?php  if($_SESSION['user_id']==$user_id){ ?>

    <a href="/cms/admin/profile.php" id="shsh" class="btn btn-sm btn-danger "><i class="far fa-edit"></i> <?php echo Edit?></a>
    <?php } ?>


    </div>  

    </div>  
    </br></br> 

    <div class="row justify-content-center">
    <h6 id="shsh" class="text-center m-1"><?php if($user_status=='Online'){?>
    <img height="50" width="50" src="images/online-icon.png" alt=""> <?php } else { ?>
      <img height="50" width="50" src="images/offline-icon.png" alt="">  <?php } ?>
    </h6> </div>
    <div class="row justify-content-center">

    <h6 id="shsh" class="text-center m-1"><?php echo LastActivity ; ?> : <time class='timeago' datetime=' <?php echo  $user_time ?>'></time> </h6>
  </div>

  
    </div></br></br></br> 
    <?PHP if(isset($_SESSION['user_id'])){
$id=$_SESSION['user_id'];}
    $query = " SELECT * FROM followers WHERE (user_id_r = '$me') ";
    $result = $conn->prepare($query);    
    $result->execute();    
    $count =$result->rowCount();
    $query = " SELECT * FROM followers WHERE (user_id_s = '$me') ";
    $result = $conn->prepare($query);    
    $result->execute();    
    $co =$result->rowCount();
    ?>


</br></br> </br></br> 
</br>

    <div class="row justify-content-center">
    <h6 id="shsh" class=""><?php echo Following?><a href="" id="shsh" class="btn btn-sm coloor m-4" 
    style="border-radius: 100%;"><?PHP echo $count;?></a></h6>
    <h6 id="shsh" class=""><?php echo Followers?><a href="" id="shsh" class="btn btn-sm coloor m-4" 
    style="border-radius: 100%;"><?php echo $co; ?></a></h6></div>
  
  </div>
   
    <div class="col-4">
<form action="" method="post">
<!-- Friend -->
<?php

if(isset($_SESSION['user_id'])){
$id=$_SESSION['user_id'];
if ($id!=$me) {
$query = " SELECT * FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$me' AND del=0) OR (user_id_s = '$me' AND user_id_r = '$id' AND del=0)";
$result = $conn->prepare($query);    
$result->execute();    
$count =$result->rowCount();
$query = " SELECT * FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$me' AND del=1) OR (user_id_s = '$me' AND user_id_r = '$id' AND del=1)";
$result = $conn->prepare($query);    
$result->execute();    
$coun =$result->rowCount();
?>
<?php if($count>0){ ?>
<button name="pending" class="btn btn-sm btn-secondary friend "><i class="fas fa-plus-circle"></i> <?php echo pending ?></button>  
<?php } elseif($coun>0) { ?>
<button name="UnFriend" class="btn btn-sm btn-primary friend "><i class="fas fa-times"></i> <?php echo UnFriend?></button>  
<?php } else { ?>
<button name="friend" id="friend<?PHP  echo $user_id;?>" type="" class="btn btn-sm btn-primary friend ">
<i class="fas fa-plus-circle"></i> <?php echo Add ?></button>  
<?php } } ?>
<!-- Follow -->

<?PHP
if ($id!=$me) {
$query = " SELECT * FROM followers WHERE (user_id_s = '$id' AND user_id_r = '$me') ";
$result = $conn->prepare($query);    
$result->execute();    
$count =$result->rowCount();
if($count>0){ ?>
<button name="UnFollow" class="btn btn-sm btn-primary friend "><i class="fas fa-times"></i> <?php echo UnFollow?></button>  
<?php } else { ?>
<button name="follow" type="" class="btn btn-sm btn-info "><i class="far fa-caret-square-right"></i> <?php echo  Follow?></button>
<?php }} ?>


<!-- message -->
<?php 
if ($id!=$me) {
$query = "SELECT * FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$me' AND del=1  AND friends_status = 'yes') OR
 (user_id_s = '$me' AND user_id_r = '$id' AND del=1 AND friends_status = 'yes')";
    $result = $conn->prepare($query);    
    $result->execute();    
    $co =$result->rowCount();
if($co>0){
?>
<button name="send" type="" class="btn btn-sm btn-success  " ><i class="fas fa-location-arrow"></i> <?php echo Message?></button>
<?php } else { ?> 
  <button name="send" type="" class="btn btn-sm btn-success  " disabled ><i class="fas fa-location-arrow"></i> <?php echo Message?></button>
  <?php }} ?>
</form>
<?PHP if(isset($_POST['send'])){ ?>
<form action="" method="post"></br>
<div class="col-9">
<input class="form-control" name="title" placeholder="Title" required></br>
<input class="form-control" name="username" value="<?PHP echo $_SESSION['username'];?>"></br>
<textarea name="message" class="form-control"></textarea></br>
<button name="sendd" type="" class="btn btn-sm btn-success"><i class="fas fa-location-arrow"></i> <?php echo Send ?></button></div></br>
</form>
<!-- else disabled button -->
<?php } } else {?>
<button name="friend" id="friend<?PHP  echo $user_id;?>" type="" disabled class="btn btn-sm btn-primary friend ">
<i class="fas fa-plus-circle"></i> <?php echo Add  ?></button>  
<button name="follow" type="" class="btn btn-sm btn-info " disabled><i class="far fa-caret-square-right"></i> <?php echo Follow?></button>
<button name="send" type="" class="btn btn-sm btn-success " disabled><i class="fas fa-location-arrow"></i> <?php echo Message?></button>
<?php } ?>

            <!-- message insert -->
      <?PHP 
      if(isset($_POST['sendd'])){
        $title =  $_POST["title"];
        $user_name_s =  $_POST["username"];
        $message =  $_POST["message"];
        $user_id_s = $_SESSION['user_id'];

       $img_s = $_SESSION['user_image'] ;
       $query = "SELECT * FROM users WHERE user_id = $user_id_r ";
       $result=$conn->prepare($query);
       $result->execute();
       while($row = $result->fetch()){
       $user_name_r = $row['username'];
       $img_r = $row['user_image'];
       }

       $query = "INSERT INTO messages(user_id_r, user_name_r, user_id_s, user_name_s, letter, title, message_date, `status`, reply, img_r, img_s) 
VALUES(?, ?, ?, ?, ?, ?, NOW(), ?, ?,?,?)";      
$result = $conn->prepare($query);    
$result->execute([$user_id_r,$user_name_r,$user_id_s,$user_name_s,$message,$title,'unread','no', $img_r,$img_s]);    

$message_id =  $conn->lastInsertId();
echo "<br></br><h6 class='alert alert-success text-center' role='alert'> <a class='' href='/cms/show_message.php?message=$message_id' >".YourmessagesentSuccessfully."</a></h6>";
$query ="INSERT INTO `notifications_message` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`, message_id) VALUES
($user_id_r, '$user_name_s', 'message', '$message', 'unread', CURRENT_TIMESTAMP, '$user_name_r', '$user_id_r', '$message_id')";
$result = $conn->prepare($query);    
$result->execute();    
$query ="UPDATE notifications_message SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id_r";
$result = $conn->prepare($query);    
$result->execute();    
 }   ?>   </div></div>


<!-- Friend insert-->
<?PHP  
if(isset($_POST['friend'])){
  $user_id_s = $_SESSION['user_id'];
  $user_name_s = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE user_id = $user_id_r ";
  $result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
  $user_name_r = $row['username'];
    $user_image_r = $row['user_image'];  }
    $query = "SELECT * FROM users WHERE user_id = $user_id_s ";
    $result = $conn->prepare($query);    
$result->execute();    
    while($row = $result->fetch()){
      $user_image = $row['user_image']; 
    $country = $row['country'];    }
$query = "INSERT INTO friends(user_id_r, user_name_r, user_id_s, user_name_s, friends_date, `friends_status`, user_image, country, user_image_r) 
VALUES('$user_id_r', '$user_name_r', '$user_id_s', '$user_name_s', NOW(),'no', '$user_image', '$country', '$user_image_r')";      
$result = $conn->prepare($query);    
$result->execute();    
$message_id = $conn->lastInsertId();
echo "<h6 class='alert alert-success' role='alert'>Your Friend Request sent Successfully</h6>";
$query ="INSERT INTO `notifications` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`) 
VALUES ($user_id_s, '$user_name_s', 'friends', '', 'unread', CURRENT_TIMESTAMP, '$user_name_r', '$user_id_r')";
$result = $conn->prepare($query);    
$result->execute();    
$query ="UPDATE notifications SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id_r";
$result = $conn->prepare($query);    
$result->execute();    
header("location: /cms/profile.php?u_id=$me"); }   
#<!-- UnFriend -->
if (isset($_POST['UnFriend'])) {
    $id=$_SESSION['user_id'];
    $query="DELETE FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$me' AND del=1) OR (user_id_s = '$me' AND user_id_r = '$id' AND del=1)";
    $result = $conn->prepare($query);    
    $result->execute();    
        header("location: /cms/profile.php?u_id=$me");}
    #<!-- pending -->
  if (isset($_POST['pending'])) {
        $id=$_SESSION['user_id'];
        $query="DELETE FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$me' AND del=0) OR (user_id_s = '$me' AND user_id_r = '$id' AND del=0)";
        $result = $conn->prepare($query);    
        $result->execute();    
                header("location: /cms/profile.php?u_id=$me");}?>
<!-- Follow insert-->
<?PHP  
if(isset($_POST['follow'])){
  $user_id_s = $_SESSION['user_id'];
  $user_name_s = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE user_id = $user_id_r ";
  $result = $conn->prepare($query);    
$result->execute();    

while($row = $result->fetch()){
  $user_name_r = $row['username'];}
    $query = "SELECT * FROM users WHERE user_id = $user_id_s ";
    $result = $conn->prepare($query);    
$result->execute();    

while($row = $result->fetch()){
  $user_image = $row['user_image']; 
    $country = $row['country'];    }
$query =  "INSERT INTO followers(user_id_r, user_name_r, user_id_s, user_name_s, friends_date, `friends_status`, user_image, country) 
VALUES('$user_id_r', '$user_name_r', '$user_id_s', '$user_name_s', NOW(),'no', '$user_image', '$country')";      
$result = $conn->prepare($query);    
$result->execute();    
$message_id =  $conn->lastInsertId();
echo "<h6 class='alert alert-success' role='alert'>Your Friend Request sent Successfully</h6>";
$query ="INSERT INTO `notifications` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`) 
VALUES ($user_id_s, '$user_name_s', 'follow', '', 'unread', CURRENT_TIMESTAMP, '$user_name_r', '$user_id_r')";
$result = $conn->prepare($query);    
$result->execute();    
$query ="UPDATE notifications SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id_r";
$result = $conn->prepare($query);    
$result->execute();    
header("location: /cms/profile.php?u_id=$me"); }  
#<!-- UnFollow -->
if (isset($_POST['UnFollow'])) {
  $id=$_SESSION['user_id'];
  $query="DELETE FROM followers WHERE (user_id_s = '$id' AND user_id_r = '$me')";
  $result = $conn->prepare($query);    
  $result->execute();    

  
  $query="DELETE FROM notifications WHERE (notification_post_id = '$id' AND notification_user_id = '$me' AND `type` = 'follow')";
  $result = $conn->prepare($query);    
  $result->execute();    


  header("location: /cms/profile.php?u_id=$me");}


?><br></br>
<?php /*  include "includes/Carousel.php"; */ ?>
<div class="row">        
<div class="col-md-8">
<?php  
$count="";
$per_page = 5;
if(isset($_GET['page'])) {
$page = $_GET['page']; } 
else {
$page = 1 ; 
$count = 1 ; }
if($page == "" || $page == 1) {
$page_1 = 0;  } 
else {
$page_1 = ($page * $per_page) - $per_page;  }
$query = "SELECT * FROM posts WHERE post_user_id = $me  AND post_status = '".Published."'"; 
$result = $conn->prepare($query);    
$result->execute();    
$count = $result->rowCount();
if($count < 1) {
echo "<br></br><div class='alert alert-secondary  text-center ' role='alert'>" . NoPostsAvailable . "</div>";
 } else {
$count  = ceil($count /$per_page);
$query = "SELECT * FROM posts WHERE post_user_id = $me AND post_status = '".Published."' ORDER BY post_id DESC LIMIT $page_1,$per_page";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$post_id = $row['post_id'];
$post_title = $row['post_title'];
$post_user = $row['post_user'];
$post_user_id = $row['post_user_id'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_description = substr($row['post_description'],0,600);
$post_status = $row['post_status']; ?>
<br></br>
<div class="card shadow-lg mb-5 <?php echo _align ?>">
<img src="upload/<?php echo $post_image;?> " class="card-img-top cv" alt="">
<div class="card-header ">
<h3 class="card-title"><?php echo $post_title ?></h3></div>
<div class="card-body">
<p class="card-text"><?php echo $post_description ?></p>
<a href="/cms/post.php?p_id=<?php echo $post_id;?>" class="btn btn-sm btn-danger"><i class="fas fa-info-circle"></i> <?php echo More?></a></div>
<div class="cb text-muted">
<small class="m-3"><?php echo $post_date ?></small>
<small><?php echo "<a class='text-dark' href='profile.php?u_id={$post_user_id}'>$post_user</a>";?></small>
</div></div><?php }  } 
?></div>
<?php include "includes/category.php";?></div>
<nav aria-label="Page navigation example">
<ul class="pagination">
<?php 
 $s=$page; $d=1; if($s>1){$s=$s-$d;

  ?>
<li class='page-item'><a class='page-link shadow p-3 mb-5' href='profile.php?u_id=<?PHP $me ?>&page=<?php $s ?>'><?php echo Previous ?></a></li>
<?php

} else { ?> <li class='page-item'><a class='page-link shadow p-3 mb-5 btn disabled' href='#'><?php echo Previous ?></a></li><?php }
for($i =1; $i <= $count; $i++) { $s = $page ;
if($i == $page) { ?>
    <li class="page-item active"><a class="page-link shadow p-3 mb-5" href="profile.php?u_id=<?php echo $me; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } else { ?>
     <li class="page-item"><a class="page-link shadow p-3 mb-5" href="profile.php?u_id=<?php echo $me; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } } 
    $s=$page;
    if($s==$count || empty($count)){
    ?> <li class='page-item'><a class='page-link shadow p-3 mb-5 btn disabled' href='#'><?php echo Next ?></a></li><?php }
    else{$s=$s+1;
    ?> <li class='page-item'><a class='page-link shadow p-3 mb-5' href='profile.php?u_id=<?php $me ?>&page=<?php $s ?>'><?php echo Next ?></a></li><?php }?>
    </ul></nav></div>
<?php include "includes/footer.php";
/* reset notification */
if(isset($_SESSION['user_id'])){
$x=$_SESSION['user_id'];
$query ="UPDATE `notifications` SET `status` = 'read' WHERE (`type` = 'follow' AND `notification_user_id` = '$x' AND notification_post_id='$me') 
OR (`type` = 'accept' AND `notification_user_id` = '$x' AND notification_post_id='$me') ";
$result = $conn->prepare($query);    
$result->execute();  
}?>


