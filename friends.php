<?php include "admin/functions.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<br></br><br></br>
<div class="container">
<!-- Friends Request -->
<div class="row"> <?php
if (isset($_SESSION['user_id'])) {
$id=$_SESSION['user_id'];
$username=$_SESSION['username'];
$image=$_SESSION['user_image'];
$query = "SELECT * FROM friends WHERE user_id_r = $id AND del=0";
$result = $conn->prepare($query);    
$result->execute();    
foreach($result->fetchall() as $index => $row){
  $friends_id    = $row['friends_id'];
$friends_date  = $row['friends_date'];
$user_name_s   = $row['user_name_s'];
$user_id_s     = $row['user_id_s'];
$user_id_r     = $row['user_id_r'];
$user_image    = $row['user_image'];
$country       = $row['country'];?>
<div class="card mb-3 m-3 text-center" style="width: 500px; height: 171px;">
  <div class="row no-gutters">
    <div class="col-4">
    <a href="/cms/profile.php?u_id=<?php echo $user_id_s ;?>">
    <img width="170" height="170" src="/cms/images/<?PHP echo $user_image ;?>" alt=""><a></div>
    <div class="col">
      <div class="card-body">
        <h5 class="card-title"> <?php echo FriendsRequest ?></h5>
        <p class="card-text"><?PHP echo $user_name_s ;?></p>
        <form action="" method="post">
        <input type="hidden" name="notee" value="<?PHP echo $user_id_r ;?>">
        <input type="hidden" name="note" value="<?PHP echo $user_id_s ;?>">
        <input type="hidden" name="acc" value="<?PHP echo $friends_id ;?>">
        <input type="hidden" name="dec" value="<?PHP echo $friends_id ;?>">
         <button name="Accept" type="" class="btn btn-sm btn-success"><i class="fas fa-check"></i><?php echo Accept ?></button>
        <button name="Decline" type="" class="btn btn-sm btn-danger"><i class="fas fa-times"></i><?php echo  Decline ?></button>
        </form> 
        <p class="card-text m-2"><small class="text-muted"><?PHP echo $friends_date ;?></small></p>
      </div></div></div></div> <?php } ?></div>
<!-- Friends List -->
      <br></br>
      <h1 class="card-title text-center"> <?php echo FriendsList ?></h1><br></br>
      <div class="row">

<?php
$query = "SELECT COUNT(*) FROM friends WHERE (user_id_s = '$id' AND del=1) OR (user_id_r = '$id' AND del=1)";
$result=$conn->prepare($query);
$result->execute();
$count =$result->fetchColumn();
if($count>0){
  $query = "SELECT * FROM friends WHERE (user_id_s = '$id' AND del=1) OR (user_id_r = '$id' AND del=1)";
  $result = $conn->prepare($query);    
  $result->execute();    
  foreach($result->fetchall() as $index => $row){
    $friends_id    = $row['friends_id'];
$friends_date  = $row['friends_date'];
$user_name_s   = $row['user_name_s'];
$user_id_s     = $row['user_id_s'];
$user_id_r     = $row['user_id_r'];
$user_name_r   = $row['user_name_r'];
$user_image    = $row['user_image'];
$user_image_r   = $row['user_image_r'];
$country       = $row['country'];?>
<div class="card mb-3 m-3 text-center" style="width: 500px; height: 171px;">
  <div class="row no-gutters">
    <div class="col-4">
    
    <a href="/cms/profile.php?u_id=<?php if($user_id_s!=$id){echo $user_id_s;} else {echo $user_id_r;}?>">
    <img width="170" height="170" src="/cms/images/<?php if($user_image!=$image){echo $user_image;} else {echo $user_image_r;}?>" alt=""><a></div>
    <div class="col">
      <div class="card-body">
        <h5 class="card-title"><?php if($user_name_s!=$username){echo $user_name_s;} else {echo $user_name_r;}?></h5>
        <p class="card-text"></p>
        <form action="" method="post">
        <input type="hidden" id="tg" name="user_id_r" value="<?php if($id!=$user_id_s){echo $user_id_s;} else {echo $user_id_r;}?>">
        <button name="UnFriend" class="btn btn-sm btn-primary friend"><i class="fas fa-times"></i><?php echo UnFriend ?></button>  
        
<!-- follow -->
<?PHP

 if($user_id_s!=$id){ 
  $query = " SELECT * FROM followers WHERE (user_id_s = '$id' AND user_id_r = '$user_id_s')"; } 
 else { $query = " SELECT * FROM followers WHERE (user_id_s = '$id' AND user_id_r = '$user_id_r')";}  
 $result=$conn->prepare($query);
 $result->execute();
$countt = $result->rowCount();
if($countt>0){ ?>
<button name="UnFollow" class="btn btn-sm btn-primary friend"><i class="fas fa-times"></i><?php echo UnFollow ?></button>  
<?php } else { ?>
<button name="follow" type="" class="btn btn-sm btn-info "><i class="far fa-caret-square-right"></i> <?php echo Follow ?></button>
<?php } ?>


        </form> 
        <p class="card-text m-2"><small class="text-muted"><?PHP echo $friends_date ;?></small></p>
      </div></div></div></div> <?php } } 
      else { ?> <br></br><div class='col order-last alert alert-secondary text-center' role='alert'><?php echo YouDontHaveFriends ?></div> <?php  } ?></div>
    
   <?php } ?>  <br></br><br></br>
   <!-- Add Friends -->
<h1 class="card-title text-center"><?php echo AddFriends ?></h1><br></br>
<div class="row">
<?php
$query = "SELECT * FROM users WHERE user_id != '$id'";
$resul=$conn->prepare($query);
$resul->execute();
foreach($resul->fetchall() as $index => $row){
  $user_id             = $row['user_id'];
    $username            = $row['username'];
    $user_password       = $row['user_password'];
    $user_email          = $row['user_email'];
    $user_date           = $row['user_date'];  
    $user_image          = $row['user_image'];  
    $sex                 = $row['sex'];  
    $user_cv             = $row['user_cv'];  
    $user_birthday       = $row['user_birthday'];  
    $country             = $row['country'];    ?>
<div class="card mb-3 m-3 text-center" style="width: 500px; height: 171px;">
  <div class="row no-gutters">
    <div class="col-4">
      <a href="/cms/profile.php?u_id=<?php echo $user_id;?>" ><img width="170"
        height="170" src="/cms/images/<?PHP echo $user_image ;?>" alt=""><a>    </div>
        <div class="col">
        <div class="card-body">
        <h5 class="card-title"><?PHP echo $username ;?> </h5>
        <p class="card-text"><?PHP echo $country ;?></p>
        <form action="" method="post">
        <input type="hidden" id="tg" name="user_id_r" value="<?PHP echo $user_id  ;?>">
        <input type="hidden" name="user_name_r" value="<?PHP echo $username  ;?>">
        <input type="hidden" name="use" value="<?PHP echo $user_image  ;?>">

        <!-- friend -->
<?php 
$query = " SELECT * FROM friends
WHERE (user_id_s = '$id' AND user_id_r = '$user_id' AND del=0) OR (user_id_s = '$user_id' AND user_id_r = '$id' AND del=0)";
$result = $conn->prepare($query);    
$result->execute();    
$count = $result->rowCount();
$query = "SELECT * FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$user_id' AND del=1) 
OR (user_id_s = '$user_id' AND user_id_r = '$id' AND del=1)";
$result=$conn->prepare($query);
$result->execute();
$coun = $result->rowCount();
if($count>0){ ?>
<button name="pending" class="btn btn-sm btn-secondary friend"><i class="fas fa-plus-circle"></i><?php echo pending ?></button>  
<?php } elseif($coun>0) { ?>
  <button name="UnFriend" class="btn btn-sm btn-primary friend"><i class="fas fa-times"></i><?php echo UnFriend ?></button>  
<?php } else { ?>
<button name="friend" id="friend<?PHP  echo $user_id;?>" type="" class="btn btn-sm btn-success friend">
<i class="fas fa-plus-circle"></i><?php echo Add ?></button>  
<?php } ?>

<!-- follow -->
<?PHP
$query = " SELECT * FROM followers WHERE (user_id_s = '$id' AND user_id_r = '$user_id')";
$result=$conn->prepare($query);
$result->execute();
$count = $result->rowCount();
if($count>0){ ?>
<button name="UnFollow" class="btn btn-sm btn-primary friend"><i class="fas fa-times"></i> <?php echo UnFollow ?></button>  
<?php } else { ?>
<button name="follow" type="" class="btn btn-sm btn-info "><i class="far fa-caret-square-right"></i> <?php echo Follow ?></button>
<?php } ?>

</form> 
<p class="card-text m-2"><small class="text-muted"><?PHP echo $user_date ;?></small></p>
</div></div></div></div><?php } ?></div></div><br></br><br></br>
<?php include "includes/footer.php";?>
<?PHP 
/* Accept */
if (isset($_POST['Accept'])) {
$acc=$_POST['acc'];
$note=$_POST['note'];
$notee=$_POST['notee'];
$query="UPDATE friends SET friends_status = 'yes', del=1 WHERE friends_id=$acc";
$result=$conn->prepare($query);
$result->execute();

$query ="SELECT * FROM users WHERE user_id = $note ";
$result=$conn->prepare($query);
$result->execute();
foreach($result->fetchall() as $index => $row){
  $user_id             = $row['user_id'];
  $username            = $row['username'];}
  $query = "SELECT * FROM users WHERE user_id = $notee ";
  $result=$conn->prepare($query);
$result->execute();
foreach($result->fetchall() as $index => $row){
  $user_idd             = $row['user_id'];
    $usernamee            = $row['username'];}
$query ="INSERT INTO `notifications` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`) 
VALUES ($user_idd, '$usernamee', 'accept', '', 'unread', CURRENT_TIMESTAMP, '$username', '$user_id')";
$result=$conn->prepare($query);
$result->execute();
$query ="UPDATE notifications SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id";
$result=$conn->prepare($query);
$result->execute();
header("location: /cms/friends.php");}


/* Decline */
 if (isset($_POST['Decline'])) {
    $dec=$_POST['dec'];
    $query="DELETE FROM friends WHERE friends_id=$dec";
    $result=$conn->prepare($query);
    $result->execute();
        header("location: /cms/friends.php");}

/* add friend */
if(isset($_POST['friend'])){
    $user_id_s = $_SESSION['user_id'];
    $user_name_s = $_SESSION['username'];
    $user_id_r=$_POST['user_id_r'];
    $user_name_r=$_POST['user_name_r'];
    $user_image_r=$_POST['use'];
    $query = "SELECT * FROM users WHERE user_id = $user_id_s ";
    $result=$conn->prepare($query);
$result->execute();
foreach($result->fetchall() as $index => $row){
  $user_image = $row['user_image']; 
      $country = $row['country'];      }
  $query =  "INSERT INTO friends(user_id_r, user_name_r, user_id_s, user_name_s, friends_date, `friends_status`, user_image, country, user_image_r) 
  VALUES('$user_id_r', '$user_name_r', '$user_id_s', '$user_name_s', NOW(),'no', '$user_image', '$country', '$user_image_r')";      
$result=$conn->prepare($query);
$result->execute();
  $message_id = $conn->lastInsertId();
  echo "<h6 class='alert alert-success' role='alert'>Your Friend Request sent Successfully</h6>";
  $query ="INSERT INTO `notifications` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`) 
  VALUES ($user_id_r, '$user_name_s', 'friends', '', 'unread', CURRENT_TIMESTAMP, '$user_name_r', '$user_id_r')";
$result=$conn->prepare($query);
$result->execute();
  $query ="UPDATE notifications SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id_r";
  $result=$conn->prepare($query);
  $result->execute();
  header("location: /cms/friends.php");}

/* UnFriend */
if (isset($_POST['UnFriend'])) {
  $user_id_r=$_POST['user_id_r'];
    $id=$_SESSION['user_id'];
    $query="DELETE FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$user_id_r' AND del=1) OR (user_id_s = '$user_id_r' AND user_id_r = '$id' AND del=1)";
    $result=$conn->prepare($query);
    $result->execute();
        header("location: /cms/friends.php");}

    /* pending */
    if (isset($_POST['pending'])) {
      $user_id_r=$_POST['user_id_r'];
        $id=$_SESSION['user_id'];
        $query="DELETE FROM friends WHERE (user_id_s = '$id' AND user_id_r = '$user_id_r' AND del=0) OR (user_id_s = '$user_id_r' AND user_id_r = '$id' AND del=0)";
        $result=$conn->prepare($query);
        $result->execute();
                header("location: /cms/friends.php");}?>





        <!-- Follow insert-->
<?PHP  
if(isset($_POST['follow'])){
  $user_id_r=$_POST['user_id_r'];
  $user_id_s = $_SESSION['user_id'];
  $user_name_s = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE user_id = $user_id_r ";
  $result=$conn->prepare($query);
$result->execute();

foreach($result->fetchall() as $index => $row){
  $user_name_r = $row['username'];}
    $query = "SELECT * FROM users WHERE user_id = $user_id_s ";
    $result=$conn->prepare($query);
$result->execute();

foreach($result->fetchall() as $index => $row){
  $user_image = $row['user_image']; 
    $country = $row['country'];    }
$query = "INSERT INTO followers(user_id_r, user_name_r, user_id_s, user_name_s, friends_date, `friends_status`, user_image, country) 
VALUES('$user_id_r', '$user_name_r', '$user_id_s', '$user_name_s', NOW(),'no', '$user_image', '$country')";      
$result=$conn->prepare($query);
$result->execute();
$message_id = $conn->lastInsertId();

echo "<h6 class='alert alert-success' role='alert'>Your Friend Request sent Successfully</h6>";
$query ="INSERT INTO `notifications` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`) 
VALUES ($user_id_s, '$user_name_s', 'follow', '', 'unread', CURRENT_TIMESTAMP, '$user_name_r', '$user_id_r')";
$result=$conn->prepare($query);
$result->execute();
$query ="UPDATE notifications SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id_r";
$result=$conn->prepare($query);
$result->execute();
header("location: /cms/friends.php"); }  
#<!-- UnFollow -->
if (isset($_POST['UnFollow'])) {
  $me=$_POST['user_id_r'];
  $id=$_SESSION['user_id'];
  $query="DELETE FROM followers WHERE (user_id_s = '$id' AND user_id_r = '$me') ";
  $result=$conn->prepare($query);
  $result->execute();
  $query="DELETE FROM notifications WHERE (notification_post_id = '$id' AND notification_user_id = '$me' AND `type` = 'follow')";
  $result=$conn->prepare($query);
  $result->execute();
  header("location: /cms/friends.php");}



/* notification reset */
$query ="UPDATE `notifications` SET `status` = 'read' WHERE `type` = 'friends' AND `notification_user_id` = '$id' ";
$result=$conn->prepare($query);
$result->execute();

