<?php
include "../db.php"; 

if(isset($_POST['edit'])) {
    $post_id = $_POST['post_id'];
    $con = $_POST['con'];

    $com_id = $_POST['com_id'];


/*     $con = preg_replace('/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/' ,
    '<iframe width="690" height="400" src="https://www.youtube.com/embed/$1" allowfullscreen></iframe>', $con); */


        $query="UPDATE comments SET comment_content = ? WHERE comment_id= ? ";
        $result = $conn->prepare($query);    
        $result->execute([$con,$com_id]);  


}

if(isset($_POST['reply'])) {
    $post_id = $_POST['post_id'];
    $con = $_POST['con'];

    $com_id = $_POST['com_id'];


/*     $con = preg_replace('/http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/' ,
    '<iframe width="690" height="400" src="https://www.youtube.com/embed/$1" allowfullscreen></iframe>', $con); */


        $query="UPDATE comments SET comment_content = ? WHERE comment_id = ? ";
        $result = $conn->prepare($query);    
        $result->execute([$con,$com_id]);  


}