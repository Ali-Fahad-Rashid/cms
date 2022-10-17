<?php  include "includes/db.php"; 
include "includes/header.php"; 
include "admin/functions.php"; 
include "includes/navigation.php"; 
?>
<br></br><br></br>
<?php
if(isset($_POST['submit'])){
    $user=trim($_POST['user']);
    $pass=trim($_POST['pass']);
$error=['user'=>'','pass'=>'','email'=>''];

$query="SELECT COUNT(*) FROM users WHERE username='$user'";
$result=$conn->prepare($query);
$result->execute();
$count =$result->fetchColumn();

if(empty($count)){
    $error['user'] = usernamenotexist ;
}

if(!empty($count)){
    $pass2="";
$query="SELECT * FROM users WHERE username='$user'";
$result=$conn->prepare($query);
$result->execute();
$row=$result->fetch();
$pass2 = $row['user_password'];
$pass2 = password_verify($pass,$pass2);
    if($pass!=$pass2){
    $error['pass']=  WrongPassword; }}


if(array_filter($error)){}
else {



    $query="SELECT * FROM users WHERE username='$user'";
    $result=$conn->prepare($query);
    $result->execute();

while($row=$result->fetch()){
$email=$row['user_email'];
$user_id=$row['user_id'];
$user_role=$row['user_role'];
$user_image=$row['user_image'];
$lang=$row['lang'];

}
$_SESSION['user_id']=$user_id;
$_SESSION['username']=$user;
$_SESSION['user_email']=$email;
$_SESSION['user_role']=$user_role;
$_SESSION['user_image'] = $user_image;
$_SESSION['lang'] = $lang;


$session    = session_id();
$query="UPDATE users SET user_time = now(), user_session = '$session', user_status = 'Online' WHERE username='$user'";
$result=$conn->prepare($query);
$result->execute();



if(isset($_POST['xxx'])){
setcookie('user', $user_id, time() + (86400 * 30), "/"); // 86400 = 1 day
}
header('location: index.php');

}}
?>
<div class="container">

<div class="row">
<div class="col">

<br></br>
<div class="text-center">
<h3><i class="fa fa-user fa-4x"></i></h3>
<h2 class="text-center"><?php echo Login ?></h2>
<br></br></div>
<form method="POST">
<div class="form-group">
<input id="val" name="user" type="text" class="form-control" placeholder="<?php echo Username ?>" value="<?php echo isset($user) ? $user : '' ?>" required autofocus>
<p class="text-danger  <?php echo _align ;?>"><?php echo isset($error['user']) ? $error['user'] : '' ?></p>
</div>
<div class="form-group">
<input id="val" name="pass" type="password" class="form-control" placeholder="<?php echo Password ?>"required>
<p class="text-danger  <?php echo _align ;?>"><?php echo isset($error['pass']) ? $error['pass'] : '' ?></p>
</div>

<div class="<?php echo _align ;?>"> 
            <label class="switch m-1">
  <input name="xxx" type="checkbox" checked>
  <span class="slider round"></span>
</label>
<label><?php echo RememberMe ?></label>
</div>

<div class="form-group <?php echo _align ;?>">
<div class="col">
<a href='/cms/forgot.php?forgot=<?php echo uniqid(true);?>' class="text-primary " ><?php echo Forgot  ?></a></div></div>
<div class="form-group">



<!-- log in with google -->



<input  type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo Login ?>"></div></form>






<?php
require_once 'vendor/autoload.php';
$google_client = new Google_Client();
$google_client->setClientId('460824604015-9vc0ru5mjblhlhhs6a2p7gjlqhncoq2n.apps.googleusercontent.com');
$google_client->setClientSecret('KTgqYqSNa9xxgzdcnD88_gxK');
$google_client->setRedirectUri('http://localhost/cms/login.php');
$google_client->addScope('email');
$google_client->addScope('profile');



$login_button = '';
if(isset($_GET["code"]))
{
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error']))
 {
  $google_client->setAccessToken($token['access_token']);
  $_SESSION['access_token'] = $token['access_token'];
  $google_service = new Google_Service_Oauth2($google_client);
  $data = $google_service->userinfo->get();
  if(!empty($data['given_name']))
  {
    $user = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $email = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
 $image = $data['picture'];
  }
 }
}
if(!isset($_SESSION['access_token']))
{
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img height="50" width="350" src="images/oo.png" /></a>';
}
?>
   <?php
   if($login_button == '')
   {

    $query="SELECT * FROM users WHERE user_email='$email'";
    $result=$conn->prepare($query);
    $result->execute();

if(!empty($result)){




while($row=$result->fetch()){
$email=$row['user_email'];
$user_id=$row['user_id'];
$user_role=$row['user_role'];
$user_image=$row['user_image'];
$lang=$row['lang'];

}

$_SESSION['user_id']=$user_id;
$_SESSION['username']=$user;
$_SESSION['user_email']=$email;
$_SESSION['user_role']=$user_role;
$_SESSION['user_image'] = $user_image;
$_SESSION['lang'] = $lang;


$session    = session_id();
$query="UPDATE users SET user_time = now(), user_session = '$session', user_status = 'Online' WHERE user_id='$user_id'";
$result=$conn->prepare($query);
$result->execute();




if(isset($_POST['xxx'])){
setcookie('user', $user_id, time() + (86400 * 30), "/"); // 86400 = 1 day
}
header('location: index.php');


}


else {

    $pass="";
    $session    = session_id();
    $pass = password_hash( $pass, PASSWORD_BCRYPT, array('cost' => 12));
    $query = "INSERT INTO users (username, user_email, user_password, user_role, user_date, user_image, lang, user_time, user_session, user_status) 
    VALUES(?,?,?,?,NOW(),?,?,now(),?,?)";
    $result=$conn->prepare($query);
$result->execute([$user,$email,$pass,'User',$image,'ar',$session,'Online']);
$user_id=$conn->lastinsertid();

$_SESSION['user_id']=$user_id;
$_SESSION['username']=$user;
$_SESSION['user_email']=$email;
$_SESSION['user_role']='User';
$_SESSION['user_image'] = $image;
$_SESSION['lang'] = 'ar';

header('location: index.php');

}
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }


   $google_client->revokeToken();

   ?>






</div>



<div class="col-md-4"></div> 
<?php include "includes/admin_category.php";?>
</div></div><br></br>
<?php include "includes/footer.php";?>





<style>
.switch {
  position: relative;
  display: inline-block;
  width: 32px;
  height: 21px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
/*   background: url('upload/6087f0f336f1b.jpg');
  background-size: contain; */


    transition: 0.1s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: -5px;
  bottom: 0px;
  background-image: radial-gradient(circle, red, yellow, green);


    transition: 0.1s;
}

input:checked + .slider {
  background-color: cyan;
  background-image: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);

}



input:checked + .slider:before {

  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 35px;
}

.slider.round:before {
  border-radius: 50%;
  
}
</style>