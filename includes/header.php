<!DOCTYPE html> 
<?php if(isset($_SESSION['lang'])){
if($_SESSION['lang']=="ar"){
                include "lang/ar.php";
              }
              if($_SESSION['lang']=="en") { include "lang/en.php"; }
              }
                else { include "lang/ar.php";} ?>
<html dir="<?php echo dire ; ?>" lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <link rel="icon" type="image/jpg" href="images/ss.jpg">
         <!-- bootstrap -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
         <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="/cms/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<!-- editor -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- Ajax -->
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 -->   
 <script src="/cms/js/jquery.js"></script>

  <title>Programming Institution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">




<!--     <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e560fc9073384faa8558', {
      cluster: 'mt1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script> -->




</head><body>
<!-- background -->
<?php 
if(isset($_SESSION['user_id'])){
$x = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $x  ";
$result = $conn->prepare($query);    
$result->execute();    
$row = $result->fetch();
$picture = $row['background']; ?>
<style>
body {background-image: url("/cms/background_picture/<?php echo $picture;?>");}
</style>
<?php }?>  
<!--FONT-->
<?php 
if(isset($_SESSION['user_id'])){
$x = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $x  ";
$result = $conn->prepare($query);    
$result->execute();    
$row = $result->fetch();
$font = $row['font']; ?>  
<style>
@import url('https://fonts.googleapis.com/css2?family=Amiri:ital@1&family=Harmattan&family=Lateef&family=Open+Sans+Condensed:wght@300&family=Rakkas&family=Scheherazade&family=Tajawal:wght@200&family=Tangerine&display=swap');
body,.card{ font-family: <?php echo $font ;?> , sans-serif;}
</style>
<?php } ?>
<!--DARK MODE-->
 <?php 
if(isset($_SESSION['user_id'])){
$x=0;
$x = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $x  ";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$color_light = $row['color_light']; 
$color_dark = $row['color_dark']; 
$back_light = $row['back_light']; 
$back_dark = $row['back_dark'];
}
if(empty($color_light)){ ?>
  <style>
  :root {
    --on-background: black;
    --background: white;}
  [data-theme="dark"] {
    --on-background: white ;
    --background: black;}
    </style>
    <?php  } 
else {
?>
<style>
:root {
  --on-background: <?php echo $color_light ;?>;
  --background: <?php echo $back_light ;?>;}
[data-theme="dark"] {
  --on-background:<?php echo $color_dark ;?>;
  --background:<?php echo $back_dark ;?>;}
  </style>
<?php } }?>  


<?php
if(isset($_SESSION['user_id'])){

if(isset($_COOKIE['user'])){
  $id=$_COOKIE['user'];

  $query="SELECT * FROM users WHERE user_id='$id'";
  $result=$conn->prepare($query);
  $result->execute();

while($row=$result->fetch()){
$email=$row['user_email'];
$user_id=$row['user_id'];
$user_role=$row['user_role'];
$user_image=$row['user_image'];
$lang=$row['lang'];
$user=$row['username'];
}
$_SESSION['user_id']=$user_id;
$_SESSION['username']=$user;
$_SESSION['user_email']=$email;
$_SESSION['user_role']=$user_role;
$_SESSION['user_image'] = $user_image;
$_SESSION['lang'] = $lang;
} }
?>


<?php
if(isset($_SESSION['user_id'])){
$x=$_SESSION['user_id'];
$session = session_id();
$query="UPDATE users SET user_time = now(), user_session = '$session', user_status = 'Online'  WHERE user_id='$x'";
$result=$conn->prepare($query);
$result->execute();
}

?>


<script>
    setInterval(function () {

      $.ajax({
url: "/cms/includes/online.php",
type: 'POST',

data: {
'sleep': 1,

},


});


    }, 100);  

</script>


