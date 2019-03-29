<?php

include_once("../../BackEnd/dataLayer.php");

if (isset($_COOKIE['t'])) {
    $dl = new dataLayer();
    $authenticated = $dl->authenticateToken();
} 

if($authenticated != true){
    header("Location:index.php");
}
?>