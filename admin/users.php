<?php include "admin_navigation.php";?>

<?php


if(isset($_POST['checkBoxArray'])) {
foreach($_POST['checkBoxArray'] as $commentValueId ){
$bulk_options = $_POST['bulk_options'];
switch($bulk_options) {
case Admin :
$query = "UPDATE users SET user_role = '$bulk_options' WHERE user_id = '$commentValueId'";
$result = $conn->prepare($query);    
$result->execute();    

break;
case User :
$query = "UPDATE users SET user_role = '$bulk_options' WHERE user_id = '$commentValueId'";
$result = $conn->prepare($query);    
$result->execute();    

break;
case 'delete' :
$query = "DELETE FROM users WHERE user_id = '$commentValueId'";
$result = $conn->prepare($query);    
$result->execute();    

break;}}}?>


<div class="container" style="font-size:15px;">
<h1 class="m-4 text-center"><?php echo WelcomeToUsers ?></h1>
<form action="" method='post'>           

<table class="table table-striped table-dark">
<div class="row">
<div class="col-3">
<select class="custom-select mr-sm-2" name="bulk_options" id="">
<option value=""><?php echo SelectOptions?></option>
<option value="<?php echo Admin ;?>"><?php echo AAdmin ?></option>
<option value="<?php echo User ;?>"><?php echo UUser ?></option>
<option value="delete"><?php echo Delete ?></option>
</select>
</div>
<input type="submit" name="submit" class="btn btn-success" value="<?php echo Apply ?>">
<thead><tr><th><input id="selectAllBoxes" type="checkbox"></th>
<th><?php echo Username ?></th><th> <?php echo Email ?></th><th> <?php echo Role ?></th>
<th><?php echo Managementt ?></th>
</tr></thead><tbody><?php    
$query = "SELECT * FROM users";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$user_id             = $row['user_id'];
$username            = $row['username'];
$user_password       = $row['user_password'];
$user_email          = $row['user_email'];
$user_role           = $row['user_role'];      
echo "<tr>";  ?>   
<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $user_id; ?>'></td>
<?php
echo "<td>$username</td>";
echo "<td>$user_email</td>";

if($user_role==Admin){
echo "<td>".AAdmin."</td>"; 
}
else {
  echo "<td>".UUser."</td>"; 
}

echo "<td>
<div class='dropdown'>
  <a class='btn btn-dark btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown'
   aria-haspopup='true' aria-expanded='false'>
   ".Management."  </a>

  <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
  <a class='dropdown-item' href='users.php?change_to_admin={$user_id}'>".AAAdmin."</a>
    <a class='dropdown-item' href='users.php?change_to_sub={$user_id}'>".UUUser."</a>
    <a class='dropdown-item' href='edit_user.php?edit_user={$user_id}'>".Edit."</a>
    <a class='dropdown-item text-danger' href='' data-toggle='modal' data-target='#myModal$user_id'>".Delete."</a>
  </div>
</div> </td>";
echo "</tr>";?>
  <!-- Modal -->
  <div class="<?php echo _align ?> modal fade" id="myModal<?=$user_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo Delete ?></h5>
        <h5 class="<?php echo _align ?>"><button type="button" class="close <?php echo _align ?>" data-dismiss="modal" aria-label="Close">
          <span class="<?php echo _align ?>" aria-hidden="true">&times;</span></h5>
        </button>
      </div>
      <div class="modal-body">
      <p><?php echo Really?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Close ?></button>
        <a href="?delete=<?= $user_id ?>" class="btn btn-primary" ><?php echo  Delete ?></a>
      </div>
    </div>
  </div>
</div>
<?php } ?></tbody></table></form><?php
if(isset($_GET['change_to_admin'])) {    
$the_user_id = $_GET['change_to_admin'];   
$query = "UPDATE users SET user_role = '".Admin."' WHERE user_id = $the_user_id   ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: users.php");}
if(isset($_GET['change_to_sub'])){    
$the_user_id = $_GET['change_to_sub'];
$query = "UPDATE users SET user_role = '".User."' WHERE user_id = $the_user_id   ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: users.php");}
if(isset($_GET['delete'])){
if($_SESSION['user_role'] == Admin) {
$the_user_id = $_GET['delete'];
$query = "DELETE FROM users WHERE user_id = '$the_user_id'";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: users.php");}}?></div></div>
<br></br><br></br></br><br></br>
<?php include "../includes/footer.php";?>

<?php 
/*  if($_SESSION['user_role']!=Admin){
  header("Location: /cms/admin/index2.php");
}  */
?>

