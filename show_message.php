<?php  include "admin/functions.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<br></br><br></br>

<div class="container">
         <?PHP $message = $_GET['message'];
         $query="SELECT * FROM messages WHERE message_id = $message ORDER BY message_id DESC";
         $result = $conn->prepare($query);    
         $result->execute();    
         while($row = $result->fetch()){
          $message_id   = $row['message_id'];
            $user_id_rr    = $row['user_id_r'];
            $user_name_rr  = $row['user_name_r'];
            $user_id_s    = $row['user_id_s'];
            $user_name_s  = $row['user_name_s'];
            $letter       = $row['letter'];    
            $title        = $row['title'];    


            $img_s       = $row['img_s'];    
            $img_rr       = $row['img_r'];  



            $message_date = $row['message_date'];
            $reply = $row['reply'];    
            $status       = $row['status'];}
            if(isset($_SESSION['user_role'])){
              $x=$_SESSION['user_id'];
              if($user_id_rr  != $x && $user_id_s != $x){
                header("Location: /cms/index.php");
              
              }

                $query ="UPDATE `notifications_message` SET `status` = 'read' WHERE (`message_id` = '$message_id' AND `notification_user_id` = '$x') 
                OR (`notification_user_id` = '$x' AND `type` = 'reply_message')";
$result = $conn->prepare($query);    
$result->execute();    
                  

$query ="UPDATE `messages` SET `status` = 'read' WHERE `message_id` = '$message_id' AND `user_id_r` = '$x'";
$result = $conn->prepare($query);    
$result->execute();    

}  ?>
         <form id="bep" enctype="multipart/form-data" method="post">
         <div class="row justify-content-center">
         <div class="col-8">
         <textarea id="editor" type="text" class=" form-control m-2" name="litter" required></textarea>
         <button name="sendd" id="beep" type="" class="btn btn-sm btn-success m-2"><i class="fas fa-location-arrow"></i> <?php echo Send ?></button>
         </br></div></div>
         </form></br>
      <?PHP  
      if(isset($_POST['sendd'])){
       $reply_of    = $message;
       if(empty($user_id_s)){
        $query="SELECT * FROM users WHERE username ='$user_name_s'";
        $result = $conn->prepare($query);    
        $result->execute();    
        while($row = $result->fetch()){
          $user_id    = $row['user_id'];   
          $imgg = $row['user_image'];

        }

        $img_s =  $imgg ;
       $user_id_s=$user_id;     
       $query ="UPDATE `messages` SET `user_id_s` = '$user_id' , `img_s` = '$imgg' WHERE `message_id` = $message";
       $result = $conn->prepare($query);    
       $result->execute();     
        }
       if(empty($user_id_rr)){
        $query="SELECT * FROM users WHERE username ='$user_name_rr'";
        $result = $conn->prepare($query);    
        $result->execute();    
        while($row = $result->fetch()){
          $user_id    = $row['user_id'];   
          $imgg = $row['user_image'];

        }
        $img_rr =  $imgg ;
       $user_id_rr=$user_id;     
       $query ="UPDATE `messages` SET `user_id_r` = '$user_id' , `img_r` = '$imgg' WHERE `message_id` = $message";
       $result = $conn->prepare($query);    
       $result->execute();    
         }
       $user_id_r   =  $user_id_s;
       $user_name_r = $user_name_s;
       $img_r =  $img_s ;

       $user_name_ss = $_SESSION['username'];
       $litter      =  $_POST["litter"];
       $user_id_ss   = $_SESSION['user_id'];

       $img_ss = $_SESSION['user_image'] ;

$query ="UPDATE `messages` SET reply='yes', `count` = `count` + 1  , `last_date` = NOW() WHERE `message_id` = $message";
$result = $conn->prepare($query);    
$result->execute();    
$query= "INSERT INTO messages(user_id_r, user_name_r, user_id_s, user_name_s, letter, title, message_date, reply_of, `status`, reply,img_r,img_s) 
VALUES(?,?,?,?,?,? , NOW(), ?,?,?,?,?)";      
$result = $conn->prepare($query);    
$result->execute([$user_id_r, $user_name_r, $user_id_ss, $user_name_ss, $litter, $title,$reply_of,'unread','no',$img_r,$img_ss]);    


$message_id = $conn->lastInsertId();
echo "<small><h6 class='alert alert-success text-center' role='alert'>".YourmessagesentSuccessfully."</h6></small><br></br>";
if ($user_id_ss===$user_id_r) { 
$query ="INSERT INTO `notifications_message` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`, message_id, reply_of) VALUES
($user_id_s, '$user_name_s', 'reply_message', '$litter', 'unread', CURRENT_TIMESTAMP, '$user_name_rr', '$user_id_rr', '$message_id','$reply_of')";
$result = $conn->prepare($query);    
$result->execute();    
$query ="UPDATE notifications_message SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id_rr";
$result = $conn->prepare($query);    
$result->execute();    
} else {
   $query ="INSERT INTO `notifications_message` (`notification_post_id`, `username`, `type`, `message`, `status`, `date`, `post_name`, `notification_user_id`, message_id, reply_of) VALUES
  ($user_id_rr, '$user_name_rr', 'reply_message', '$litter', 'unread', CURRENT_TIMESTAMP, '$user_name_s', '$user_id_s', '$message_id', '$reply_of')";
$result = $conn->prepare($query);    
$result->execute();    
  $query ="UPDATE notifications_message SET notification_count = notification_count + 1 WHERE notification_user_id = $user_id_s";
  $result = $conn->prepare($query);    
  $result->execute();    
 }} 
 $reply_of = $message;
$query="SELECT * FROM messages WHERE reply_of = $reply_of ORDER BY message_id DESC";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
  $message_id   = $row['message_id'];
   $user_id_r    = $row['user_id_r'];
   $user_name_r  = $row['user_name_r'];
   $user_id_ss    = $row['user_id_s'];
   $user_name_ss  = $row['user_name_s'];

   $img_ss       = $row['img_s'];    
   $img_r      = $row['img_r'];  


   $litter       = $row['letter'];    
   $title        = $row['title'];    
   $message_datee = $row['message_date']; 
   if ($user_name_ss==$_SESSION['username']) { ?>  <div class="col-7">

<div class="card <?php echo _align ;?> " >
  <div class="bg-primary text-light ct">

  <div class="row"><div class="col">       
  <img src="/cms/images/<?PHP echo $img_ss;?>" class="" alt="Avatar" style="width:50px;height:50px;border-radius: 100%;"></div><div class="col">
  <h2 class="text-center m-1"><?PHP echo $user_name_ss ; ?></h2>  </div></div>
    </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><?PHP echo $litter ; ?></p>
      <footer class="blockquote-footer"><?PHP  ?><cite title="Source Title"><?PHP echo $message_datee ; ?></cite></footer>
    </blockquote>
  </div> 
  </div>
</div></br></br>
    <?PHP
   } else {   ?>    
  <div class="row justify-content-end">

<div class="col-7">
<div class="card <?php echo _align ;?> " >
  <div class="ct bg-dark text-light ">
<div class="row"><div class="col">       
  <img src="/cms/images/<?PHP echo $img_ss;?>" class="" alt="Avatar" style="width:50px;height:50px;border-radius: 100%;"></div><div class="col">
  <h2 class="text-center m-1"><?PHP echo $user_name_ss ; ?></h2>  </div></div>
   </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><?PHP echo $litter ; ?></p>
      <footer class="blockquote-footer"><?PHP  ?><cite title="Source Title"><?PHP echo $message_datee ; ?></cite></footer>
    </blockquote>
  </div>  </div> </div>
</div>
</br></br>
<?PHP } } if ($user_name_s==$_SESSION['username']) { ?><div class="col-7">
  <div class="card <?php echo _align ;?> ">
  <div class="bg-primary text-light ct" >

  <div class="row"><div class="col">       
  <img src="/cms/images/<?PHP echo $img_s;?>" class="" alt="Avatar" style="width:50px;height:50px;border-radius: 100%;"></div><div class="col">
  <h2 class="text-center m-1"><?PHP echo $user_name_s ; ?></h2>  </div></div>
    </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><?PHP echo $letter ; ?></p>
      <footer class="blockquote-footer"><?PHP  ?><cite title="Source Title"><?PHP echo $message_date ; ?></cite></footer>
    </blockquote>
  </div></div>
</div></br></br>
<?PHP   } else {   ?>   <div class="row justify-content-end">
 <div class="col-7">
<div class="card <?php echo _align ;?> " >
  <div class="ct bg-dark text-light ">
  <div class="row"><div class="col">       
  <img src="/cms/images/<?PHP echo $img_s;?>" class="" alt="Avatar" style="width:50px;height:50px;border-radius: 100%;"></div><div class="col">
  <h2 class="text-center m-1"><?PHP echo $user_name_s ; ?></h2>  </div></div>

</div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><?PHP echo $letter ; ?></p>
      <footer class="blockquote-footer"><?PHP  ?><cite title="Source Title"><?PHP echo $message_date ; ?></cite></footer>
    </blockquote></div></div>
  </div></div></br></br>
<?PHP    }    ?>  </div>






<script>
          $(document).on('submit', '#bep', function(){
      // e.preventDefault();  

        var beepsound = new Audio('images/2.mp3');   
        beepsound.play();  });

        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>




</br></br></br></br></br></br></br></br></br></br></br></br>
<?php include "includes/footer.php";?>
<?php/*   if(!isset($_SESSION['user_role'])){
header("Location: /cms/index.php");} */ ?>
