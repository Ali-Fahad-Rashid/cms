<?php
include "db.php"; 
if(isset($_SESSION['user_id'])){

 if(isset($_POST['sleep'])){
  $query="UPDATE users SET user_status = 'Offline' WHERE user_time < now()"; 
  $result=$conn->prepare($query);
  $result->execute();
} 
}

?>
