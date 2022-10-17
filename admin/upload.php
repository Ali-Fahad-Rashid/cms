<?php  


 if($_FILES['file']['name'] != '')  
 {  $x = $_FILES['file']['name'];
      $extension = explode(".",$x);  
      $allowed_type = array("jpg", "jpeg", "png", "gif");  
      if(in_array(end($extension), $allowed_type))  
      {  
           $new_name = time() . "." . end($extension);  
           $path = "../upload/" . $new_name;  
           if(move_uploaded_file($_FILES['file']['tmp_name'], $path))  
           {  
                echo '  
                     <div class="col-md-8">       
                          <img height="100" width="100" src="'.$path.'" class="img-responsive" />  
                     </div>  
                     <div class="col-md-4">  
                          <button type="button" data-path="'.$path.'" id="remove_button" class="btn btn-danger">x</button>  
                     </div>  
                     ';  
           }  
      }  
      else  
      {  
           echo '<script>alert("Invalid File Formate")</script>';  
      }  
 }  
 else  
 {  
      echo '<script>alert("Please Select File")</script>';  
 }  
 ?>  