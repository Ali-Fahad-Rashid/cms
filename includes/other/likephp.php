<!-- like -->
<br></br>
<?php
if(isset($_SESSION['user_role'])){
$x=$_SESSION['user_id'];
  $query="SELECT * FROM likes WHERE user_id='$x' AND post_id='$post_id' AND types='like'  AND com_id=0";
  $result = $conn->prepare($query);    
  $result->execute();  
  $c=$result->rowCount();
  ?>
<a id="" class="<?php if($c>=1){ echo 'unlike' ; } else { echo 'like' ; } ?> m-2">
<?php if($c>=1){ echo "<i class='fas fa-thumbs-up fa-2x'></i>" ; } else { echo "<i class='far fa-thumbs-up fa-2x'></i>" ; }   
?>
</a>
 <?php  } 
 else { ?><span class="d-inline-block m-2" tabindex="0" data-toggle="tooltip" title="You need to Login to like">
<a class="disabled">
<i class="fas fa-thumbs-up fa-2x"></i></a></span>
<?php  }?> 
<!-- unlike -->
<?php
if(isset($_SESSION['user_role'])){
$x=$_SESSION['user_id'];
  $query="SELECT * FROM likes WHERE user_id='$x' AND post_id='$post_id' AND types='unlike'  AND com_id=0";
  $result = $conn->prepare($query);    
  $result->execute();  
  $c=$result->rowCount();
  ?>
<a id="ddd" class="<?php if($c>=1){ echo 'unlike2' ; } else { echo 'like2' ; } ?> m-2">
<?php if($c>=1){ echo "<i class='fas fa-thumbs-down fa-2x'></i>" ; } else { echo "<i class='far fa-thumbs-down fa-2x'></i>" ; }   
?>
</a>
 <?php  } 
 else { ?><span class="d-inline-block m-2" tabindex="0" data-toggle="tooltip" title="You need to Login to Unlike">
<a class="disabled">
<i class="fas fa-thumbs-up fa-2x"></i></a></span>
<?php  }?> 
<br></br>
<span class="m-1">UnLike : <small id="mnk"> 
<?php
    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  
    $row = $result->fetch();
    $unlikes = $row['unlikes'];
                    echo $unlikes ;
                     ?>
                     </small></span>
<span class="m-1">Like : <small id="kk"> 
<?php
    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  
    $row = $result->fetch();
    $likes = $row['likes'];
                    echo $likes ;
                     ?>
                     </small></span>
<!-- end like -->
<script>
$(document).ready(function(){
var post_id = <?php echo $the_post_id;?>;
var user_id = <?php echo $_SESSION['user_id'];?>;
$(document).on('click', '.like', function(){
$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'JSON',
data: {
'liked': 1,
'post_id': post_id,
'user_id': user_id
},
success: function(array){
  $("#kk").text(array.likes);
  $("#mnk").text(array.unlikes);
}
});
$(".like").html("<i class='fas fa-thumbs-up fa-2x'></i>");
$('.like').addClass('unlike').removeClass('like');

$(".unlike2").html("<i class='far fa-thumbs-down fa-2x'></i>");
$('.unlike2').addClass('like2').removeClass('unlike2');

});
$(document).on('click', '.unlike', function(){
$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'text',
data: {
'unliked': 1,
'post_id': post_id,
'user_id': user_id
},
success: function(data){
  $("#kk").text(data);
}
});
$(".unlike").html("<i class='far fa-thumbs-up fa-2x'></i>");
$('.unlike').addClass('like').removeClass('unlike');
});
$(document).on('click', '.like2', function(){
$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'JSON',
data: {
'liked2': 1,
'post_id': post_id,
'user_id': user_id
},
success: function(array){
  $("#kk").text(array.likes);
  $("#mnk").text(array.unlikes);
}
});
$(".like2").html("<i class='fas fa-thumbs-down fa-2x'></i>");
$('.like2').addClass('unlike2').removeClass('like2');

$(".unlike").html("<i class='far fa-thumbs-up fa-2x'></i>");
$('.unlike').addClass('like').removeClass('unlike');
});

$(document).on('click', '.unlike2', function(){
$.ajax({
url: "includes/other/like.php",
type: 'POST',
dataType: 'text',
data: {
'unliked2': 1,
'post_id': post_id,
'user_id': user_id
},
success: function(data2){
  $("#mnk").html(data2);
}
});
$(".unlike2").html("<i class='far fa-thumbs-down fa-2x'></i>");
$('.unlike2').addClass('like2').removeClass('unlike2');
});

});

</script>