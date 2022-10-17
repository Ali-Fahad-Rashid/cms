<?php
  include "admin/functions.php";
  include "includes/db.php"; 
  include "includes/header.php"; 
  include "includes/navigation.php";   ?> 
<br></br><br></br>
<div class="container">

<div class="row">
<div class="col-8">
<br></br><?php
if(isset($_GET['p_id'])){
$the_post_id = $_GET['p_id'];
$query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
$result = $conn->prepare($query);    
$result->execute();    
$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
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
  $post_content       = $row['post_content'];}
 ?>


<div id="myModal" class="modal">
  <span class="close">&times;<i class="fas fa-times mn"></i></span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>




<div class="card card shadow-lg <?php echo _align ?>">
<img src="/cms/upload/<?php echo $post_image;?> " class="card-img-top cv" alt="">
<div class="card-header">
<h3 class="card-title"><?php echo $post_title ?></h3>
<h6 class=""><?php echo $post_user ?></h6>
<small class="text-muted"> <?php echo $post_date; ?></small>
</div>
<div class="card-body">
<div class="card-text"><?php echo $post_content ?></div><br></br>
<?php   
$query = "SELECT * FROM img WHERE img_post_id = $post_id AND img_user_id = $post_user_id";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$images = $row['images'];
$images_id = $row['id'];


?> 
<img class="multi" data="<?php echo $images_id; ?>" height="100" width="200" id="myImg<?php echo $images_id; ?>" src="/cms/upload/<?php echo $images; ?>">
<!-- <a target="_blank" class="img-box lightbox" href="upload/<?php echo $images; ?>">
<img class="multi" id="myImg" src="upload/<?php echo $images; ?>"></a>  -->
<?PHP }
if(isset($_SESSION['user_role'])){
 if($_SESSION['user_role']===Admin || $_SESSION['user_id']===$post_user_id) { ?>
 <br></br>
<a class='btn btn-sm btn-danger' href='/cms/admin/edit_post/<?php echo $_GET['p_id'];?>'><?php echo Edit ?><i class="far fa-edit"></i></a>

<?php }} ?></div>
<div class="card-footer">
<?php include "includes/other/starphp.php"; ?>
<?php include "includes/other/likephp.php"; ?>
<?php } ?></div></div>
<?php include "includes/comments/comment.php"; ?>
</div>
<?php include "includes/admin_category.php"; ?>
</div>

<?php    include "includes/carousel.php";   ?>


</div>
<?php include "includes/footer.php"; ?>




<script>
// Get the modal
$(".multi").click(function(){  
var att = $(this).attr("data");  
var src = $("#myImg"+att).attr("src");  
$("#myModal").css("display", "block"); 
$("#img01").attr("src",src);  

$(".close").click(function(){  

  $("#myModal").css("display", "none"); 




});
});
</script>


<style>
.mn {
  
  
  color: red;
  position: absolute;
  top: 55px;
  right: 35px;
  font-size: 50px;
  font-weight: bold;
  transition: 0.3s;

}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  max-width: 1000px;
  max-height: 1000px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>