<?php include "admin_navigation.php";?>

<?php


if(isset($_POST['checkBoxArray'])) {
foreach($_POST['checkBoxArray'] as $postValueId ){     
$bulk_options = $_POST['bulk_options'];     
switch($bulk_options) { case 'Published':
$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";     
$result = $conn->prepare($query);    
$result->execute();        
break; case 'Draft':     
$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";      
$result = $conn->prepare($query);    
$result->execute();    
break; case 'delete':      
$query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";      
$result = $conn->prepare($query);    
$result->execute();    

$quer = "DELETE FROM comments WHERE comment_post_id = {$postValueId} ";
$result = $conn->prepare($quer);    
$result->execute();    


break;}}}?>
<div class="container" style="font-size:15px;">
<h1 class="m-4 text-center"><?php  echo WelcomeToPosts ?></h1></br>
<form action="" method='post'>
<table class="table table-striped table-dark">
<div class="row">
<div class="col-3">
<select class="form-control" name="bulk_options" id="">
<option value=""><?php  echo SelectOptions ?></option>
<option value="<?php  echo Published ?>"><?php  echo PPublished ?></option>
<option value="<?php  echo Draft ?>"><?php  echo DDraft ?></option>
<option value="delete"><?php echo Delete ?></option>
</select></div>         
<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="<?php echo Apply ?>">
<a class="btn btn-primary" href="add_post.php"><?php  echo Addd?></a> </div></div>   
<thead><tr>
<th><input id="selectAllBoxes" type="checkbox"></th>
                        <th><?php  echo Name ?></th>
                        <th><?php  echo Title ?></th>
                        <th><?php  echo Status ?></th>
                        <th><?php  echo Image ?></th>
                        <th><?php  echo Tags ?></th>
                        <th><?php  echo Date ?></th>
                        <th><?php  echo Managementt ?></th>
                        </tr></thead><tbody><?php 
if($_SESSION['user_role']=='User'){$t= $_SESSION['user_id'];
$query = "SELECT * FROM posts WHERE post_user_id = '$t' ORDER BY post_id DESC";
}
else {
$query = "SELECT * FROM posts ORDER BY post_id DESC";
}

$result = $conn->prepare($query);    
$result->execute();    
foreach($result->fetchall() as $v => $row){
  $post_id            = $row['post_id'];
        $post_user          = $row['post_user'];
        $post_user_id       = $row['post_user_id'];
        $post_title         = $row['post_title'];
        $post_category_id   = $row['post_category_id'];
        $post_status        = $row['post_status'];
        $post_image         = $row['post_image'];
        $post_tags          = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date          = $row['post_date'];
        $post_views_count   = $row['post_views_count'];
        echo "<tr>";?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td><?php
        echo "<td>$post_user</td>";
        echo "<td>$post_title</td>";
        $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
        $result = $conn->prepare($query);    
        $result->execute();    
        while($row = $result->fetch()){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<td>$cat_title</td>";}

        if($post_status=='Published'){
          echo "<td>".PPublished."</td>"; 
          }
          else {
            echo "<td>".DDraft."</td>"; 
          }        
        echo "<td><img width='100' src='../upload/$post_image' alt='image'></td>";
        echo "<td>$post_tags</td>";
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $result = $conn->prepare($query);    
        $result->execute();    
                $count_comments =  $result->rowCount();

        $query = "SELECT * FROM likes WHERE post_id = $post_id";
        $result = $conn->prepare($query);    
        $result->execute();    
                $count_likes =  $result->rowCount();

        echo "<td>$post_date </td>";
        echo "<td>
        <div class='dropdown'>
        <a class='btn btn-dark btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown'
        aria-haspopup='true' aria-expanded='false'>". Management ."</a>
        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
        <a class='dropdown-item' href='../post.php?p_id={$post_id}'>" . Likes . "
        <span class='badge badge-warning'> $count_likes</span></a>
        <a class='dropdown-item' href='../post.php?p_id={$post_id}'>" . Comments . "
         <span class='badge badge-warning'> $count_comments</span></a>
         <a class='dropdown-item' href='../post.php?p_id={$post_id}'>" . views . "
         <span class='badge badge-warning'> $post_views_count</span></a>
        <a class='dropdown-item' href='edit_post.php?edit=$post_id'>" . Edit . "</a>
        <a class='dropdown-item text-danger' href='#' data-toggle='modal' data-target='#myModal$post_id'>" . Delete . "</a>
        </div>
        </div> </td>";
        echo "</tr>";?>

 <!-- Modal -->
 <div class="<?php echo _align ?> modal fade" id="myModal<?=$post_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php  echo Close ?></button>
        <a href="?delete=<?= $post_id ?>" class="btn btn-primary" ><?php  echo Delete ?></a>
      </div>
    </div>
  </div>
</div>
 <?php } ?>
        </tbody></table></form><?php 
    if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
    $result = $conn->prepare($query);    
    $result->execute();    
        $quer = "DELETE FROM comments WHERE comment_post_id = {$post_id} ";
    $result = $conn->prepare($query);    
    $result->execute();    
        header("Location: /cms/admin/posts.php");}  ?>   

</div></div>
</br></br></br></br></br></br></br></br></br>
<?php include "../includes/footer.php";?>
<?php  if(!isset($_SESSION['user_role'])){
header("Location: /cms/index.php");} ?>

