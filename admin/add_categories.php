<?php include "admin_navigation.php";?>
<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-4 xs-3 sm-3">
        <?php if(isset($_POST['create_cat'])) {
        $cat_post_id      = $_POST['cat_post_id'];
        $cat_title        = $_POST['title'];
        $cat_status       = $_POST['cat_status'];
        $cat_content      = $_POST['cat_content'];
        $cat_date         = date('d-m-y');
          $uploadsDir = "../upload/";
          $tempLocation = $_FILES['file']['tmp_name'];
          $temp = explode(".", $_FILES["file"]["name"]);
          $cat_image = uniqid() . '.' . end($temp);
          $targetFilePath = $uploadsDir . $cat_image;
          move_uploaded_file($tempLocation, "../upload/" . uniqid() . '.' . end(explode(".", $_FILES["file"]["name"])));
        $cat_user = $_SESSION['username'];
        $cat_user_id = $_SESSION['user_id'];
        $query = "INSERT INTO categories(cat_post_id, cat_title, cat_user, cat_status, cat_date, cat_image, cat_content, cat_user_id)
        VALUES(?,?,?,?,now(),?,?,?)";      
$result = $conn->prepare($query);    
$result->execute([$cat_post_id,$cat_title,$cat_user,$cat_status,$cat_image,$cat_content,$cat_user_id]);    

        $the_cat_id = $conn->lastInsertId();


        echo "<div class='alert alert-success text-center' role='alert'><a href='/cms/post.php?p_id=$cat_post_id'>" . Publishedsuccessfully . "</a></div>";}?>
        <form action="" method="post" enctype="multipart/form-data">    
        <div class="form-group">
        <h5 class="text-center"><?php echo Title ?></h5>
        <input type="text" class="form-control" name="title" required ></div>
<div class="form-group">
<h5 class="text-center"> <?php echo Status ?></h5>
<select class=custom-select name="cat_status" id="">
<option value="<?php echo Published ?>"><?php echo PPublished ?></option>
<option value="<?php echo Draft ?>"> <?php echo DDraft ?></option></select></div>   
<div class="form-group">
<h5 class="text-center"><?php echo  Post ?></h5>
<select class=custom-select name="cat_post_id" id="" required><?php
$me=$_SESSION['user_id'];


$query = "SELECT * FROM posts WHERE post_user_id = $me";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$post_id = $row['post_id'];
$post_title = $row['post_title'];


echo "<option value='$post_id'>{$post_title}</option>";}?>
</select></div>
<div class="form-group">
<h5 class="text-center"> <?php echo  Content ?></h5>
<textarea class="form-control "name="cat_content" id="editor" cols="30" rows="10"></textarea></div>
</br>
<h5 class="text-center"> <?php echo  Image  ?></h5>  </br>



<div class="file-input row justify-content-center">
  <input type="file" id="file" name="file" class="file">
  <label for="file">
    Select file
    <p class="file-name"></p>
  </label>
</div>



<br></br>
<div class="form-group">
<input class="btn btn-primary btn-block" id="but_upload" type="submit" name="create_cat" value="<?php echo Publish ?>"></div></form>
</div></div></div>
</div><br></br><br></br>
<?php include "../includes/footer.php";?>


<?php  if(!isset($_SESSION['user_role'])){
header("Location: /cms/admin/index2.php");} ?>


