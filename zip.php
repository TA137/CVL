<?php
/* creates a compressed zip file */
function create_zip($files,$name,$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) {
            $zip = new ZipArchive;
            $zip->open('my-archive.zip');
            $zip->addFile($files, $name);
            $zip->close();
        
        
        return false;
    }
	//if we have good files...
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
			$zip->addFile($files,$name);
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
}
?>