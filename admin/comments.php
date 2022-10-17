<?php include "admin_navigation.php";?>

<?php
if(isset($_POST['checkBoxArray'])) {
foreach($_POST['checkBoxArray'] as $commentValueId ){
$bulk_options = $_POST['bulk_options'];
switch($bulk_options) {
case Approve:
$query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}  ";
$result = $conn->prepare($query);    
$result->execute();    
break;
case Unapprove:
$query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}  ";
$result = $conn->prepare($query);    
$result->execute();    
break;
case 'delete' :
$query = "DELETE FROM comments WHERE comment_id = {$commentValueId}  ";
$result = $conn->prepare($query);    
$result->execute();    
break;}}}?>

<div class="container" style="font-size:15px;">

<h1 class="m-4 text-center"><?php echo WelcomeToComments ?></h1>
<form action="" method='post'>           
<table class="table table-striped table-dark">   
<div class="row">
<div class="col-3">
<select class="custom-select mr-sm-2" name="bulk_options" id="">
<option value=""><?php echo SelectOptions ?></option>
<option value="<?php echo Approve ?>"><?php echo AApprove ?></option>
<option value="<?php echo Unapprove ?>"><?php echo UUnapprove ?></option>
<option value="delete"><?php echo Delete ?></option>
</select>
</div>
<input type="submit" name="submit" class="btn btn-success" value="<?php echo Apply ?>">
<thead>
<tr>
<th><input id="selectAllBoxes" type="checkbox"></th>
<th><?php echo Name ?></th>
<th><?php echo Email ?></th>
<th><?php echo Status ?></th>
<th><?php echo Date ?></th>
<th><?php echo Post ?></th>
<th><?php echo Managementt ?></th>
</tr></thead>
<tbody>
<?php 
        if($_SESSION['user_role']===User){$t= $_SESSION['user_id'];
     $query = "SELECT * FROM comments WHERE comment_user_id = '$t' ORDER BY comment_id DESC";}
          else{
    $query = "SELECT * FROM comments ORDER BY comment_id DESC";}
    $result = $conn->prepare($query);    
    $result->execute();    
    foreach($result->fetchall() as $v => $row){
      $comment_id          = $row['comment_id'];
        $comment_post_id     = $row['comment_post_id'];
        $comment_user_id     = $row['comment_user_id'];
        $comment_user        = $row['comment_user'];
        $comment_email       = $row['comment_email'];
        $comment_status      = $row['comment_status'];
        $comment_date        = $row['comment_date'];
        echo "<tr>";?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td><?php
        echo "<td>$comment_user</td>";
        echo "<td>$comment_email</td>";


        if($comment_status==Approve){
          echo "<td>".AApprove."</td>"; 
          }
          else {
            echo "<td>".UUnapprove."</td>"; 
          }

        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
        $result = $conn->prepare($query);    
        $result->execute();    
        while($row = $result->fetch()){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "<td>$comment_date</td>";
        echo "<td><a class='btn btn-primary btn-sm' href='../post.php?p_id=$post_id'>$post_title</a></td>";}
echo "<td>
<div class='dropdown'>
<a class='btn btn-danger btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown'
aria-haspopup='true' aria-expanded='false'>
" . Management . " </a>
<div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
<a class='dropdown-item text-success' href='comments.php?approve=$comment_id'>" . AApprove . "</a>
<a class='dropdown-item text-info' href='comments.php?unapprove=$comment_id'>" . UUnapprove . "</a>

<a class='dropdown-item text-warning' href='com.php?edit={$comment_id}'>" . Edit . "</a>

<a class='dropdown-item text-danger' href='#' data-toggle='modal' data-target='#myModal$comment_id'>" . Delete . "</a>
</div>
</div> </td>";
echo "</tr>";  ?>


  <!-- Delete Modal -->
  <div class="<?php echo _align ?> modal fade" id="myModal<?=$comment_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel"><?php echo Delete ?></h5>
        <h5 class="<?php echo _align ?>"><button type="button" class="close <?php echo _align ?>" data-dismiss="modal" aria-label="Close">
          <span class="<?php echo _align ?>" aria-hidden="true">&times;</span></h5>
        </button>
      </div>
      <div class="modal-body">
      <p><?php echo Really ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Close ?></button>
        <a href="?delete=<?= $comment_id ?>" class="btn btn-primary" ><?php echo Delete ?></a>
      </div>
    </div>
  </div>
</div>

<?php }  ?>
</tbody></table></form><?php
if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = '".Approve."' WHERE comment_id = $the_comment_id   ";
    $result = $conn->prepare($query);    
    $result->execute();    
        header("Location: comments.php");}
if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = '".Unapprove."' WHERE comment_id = $the_comment_id ";
    $result = $conn->prepare($query);    
    $result->execute();    
        header("Location: comments.php");}
if(isset($_GET['delete'])){
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $result = $conn->prepare($query);    
    $result->execute();    
        header("Location: comments.php");}?>
    </div></div>  
    <br></br><br></br><br></br>    <br></br><br></br><br></br><br></br>

<?php include "../includes/footer.php";?>



<?php  if(!isset($_SESSION['user_role'])){
header("Location: /cms/admin/index2.php");} ?>