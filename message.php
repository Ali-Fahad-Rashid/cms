<?php  include "admin/functions.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<br></br><br></br>
<div class="container">
<div class="row">      
<div class="col">
<div class="card">
        <h1 class="m-4 text-center"><?php echo Receive ?></h1>
        <table class="table">   
        <thead><tr><th><?php echo Title ?></th><th><?php echo From ?></th>
        <th> <?php echo Date ?> </th>        <th> <?php echo ReplyCount ?></th>
        <th> <?php echo LastReplyDate ?></th>
        <th> <?php echo Delete ?></th>
        </tr></thead>
         <?PHP $id = $_GET['u_id'];
               $idd=$_SESSION['user_id'];
         $query="SELECT * FROM messages WHERE (user_id_r = $id AND reply_of=0) OR (user_id_s = $id AND reply = 'yes')";
         $result = $conn->prepare($query);    
         $result->execute();    
         while($row = $result->fetch()){
            $message_id   = $row['message_id'];
            $user_id_r    = $row['user_id_r'];
            $user_name_r  = $row['user_name_r'];
            $user_id_s    = $row['user_id_s'];
            $user_name_s  = $row['user_name_s'];
            $letter       = $row['letter'];    
            $title        = $row['title'];    
            $message_date = $row['message_date'];    
            $status       = $row['status'];   
            $reply        = $row['reply'];   
            $count        = $row['count'];   
            $last_date    = $row['last_date'];   
            if($status=="unread"){
            ?> <tbody style="background-color: cyan;">
            <?PHP } else {?>
              <tbody style="background-color: white;">
           <?PHP }
            echo "<tr>";
            echo "<td><a class='' href='/cms/show_message.php?message=$message_id'>$title</a></td>";
            echo "<td>$user_name_s</td>";
            echo "<td>$message_date</td>";
            echo "<td>$count</td>";
            echo "<td>$last_date</td>";
            ?>
            <form method="post">
        
            <input type="hidden" name="me" value="<?php echo $message_id ?>">
        
 
        
           <td><input class="btn btn-danger" type="submit" name="del" value="<?php echo Delete ?>"></td>
        

        
        
        </form>
        <?php            echo "</tr>";}?>

         </tbody></table></br>
         <h1 class="m-4 text-center"><?php echo Sentm ?></h1>
         <table class="table">   
<thead><tr><th><?php echo Title ?></th><th><?php echo to ?></th><th><?php echo Date ?></th> <th><?php echo ReplyCount ?></th>
        <th><?php echo LastReplyDate ?></th>
        <th><?php echo Delete ?></th></tr></thead><tbody>
 <?PHP 
 $query="SELECT * FROM messages WHERE user_id_s = $id AND reply_of=0";
 $result = $conn->prepare($query);    
 $result->execute();    
 while($row = $result->fetch()){
    $message_id   = $row['message_id'];
    $user_id_r    = $row['user_id_r'];
    $user_name_r  = $row['user_name_r'];
    $user_id_s    = $row['user_id_s'];
    $user_name_s  = $row['user_name_s'];
    $letter       = $row['letter'];    
    $title        = $row['title'];    
    $message_date = $row['message_date'];    
    $count        = $row['count'];   
    $last_date    = $row['last_date']; 
    echo "<tr>";
    echo "<td><a class='' href='/cms/show_message.php?message=$message_id'>$title</a></td>";
    echo "<td>$user_name_r</td>";
    echo "<td>$message_date</td>";
    echo "<td>$count</td>";
    echo "<td>$last_date</td>";


?>
    <form method="post">

    <input type="hidden" name="mes" value="<?php echo $message_id ?>">


   <td><input class="btn btn-danger" type="submit" name="delete" value="<?php echo Delete ?>"></td>

  


</form>
<?php


    echo "</tr>";   } ?>
 </tbody></table></div></div></div></div></br></br></br></br></br></br></br></br></br>
<?php include "includes/footer.php";?>



<?php 
     if(isset($_POST['delete'])){
    $delete = $_POST['mes'];
      $query ="UPDATE `messages` SET `user_id_s` = '' WHERE `message_id` = $delete";
      $result = $conn->prepare($query);    
      $result->execute(); 
    header("location:/cms/message.php?u_id=$id"); } ?>   
    
<?php 
     if(isset($_POST['del'])){
      $delete = $_POST['me'];
      $idd=$_SESSION['user_id'];
      $query="SELECT * FROM messages WHERE message_id = '$delete'";
      $result = $conn->prepare($query);    
      $result->execute(); 
      while($row = $result->fetch()){
         $reply = $row['reply'];
         $user_id_s = $row['user_id_s']; }
      if ($reply==='yes' && $user_id_s===$id) {
         $query ="UPDATE `messages` SET `user_id_s` = '' WHERE `message_id` = $delete";
         $result = $conn->prepare($query);    
         $result->execute(); 
      } else {
    $query ="UPDATE `messages` SET `user_id_r` = '' WHERE `message_id` = $delete";
    $result = $conn->prepare($query);    
    $result->execute(); 
     }
    header("location:/cms/message.php?u_id=$id"); } 
    
    
    if($id != $idd){
      header("Location: /cms/index.php");}?>   