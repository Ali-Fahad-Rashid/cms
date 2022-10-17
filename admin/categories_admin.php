<?php include "admin_navigation.php";?>
<?php
if(isset($_POST['checkBoxArray'])) {
foreach($_POST['checkBoxArray'] as $postValueId ){     
$bulk_options = $_POST['bulk_options'];     
switch($bulk_options) { case Published:
$query = "UPDATE admin_category SET cat_status = '{$bulk_options}' WHERE cat_id = {$postValueId}  ";     
$result = $conn->prepare($query);    
$result->execute();       
break; case Draft:     
$query = "UPDATE admin_category SET cat_status = '{$bulk_options}' WHERE cat_id = {$postValueId}  ";      
$result = $conn->prepare($query);    
$result->execute();   
break; case 'delete':      
$query = "DELETE FROM admin_category WHERE cat_id = {$postValueId}  ";      
$result = $conn->prepare($query);    
$result->execute();  
break;}}}?>
<div class="container" style="font-size:15px;">
<form action="" method='post'>
<h1 class="m-4 text-center"><?php echo WelcomeToAdmin ?></h1>
<table class="table table-striped table-dark">
<div class="row">
<div class="col-3">
<select class="form-control" name="bulk_options" id="">
<option value=""><?php echo SelectOptions ?></option>
<option value="<?php echo Published ?>"><?php echo PPublished ?></option>
<option value="<?php echo Draft ?>"><?php echo DDraft ?></option>
<option value="delete"><?php echo Delete ?></option>
</select></div>         
<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="<?php echo Apply ?>">
<a class="btn btn-primary" href="add_categories_admin.php"><?php echo Addd ?></a> </div></div>   
<thead><tr>
<th><input id="selectAllBoxes" type="checkbox"></th>
                        <th><?php echo Name ?></th>
                        <th><?php echo Title ?></th>
                        <th><?php echo Status ?></th>
                        <th><?php echo Image ?></th>
                        <th><?php echo Date ?></th>
                        <th><?php echo Post ?></th>
                        <th><?php echo Managementt ?></th>
                        </tr></thead><tbody><?php 


 $query = "SELECT * FROM admin_category ORDER BY cat_id DESC";
 $result = $conn->prepare($query);    
 $result->execute();    
 foreach($result->fetchall() as $v => $row){
  $cat_id            = $row['cat_id'];
        $cat_post_id       = $row['cat_post_id'];
        $cat_user          = $row['cat_user'];
        $cat_title         = $row['cat_title'];
        $cat_status        = $row['cat_status'];
        $cat_image         = $row['cat_image'];
        $cat_date          = $row['cat_date'];
        echo "<tr>";?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $cat_id; ?>'></td><?php
        echo "<td>$cat_user</td>";
        echo "<td>$cat_title</td>";
        if($cat_status==Published){
          echo "<td>".PPublished."</td>"; 
          }
          else {
            echo "<td>".DDraft."</td>"; 
          }        echo "<td><img width='100' src='../upload/$cat_image' alt='image'></td>";
        echo "<td>$cat_date </td>";
        $query = "SELECT * FROM posts WHERE post_id = $cat_post_id ";
        $result = $conn->prepare($query);    
        $result->execute();    
        while($row = $result->fetch()){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "<td><a class='btn btn-dark btn-sm' href='../post.php?p_id=$post_id'>$post_title</a></td>";}
        echo "<td>
        <div class='dropdown'>
        <a class='btn btn-dark btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown'
        aria-haspopup='true' aria-expanded='false'>
        " . Management . "  </a>
        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
        <a class='dropdown-item' href='edit_categories_admin.php?edit={$cat_id}'>" . Edit . "</a>
        <a class='dropdown-item text-danger' data-toggle='modal' data-target='#myModal$cat_id'>" . Delete . "</a>
        </div>
        </div> </td>";
        echo "</tr>";?>
  <!-- Modal -->
<div class="<?php echo _align ?> modal fade" id="myModal<?=$cat_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <a href="?delete=<?= $cat_id ?>" class="btn btn-primary"><?php echo Delete ?></a>
      </div>
    </div>
  </div>
</div>
    <?php }?>
    </tbody></table></form><?php 
    if(isset($_GET['delete'])){
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM admin_category WHERE cat_id = {$the_cat_id} ";
    $result = $conn->prepare($query);    
    $result->execute();    
          header("Location: /cms/admin/categories_admin.php");}?>   
    </div></div>
    <br></br><br></br><br></br>    <br></br><br></br><br></br><br></br>

    <?php include "../includes/footer.php";?>

    <?php  if($_SESSION['user_role']!=Admin){
header("Location: /cms/admin/index2.php");} ?>