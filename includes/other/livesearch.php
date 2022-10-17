<?php  include "../db.php"; ?>

<?php if(isset($_SESSION['lang'])){
if($_SESSION['lang']=="ar"){
                include "../lang/ar.php";
              }
              if($_SESSION['lang']=="en") { include "../lang/en.php"; }
              }
                else { include "../lang/ar.php";} ?>
</br>
<?php
if(isset($_POST['query'])){
$search = $_POST['query'];     

$search =  strtolower(trim($search)) ;

$query = "SELECT * FROM posts WHERE lower(post_tags) LIKE '%$search%' ";
$result = $conn->prepare($query);    
$result->execute();  
$count = $result->rowCount();
if($count <= 0){?> 
<h6 class="text-center text-dark"> <?php echo _no ?> </h6>
<?php } else { ?>
<h6 class="text-center text-dark"> <ins><?php echo Result ?></ins>  </h6>
<?php
while($row = $result->fetch()){
$post_id = $row['post_id'];
$post_user = $row['post_user'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_title = $row['post_title'];
if (strlen($post_title) > 30){
    $post_title = mb_substr($post_title,0,30,'UTF-8') . '...';}
else {
$post_title = mb_substr($post_title,0,30,'UTF-8'); }



?>

<div class="text-center"><a href="/cms/post.php?p_id=<?php echo $post_id;?>" class="btn"><?php echo $post_title ?></a></div>


<?php }}} ?>