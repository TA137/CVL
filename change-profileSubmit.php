<?php
session_start();
if(@isset($_SERVER['HTTP_REFERER'])){
require_once 'dbconfig.php'; //connection ?>
<?php
 if(isset($_REQUEST['user_Id']) && isset($_REQUEST['firstname'])){ //if the generate button is clicked AND
    
      if(isset($_FILES['profile_pic']['name']) && trim(($_FILES['profile_pic']['name'])," ")!=""){
      $file_name = "profile/".$_FILES['profile_pic']['name'];
      $file_tmp =$_FILES['profile_pic']['tmp_name'];
      $file_type=$_FILES['profile_pic']['type'];
      $file_ext=strtolower(end((explode('.',$_FILES['profile_pic']['name']))));
      $extensions= array("png","jpeg","jpg");
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose allowed file.";
      }
      }else{
        $file_name ="profile/";
      }
      $errors= array();
      $field= array();
     
      $id=$_REQUEST['user_Id'];
      $firstname=$_REQUEST['firstname'];
      $lastname=$_REQUEST['lastname'];
      $gender=$_REQUEST['gender'];
      $phone=$_REQUEST['phone'];
      $emailAddress=$_REQUEST['emailAddress'];
      
      
     // echo " wallah:".$file_name;
      if(empty($errors)==true){
		 $change_pro=$user->change_profile($id,$firstname,$lastname,$gender,$phone,$emailAddress,$file_name);
	    if($change_pro=="updated"){
		  if(isset($_FILES['profile_pic']) && trim($_FILES['profile_pic']['name']," ") !=""){ //if the picture has been given
		  move_uploaded_file($file_tmp,"profile/".$id.".".$file_ext);
          echo "<div class='alert alert-success'> profile updated.</div>";
		  }else{
		      // do nothing
		  }
          echo "<div class='alert alert-success'> profile updated.</div>";
	    }else{
	       echo "<div class='alert alert-danger'>";
	       echo "Some Error occured";
	       echo "</div>";
	    }
		
      }else{
        echo "<div class='alert alert-danger'>";
        for($i=0;$i<count($errors);$i++){
            echo $errors[$i]."<br>";
        }
	echo "</div>";
      }

   }else{
      echo "<div class='error'>some error occur.</div>";
 }
 
 
}
		else{
			header('location:login.php');
		}
 
?>