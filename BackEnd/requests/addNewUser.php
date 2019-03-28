<?php 
include_once("../dataLayer.php");
$firstName= $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['userName'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);
echo($hash);
$validPassword = password_verify($password, $hash);
if($validPassword == true){
    $dl = new DataLayer();
 
    
        $insertUser = $dl->saveNewUser($firstName, $lastName, "test", $hash, $username, "developer");
        
        
   
}else{
   echo("The passwords do not match");
}
