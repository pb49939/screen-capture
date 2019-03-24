<?php
include_once("../dataLayer.php");

if (isset($_POST["userID"]))
{
$userID = $_POST["userID"];
}else{
    echo ("ERROR: No userID in request to get recordings.");
}


$dl = new dataLayer();
$tasks = $dl->getAllTasksForUserTester($userID);
echo(json_encode($tasks));

return;


?>