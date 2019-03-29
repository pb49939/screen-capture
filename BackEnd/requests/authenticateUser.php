<?php 
include_once("../dataLayer.php");
$username = $_POST['username'];
$password = $_POST['password'];

$dl = new DataLayer();
$authenticated = $dl->login($username, $password);
if($authenticated == true){
    echo("authenticated");
}else{
    echo("not authenticated");
}
        
   

