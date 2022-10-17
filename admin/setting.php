<?php include "admin_navigation.php";?>
<!-- color -->
<?php if(isset($_POST['colorr'])) {
  $id = $_SESSION['user_id'];
$color_light = $_POST['color_light'];
$color_dark = $_POST['color_dark'];
$back_light = $_POST['back_light'];
$back_dark = $_POST['back_dark'];
$query = "UPDATE users SET ";
$query .="color_light = '{$color_light}', ";
$query .="color_dark = '{$color_dark}', ";
$query .="back_light = '{$back_light}', ";
$query .="back_dark = '{$back_dark}' ";
$query .= "WHERE user_id = '{$id}' ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: /cms/admin/setting.php");}?>
<?php if(isset($_POST['colo'])) {
  $id = $_SESSION['user_id'];
$color_light = $_POST['color_light'];
$color_dark = $_POST['color_dark'];
$back_light = $_POST['back_light'];
$back_dark = $_POST['back_dark'];
$query = "UPDATE users SET ";
$query .="color_light = '#000000', ";
$query .="color_dark = '#FFFFFF', ";
$query .="back_light = '#FFFFFF', ";
$query .="back_dark = '#000000' ";
$query .= "WHERE user_id = '{$id}' ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: /cms/admin/setting.php");}?>
<?php 
if(isset($_SESSION['user_id'])){
$x=0;
$x = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $x  ";
$result = $conn->prepare($query);    
$result->execute();    
$row = $result->fetch();
$color_light = $row['color_light']; 
$color_dark = $row['color_dark']; 
$back_light = $row['back_light']; 
$back_dark = $row['back_dark']; }?>
<!-- background picture -->
<?php if(isset($_POST['Apply'])) {
  $id = $_SESSION['user_id'];
$image = $_FILES['file']['name'];




if(empty($image)) {
    $query = "SELECT * FROM users WHERE user_id = $id ";
    $result = $conn->prepare($query);    
    $result->execute();    
    while($row = $result->fetch()){
      $image = $row['background'];      }}
      else {

            $uploadsDir = "../background_picture/";
            $tempLocation = $_FILES['file']['tmp_name'];
            $temp = explode(".", $_FILES["file"]["name"]);
            $image = uniqid() . '.' . end($temp);
            $targetFilePath = $uploadsDir . $image;
            move_uploaded_file($tempLocation, $targetFilePath);

      }
$query = "UPDATE users SET ";
$query .="background = '$image'";
$query .= "WHERE user_id = '$id' ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: /cms/admin/setting.php");}?>
    <?php if(isset($_POST['Delete'])) {
  $id = $_SESSION['user_id'];
$query = "UPDATE users SET ";
$query .="background   = '' ";
$query .= "WHERE user_id = '{$id}' ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: /cms/admin/setting.php");}?>
<!-- Font -->
<?php if(isset($_POST['fontt'])) {
  $id = $_SESSION['user_id'];
  $font=$_POST['font'];
$query = "UPDATE users SET ";
$query .="font = '$font' ";
$query .= "WHERE user_id = '{$id}' ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: /cms/admin/setting.php");}?>

<div class="container">
<div class="row justify-content-center"> 
<div class="col-md-3 xs-3 sm-3">
    <form class="<?php echo _align ?>" method="post" enctype="multipart/form-data">
    <h6 class="m-2 <?php echo _align ?>"><?php echo LightModecolor ?> <i class="fas fa-sun"></i></h6>
    <h6 class="p-1 <?php echo _align ?>"><?php echo TextColor ?></h6>
    <input type="text" class="jscolor m-1" id="color_light" name="color_light" value="<?php echo $color_light ;?>">
    <h6 class="p-1 <?php echo _align ?>"><?php echo Background ?> </h6>
    <input type="text" class="jscolor m-1" id="back_light" name="back_light" value="<?php echo $back_light ;?>">
    <h6  class="m-2 <?php echo _align ?>"><?php echo DarkModecolor ?><i class="fas fa-moon"></i></h6>
    <h6 class="p-1 <?php echo _align ?>"><?php echo TextColor ?></h6>
    <input type="text" class="jscolor m-1 <?php echo _align ?>" id="color_dark" name="color_dark" value="<?php echo $color_dark ;?>">
    <h6 class="p-1 <?php echo _align ?>"><?php echo Background ?> </h6>
    <input type="text" class="jscolor m-1" id="back_dark" name="back_dark" value="<?php echo $back_dark ;?>"></br>
    <button class="btn btn-primary btn-sm m-2" name="colorr"><?php echo Apply ?></button> 
    <button class="btn btn-danger btn-sm m-2" name="colo"><?php echo Resett ?> </button> 
    </form></div>
</br></br>
<div class="col-md-3 xs-3 sm-3">
   

    <h6 class="m-2  <?php echo _align ?>"> <?php echo ChooseYourFont?> </h5>
    <form class="" method="post" enctype="multipart/form-data">
    <?php 
$x = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $x  ";
$result = $conn->prepare($query);    
$result->execute();    
$row = $result->fetch();
$font = $row['font'];   ?> 
  <select class="form-control" name="font" class="kk">

<?php if(isset($font)){ ?>
<option selected value="<?PHP echo $font ?>"> <?PHP echo $font ?> </option>
<?PHP } else { ?>
<option selected value=""> <?PHP echo ChooseYourFont ?> </option>
<?PHP } ?>



  <?php  if($font!="Amiri"){ ?>
  <option value="Amiri">Amiri</option>
  <?php } if($font!="Harmattan"){ ?>
  <option value="Harmattan">Harmattan</option>
  <?php } if($font!="Lateef"){ ?>
  <option value="Lateef">Lateef</option>
  <?php } if($font!="Open Sans Condensed"){ ?>
  <option value="Open Sans Condensed">Open Sans Condensed</option>
  <?php } if($font!="Rakkas"){ ?>
  <option value="Rakkas">Rakkas</option>
  <?php } if($font!="Scheherazade"){ ?>
  <option value="Scheherazade">Scheherazade</option>
  <?php } if($font!="Tajawal"){ ?>
  <option value="Tajawal">Tajawal</option>
  <?php } if($font!="Tangerine"){ ?>
  <option value="Tangerine">Tangerine</option>


  <?php } ?>






  </select>
  <button class="btn btn-primary btn-sm m-2" name="fontt"> <?php echo Apply ?> </button></form>




  <?php 
$x = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $x  ";
$result = $conn->prepare($query);    
$result->execute();    
$row = $result->fetch();
$lala = $row['lang'];   ?> 

    <h6 class="m-2  <?php echo _align ?>"> <?php echo ChooseYourLanguage ?></h5>
    <form class="" method="post" enctype="multipart/form-data">
  <select class="form-control" name="lang">
  <?php  if($lala!="ar"){ ?>
  <option value="en">English</option>
  <option value="ar">العربية</option>
  <?php } else { ?>
  <option value="ar">العربية</option>
  <option value="en">English</option>
  <?php } ?>
  
  </select>
  <button class="btn btn-primary btn-sm m-2" name="langg"> <?php echo Apply ?> </button></form>


<?php if(isset($_POST['langg'])) {
$id = $_SESSION['user_id'];
$lang=$_POST['lang'];
$_SESSION['lang'] = $lang;
$query = "UPDATE users SET ";
$query .="lang = '$lang' ";
$query .= "WHERE user_id = '{$id}' ";
$result = $conn->prepare($query);    
$result->execute();    
header("Location: /cms/admin/setting.php");}?>

<h6 class="m-2 <?php echo _align ?>"><?php echo Backgroundpicture ?></h5>
    <form action="" method="post" enctype="multipart/form-data">
    
    <div class="custom-file">
    <label class="custom-file-label" for="file"><?php echo Choosefile ?></label>
    <input  class="custom-file-input" type="file" id="file" name="file">
    <div class="invalid-feedback"></div>
  </div>

    <button class="btn btn-primary btn-sm m-2" id="but_upload" name="Apply"> <?php echo Apply ?> </button> 
    <button class="btn btn-danger btn-sm m-2" name="Delete"> <?php echo Delete ?></button>
    </form> 
    </br></br>

  </div>  </div>
  </div></div></br></br></br></br></br></br></br>
 <?php include "../includes/footer.php";?>
 <style>
.kk{
  border: 1px solid #E8EAED;
    border-radius: 5px;
    box-shadow: 0 1px 3px -2px #9098A9;
    cursor: pointer;
    font-family: inherit;
    font-size: 16px;
    transition: all 150ms ease;
      color: #5A667F;}
</style>

<script type="application/javascript">
    $('#file').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>