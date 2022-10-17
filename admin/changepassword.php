<?php include "admin_navigation.php";?>
<div class="container">
 
<div class="row justify-content-center"> 
    </br><br></br>

    <form action="" method="post" enctype="multipart/form-data">    
    <h5 class="text-center"><?php echo Password ?></h5>
    <input type="text" value="" class="form-control" name="user_password" required></br>
    <h5 class="text-center"><button class="btn btn-primary text-center" type="submit" name="edit" value="Save"><?php echo Save ?></button></h5>
</form></div>

<?php
if(isset($_GET['edit'])){ $hashed_password='kkk';
$the_user_id =  $_GET['edit'];
          if(isset($_POST['edit'])) {
          $user_password = $_POST['user_password'];
          $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
          $query = "UPDATE users SET ";
          $query .="user_password   = ? ";
          $query .= "WHERE user_id = ? ";
          $result = $conn->prepare($query);    
          $result->execute([$hashed_password,$the_user_id]);    
          echo "</br><div class='alert alert-success text-center' role='alert'>" . operationaccomplishedsuccessfully . "</div>";}}?>  

</div></div>
</br><br></br></br><br></br></br><br></br></br>
<?php include "../includes/footer.php";?>
   

   
<?php 
if($_SESSION['user_role']!=Admin && $_SESSION['user_id']!=$the_user_id){
header("Location: /cms/admin/index2.php");} 
?>