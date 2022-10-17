<div class="col-md-4">
<br></br>
<?php
$query = "SELECT * FROM categories WHERE cat_user_id = $me AND cat_status = '".Published."' ORDER BY cat_id DESC LIMIT 5";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
  $cat_id            = $row['cat_id'];
  $cat_post_id       = $row['cat_post_id'];
  $cat_user          = $row['cat_user'];
  $cat_user_id       = $row['cat_user_id'];
  $cat_title         = $row['cat_title'];
  $cat_status        = $row['cat_status'];
  $cat_image         = $row['cat_image'];
  $cat_date          = $row['cat_date'];
  $cat_content       = substr($row['cat_content'],0,75);
  ?>
<div class="card text-center shadow mb-5" >
<a href="/cms/post/<?php echo $cat_post_id ;?>"><img width="200" height="200" 
src="/cms/upload/<?php echo $cat_image ;?>" class="cv card-img-top" alt=""></a>
  <div class="cb">
    <h5><?php echo $cat_title ;?></h5>
    </div>


  </div>
<?php } ?>
</div>