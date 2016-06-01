<?php 
	session_start();
	session_destroy();
	$files_cards = glob('uzzipped/*'); // get all file names
                foreach($files_cards as $file){ // iterate files
                  if(is_file($file)){
                    unlink($file); // delete file
                  }
     }
	header("location:login.php");
?>