<?php
include "db.php"; 
if (isset($_POST['getData'])) {
$start = $_POST['start'];
$limit = $_POST['limit'];
$x=$_SESSION['user_id'];
$query = "SELECT * FROM `notifications` WHERE `notification_user_id`='$x' ORDER BY `date` DESC LIMIT $start, $limit";
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);
if($count>0){ 	$response = "";
while( $row = mysqli_fetch_assoc($result)){
$notification_post_id      = $row['notification_post_id'];
$name                      = $row['username'];
$type                      = $row['type'];
$message                   = $row['message'];
$status                    = $row['status'];
$date                      = $row['date'];    
$notification_user_id      = $row['notification_user_id'];    
if($status=='unread'){$b="yellow";}
else{ $b="white"; }
if($type =='comment'){$a="$name" . " " . "Commented on your post";
    $response .="<a style ='background-color :$b;' class='dropdown-item' 
    href='/cms/post.php?p_id=$notification_post_id'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='dropdown-divider'></div>  ";}
else if($type =='reply'){$a="$name" . " " . "Reply on your comment";
    $response .="<a style ='background-color :$b;' class='dropdown-item' 
    href='/cms/post.php?p_id=$notification_post_id'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='dropdown-divider'></div>  ";}
  
  
    else if($type =='friends'){$a="$name" . " " . " Sent You a Friend Request";
        $response .="<a style ='background-color :$b;' class='dropdown-item' 
        href='/cms/friends.php'>
        $a <br/>  " . "<small><i>$date</i></small>" . " </a>
        <div id='load_data_message' class='dropdown-divider'></div>  ";}
    else if($type =='follow'){$a="$name" . " " . "Follow you";
        $response .="<a style ='background-color :$b;' class='dropdown-item' 
        href='/cms/profile.php?u_id=$notification_post_id'>
        $a <br/>  " . "<small><i>$date</i></small>" . " </a>
        <div id='load_data_message' class='dropdown-divider'></div>  ";}
        else if($type =='accept'){$a="$name" . " " . "Accept your Friend Request";
            $response .="<a style ='background-color :$b;' class='dropdown-item' 
            href='/cms/profile.php?u_id=$notification_post_id'>
            $a <br/>  " . "<small><i>$date</i></small>" . " </a>
            <div id='load_data_message' class='dropdown-divider'></div>  ";}


 } exit($response);}
else exit('reachedMax');}