<?php //ob_start(); ?>
<?php //session_start(); ?>
<?php 
include "db.php"; 
$user = $_SESSION['username'];
$query="UPDATE users SET user_status = 'Offline', user_session = '' WHERE username='$user'";
$result=$conn->prepare($query);
$result->execute();

setcookie("user", "" , time() - 3600 , "/");

$_SESSION['user_id'] = null;
$_SESSION['username'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_email'] = null; 
$_SESSION['lang'] = null; 

   $_SESSION['access_token']=null;

header("Location: /cms/index.php");

?>

