<?php
include "db.php"; 
if (isset($_POST['get'])) {
$startt = $_POST['startt'];
$limitt = $_POST['limitt'];
$x=$_SESSION['user_id'];
$query = "SELECT * from `notifications_message` where `notification_user_id`='$x' order by `date` DESC LIMIT $startt, $limitt";
$result=mysqli_query($connection,$query);
$count=mysqli_num_rows($result);
if($count>0){ 	$res = "";
while( $row = mysqli_fetch_assoc($result)){
$notification_post_id      = $row['notification_post_id'];
$name                      = $row['username'];
$type                      = $row['type'];
$message                   = $row['message'];
$status                    = $row['status'];
$date                      = $row['date'];    
$notification_user_id      = $row['notification_user_id'];    
$message_id      = $row['message_id'];    
$reply_of      = $row['reply_of'];    
if($status=='unread'){$b="orange";}
else{ $b="white"; }
if($reply_of==0){$k=$message_id;}
else {$k=$reply_of;}
 if($type =='message'){$a="$name" . " " . " send message to you";
    $res .="
    <a style ='background-color :$b;' class='dropdown-item' 
    href='/cms/show_message.php?message=$k'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='dropdown-divider'></div>  ";
}
else if($type =='reply_message'){$a="$name" . " " . "Reply on your message";
    $res .="
    <a style ='background-color :$b;' class='dropdown-item' 
    href='/cms/show_message.php?message=$k'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='dropdown-divider'></div>  ";
}
}
exit($res);
}
else exit('reach'); 
}