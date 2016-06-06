<?php
   include "dbconfig.php";
   include "zip.php";
?>
<?php
if(@isset($_SERVER['HTTP_REFERER']) && isset($_FILES['upload_doc']['name'])){ //if the generate button is clicked AND
      $file_name = $_FILES['upload_doc']['name'];
      $file_tmp =$_FILES['upload_doc']['tmp_name'];
      $file_type=$_FILES['upload_doc']['type'];
      $file_ext=strtolower(end((explode('.',$_FILES['upload_doc']['name']))));
      $errors= array();
      $field= array();
      $extensions= array("docx","xlsx","pdf","png","jpeg","jpg");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose allowed file.";
      }
	  $user_Id=$_REQUEST['user_Id'];
      $name=$_REQUEST['name'];
      $sub_check=$_REQUEST['sub_check'];
	  if($sub_check){
		 $categories=explode('/',$_REQUEST['categorie']);
		 $categorie=$categories[0];
		 $sub_categorie=$categories[1];
	  }else{
		 $categorie=$_REQUEST['categorie'];
	  }
	  $description=$_REQUEST['description'];
      
     // echo " wallah:".$file_name;
      if(empty($errors)==true){
		 $upload=$user->upload($user_Id,$name,$categorie,$file_ext,$file_name,$description);
	    if($upload!="not done"){
		 if($sub_check){
			$sub_cat=$user->sub_categorie_ins($upload,$sub_categorie);
		 }
		 if(isset($_FILES['upload_doc']) && trim($_FILES['upload_doc']['name']," ") !=""){ //if the picture has been given
			//if true, good; if false, zip creation failed
		   $result = create_zip($file_tmp,$name."/".$_REQUEST['categorie']."/".$upload.".".$file_ext,'my-archive.zip');
		 }else{
			 // do nothing
		 }
	  echo "<div class='alert alert-success'> file uploaded</div>";
			 
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
      echo "<div class='alert alert-danger'>some error occur.</div>";
 }
 
 
 
 
?>