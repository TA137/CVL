<!--<html>
<head>
<style type="text/css">

</style>
</head>
<body>
<div>
<!--<iframe name="myiframe" style"width:600px; height:100%;" id="myiframe" src="example.pdf">-->
    <!--<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://742b1442.ngrok.io/scan_doc/example.docx' width='500px' height='350px' frameborder='0'></iframe>
<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://img.labnol.org/di/PowerPoint.ppt' width='500px' height='350px' frameborder='0'></iframe>
</div>
</body>
</html>-->
    
<?php
/*Actual filename = 'attachment.zip' (Unknown to the viewers).
When downloaded to be saved as 'mydownload.zip'.
*/
$file_name = "uzzipped/4/4/13.pdf";
/*
|-----------------
| Chip Download Class
|------------------
*/
 
require_once("class.chip_download.php");
 
/*
|-----------------
| Class Instance
|------------------
*/
 
$download_path = "uzzipped/";
$file = "4/4/13.pdf";
$args = array(
        'download_path'     =>   $download_path,
        'file'              =>   $file,
        'extension_check'   =>   TRUE,
        'referrer_check'    =>   FALSE,
        'referrer'          =>   NULL,
        );
$download = new chip_download( $args );
 
/*
|-----------------
| Pre Download Hook
|------------------
*/
 
$download_hook = $download->get_download_hook();
//$download->chip_print($download_hook);
//exit;
 
/*
|-----------------
| Download
|------------------
*/
 
if( $download_hook['download'] == TRUE ) {
 
    /* You can write your logic before proceeding to download */
 
    /* Let's download file */
    $download->get_download();
 
}
 
?>