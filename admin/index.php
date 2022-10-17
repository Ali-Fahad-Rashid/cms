<?php include "admin_navigation.php";?>
<div class="container">
<h1 class="m-3 text-center"><?PHP echo WelcomeToAdministrationboard ?></h1></br></br>
<div class="card-deck">
  <div class="card border-danger">
    <div class="card-body text-center">
    <div class="row">
    <div class="col-1">
    <i class="far fa-copy  fa-4x"></i>
        </div>
    <?php $query = "SELECT * FROM posts";
$result = $conn->prepare($query);    
$result->execute();    
$count_post = $result->rowCount();
?>
<h1 class="offset-6"><?php echo "$count_post";?></h1>
<h6 class=""><?PHP echo  Posts ?></h6>
</div>
    </div>
    <div class="card-footer">
    <small class=""><a href="posts.php" class=" colorr"><?PHP echo  Details ?></a></small>
  </div></div>
  <div class="card border-danger">
    <div class="card-body text-center">
    <div class="row">
    <div class="col-1">
    <i class="far fa-bookmark fa-4x"></i>
    </div>
    <?php  $query = "SELECT * FROM categories ";
$result = $conn->prepare($query);    
$result->execute();    
$count_cat = $result->rowCount();
?>
<h1 class="offset-6"><?php echo "$count_cat";?></h1>
<h6 style="font-size:<?php echo font ?>"><?PHP echo Categories ?></h6>
</div>
    </div>
    <div class="card-footer">
    <small class=""><a href="categories.php" class=" colorr"><?PHP echo  Details ?></a></small>
  </div></div>
  <div class="card border-danger">
    <div class="card-body text-center">
    <div class="row">
    <div class="col-1">
    <i class="far fa-comment-alt fa-4x"></i>
        </div>
    <?php $query = "SELECT * FROM comments ";
$result = $conn->prepare($query);    
$result->execute();  
$count_comment =$result->rowCount();
?>
<h1 class="offset-6"><?php echo "$count_comment";?></h1>
<h6 style="font-size:<?php echo font ?>"><?PHP echo  Comments ?></h6>
</div>
    </div>
    <div class="card-footer">
    <small class=""><a href="comments.php" class=" colorr"><?PHP echo Details ?></a></small>
  </div></div>
  <div class="card border-danger">
    <div class="card-body text-center"> <div class="row">
    <div class="col-1">
    <i class="fas fa-chalkboard-teacher fa-4x"></i>
        </div>
    <?php  $query = "SELECT * FROM users ";
$result = $conn->prepare($query);    
$result->execute();  
$count_user =$result->rowCount();
?>
<h1 class="offset-6"><?php echo "$count_user";?></h1>
<h6 class=""><?PHP echo  Users ?></h6>
</div>
    </div>
    <div class="card-footer">
    <small class=""><a href="users.php" class=" colorr"><?PHP echo  Details ?></a></small>
  </div></div>
</div>
<!-- count -->
<?php  $drift_count = num('posts','post_status','Draft');
$unapproved_count = num('comments','comment_status','Unapproved'); ?>
<!-- charts --></br></br></br>
<div class="row justify-content-center"> 
<div id="barchart_material" style="width: 500px; height: 200px; "></div>
</div></div></div>
</br></br></br>
<?php include "../includes/footer.php"; ?>



 <!-- charts -->
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>   
         <!-- charts -->
<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
['', ''],
<?php
$element_text =['Posts','Comments','Users','Categories','Drift ','Unapprove '];
$element_count=[$count_post, $count_comment, $count_user, $count_cat,$drift_count,$unapproved_count];
for($i=0;$i<6;$i++){
echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";}?>]);

var options = {
    backgroundColor: 'transparent',
    bars: 'horizontal'  ,

    chartArea: {
      backgroundColor: 'transparent',
    },
    colors: ['yellow', '', '', ''],
    hAxis: {
      textStyle: {
        color: 'red',
      }
    },
    legend: {
      textStyle: {
        color: '',
      }
    },
    vAxis: {
      textStyle: {
        color: 'red',
      }
    },
  };
// Set chart options

var chart = new google.charts.Bar(document.getElementById('barchart_material'));
chart.draw(data, google.charts.Bar.convertOptions(options));  



}
</script>

<style>

#barchart_material{
  direction: ltr;
  }
</style>