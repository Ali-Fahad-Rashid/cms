<?php include "admin/functions.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; 

$_SESSION['access_token']=null;

?>
<div class="cover"></div>

<?php  include "includes/navigation.php"; ?>
<br></br><br></br>

<link rel="stylesheet" href="/cms/css/animations.css?v=<?php echo time(); ?>">

<div class="container">



<?php



/*   require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'mt1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'e560fc9073384faa8558',
    '9f88bc0b647e58aa508d',
    '1213961',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data['message']); */
?>


<div class="row">        
<div class="col-md-8">
<?php  
$count="";
$per_page = 5;
if(isset($_GET['page'])) {
$page = $_GET['page']; } 
else {
$page = 1 ; 
$count = 1 ; }
if($page == "" || $page == 1) {
$page_1 = 0;  } 
else {
$page_1 = ($page * $per_page) - $per_page;  }
if(isset($_SESSION['user_id'])){
$query = " SELECT COUNT(*) FROM posts 
INNER JOIN users ON users.user_id = posts.post_user_id 
LEFT JOIN followers ON followers.user_id_r = posts.post_user_id 
WHERE (followers.user_id_s = '".$_SESSION["user_id"]."'  AND post_status = 'Published') OR (posts.post_user_id = '".$_SESSION["user_id"]."' AND post_status = 'Published')
GROUP BY posts.post_id 
ORDER BY posts.post_id DESC";

$result=$conn->prepare($query);
$result->execute();
$count =$result->fetchColumn();

if($count < 1) {
    ?><br></br><div class='alert alert-secondary text-center' role='alert'><?php echo YouNeedToFollowPeopleToSeeposts ; ?></div><?php 
 } else {
$count  = ceil($count /$per_page);
 $query = " SELECT * FROM posts 
 INNER JOIN users ON users.user_id = posts.post_user_id 
 LEFT JOIN followers ON followers.user_id_r = posts.post_user_id 
 WHERE (followers.user_id_s = '".$_SESSION["user_id"]."'  AND post_status = 'Published') OR (posts.post_user_id = '".$_SESSION["user_id"]."' AND post_status = 'Published')
 GROUP BY posts.post_id 
 ORDER BY posts.post_id DESC LIMIT $page_1,$per_page";
$result = $conn->prepare($query);    
$result->execute(); 

while($row = $result->fetch()){
    $post_id = $row['post_id'];
$post_title = $row['post_title'];
$post_user = $row['post_user'];
$post_date = $row['post_date'];
$post_user_id = $row['post_user_id'];
$post_image = $row['post_image'];
$post_description = substr($row['post_description'],0,600);
$post_status = $row['post_status']; ?>
<br></br>
<div data-aos="fade-up" data-aos-duration="500" data-aos-delay="50" data-aos-easing="ease-in-out" 
class="card shadow mb-3 <?php echo _align ?>">
<img src="upload/<?php echo $post_image;?> " class="card-img-top cv" height="300" width="400" alt="">
<div class="card-header ">
<h3 class="card-title"><?php echo $post_title ?></h3></div>
<div class="card-body">
<p class="card-text"><?php echo $post_description ?></p>
<a href="post/<?php echo $post_id;?>" class="btn btn-sm btn-danger"><i class="fas fa-info-circle"></i> <?php echo More ;?></a></div>
<div class="cb">
<small class="m-3"><?php echo $post_date ?></small>
<small><?php echo "<a class='text-dark' href='/cms/profile.php?u_id=$post_user_id'>$post_user</a>";?></small>
</div></div><?php }  } }
else {    ?><br></br><div class='alert alert-secondary text-center' role='alert'> <?php echo YouNeedTologinToSeeposts ?></div><?php }
?></div>


<?php include "includes/admin_category.php";?>


</div>
<nav aria-label="Page navigation example">
<ul class="pagination">
<?php if(isset($_SESSION['user_id'])){
 $s=$page; $d=1; if($s>1){$s=$s-$d;
 ?> <li class='page-item'><a class='page-link shadow p-3 mb-5' href='index.php?page=<?php echo $s ?>'> <?php echo Previous ?></a></li> <?php 
} else{ ?><li class='page-item'><a class='page-link shadow p-3 mb-5 btn disabled' href='#'><?php echo Previous ?></a></li> <?php }
for($i =1; $i <= $count; $i++) { $s = $page ;
if($i == $page) { ?>
    <li class="page-item active"><a class="page-link shadow p-3 mb-5" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } else { ?>
     <li class="page-item"><a class="page-link shadow p-3 mb-5" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } } 
    $s=$page;
    if($s==$count || empty($count)){
    ?><li class='page-item'><a class='page-link shadow p-3 mb-5 btn disabled' href='#' ><?php echo Next ?></a></li><?php }
    else{$s=$s+1;
    ?><li class='page-item'><a class='page-link shadow p-3 mb-5' href='index.php?page=<?php echo $s ?>'><?php echo Next ?></a></li> <?php }}?>
    </ul></nav>
  
  
    <?php    include "includes/carousel.php";   ?>

  
  </div>


<?php include "includes/footer.php";?>

