<?php
session_start();
require_once 'dbconfig.php'; //connection ?>
<?php
if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$user->login($username,$password);
}
if(isset($_REQUEST['firstname']) && isset($_REQUEST['lastname'])  && isset($_REQUEST['gender'])  && isset($_REQUEST['username'])){
    $firstname=$_REQUEST['firstname'];
    $lastname=$_REQUEST['lastname'];
    $gender=$_REQUEST['gender'];
    $username=$_REQUEST['username'];
    if($user->check_username($username)=="user_exist"){
        echo "user_exist";
    }
    else if($user->check_username($username)=="user_unfound"){
        echo $user->register($firstname,$lastname,$gender,$username);
    }
}
if(isset($_REQUEST['current']) && isset($_REQUEST['newPass']) && isset($_REQUEST['user'])){
    $username=$_REQUEST['user'];
    $current=md5($_REQUEST['current']);
    $newPass=md5($_REQUEST['newPass']);
    if($user->check_login($username,$current)=="ok"){
        echo $user->changePass($username,$current,$newPass);
    }
    else{
        echo "incorrect_pass";
    }
}
if(isset($_REQUEST['require_id']) && isset($_REQUEST['field'])){
$id=$_REQUEST['require_id'];
$field=$_REQUEST['field'];
$user->change_details($id,$field);
}
?>