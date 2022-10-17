<!-- notification -->
<?php 
if(isset($_SESSION['user_id'])){
    ?> 
<li id="ll" class="footer nana dropdown">
<a class="zoom nana footer btn " id="vvv" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell fa-1x"></i> 
<span class='badge badge-primary count'><?php
$x=$_SESSION['user_id']; $count = 0;
$query = "SELECT * from `notifications` where `notification_user_id`='$x' order by `date` DESC";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
    $count = $row['notification_count'];}
    if($count>0){
 echo $count ; ?>
 </span>
<?php } ?>
</a>
<div  class="coloor dropdown-menu">
<div id="kkk" class="coloor scrollbar">
<?PHP
/* 
$query = "SELECT COUNT(*) FROM `notifications` WHERE `notification_user_id`='$x' ORDER BY `date` DESC";
$result=$conn->prepare($query);
$result->execute();
$count =$result->fetchColumn();

if($count>0){ 	

 $query = "SELECT * FROM `notifications` WHERE `notification_user_id`='$x' ORDER BY `date` DESC";
 $result = $conn->prepare($query);    
 $result->execute();    
while($row = $result->fetch()){
$notification_post_id      = $row['notification_post_id'];
$name                      = $row['username'];
$type                      = $row['type'];
$message                   = $row['message'];
$status                    = $row['status'];
$date                      = $row['date'];    
$notification_user_id      = $row['notification_user_id'];    
if($status=='unread'){$b="glow";}
else{ $b="coloor"; }
if($type =='comment'){ $a="$name" . " " . Commentedonyourpost;
   echo "<a  class=' btn zzoom dropdown-item $b' 
    href='/cms/post.php?p_id=$notification_post_id'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='dropdown-divider'></div>  ";}

else if($type =='reply'){$a="$name" . " " . Replyonyourcomment;
    echo "<a  class=' btn zzoom dropdown-item $b' 
    href='/cms/post.php?p_id=$notification_post_id'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='dropdown-divider'></div>  ";}
  
  
    else if($type =='friends'){$a="$name" . " " . SentYouaFriendRequest;
        echo "<a  class=' btn zzoom dropdown-item $b' 
        href='/cms/friends.php'>
        $a <br/>  " . "<small><i>$date</i></small>" . " </a>
        <div id='load_data_message' class='dropdown-divider'></div>  ";}

    else if($type =='follow'){$a="$name" . " " . Followyou;
        echo "<a  class=' btn zzoom dropdown-item $b' 
        href='/cms/profile.php?u_id=$notification_post_id'>
        $a <br/>  " . "<small><i>$date</i></small>" . " </a>
        <div id='load_data_message' class='dropdown-divider'></div>  ";}

        else if($type =='accept'){$a="$name" . " " . AcceptyourFriendRequest;
            echo "<a  class=' btn zzoom dropdown-item $b' 
            href='/cms/profile.php?u_id=$notification_post_id'>
            $a <br/>  " . "<small><i>$date</i></small>" . " </a>
            <div id='load_data_message' class='dropdown-divider'></div>  ";}

 */
?>

       




<?php

     //   }







    //} 
?>




<?php if($count<=0){ echo "<h6 class='text-center' >" . YouDontHaveAnyNotification . "</h6>"; }?>
</div>
</div>
</li>
<!-- notification  END -->
<!-- message -->
<li id="ll" class="footer nana dropdown">
<a class="zoom nana btn footer " id="rrr" href="" data-toggle="dropdown"
><i class="fas fa-envelope"></i> 
<span class='badge badge-primary countt'><?php $x=$_SESSION['user_id']; $count = 0;
$query = "SELECT * from `notifications_message` where `notification_user_id`='$x' order by `date` DESC";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$count = $row['notification_count'];}
if($count>0){
 echo $count ; ?></span>
<?php } ?>
</a>
<div class=" coloor dropdown-menu">
<div id="mmm" class="coloor scrollbar">
<?php
$query = "SELECT COUNT(*) from `notifications_message` where `notification_user_id`='$x' order by `date` DESC";
$result=$conn->prepare($query);
$result->execute();
$count =$result->fetchColumn();

if($count>0){ 	
$query = "SELECT * from `notifications_message` where `notification_user_id`='$x' order by `date` DESC";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$notification_post_id      = $row['notification_post_id'];
$name                      = $row['username'];
$type                      = $row['type'];
$message                   = $row['message'];
$status                    = $row['status'];
$date                      = $row['date'];    
$notification_user_id      = $row['notification_user_id'];    
$message_id      = $row['message_id'];    
$reply_of      = $row['reply_of'];    
if($status=='unread'){$b="glow";}
else{ $b="coloor"; }
if($reply_of==0){$k=$message_id;}
else {$k=$reply_of;}
 if($type =='message'){$a="$name" . " " . sendmessagetoyou;
    echo "
    <a  class=' btn zzoom dropdown-item $b' 
    href='/cms/show_message.php?message=$k'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='dropdown-divider'></div>  ";
}
else if($type =='reply_message'){$a="$name" . " " . Replyonyourmessage;
    echo "
    <a  class=' btn zzoom dropdown-item $b' 
    href='/cms/show_message.php?message=$k'>
    $a <br/>  " . "<small><i>$date</i></small>" . " </a>
    <div id='load_data_message' class='coloor dropdown-divider'></div>  ";
}
} }?>

<?php if($count<=0){ echo "<h6 class='text-center'>" . YouDontHaveAnymessages . "</h6>"; }?>
</div>
<h6 class="text-center coloor m-2"><a href="/cms/message.php?u_id=<?PHP echo $x ;?>"> <?PHP echo  ShowAllMessage ?></a></h6>
</div>
</li>
<?php } ?>
<!-- message  END -->
<style>
#ll{
    display:inline;
}
#search{
  border: none;
}
</style>

<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        -->
       
       <script type="text/javascript">
            var start = 0;
            var limit = 5;
            var reachedMax = false;
            $("div").scroll(function () {
                if ($("div").scrollTop() == $("div").height() - $("div").height())
                    getData();
            });
            $(document).ready(function () {
               getData();
            });
            function getData() {
                if (reachedMax)
                    return;
                $.ajax({
                   url: '/cms/includes/other/notifications.php',
                   method: 'POST',
                    dataType: 'text',
                   data: {
                       getData: 1,
                       start: start,
                       limit: limit
                   },
                   success: function(response) {
                        if (response == "reachedMax")
                            reachedMax = true;
                        else {
                            start += limit;
                            $("#kkk").append(response);
                        }
                    }
                });
            }
        </script> 


        <!-- message --><!-- 
<script type="text/javascript">
            var startt = 0;
            var limitt = 5;
            var reach = false;
            $("div").scroll(function () {
                if ($("div").scrollTop() == $("div").height() - $("div").height())
                    get();
            });
            $(document).ready(function () {
               get();
            });
            function get() {
                if (reach)
                    return;
                $.ajax({
                   url: '/cms/includes/notifications_message.php',
                   method: 'POST',
                    dataType: 'text',
                   data: {
                       get: 1,
                       startt: startt,
                       limitt: limitt
                   },
                   success: function(res) {
                        if (res == "reach")
                            reach = true;
                        else {
                            startt += limitt;
                            $("#mmm").append(res);
                        }
                    }
                });
            }
        </script> -->

<!-- setInterval(function(){
$("#kkk").load('/cms/includes/notifications.php')
}, 200);  -->