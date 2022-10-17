<nav class="navbar coloor shadow-lg navbar-expand-lg fixed-top p-1">
<a class="navbar-brand btn zzoom glow footer ali"  data-toggle="tooltip" data-placement="top" 
title="" href="/cms/index.php">Programming Institution</a>
<label class="switc m-2 nana">
  <input type="checkbox" id="customSwitch1">
  <span class="slide roun"></span>
</label>
<div class="col offset-1"></div>
<div class="btn-group ">

    <button type="button" class="nana zoom btn coloor  dropdown-toggle-split"
    id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
      <span class="sr-only">Toggle Dropdown</span><i class="fas fa-bars"></i></button>
    <div class="dropdown-menu coloor" aria-labelledby="dropdownMenuReference">
    <?php
    
    if(isset($_SESSION['user_id'])){
        
        ?> 
<a class="dropdown-item coloor zzoom <?php echo _align ;?>" href="/cms/profile.php?u_id=<?php echo $_SESSION['user_id'];?>">
<i class="fas fa-user"></i> <?php echo $_SESSION['username'] ?></a>
<a class="dropdown-item coloor zzoom <?php echo _align ;?>" href="/cms/friends.php"> 
<i class="fas fa-user-friends"></i> <?php echo Friends ?></a>
<a class="dropdown-item coloor zzoom <?php echo _align ;?>" href="/cms/admin/setting.php">
<i class="fas fa-cog"></i> <?php echo Setting ;?></a>
<a class=" dropdown-item coloor zzoom <?php echo _align ;?>" href="/cms/admin">
 <i class="fas fa-user-cog" > </i> <?php echo Adminn ;?></a>
<a class=" dropdown-item coloor zzoom <?php echo _align ;?>" href="/cms/includes/logout.php" > 
<i class="fas fa-sign-out-alt"></i> <?php echo Logout ;?></a>
<?PHP } else {?>
<a class=" dropdown-item coloor zzoom <?php echo _align ;?>" href="/cms/login.php">
<i class="fas fa-sign-in-alt"></i> <?php echo Login ;?></a>
<a class=" dropdown-item coloor zzoom <?php echo _align ;?>" href="/cms/registration.php"> 
<i class="fas fa-registered"></i>  <?php echo Register ;?></a>
<?php }?>
    </div>  </div>
    <a class="footer nana zoom btn" href="/cms/index.php">
<i class="fas fa-home"></i></a>
<?php
if(isset($_SESSION['user_id'])){?>

<a class=" footer nana zoom btn <?php echo _align ;?>" href="/cms/profile.php?u_id=<?php echo $_SESSION['user_id'];?>">
<i class="fas fa-user"></i> <?php //echo $_SESSION['username'] ?></a>


    <?php } include "other/nav.php"?>
   <!-- Dark Mode Switch -->
<!--    <div class="zzoom m-2" id="toggle-icon"><i class="fas fa-sun"></i></div>
   <div class="custom-control custom-switch mb-1">
            <input type="checkbox" class="custom-control-input" id="customSwitch1">
            <label class="custom-control-label " for="customSwitch1"></label>
            </div> -->
            <!-- Dark Mode End -->
<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
<?php 
if(!isset($_SESSION['user_id'])){
    ?> 
<a class="zoom nana footer btn" href="/cms/login.php"><i class="fas fa-sign-in-alt"></i> <?php echo Login ;?></a>
<a class="zoom nana footer btn" href="/cms/registration.php"> 
<i class="fas fa-registered"></i> <?php echo Register ;?></a>
<?php }?> 
</div>

<form action="/cms/search.php" method="post" class="coloor form-inline d-none d-lg-block searchh">
<input name="search" id="search" class="form-control coloor" type="search" placeholder="<?php echo Search ?>" required autocomplete="off">
<button name="submit" class="zoom btn coloor" type="submit"> <i class="fa fa-search"></i></button>
</form>
<div class="" id="search_result"></div>

<br></br>

</nav>





<?php if(isset($_POST['reset'])) { $x = $_SESSION['user_id'];
$query = "UPDATE  notifications SET notification_count = '' WHERE notification_user_id = '$x' ";    
$result = $conn->prepare($query);    
$result->execute();    
}?>
<?php if(isset($_POST['rese'])) { $x = $_SESSION['user_id'];
$query = "UPDATE  notifications_message SET notification_count = '' WHERE notification_user_id = '$x' ";    
$result = $conn->prepare($query);    
$result->execute();    
}?>


<script type="text/javascript">
        $(document).ready(function () {
            $("#search").keyup(function () {
                var query = $(this).val();
                if (query != "" && query != " ") {
                    $.ajax({
                      url: "/cms/includes/other/livesearch.php",
                        method: 'POST',
                        data: {
                            'query': query
                        },
                        success: function (data) {
                            $('#search_result').html(data);
                            $('#search_result').css('display', 'block');

                            $("#search").focusout(function () {

                              setTimeout(function () {  

                                $('#search_result').css('display', 'none');

                               }, 200); 



                            });

                            
                            $("#search").focusin(function () {
                                $('#search_result').css('display', 'block');
                            });
                        }
                    });
                } else {
                    $('#search_result').css('display', 'none');
                }
            });
        });
    </script>




<?php if(isset($_SESSION['lang'])){
if($_SESSION['lang']=="ar"){?>

  <style>
  #search_result{
left: 49px;
top: 49px;
 } 
 </style>

 <?php      } 

              if($_SESSION['lang']=="en") { ?>
                
                <style>
                #search_result{
              right: 49px;
              top: 49px;
               } 
               </style>
              
         <?php     }
              }
                else { ?>

                  
    <style>
    #search_result{
left: 49px;
top: 49px;
   } 
   </style>

            <?php      } 
                  ?>



    <style>
     #search_result{
  position: absolute;

  background-color: #f6f6f6;
  width: 276px;
   max-height: 300px;

  overflow: auto;
  border-radius: 10px;

    } 
    </style>