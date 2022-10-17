<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>
<br></br><br></br>
<?php  include "includes/navigation.php"; ?>  
<div class="container">
<div class="row">            
<div class="col-md-8"><?php
if(isset($_POST['submit'])){          
$search = $_POST['search'];     

$search =  strtolower(trim($search)) ;


$query = "SELECT * FROM posts WHERE lower(post_tags) LIKE '%$search%' ";
$result = $conn->prepare($query);    
$result->execute();  

$count = $result->rowCount();
if($count == 0) {
    ?> <h1 class=text-center> <?php echo _no ?> </h1><?php
} else { ?> <h1 class=text-center> <?php echo Result ?> </h1><?php
    while($row = $result->fetch()){
        $post_id = $row['post_id'];
$post_title = $row['post_title'];
$post_user = $row['post_user'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_content = substr($row['post_content'],0,400);?>
<div class="card shadow-lg mb-5 ">
<img src="upload/<?php echo $post_image;?> " class="card-img-top cv" alt="">

<div class="card-header">
<h3 class="card-title"><?php echo $post_title ?></h3></div>
<div class="card-body">

<p class="card-text"><?php echo $post_content ?></p>
<a href="post.php?p_id=<?php echo $post_id;?>" class="btn btn-danger"><i class="fas fa-info-circle"></i> <?php echo More?></a></div>
<div class="card-footer text-muted">
<p class="card-text"><small class="text-muted"><?php echo $post_date ?></small></p>
<h5 class="card-subtitle mb-2 text-muted"><?php echo $post_user ?></h5>

</div></div><?php }}}?></div>          
<?php include "includes/admin_category.php";?>
</div></div>
<?php include "includes/footer.php";?>