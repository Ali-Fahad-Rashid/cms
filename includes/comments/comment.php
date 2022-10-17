<?php include "com_form.php"; ?>
<?php
 // get all comments of post
$query= "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = '".Approve."' ORDER BY comment_id DESC ";
$result = $conn->prepare($query);    
$result->execute();    
 // save all records from database in an array
$comments = array();
while($row = $result->fetchObject()){
    array_push($comments, $row);}
// loop through each comment
foreach ($comments as $comment_key => $comment){
    // initialize replies array for each comment
    $replies = array();
    // check if it is a comment to post, not a reply to comment
    if ($comment->reply_of == 0) {
        // loop through all comments again
        foreach ($comments as $reply_key => $reply) {
            // check if comment is a reply
            if ($reply->reply_of == $comment->comment_id ) {
                // add in replies array
                array_push($replies, $reply);
                // remove from comments array
                unset($comments[$reply_key]);}}}
    // assign replies to comments object
    $comment->replies = $replies;}?></br></br>
    <div class="comments">
    <?php foreach ($comments as $comment): $x=$comment->comment_id;?>
    <h6  class="drhjrt" id="<?php echo $x;?>"></h6>
    <div class="row " >
    <div class="col " >
    <div class="d-inline-flex p-2 bd-highlight">
    <img class="m-3" style="border-radius: 25%;" height="150" width="150" src="/cms/images/<?php echo $comment->comment_image; ?>" alt=""></img>
    <div class="card border-primary shadow-lg <?php echo _align ?>" style="width: 34rem;">
    <?php if($comment->comment_user_id!=0){?>
    <h5 class="card-header"><a class='' href='/cms/profile.php?u_id=<?php echo $comment->comment_user_id;?>'><?php echo $comment->comment_user; ?></a></h5>
    <?php } else {?>
    <h5 class="card-header"><a class='' href=''><?php echo $comment->comment_user; ?></a></h5>
    <?php } ?>
    <div id="ed<?php echo $x;?>"  class="card-body content">
   <?php echo $comment->comment_content; ?>
    </div>
    <div class="card-footer">
    <div class="row">
    <div class="col">
    <div id="dffdgb" class="btn btn-sm btn-primary" data-comment_id="<?php echo $comment->comment_id; ?>" 
    onclick="showReplyForm(this);"> <?php  echo Reply ?> <i class="far fa-paper-plane"></i></div>
    <?php 
    if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role']===Admin || $_SESSION['user_id']===$comment->comment_user_id) {?>
    <a data="<?php echo $x;?>" class='btn btn-sm btn-danger edi'> <?php  echo Edit ?>
    <i class="far fa-edit"></i></a>
    <input class="btn btn-sm btn-primary sav" data="<?php echo $x;?>" style="display:none" id="eds<?php echo $x;?>" type="submit" name="" value="<?php echo Save ?>">

     <?php }}?></br>
                <form method="post" id="form-<?php echo $comment->comment_id; ?>" style="display: none;">
                <input class="form-control" type="hidden" name="reply_of" value="<?php echo $comment->comment_id; ?>" required>
                <input class="form-control" type="hidden" name="post_id" value="<?php echo $comment->comment_post_id; ?>" required>
                <label><?php  echo Username ?></label><input class="form-control" type="text" name="name" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "" ?>" required>
                <label><?php  echo Email ?></label><input class="form-control" type="email" name="email" value="<?php  echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "" ?>"  required>
                <label> <?php  echo YourComment ?></label></br>
                <textarea id="editor" name="comment" class="form-control" rows="3" required></textarea></br>
                <button class="btn btn-sm btn-success" type="submit" value="Send" name="do_reply"><?php  echo Send ?> <i class="fas fa-paper-plane"></i>
    </button></form></div>
    <div class="col">
    <?php include "com_like.php"; ?>
    </div></div></div>
    </div></div></div></div></br>
        <div class="container comments reply">
        <?php foreach ($comment->replies as $reply): $x=$reply->comment_id; ?>
        <div class="d-inline-flex p-2 bd-highlight offset-2">
        <img class="m-3" style="border-radius: 25%;" height="150" width="150" src="/cms/images/<?php echo $reply->comment_image; ?>" alt=""></img>
        <div class="card border-info shadow-lg <?php  echo _align ?>" style="width: 26rem;">
        <?php if($reply->comment_user_id!=0){?>
        <h5 class="card-header"><a class='' href='/cms/profile.php?u_id=<?php echo $reply->comment_user_id;?>'><?php echo $reply->comment_user; ?></a></h5>
        <?php } else {?>
        <h5 class="card-header"><a class='' href=''><?php echo $reply->comment_user; ?></a></h5>
        <?php } ?>

    <div id="edd<?php echo $x;?>"  class="card-body contentt">
    <?php echo $reply->comment_content; ?>
    </div>

    <div class="card-footer">
    <div class="row">
    <div class="col">
    <div class="btn btn-sm btn-info" onclick="showReplyForReplyForm(this);" data-comment_user="<?php echo $reply->comment_user; ?>" 
    data-comment_id="<?php echo $comment->comment_id; ?>"> <?php  echo Reply ?><i class="far fa-paper-plane"></i></div>
    <?php if($reply->comment_user_id!=0){ if($_SESSION['user_role']===Admin || $_SESSION['user_id']===$reply->comment_user_id) {?>
    <a class='btn btn-sm btn-danger edii' data="<?php echo $x;?>" > <?php  echo Edit ?><i class="far fa-edit"></i></a>
    <input class="btn btn-sm btn-primary savv" data="<?php echo $x;?>" style="display:none" id="edss<?php echo $x;?>" type="submit" name="" value="<?php echo Save ?>">

    <?php } }?> </div>
    <div class="col">
    </div></div></div></div> </div></br>
    <?php endforeach; ?></br></div></br>
    <?php endforeach; ?></div>
    <?php include "com_reply.php"; ?>
    <?php include "com_scrpt.php"; ?>