<?php 
	session_start();
	session_destroy();
	recursiveRemoveDirectory('uzzipped/'); // get all file names
             function recursiveRemoveDirectory($directory)
			{
				foreach(glob("{$directory}/*") as $file)
				{
					if(is_dir($file)) { 
						recursiveRemoveDirectory($file);
					} else {
						unlink($file);
					}
				}
				rmdir($directory);
			}
	header("location:login.php");
?>