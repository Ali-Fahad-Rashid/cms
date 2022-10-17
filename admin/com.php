<?php include "admin_navigation.php";?>

<?php
$the_comment_id = $_GET['edit'];
$query = "SELECT * FROM comments WHERE comment_id = '$the_comment_id'";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
        $comment_content     = $row['comment_content'];
        $comment_date        = $row['comment_date'];
        $comment_post_id     = $row['comment_post_id'];
        $comment_user_id     = $row['comment_user_id'];

/*         $comment_content      = make_clickable($comment_content);
 */

    }?>
          <div class="container"><br></br><br></br><br></br>
          <form method="POST">
          <div class="form-group">
          <textarea class="form-control" id="editor" name="new"><?php echo $comment_content ?></textarea>
          <input name="editt" type="submit" class="btn btn-primary" value="<?php echo Save ?>"></input></div></form>
          <?php 
      if(isset($_POST['editt'])){  $y=$_POST['new']; 
        
        $y = make_clickable($y);
 
        
        $z=$_SESSION['username'];
      $query="UPDATE comments SET comment_content = ? WHERE comment_id = ? ";
      $result = $conn->prepare($query);    
      $result->execute([$y,$the_comment_id]);    
      header("Location: ../post.php?p_id=$comment_post_id");

      
      }?></div></div><br></br><br></br><br></br></br><br></br></br><br>
      <?php

      
      include "../includes/footer.php";?>

         
<?php 
if($_SESSION['user_role']!=Admin && $_SESSION['user_id']!=$comment_user_id) {
header("Location: /cms/admin/index2.php");} 
?>


<?php/*  echo str_replace('\r\n',' ',$comment_content); */?>