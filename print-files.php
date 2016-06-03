<?php
if(isset($_POST['id_doc'])&& isset($_POST['org_id'])&& isset($_POST['cat_id']) && isset($_POST['Doc_type'])){
    $id=$_POST['id_doc'];
    $org_id=$_POST['org_id'];
    $cat_id=$_POST['cat_id'];
    $doc_type=$_POST['Doc_type'];
    $filesToView=$org_id."/".$cat_id."/".$id.".".$doc_type;
    if(unzip($filesToView)){
        if(strtolower($doc_type)=="jpg" || strtolower($doc_type)=="png"){
          if (file_exists("uzzipped/".$filesToView)) {
                echo"<img src='uzzipped/".$filesToView."'>";
            }else{
                echo "<script>alert('file does not exists');</script>";
                echo "<script>window.close();</script>";
            }
        }else if($doc_type=="pdf"){
            if (file_exists("uzzipped/".$filesToView)) {
          
                    $filename = 'filename.pdf';
                    header('Content-type: application/pdf');
                    header('Content-Disposition: inline; filename="' . $filename . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Accept-Ranges: bytes');
                    @readfile('uzzipped/'.$filesToView);
            }else{
                echo "<script>alert('file does not exists');</script>";
                echo "<script>window.close();</script>";
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
