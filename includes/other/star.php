<?php
include "../db.php"; 

if(isset($_POST['st1'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $query = "SELECT * FROM stars WHERE post_id=$post_id AND user_id=$user_id";
    $result = $conn->prepare($query);    
    $result->execute();  
    if($result->rowCount() > 0){
        $query="UPDATE stars SET types = 1 WHERE  post_id=$post_id AND user_id=$user_id";
        $result = $conn->prepare($query);    
        $result->execute();  
    } else {
    $query="INSERT INTO stars(user_id, post_id, types) VALUES($user_id, $post_id,1)";
    $result = $conn->prepare($query);    
    $result->execute();      }

    $query = "SELECT * FROM stars WHERE post_id=$post_id ";
    $result = $conn->prepare($query);    
      $result->execute();  
      $starcount=0;
          $num = $result->rowCount(); ;
          while($row = $result->fetch()){
              $types = $row['types'];
          $starcount = $starcount + $types ;
          }
                      echo $starcount/$num ;

    }


    if(isset($_POST['st2'])) {
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
        $query = "SELECT * FROM stars WHERE post_id=$post_id AND user_id=$user_id";
        $result = $conn->prepare($query);    
        $result->execute();  
        if($result->rowCount() > 0){
            $query="UPDATE stars SET types = 2 WHERE  post_id=$post_id AND user_id=$user_id";
            $result = $conn->prepare($query);    
            $result->execute();  
        } else {
        $query="INSERT INTO stars(user_id, post_id, types) VALUES($user_id, $post_id,2)";
        $result = $conn->prepare($query);    
        $result->execute();      }
    
        $query = "SELECT * FROM stars WHERE post_id=$post_id";
        $result = $conn->prepare($query);    
          $result->execute();  
          $starcount=0;
              $num = $result->rowCount(); ;
              while($row = $result->fetch()){
                  $types = $row['types'];
              $starcount = $starcount + $types ;
              }
                          echo $starcount/$num ;
    
        }


        if(isset($_POST['st3'])) {
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];
            $query = "SELECT * FROM stars WHERE post_id=$post_id AND user_id=$user_id";
            $result = $conn->prepare($query);    
            $result->execute();  
            if($result->rowCount() > 0){
                $query="UPDATE stars SET types = 3 WHERE  post_id=$post_id AND user_id=$user_id";
                $result = $conn->prepare($query);    
                $result->execute();  
            } else {
            $query="INSERT INTO stars(user_id, post_id, types) VALUES($user_id, $post_id,3)";
            $result = $conn->prepare($query);    
            $result->execute();      }
        
            $query = "SELECT * FROM stars WHERE post_id=$post_id ";
            $result = $conn->prepare($query);    
              $result->execute();  
              $starcount=0;
                  $num = $result->rowCount(); ;
                  while($row = $result->fetch()){
                      $types = $row['types'];
                  $starcount = $starcount + $types ;
                  }
                              echo $starcount/$num ;
        
            }


            if(isset($_POST['st4'])) {
                $post_id = $_POST['post_id'];
                $user_id = $_POST['user_id'];
                $query = "SELECT * FROM stars WHERE post_id=$post_id AND user_id=$user_id";
                $result = $conn->prepare($query);    
                $result->execute();  
                if($result->rowCount() > 0){
                    $query="UPDATE stars SET types = 4 WHERE  post_id=$post_id AND user_id=$user_id";
                    $result = $conn->prepare($query);    
                    $result->execute();  
                } else {
                $query="INSERT INTO stars(user_id, post_id, types) VALUES($user_id, $post_id,4)";
                $result = $conn->prepare($query);    
                $result->execute();      }
            
                $query = "SELECT * FROM stars WHERE post_id=$post_id ";
                $result = $conn->prepare($query);    
                  $result->execute();  
                  $starcount=0;
                      $num = $result->rowCount(); ;
                      while($row = $result->fetch()){
                          $types = $row['types'];
                      $starcount = $starcount + $types ;
                      }
                                  echo $starcount/$num ;
            
                }

                if(isset($_POST['st5'])) {
                    $post_id = $_POST['post_id'];
                    $user_id = $_POST['user_id'];
                    $query = "SELECT * FROM stars WHERE post_id=$post_id AND user_id=$user_id";
                    $result = $conn->prepare($query);    
                    $result->execute();  
                    if($result->rowCount() > 0){
                        $query="UPDATE stars SET types = 5 WHERE  post_id=$post_id AND user_id=$user_id";
                        $result = $conn->prepare($query);    
                        $result->execute();  
                    } else {
                    $query="INSERT INTO stars(user_id, post_id, types) VALUES($user_id, $post_id,5)";
                    $result = $conn->prepare($query);    
                    $result->execute();      }
                
                    $query = "SELECT * FROM stars WHERE post_id=$post_id ";
                    $result = $conn->prepare($query);    
                      $result->execute();  
                      $starcount=0;
                          $num = $result->rowCount(); ;
                          while($row = $result->fetch()){
                              $types = $row['types'];
                          $starcount = $starcount + $types ;
                          }
                                      echo $starcount/$num ;
                
                    }