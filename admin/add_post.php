<?php include "admin_navigation.php";?>
<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-8 xs-3 sm-3">
        <form action="" method="post" enctype="multipart/form-data">    
        <?php
if(isset($_POST['create'])) {
            $post_title        = $_POST['title'];
            $post_status       = $_POST['post_status'];


            $tag = explode(' ',$post_title);
            $post_tags = implode(", ",$tag);

            $post_content      = $_POST['post_content'];
            $Description       = $_POST['Description'];
            $post_content      = make_clickable($post_content);
            $post_date         = date('d-m-y');

            $uploadsDir = "../upload/";
            $tempLocation = $_FILES['file']['tmp_name'];
            $temp = explode(".", $_FILES["file"]["name"]);
            $post_image = uniqid() . '.' . end($temp);
            $targetFilePath = $uploadsDir . $post_image;
            move_uploaded_file($tempLocation, $targetFilePath);

        $post_user = $_SESSION['username'];
        $post_user_id = $_SESSION['user_id'];
$query = "INSERT INTO posts(post_title, post_user, post_date, post_image, post_content, post_tags, post_status, post_user_id, post_description) ";
$query .= "VALUES(?,? ,now(),?,?,?, ?, ?, ?) ";      
$result = $conn->prepare($query);    
$result->execute([$post_title,$post_user,$post_image,$post_content,$post_tags,$post_status,$post_user_id,$Description]);    
        $post_id = $conn->lastInsertId();
        echo "<h6 class='alert alert-success text-center' role='alert'> <a href='/cms/post.php?p_id={$post_id}'>" . Publishedsuccessfully . "</a></h6>";
        }?> 
        <div class="form-group">
        <h5  class="text-center"><?php echo Title ?></h5>
        <input type="text" class="form-control" name="title" required></div>

        <div class="form-group">
        <h5  class="text-center"><?php echo Description ?></h5>
        <input type="text" class="form-control" name="Description" required></div>

<div class="form-group">
<h5 class="text-center"><?php echo Status ?></h5>
<select class="custom-select text-center" name="post_status" id="">
<option  value="<?php echo Published ?>"><?php echo PPublished ?></option>
<option value="<?php echo Draft ?>"><?php echo DDraft ?></option></select></div>   

<!-- <div class="form-group">
<h5  class="text-center"><?php echo Tags ?></h5>
<input type="text" class="form-control" name="post_tags" required></div>    --> 

<h5  class="text-center"><?php echo  Image ?></h5></br>
<div class="file-input row justify-content-center">
  <input type="file" id="file" name="file" class="file">
  <label for="file">
    Select file
    <p class="file-name"></p>
  </label>
</div>
  <div class="form-group"></br>
<h5  class="text-center"><?php echo Content ?></h5>
<textarea class="form-control "name="post_content" id="editor" cols="30" rows="10"></textarea></div></br>
<h5 class="text-center"><?php echo Other  ?></h5></br>

  <div class="file-input row justify-content-center">
  <input type="file" id="chooseFile" name="fileUpload[]" class="file" multiple>
  <label for="chooseFile">
    Select file
    <h6 class="namee"></h6>
  </label>
</div>

  <div class="imgGallery"></div>
</br>
<?php include "multi_upload.php";?>

<input type="submit" class="btn btn-lg btn-primary btn-block"  id="but_upload" type="submit" name="create" value="<?php echo Publish ?>">



</form>
</div></div></div>
</div>
<br></br><br></br>
<?php include "../includes/footer.php";?>
<?php  if(!isset($_SESSION['user_role'])){
header("Location: /cms/admin/index2.php");} ?>

<!-- 
<input type="file" id="filee" class="fdbhd" />
  <label for="filee" class="btn-1">upload file</label> -->
<!-- 

  <style>
          .fdbhd {
  height: 0;
  overflow: hidden;
  width: 0;
}

.fdbhd + label {
  background: #f15d22;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: 'Rubik', sans-serif;
  font-size: inherit;
  font-weight: 500;
  margin-bottom: 1rem;
  outline: none;
  padding: 1rem 50px;
  position: relative;
  transition: all 0.3s;
  vertical-align: middle;}

  .btn-1 {
    background-color: #f79159;
    box-shadow: 0 6px darken(#f79159, 10%);
    transition: none;


  }
  

  </style> -->