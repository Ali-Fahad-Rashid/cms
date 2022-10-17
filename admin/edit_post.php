<?php include "admin_navigation.php";?>
<?php
    if(isset($_GET['edit'])){
    $the_post_id =  $_GET['edit'];}
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id  ";
    $result = $conn->prepare($query);    
    $result->execute();    
    while($row = $result->fetch()){
        $post_id            = $row['post_id'];
        $post_user          = $row['post_user'];
        $post_user_id       = $row['post_user_id'];
        $post_title         = $row['post_title'];
        $post_status        = $row['post_status'];
        $post_image         = $row['post_image'];
        $post_content       = $row['post_content'];




        $Description = $row['post_description'];

        $post_comment_count = $row['post_comment_count'];
        $post_date          = $row['post_date'];}
?>

<div class="container">


<div class="row justify-content-center"> 
<div class="col-md-8 xs-3 sm-3">
<?PHP
        if(isset($_POST['create'])) {
          $post_title          =  $_POST['post_title'];
          $post_status         =  $_POST['post_status'];
          $post_image          =  $_FILES['file']['name'];
          $post_content        =  $_POST['post_content'];
          $post_content      = make_clickable($post_content);
          $Description      = $_POST['Description'];


          $tag = explode(' ',$post_title);
          $post_tags = implode(", ",$tag);
          



          if(empty($post_image)) {
          $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
          $result = $conn->prepare($query);    
          $result->execute();    
          while($row = $result->fetch()){
            $post_image = $row['post_image'];}}
else {  
  
          $uploadsDir = "../upload/";
          $tempLocation = $_FILES['file']['tmp_name'];
          $temp = explode(".", $_FILES["file"]["name"]);
          $post_image = uniqid() . '.' . end($temp);
          $targetFilePath = $uploadsDir . $post_image;
          move_uploaded_file($tempLocation, $targetFilePath);
          
                  }

            $query = "UPDATE posts SET ";
            $query .="post_title  = ?, ";
            $query .="post_date   =  now(), ";
            $query .="post_status = ?, ";
            $query .="post_tags   = ?, ";
            $query .="post_description   = ?, ";

            $query .="post_content= ?, ";
            $query .="post_image  = ? ";
            $query .= "WHERE post_id = ? ";
            $result = $conn->prepare($query);    
            $result->execute([$post_title,$post_status,$post_tags,$Description,$post_content,$post_image,$the_post_id]);    
            echo "<h6 class='alert alert-success text-center' role='alert'> <a href='/cms/post.php?p_id={$the_post_id}'>" . operationaccomplishedsuccessfully . "</a> 
             </h6>"; }?>
<form action="" method="post" enctype="multipart/form-data">           
<div class="form-group">
<h5 class="text-center"><?php echo Title ?></h5>
<input value="<?php echo htmlspecialchars(stripslashes($post_title));?>" type="text"
 class="form-control" name="post_title" required></div>

 <div class="form-group">
        <h5  class="text-center"><?php echo Description ?></h5>
        <input type="text" class="form-control" name="Description" value="<?php echo htmlspecialchars(stripslashes($Description));?>" required></div>

<div class="form-group">
<h5 class="text-center"><?php echo Status ?></h5>
<select class=custom-select name="post_status" id="">
<?php
if($post_status == Published ) {
echo "<option value=" . Published . ">" . PPublished . "</option>";
echo "<option value=" . Draft . ">" . DDraft . "</option>";    


} else {
echo "<option value=" . Draft . ">" . DDraft . "</option>";    
echo "<option value=" . Published . ">" . PPublished . "</option>";


}?></select></div> 

<!-- <div class="form-group">
<h5  class="text-center"> <?php echo Tags ?></h5>
<input value="<?php echo $post_tags; ?>"  type="text" class="form-control" name="post_tags"></div>   --> 

<h5 class="text-center"><?php echo Image ?></h5></br>
<h5 class="text-center"><img width="150" src="../upload/<?php echo $post_image; ?>" alt=""></h5></br>


<div class="file-input row justify-content-center">
  <input type="file" id="file" name="file" class="file">
  <label for="file">
    Select file
    <p class="file-name"></p>
  </label>
</div>
  
  
  <br></br>
 
<div class="form-group">
<h5  class="text-center"><?php echo Content ?></h5>
<textarea  class="form-control" name="post_content" id="editor" cols="30" rows="10">
<?php echo $post_content ?>
</textarea></div>
<h5 class="text-center"><?php echo Other ?></h5></br>


<div class="file-input row justify-content-center">
  <input type="file" id="chooseFile" name="fileUpload[]" class="file" multiple>
  <label for="chooseFile">
    Select file
    <h6 class="namee"></h6>
  </label>
</div>

<div class="imgGallery"></div>





</br>
<div class="form-group">
<input class="btn btn-lg btn-primary btn-block" id="" type="submit" name="create" value="<?php echo Save ?>">
</div></form>
<?php include "multi_upload.php";?>


</div>

</div></br></br>
<div class="row justify-content-center"> 
<?PHP
$query = "SELECT * FROM img WHERE img_post_id = $the_post_id AND img_user_id = $post_user_id";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
            $i  = $row['id'];
            $img_user_id = $row['img_user_id'];
            $img_post_id = $row['img_post_id'];
            $images = $row['images'];            ?> 
            <div class="col m-2 col-lg-1 col-md-2 col-sm-3 ">
<a  href="edit_post.php?edit=<?php echo $the_post_id; ?>&de=<?php echo $i; ?>" class="zoom btn btn-sm" name="del" id="mn">
<i class="fas fa-times mn"></i>
<img class="m-2" width="100" height="80" src="../upload/<?php echo $images; ?>" alt="">  </a> </div>
<?PHP }?>
</div>
</div>
</div>


</br></br>
<?php include "../includes/footer.php";?>


<?PHP
if (isset($_GET['de'])) {
$i=$_GET['de'];

$query = "SELECT * FROM img WHERE id = '$i'";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
            $i  = $row['id'];
            $img_user_id = $row['img_user_id'];
            $img_post_id = $row['img_post_id'];
            $images = $row['images'];  } 
            unlink('../upload/'.$images);


  $query = "DELETE FROM img WHERE id = '$i'";
  $result = $conn->prepare($query);    
  $result->execute();    



  header("Location: edit_post.php?edit=$the_post_id");
}?>
<style>
.mn {color: red;
  position: relative;
  top: 30px ;
  right: 40px;

}

</style>

<?php  if(!isset($_SESSION['user_role'])){
header("Location: /cms/admin/index2.php");} ?>



  
<?php 
if($_SESSION['user_role']!=Admin && $_SESSION['user_id']!=$post_user_id ) {
header("Location: /cms/admin/index2.php");} 
?>