<?php
if(isset($_SESSION['user_role'])){$types=0;
$x=$_SESSION['user_id'];
  $query="SELECT * FROM stars WHERE user_id='$x' AND post_id='$post_id'";
  $result = $conn->prepare($query);    
  $result->execute();  
  while($row = $result->fetch()){
  $types = $row['types'];}?>

  <?php if($types==1){?>
<style> #st1{color:yellow;} </style>
    <?php }
    if($types==2){?>
        <style> #st1,#st2{color:yellow;} </style>
        <?php }
    if($types==3){?>
        <style> #st1,#st2,#st3{color:yellow;} </style>
        <?php }
    if($types==4){?>
        <style> #st1,#st2,#st3,#st4{color:yellow;} </style>
        <?php }
    if($types==5){?>
        <style> #st1,#st2,#st3,#st4,#st5{color:yellow;} </style>
        <?php } }?>


<i class = "fa fa-star" aria-hidden = "true" id = "st1"></i>  
<i class = "fa fa-star" aria-hidden = "true" id = "st2"></i>  
<i class = "fa fa-star" aria-hidden = "true" id = "st3"></i>  
<i class = "fa fa-star" aria-hidden = "true" id = "st4"></i>  
<i class = "fa fa-star" aria-hidden = "true" id = "st5"></i>  

<span class="m-1"> Stars Rating : <small id="stst"> 
<?php
   $query="SELECT * FROM stars WHERE post_id='$post_id'";
  $result = $conn->prepare($query);    
    $result->execute();  
       $starcount=0.0;
        $num = $result->rowCount(); 
        if($num <= 0){
            $num=1;
        }

        while($row = $result->fetch()){
            $types = $row['types'];
        $starcount = $starcount + $types ;
        }

                    echo round($starcount/$num ,2); 
                     ?>
                     </small></span>
      
       <script>  
        $(document).ready(function() {  

            var post_id = <?php echo $the_post_id;?>;
            var user_id = <?php echo $_SESSION['user_id'];?>;

          $("#st1").click(function() {  
              $(".fa-star").css("color", "black");  
              $("#st1").css("color", "yellow");  

              $.ajax({
url: "includes/other/star.php",
type: 'POST',
dataType: 'text',
data: {
'st1': 1,
'post_id': post_id,
'user_id': user_id
},
success: function(data){
  $("#stst").text(data);
}
});

          });  


          $("#st2").click(function() {  
              $(".fa-star").css("color", "black");  
              $("#st1, #st2").css("color", "yellow");  
              $.ajax({
url: "includes/other/star.php",
type: 'POST',
dataType: 'text',
data: {
'st2': 2,
'post_id': post_id,
'user_id': user_id
},
success: function(data){
  $("#stst").text(data);
}
});
          });  


          $("#st3").click(function() {  
              $(".fa-star").css("color", "black")  
              $("#st1, #st2, #st3").css("color", "yellow");  
              $.ajax({
url: "includes/other/star.php",
type: 'POST',
dataType: 'text',
data: {
'st3': 3,
'post_id': post_id,
'user_id': user_id
},
success: function(data){
  $("#stst").text(data);
}
});
          });  


          $("#st4").click(function() {  
              $(".fa-star").css("color", "black");  
              $("#st1, #st2, #st3, #st4").css("color", "yellow");  
              $.ajax({
url: "includes/other/star.php",
type: 'POST',
dataType: 'text',
data: {
'st4': 4,
'post_id': post_id,
'user_id': user_id
},
success: function(data){
  $("#stst").text(data);
}
});
          });  


          $("#st5").click(function() {  
              $(".fa-star").css("color", "black");  
              $("#st1, #st2, #st3, #st4, #st5").css("color", "yellow");  
              $.ajax({
url: "includes/other/star.php",
type: 'POST',
dataType: 'text',
data: {
'st5': 5,
'post_id': post_id,
'user_id': user_id
},
success: function(data){
  $("#stst").text(data);
}
});

          });  


        });  
    </script>  