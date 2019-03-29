<?php 
include_once("../dataLayer.php");
$firstName= $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['password'];
$userType = $_POST['userType'];
$email = $_POST['email'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$validPassword = password_verify($password, $hash);
if($validPassword == true){
    $dl = new DataLayer();
 
    
        $insertUser = $dl->saveNewUser($firstName, $lastName, $email, $hash, $username, $userType);
        echo(json_encode($insertUser));
        return;
        
        
   
}else{
   echo("The passwords cannot be hashed");
}
