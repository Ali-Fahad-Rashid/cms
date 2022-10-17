<?php  include "includes/db.php"; 
include "includes/header.php";
include "includes/navigation.php"; 
if(isset($_POST['submit'])) {
$to         = "ali.fahd.rashd1995@gmail.com";
$subject    = wordrap($_POST['subject'],70);
$body       = $_POST['body'];
$email       = "from:" . $_POST['email'];
mail("$to","$subject",$body,$email);}
?>  
<br></br>
<br></br>
<br></br>
<div class="container">
<div class="row">
<div class="col-4">
<h2 class="text-center"><?php echo Contact ?></h2></br>
<form action="" method="post">                      
<div class="form-group">
<input type="email" name="email" class="form-control" placeholder="<?php echo Email ?>"></div>
<div class="form-group">
<input type="text" name="subject" class="form-control" placeholder="<?php echo Subject ?>"></div>
<div class="form-group">
<textarea class="form-control" name="body" id="editor" cols="50" rows="10"></textarea></div>
<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo Send ?>"></form></div></div></div><br></br>

<?php include "includes/footer.php";?>