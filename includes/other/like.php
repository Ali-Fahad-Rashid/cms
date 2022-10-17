<?php
include "../db.php"; 

if(isset($_POST['likedd'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $com_id = $_POST['com_id'];

    $query="UPDATE comments SET likes=likes+1 WHERE comment_id ='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
    $query="INSERT INTO likes(user_id, post_id, types, com_id) VALUES('$user_id', '$post_id','like', '$com_id')";
    $result = $conn->prepare($query);    
    $result->execute();  

    $query = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$user_id' AND types='unlike' AND com_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
    $count = $result->rowCount();
if($count>=1){
    $query="DELETE FROM likes WHERE post_id='$post_id' AND user_id='$user_id' AND types='unlike' AND com_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute(); 

    $query= "UPDATE comments SET unlikes=unlikes-1 WHERE comment_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
}

    $query = "SELECT * FROM comments WHERE comment_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
    while($row = $result->fetch()){
    $likes = $row['likes'];
    $unlikes = $row['unlikes'];
}
$array = ["likes"=>"$likes","unlikes"=>"$unlikes"];

   echo json_encode($array);
    }
if(isset($_POST['unlikedd'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $com_id = $_POST['com_id'];

    $query="DELETE FROM likes WHERE post_id='$post_id' AND user_id='$user_id' AND types='like' AND com_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  

    $query= "UPDATE comments SET likes=likes-1 WHERE comment_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  

    $query = "SELECT * FROM comments WHERE comment_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
    $row = $result->fetch();
    $likes = $row['likes'];
   echo "$likes";
    } 
    



    if(isset($_POST['likedd2'])) {
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
        $com_id = $_POST['com_id'];

        $query="UPDATE comments SET unlikes=unlikes+1 WHERE comment_id='$com_id'";
        $result = $conn->prepare($query);    
        $result->execute();  
        $query="INSERT INTO likes(user_id, post_id, types, com_id) VALUES('$user_id', '$post_id','unlike', '$com_id')";
        $result = $conn->prepare($query);    
        $result->execute();  

        $query = "SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$user_id' AND types='like' AND com_id='$com_id'";
        $result = $conn->prepare($query);    
        $result->execute();  
        $count = $result->rowCount();
    if($count>=1){
        $query="DELETE FROM likes WHERE post_id='$post_id' AND user_id='$user_id' AND types='like' AND com_id='$com_id'";
        $result = $conn->prepare($query);    
        $result->execute(); 
    
        $query= "UPDATE comments SET likes=likes-1 WHERE comment_id='$com_id'";
    $result = $conn->prepare($query);    
    $result->execute();  
    }
    
        $query = "SELECT * FROM comments WHERE comment_id='$com_id'";
        $result = $conn->prepare($query);    
        $result->execute();  
        while($row = $result->fetch()){
            $likes = $row['likes'];
            $unlikes = $row['unlikes'];
        }
        $array = ["likes"=>"$likes","unlikes"=>"$unlikes"];
        
           echo json_encode($array);
        }
    if(isset($_POST['unlikedd2'])) {
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
        $com_id = $_POST['com_id'];

        $query="DELETE FROM likes WHERE post_id='$post_id' AND user_id='$user_id' AND types='unlike' AND com_id='$com_id'";
        $result = $conn->prepare($query);    
        $result->execute();  

        $query= "UPDATE comments SET unlikes=unlikes-1 WHERE comment_id='$com_id'";
        $result = $conn->prepare($query);    
        $result->execute();  
    
        $query = "SELECT * FROM comments WHERE comment_id='$com_id'";
        $result = $conn->prepare($query);    
        $result->execute();  
        $row = $result->fetch();
        $unlikes = $row['unlikes'];
       echo "$unlikes";
        } 





       /*  if(isset($_SESSION['user_role'])){
        $x=$_SESSION['user_id'];
        $com_id=$comment->comment_id;
          $query="SELECT * FROM likes WHERE user_id='$x' AND post_id='$post_id' AND types='like' AND com_id='$com_id'";
          $result = $conn->prepare($query);    
          $result->execute();  
          $c=$result->rowCount(); */
   















































if(isset($_POST['liked'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $query="UPDATE posts SET likes=likes+1 WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  
    $query="INSERT INTO likes(user_id, post_id, types) VALUES($user_id, $post_id,'like')";
    $result = $conn->prepare($query);    
    $result->execute();  

    $query = "SELECT * FROM likes WHERE post_id=$post_id AND user_id=$user_id AND types='unlike' AND com_id=0";
    $result = $conn->prepare($query);    
    $result->execute();  
    $count = $result->rowCount();
if($count>=1){
    $query="DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id AND types='unlike'  AND com_id=0";
    $result = $conn->prepare($query);    
    $result->execute(); 

    $query= "UPDATE posts SET unlikes=unlikes-1 WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  
}

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  
    while($row = $result->fetch()){
    $likes = $row['likes'];
    $unlikes = $row['unlikes'];
}
$array = ["likes"=>"$likes","unlikes"=>"$unlikes"];

   echo json_encode($array);
    }
if(isset($_POST['unliked'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $query="DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id AND types='like' AND com_id=0";
    $result = $conn->prepare($query);    
    $result->execute();  

    $query= "UPDATE posts SET likes=likes-1 WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  
    $row = $result->fetch();
    $likes = $row['likes'];
   echo "$likes";
    } 
    



    if(isset($_POST['liked2'])) {
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
    
        $query="UPDATE posts SET unlikes=unlikes+1 WHERE post_id=$post_id";
        $result = $conn->prepare($query);    
        $result->execute();  
        $query="INSERT INTO likes(user_id, post_id, types) VALUES($user_id, $post_id,'unlike')";
        $result = $conn->prepare($query);    
        $result->execute();  

        $query = "SELECT * FROM likes WHERE post_id=$post_id AND user_id=$user_id AND types='like' AND com_id=0";
        $result = $conn->prepare($query);    
        $result->execute();  
        $count = $result->rowCount();
    if($count>=1){
        $query="DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id AND types='like' AND com_id=0";
        $result = $conn->prepare($query);    
        $result->execute(); 
    
        $query= "UPDATE posts SET likes=likes-1 WHERE post_id=$post_id";
    $result = $conn->prepare($query);    
    $result->execute();  
    }
    
        $query = "SELECT * FROM posts WHERE post_id=$post_id";
        $result = $conn->prepare($query);    
        $result->execute();  
        while($row = $result->fetch()){
            $likes = $row['likes'];
            $unlikes = $row['unlikes'];
        }
        $array = ["likes"=>"$likes","unlikes"=>"$unlikes"];
        
           echo json_encode($array);
        }
    if(isset($_POST['unliked2'])) {
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
    
        $query="DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id AND types='unlike'  AND com_id=0";
        $result = $conn->prepare($query);    
        $result->execute();  

        $query= "UPDATE posts SET unlikes=unlikes-1 WHERE post_id=$post_id";
        $result = $conn->prepare($query);    
        $result->execute();  
    
        $query = "SELECT * FROM posts WHERE post_id=$post_id";
        $result = $conn->prepare($query);    
        $result->execute();  
        $row = $result->fetch();
        $unlikes = $row['unlikes'];
       echo "$unlikes";
        } 
        
    