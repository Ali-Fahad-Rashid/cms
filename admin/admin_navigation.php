<?php  include "../includes/db.php"; ?>
<?php  include "../includes/header.php"; ?>
<?php  include "../includes/navigation.php"; ?>
<?php  include "functions.php"; ?>

    <br></br><br></br>
    <div class="d-flex">
    <div id="accordionExample">
    <div class="card border-danger" style="width: 8rem;">
    <a href="/cms/admin/index.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-tachometer-alt"></i><?php echo  Adminn ?></a></div>
    <div class="card  border-danger active" style="width: 8rem;">
    <a href="/cms/admin/comments.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-comment"></i><?php echo  Comments ?></a></div>
    <div class="card border-danger" style="width: 8rem;">
    <a href="/cms/admin/profile.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-id-card"></i><?php echo  Profile ?></a></div>
    <div class="card border-danger" style="width: 8rem;">
    <a  href="/cms/admin/setting.php" class="btn colorr <?php echo _align ;?>"> <i class="fas fa-cogs"></i><?php echo  Setting ?></a></div>
    <?php  if($_SESSION['user_role']==Admin){?>
    <div class="card border-danger" style="width: 8rem;">
    <a href="/cms/admin/users.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-user-tie"></i><?php echo  Users ?></a></div>
    <?php } ?>

    <div class="card border-danger text-center" style="width: 8rem;">
    <button class="btn colorr <?php echo _align ;?>" data-toggle="collapse" data-target="#collapseTwo">
    <i class="fas fa-clipboard"></i> <?php echo  Posts ?></button>
    <div id="collapseTwo" class="collapse <?php echo _align ;?>" data-parent="#accordionExample">
    <a href="/cms/admin/posts.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-clone"></i><?php echo  View ?></a>
    <a href="/cms/admin/add_post.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-plus-square"></i><?php echo  Addd ?></a>
    </div></div>
    
<?php  if($_SESSION['user_role']==Admin){?>
    <div class="card  border-danger active" style="width: 8rem;">
    <a href="/cms/admin/categories_admin.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-exclamation"></i><?php echo  Dashboard ?></a></div>
<?php } ?>

<div class="card border-danger text-center" style="width: 8rem;">
    <button class="btn colorr <?php echo _align ;?>" data-toggle="collapse" data-target="#collapseThree">
    <i class="fas fa-archive"></i><?php echo  Categories ?></button>
    <div id="collapseThree" class="collapse <?php echo _align ;?>" data-parent="#accordionExample">
    <a href="/cms/admin/categories.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-clone"></i> <?php echo  View ?></a>
    <a href="/cms/admin/add_categories.php" class="btn colorr <?php echo _align ;?>"><i class="fas fa-plus-square"></i> <?php echo  Addd ?></a>
    </div></div>

    </div>


    <?php
    