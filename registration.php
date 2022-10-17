<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/functions.php"; ?>
<?php  include "includes/navigation.php"; ?>
<br></br>
<?php
if(isset($_POST['resgister'])){
    $user=trim($_POST['user']);
    $pass=trim($_POST['pass']);
    $pass2=trim($_POST['pass2']);
    $email=trim($_POST['email']);
    $error=['user'=>'','pass'=>'','pass2'=>'','email'=>''];
    
    if(strlen($user)<3){
        $error['user']=usernamemustbelonger;
    }
    
    if($pass!=$pass2){
        $error['pass2']=passwordarenotthesame;
    }
    
    $query="SELECT COUNT(*) FROM users WHERE username ='$user'";
    $result=$conn->prepare($query);
    $result->execute();
    $count=$result->fetchcolumn();

    if(!empty($count)){
        $error['user']=usernameexist;
    }
    
    $query="SELECT COUNT(*) FROM users WHERE user_email='$email'";
    $result=$conn->prepare($query);
    $result->execute();
    $count=$result->fetchcolumn();
    if(!empty($count)){
        $error['email']=emailexist;
    }
    
    if(array_filter($error)){}
    else {
        $session    = session_id();
        $pass = password_hash( $pass, PASSWORD_BCRYPT, array('cost' => 12));
        $query = "INSERT INTO users (username, user_email, user_password, user_role, user_date, user_image, lang, user_time, user_session, user_status) 
        VALUES(?,?,?,?,NOW(),?,?,now(),?,?)";
        $result=$conn->prepare($query);
    $result->execute([$user,$email,$pass,'User','g.jpg','ar',$session,'Online']);
    $user_id=$conn->lastinsertid();
    
$_SESSION['user_id']=$user_id;
$_SESSION['username']=$user;
$_SESSION['user_email']=$email;
$_SESSION['user_role']='User';
$_SESSION['user_image'] = 'g.jpg';
$_SESSION['lang'] = 'ar';

    header('location: index.php');
    
    }}
         ?>    

        
<div class="container">
<div class="row">
<div class="col-md-4">
<br></br>
<div class="text-center">
<h3><i class="fa fa-user fa-4x"></i></h3></br>
<h2 class="text-center"><?php echo wel ?></h2>
<br></br></div>
<form method="post">
<div class="form-group">
<input id="val" type="text" name="user" class="form-control" placeholder="<?php echo Username ?>" autocomplete="on" autofocus
value="<?php echo isset($user) ? $user : '' ?>" required minlength="3" maxlength="16">
<p class="text-danger <?php echo _align ;?>"><?php echo isset($error['user']) ? $error['user'] : '' ?></p>
</div>
<div class="form-group">
<input  id="val" type="email" name="email"  class="form-control" placeholder="<?php echo Email ?>" autocomplete="on" 
value="<?php echo isset($email) ? $email : '' ?>" required>
<p class="text-danger <?php echo _align ;?>"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
</div>
<div class="form-group">
<input id="val"  type="password" name="pass" class="form-control" placeholder="<?php echo Password ?>" required>
<p class="text-danger <?php echo _align ;?>"><?php echo isset($error['pass']) ? $error['pass'] : '' ?></p>
</div>
<div class="form-group">
<input  id="val"  type="password" name="pass2" class="form-control" placeholder="<?php echo confirm ?>" required>
<p class="text-danger <?php echo _align ;?>"><?php echo isset($error['pass2']) ? $error['pass2'] : '' ?></p>
</div>
<input type="submit" name="resgister" class="btn btn-lg btn-primary btn-block" value="<?php echo Register ?>">
</form></div> 
<div class="col-md-4"></div> 
<?php include "includes/admin_category.php";?>
</div></div><br></br>
<?php include "includes/footer.php";?>

