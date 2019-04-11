<?php 
include_once("../dataLayer.php");
$username = $_POST['username'];
$password = $_POST['password'];

$dl = new DataLayer();
$authenticated = $dl->login($username, $password);
if($authenticated == "USER_TESTER"){
        echo("authenticatedUT");
}else if($authenticated == "DEVELOPER"){
        echo("authenticatedD");
}
else{
    echo("not authenticated");
}
        
   

