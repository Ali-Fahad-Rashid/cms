<?php  include "includes/db.php"; 
include "includes/header.php"; 
include "admin/functions.php"; 
include "includes/navigation.php"; ?>
<br></br><br></br><br></br><?php
$exist="";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require './vendor/autoload.php';
require './classes/Config.php';
/*     if(!isset($_GET['forgot'])){
        header("Location: index.php");
    } */
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));
            if(email_exists($email)){
                $query = "UPDATE users SET token='{$token}' WHERE user_email='$email'";
                    $result = $conn->prepare($query);    
                    $result->execute();    
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = Config::SMTP_HOST;
                    $mail->Username = Config::SMTP_USER;
                    $mail->Password = Config::SMTP_PASSWORD;
                    $mail->Port = Config::SMTP_PORT;
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom('ali.fahd.rashd1995@gmail.com', 'Ali Fahad');
                    $mail->addAddress($email);
                    $mail->Subject = 'This is a test email';
                    $mail->Body = '<p>Please click to reset your password
                    <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.' ">
                    http://localhost/cms/reset.php?email='.$email.'&token='.$token.'</a></p>';
                    if($mail->send()){
                        $emailSent = true;
                    } else{
                        echo "NOT SENT, try again later";}
                        
                    } else {$exist='Email not exists';}
                        }?>
<div class="container">
<div class="form-gap"></div>
<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="panel panel-default">
<div class="panel-body">
<div class="text-center">
<?php if(!isset( $emailSent)): ?>
<h3><i class="fa fa-lock fa-4x"></i></h3>
<h2 class="text-center"><?php echo Forgot ?></h2>
<div class="panel-body">
<form id="register-form" role="form" autocomplete="off" class="form" method="post">
<div class="form-group">
<div class="input-group">
<input id="email" name="email" placeholder="<?php echo Email ?>" class="form-control"  type="email">
</div><p class="text-danger"> <?php echo "$exist";?></p>
</div>
<div class="form-group">
<input name="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo Reset ?>" type="submit"></div>
</form></div><?php else: ?><br></br><br></br>
<h3 class="alert alert-success"><?php echo Pleasecheckyouremail ?></h3><?php endif;?></div></div></div></div></div></div></div></div>
<br></br><br></br><br></br><br></br><br></br><br></br>
<?php include "includes/footer.php";?>

