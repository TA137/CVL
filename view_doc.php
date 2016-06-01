<?php
require_once("class.chip_download.php");
if(isset($_REQUEST['doc_id'])&&isset($_REQUEST['org_id'])&&isset($_REQUEST['cat_id'])&&isset($_REQUEST['Doc_type'])){
    $action=$_REQUEST['Action'];
    $id=$_REQUEST['doc_id'];
    $org_id=$_REQUEST['org_id'];
    $cat_id=$_REQUEST['cat_id'];
    $doc_type=$_REQUEST['Doc_type'];
    //$filesToView=array();
    $filesToView=$org_id."/".$cat_id."/".$id.".".$doc_type;
    echo $filesToView."<br>";
    if(unzip($filesToView)){
        echo "unzipped";
        if($action=='view'){
            if(strtolower($doc_type)=="jpg" || strtolower($doc_type)=="png"){
              echo"<img src='uzzipped/".$filesToView."'>";
            }else if($doc_type=="pdf"){
                echo "<iframe name='myiframe' style='width:100%; height:700px;' id='myiframe' src='uzzipped/".$filesToView."'>";
            }
        }
        if($action=='download'){
            echo "<br><br><br><br><br><br><br><br><br><br>";
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
 
        }
    }
    
}
function unzip($files){
    $zip = new ZipArchive;
    if ($zip->open('my-archive.zip') === TRUE) {
        $zip->extractTo('uzzipped/', array($files,$files));
        $zip->close();
        return true;
    } else {
        return false;
    }
}

?>