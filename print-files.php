<?php
session_start(); //session is staring
require_once 'dbconfig.php'; 
if(isset($_POST['id_doc'])&& isset($_POST['org_id'])&& isset($_POST['cat_id']) && isset($_POST['Doc_type'])){
    $pass=md5($_POST['password']);
    $check_user=$user->check_login($_POST['username'],$pass);
	if($check_user!="ok"){
        echo "<script>alert('wrong password');</script>";
        echo "<script>window.close();</script>";
	}else{
        $id=$_POST['id_doc'];
        $org_id=$_POST['org_id'];
        $cat_id=$_POST['cat_id'];
        $doc_type=$_POST['Doc_type'];
        $sub_categorie=$user->check_subdirectory($id);
        if($sub_categorie=="no sub-directory"){
            $filesToView=$org_id."/".$cat_id."/".$id.".".$doc_type;
        }else{
            $filesToView=$org_id."/".$cat_id."/".$sub_categorie."/".$id.".".$doc_type;
        }
        if(unzip($filesToView)){
            if(strtolower($doc_type)=="jpg" || strtolower($doc_type)=="png"){
              if (file_exists("uzzipped/".$filesToView)) {
                    $user->doc_action_done($_SESSION['current_session'],$id,"print");
                    echo"<img src='uzzipped/".$filesToView."'>";
                    echo "<script>window.print();</script>";
                }else{
                    echo "<script>alert('file does not exists');</script>";
                    echo "<script>window.close();</script>";
                }
            }else if($doc_type=="pdf"){
                if (file_exists("uzzipped/".$filesToView)) {
                        $user->doc_action_done($_SESSION['current_session'],$id,"print");
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
