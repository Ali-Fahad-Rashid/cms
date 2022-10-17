<?php include "admin_navigation.php";?>
<?php $id=$_GET['edit_user'];
$query = "SELECT * FROM users WHERE user_id = '{$id}' ";
$result = $conn->prepare($query);    
$result->execute();    
while($row = $result->fetch()){
$image = $row['user_image'];
$use = $row['user_id'];
$usernamee = $row['username'];
$user_email = $row['user_email'];
$sex = $row['sex'];
$user_cv = $row['user_cv'];
$user_birthday = $row['user_birthday'];
$country = $row['country'];
}?>

<div class="container">

<div class="row justify-content-center"> 

<div class="col-md-4 xs-3 sm-3">

 <?php 
if(isset($_POST['edit_user'])) {
        $username      = $_POST['username'];
        $email         = $_POST['email'];
        $sex           = $_POST['sex'];
        $user_cv       = $_POST['user_cv'];
        $user_birthday = $_POST['user_birthday'];
        $country       = $_POST['country'];
        $image         = $_FILES['file']['name'];

        if(empty($image)) {
            $query = "SELECT * FROM users WHERE user_id = $id ";
            $result = $conn->prepare($query);    
            $result->execute();    
            while($row = $result->fetch()){
              $image = $row['user_image'];}}
              else {

            $uploadsDir = "../images/";
            $tempLocation = $_FILES['file']['tmp_name'];
            $temp = explode(".", $_FILES["file"]["name"]);
            $image = uniqid() . '.' . end($temp);
            $targetFilePath = $uploadsDir . $image;
            move_uploaded_file($tempLocation, $targetFilePath);

              }
        $error = ['username'=> '','email'=>'','password'=>'','Confirm'=>''];
            if(strlen($username) < 3){
                $error['username'] = usernamemustbelonger;    }

                if(username_exists($username) && $username!=$usernamee){
                    $error['username'] = usernameexist;    }

             if($username ==''){
                $error['username'] = 'Username cannot be empty';    }

                if(email_exists($email) && $email!=$user_email){
                    $error['email'] = emailexist;    }

            if($email ==''){
                $error['email'] = 'Email cannot be empty';    }
                foreach ($error as $key => $value) {
                    if(empty($value)){
                    unset($error[$key]); } } 
            if(empty($error)){
                $query = "UPDATE users SET ";
                $query .="username    = '{$username}', ";
                $query .="user_email  = '{$email}', ";
                $query .="sex         = '{$sex}', ";
                $query .="user_cv     = '{$user_cv}', ";
                $query .="user_birthday  = '{$user_birthday}', ";
                $query .="country        = '{$country}', ";
                $query .="user_image     = '{$image}' ";
                $query .= "WHERE user_id = '{$id}' ";
                $result = $conn->prepare($query);    
                $result->execute();    
$query ="UPDATE `comments` SET `comment_image` = '{$image}' , `comment_user` = '{$username}' WHERE `comment_user_id` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    

$query ="UPDATE `categories` SET `cat_user` = '$username' WHERE `cat_user_id` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    

$query ="UPDATE `admin_category` SET `cat_user` = '$username' WHERE `cat_user_id` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    

$query ="UPDATE `posts` SET `post_user` = '$username' WHERE `post_user_id` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    


$query ="UPDATE `messages` SET `user_name_r` = '$username' WHERE `user_id_r` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    
$query ="UPDATE `messages` SET `user_name_s` = '$username' WHERE `user_id_s` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    


$query ="UPDATE `friends` SET `user_name_r` = '$username', user_image_r = '$image' WHERE `user_id_r` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    
$query ="UPDATE `friends` SET `user_name_s` = '$username', user_image = '$image' WHERE `user_id_s` = '$id'";
$result = $conn->prepare($query);    
$result->execute();    

echo "<h6 class='alert alert-success text-center' role='alert'>" . operationaccomplishedsuccessfully . "</h6>";}} 


?>
<h6 class="text-center"><img  height="200" width="200" src="../images/<?php echo $image; ?>" alt=""></img></h6>
<h6 class="text-center m-2"><a href="changepassword.php?edit=<?= $id?>"><?php echo  changepassword ?></a></h6></br>

<form method="post" enctype="multipart/form-data">

<div class="file-input row justify-content-center">
  <input type="file" id="file" name="file" class="file">
  <label for="file">
    Select file
    <p class="file-name"></p>
  </label>
</div>
</br></br>


<input type="text" name="username" class="form-control" placeholder="Username" autocomplete="on"
value="<?php echo $usernamee ?>">
<p class="text-danger <?php echo _align ;?>"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
<input type="email" name="email"  class="form-control" placeholder="Email" autocomplete="on" 
value="<?php echo $user_email ?>" >
<p class="text-danger <?php echo _align ;?>"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>

<input type="date" name="user_birthday" class="form-control" value="<?php  echo $user_birthday ?>"></br>
<select class="form-control" name="sex">
<?php  if($sex=='Female'){
        echo "<option value='Female'>".Female."</option>
        <option value='Male'>".Male."</option>";

} 
else {
    echo "<option value='Male'>".Male."</option>
    <option value='Female'>".Female."</option>";
    } ?>
</select></br>
<input name="country" class="form-control" placeholder="Country" value="<?php  echo $country ?>"></br>
<input name="user_cv" class="form-control" placeholder="CV" value="<?php  echo $user_cv ?>"></br>

<input type="submit" name="edit_user" class="btn btn-lg btn-primary btn-block" id="but_upload" value="<?php echo  Save ?>">
</form>
</div></div></div></div>


<br></br><br></br>
<?php include "../includes/footer.php";?>

<?php  if(!isset($_SESSION['user_role'])){
header("Location: /cms/admin/index2.php");} ?>

  
<?php 
if($_SESSION['user_role']!=Admin && $_SESSION['user_id']!=$id ) {
header("Location: /cms/admin/index2.php");} 
?>