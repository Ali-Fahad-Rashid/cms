<!-- like -->
<?php
if(isset($_SESSION['user_role'])){
$x=$_SESSION['user_id'];
$com_id=$comment->comment_id;
  $query="SELECT * FROM likes WHERE user_id='$x' AND post_id='$post_id' AND types='like' AND com_id='$com_id'";
  $result = $conn->prepare($query);    
  $result->execute();  
  $c=$result->rowCount();
  ?>
<a id="idd<?php echo $com_id;?>" data="<?php echo $com_id;?>" class="<?php if($c>=1){ echo 'unlikee hg' ; } else { echo 'likee hg' ; } ?>  m-1 ">
<?php if($c>=1){ echo "<i class='fas fa-thumbs-up fa-2x'></i>" ; } else { echo "<i class='far fa-thumbs-up fa-2x'></i>" ; }   
?>
</a>
 <?php  } 
 else { ?><span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="You need to Login to like">
<a class="disabled">
<i class="fas fa-thumbs-up fa-2x"></i></a></span>
<?php  }?> 
<!-- unlike -->
<?php
if(isset($_SESSION['user_role'])){
$x=$_SESSION['user_id'];
$com_id=$comment->comment_id;
  $query="SELECT * FROM likes WHERE user_id='$x' AND post_id='$post_id' AND types='unlike' AND com_id='$com_id'";
  $result = $conn->prepare($query);    
  $result->execute();  
  $c=$result->rowCount();
  ?>
<a id="idxd<?php echo $com_id;?>" data="<?php echo $com_id;?>" class="<?php if($c>=1){ echo 'unlikee2 hg' ; } else { echo 'likee2 hg' ; } ?>  m-1 ">
<?php if($c>=1){ echo "<i class='fas fa-thumbs-down fa-2x'></i>" ; } else { echo "<i class='far fa-thumbs-down fa-2x'></i>" ; }   
?>
</a>
 <?php  } 
 else { ?><span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="You need to Login to Unlike">
<a class="disabled">
<i class="fas fa-thumbs-up fa-2x"></i></a></span>
<?php  }?> </br>

                     <span class="m-1">UnLike : <small id="zxc<?php echo $com_id;?>"> 
<?php
$com_id=$comment->comment_id;

    $query = "SELECT * FROM comments WHERE comment_id ='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
    $row = $result->fetch();
    $unlikes = $row['unlikes'];
                    echo $unlikes ;
                     ?>
                     </small></span>

                     <span class="m-1">Like : <small id="ghj<?php echo $com_id;?>"> 
<?php  
$com_id=$comment->comment_id;

    $query = "SELECT * FROM comments WHERE comment_id ='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
    $row = $result->fetch();
    $likes = $row['likes'];
                    echo $likes ;
                     ?>
                     </small></span>
<!-- end like -->