<?php include "admin_navigation.php";?>

<?php
    if(isset($_GET['edit'])){
    $the_cat_id =  $_GET['edit'];}
    $query = "SELECT * FROM admin_category WHERE cat_id = $the_cat_id";
    $result = $conn->prepare($query);    
    $result->execute();    
    while($row = $result->fetch()){
        $cat_post_id       = $row['cat_post_id'];
        $cat_id            = $row['cat_id'];
        $cat_user          = $row['cat_user'];
        $cat_title         = $row['cat_title'];
        $cat_status        = $row['cat_status'];
        $cat_image         = $row['cat_image'];
        $cat_date          = $row['cat_date'];
        $cat_user_id          = $row['cat_user_id'];

        $cat_content       = $row['cat_content'];}
      ?>

<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-4 xs-3 sm-3">

<?php 
if(isset($_POST['update_cat'])) {
        $cat_post_id        =  $_POST['cat_post'];
        $cat_title          =  $_POST['cat_title'];
        $cat_status         =  $_POST['cat_status'];
        $cat_image          =  $_FILES['file']['name'];
        $cat_content        =  $_POST['cat_content'];

        if(empty($cat_image)) {
        $query = "SELECT * FROM admin_category WHERE cat_id = $the_cat_id ";
        $result = $conn->prepare($query);    
        $result->execute();    
        while($row = $result->fetch()){
          $cat_image = $row['cat_image'];}}
          else {         

            $uploadsDir = "../upload/";
            $tempLocation = $_FILES['file']['tmp_name'];
            $temp = explode(".", $_FILES["file"]["name"]);
            $cat_image = uniqid() . '.' . end($temp);
            $targetFilePath = $uploadsDir . $cat_image;
            move_uploaded_file($tempLocation, $targetFilePath);

}
          $query = "UPDATE admin_category SET ";
          $query .="cat_post_id  = ?, ";
          $query .="cat_title  = ?, ";
          $query .="cat_date   =  now(), ";
          $query .="cat_status = ?, ";
          $query .="cat_content= ?, ";
          $query .="cat_image  = ? ";
          $query .= "WHERE cat_id = ? ";
          $result = $conn->prepare($query);    
          $result->execute([$cat_post_id,$cat_title,$cat_status,$cat_content,$cat_image,$the_cat_id]);    
          
          echo "<div class='alert alert-success text-center' role='alert'><a href='/cms/post.php?p_id=$cat_post_id'>" . operationaccomplishedsuccessfully . "</a>  </div>";
          
          }?>


<form action="" method="post" enctype="multipart/form-data">           
<div class="form-group">
<h5 class="text-center"><?php echo Title ?></h5>
<input value="<?php echo htmlspecialchars(stripslashes($cat_title));?>" type="text" class="form-control" name="cat_title"></div>
<div class="form-group">
<h5 class="text-center"><?php echo Status ?></h5>
<select class=custom-select name="cat_status" id="">
<?php
if($cat_status == Published) {
echo "<option value=" . Published . ">" . PPublished . "</option>";
echo "<option value=" . Draft . ">" . DDraft . "</option>";    


} else {
echo "<option value=" . Draft . ">" . DDraft . "</option>"; 
echo "<option value=" . Published . ">" . PPublished . "</option>";


}?></select></div>   
<div class="form-group">
<h5 class="text-center"><?php echo Post ?></h5>
<select class=custom-select name="cat_post" id=""><?php
$query = "SELECT * FROM posts ";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$post_id = $row['post_id'];
$post_title = $row['post_title'];
if($post_id == $cat_post_id) {     
echo "<option selected value='{$post_id}'>{$post_title}</option>";
} else {
echo "<option value='{$post_id}'>{$post_title}</option>";}}?></select></div></br>
<h5 class="text-center"><?php echo Image ?></h5></br>
<h6 class="text-center"><img width="150" src="../upload/<?php echo $cat_image; ?>" alt=""><h6>
<br></br>
<div class="file-input row justify-content-center">
  <input type="file" id="file" name="file" class="file">
  <label for="file">
    Select file
    <p class="file-name"></p>
  </label>
</div><br></br>
<div class="form-group">
<h5 class="text-center"><?php echo Content ?></h5>
<textarea  class="form-control "name="cat_content" id="editor" cols="30" rows="10"><?php echo $cat_content ?></textarea></div>
<div class="form-group"></br>
<input class="btn btn-primary btn-block" id="but_upload" type="submit" name="update_cat" value="<?php echo Save ?>">
</div></form></div></div></div></div></br></br>
<?php include "../includes/footer.php";?>
<?php if($_SESSION['user_role']!=Admin){
  header("Location: /cms/admin/index2.php");
}?>

  
<?php 
if($_SESSION['user_role']!=Admin && $_SESSION['user_id']!=$cat_user_id ) {
header("Location: /cms/admin/index2.php");} 
?>