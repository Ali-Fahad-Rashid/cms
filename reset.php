<?php include "admin/functions.php"; ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<br></br><br></br><br></br><?php
/* if(!isset($_GET['email']) && !isset($_GET['token'])){
    header("Location: /cms/index.php");} */

   $r = $_GET['token'];
   $s= $_GET['email'];
$query="SELECT username, user_email, token FROM users WHERE token= $r";
$result = $conn->prepare($query);    
$result->execute();    
if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
if($_POST['password'] === $_POST['confirmPassword']){
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
$query = "UPDATE users SET token='', user_password = ? WHERE user_email = ? ";
$result = $conn->prepare($query);    
$result->execute([$hashedPassword,$s]);    

}}?>
<?php  include "includes/navigation.php"; ?>
<div class="container">
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="panel panel-default">
<div class="panel-body">
<div class="text-center">
<h3><i class="fa fa-lock fa-4x"></i></h3>
<h2 class="text-center"><?php echo Reset?></h2>
<div class="panel-body">
<form id="register-form" role="form" autocomplete="off" class="form" method="post">
<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
<input id="password" name="password" placeholder="<?php echo enter?>" class="form-control"  type="password"></div></div>
<div class="form-group">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
<input id="confirmPassword" name="confirmPassword" placeholder="<?php echo confirm?>" class="form-control"  type="password"></div></div>
<div class="form-group">
<input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="<?php echo pass?>" type="submit"></div>
<input type="hidden" class="hide" name="token" id="token" value="">
</form></div></div></div></div></div></div></div></div></div>
<br></br><br></br><br></br><br></br><br>
<?php include "includes/footer.php";?>